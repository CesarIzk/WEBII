<?php

use Core\App;
use Models\Publicacion;
use Models\Comentario;

$db             = App::resolve('Core\Database');
$model          = new Publicacion($db);
$comentarioModel = new Comentario($db);

// --- Eliminar publicación ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['_method'] ?? '') === 'DELETE') {
    $id   = $_POST['id'] ?? null;
    $post = $id ? $model->find($id) : null;

    if ($post && (int)$post['idUsuario'] === (int)($_SESSION['user']['idUsuario'] ?? 0)) {
        $model->delete($id);
    }

    header('Location: /publicaciones');
    exit();
}

// --- Nuevo comentario ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['_action'] ?? '') === 'comentar') {
    $idPublicacion = $_POST['idPublicacion'] ?? null;
    $contenido     = trim($_POST['contenido'] ?? '');

    if ($idPublicacion && !empty($contenido)) {
        $comentarioModel->create(
            $idPublicacion,
            $_SESSION['user']['idUsuario'],
            $contenido
        );
    }

    header('Location: /publicaciones');
    exit();
}

// --- GET: feed con comentarios cargados ---
$q             = $_GET['q'] ?? '';
$publicaciones = $model->buscar($q);

// Adjuntar comentarios a cada publicación
foreach ($publicaciones as &$post) {
    $post['comentarios_data'] = $comentarioModel->porPublicacion($post['id']);
}
unset($post);

view('posts/publicaciones.view.php', [
    'publicaciones' => $publicaciones,
    'q'             => $q,
]);