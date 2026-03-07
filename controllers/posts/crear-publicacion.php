<?php

use Core\App;
use Models\Publicacion;
use Models\Categoria;

$db             = App::resolve('Core\Database');
$model          = new Publicacion($db);
$categoriaModel = new Categoria($db);
$categorias     = $categoriaModel->all();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $texto       = trim($_POST['texto'] ?? '');
    $tipo        = $_POST['tipoContenido'] ?? 'texto';
    $idCategoria = $_POST['idCategoria'] ?? null;
    $rutaMulti   = null;

    // Validación básica
    if (empty($texto)) {
        $errors['texto'] = 'El contenido no puede estar vacío.';
    }

    // Subida de archivo si hay imagen o video
    if (empty($errors) && !empty($_FILES['archivo']['name'])) {
        $ext        = strtolower(pathinfo($_FILES['archivo']['name'], PATHINFO_EXTENSION));
        $permitidos = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'mp4', 'mov', 'avi'];

        if (!in_array($ext, $permitidos)) {
            $errors['archivo'] = 'Formato de archivo no permitido.';
        } else {
            $nombre  = time() . '_' . basename($_FILES['archivo']['name']);
            $carpeta = __DIR__ . '/../../public/uploads/post/';

            if (!is_dir($carpeta)) {
                mkdir($carpeta, 0755, true);
            }

            $destino = $carpeta . $nombre;

            if (move_uploaded_file($_FILES['archivo']['tmp_name'], $destino)) {
                $rutaMulti = 'uploads/post/' . $nombre;
            } else {
                $errors['archivo'] = 'Error al subir el archivo.';
            }
        }
    }

    if (empty($errors)) {
        $model->create([
            'idUsuario'     => $_SESSION['user']['idUsuario'],
            'texto'         => $texto,
            'tipoContenido' => $tipo,
            'rutaMulti'     => $rutaMulti,
            'idCategoria'   => $idCategoria ?: null,
        ]);

        header('Location: /publicaciones');
        exit();
    }
}

view('posts/crear-publicacion.view.php', [
    'errors'     => $errors,
    'categorias' => $categorias,
]);