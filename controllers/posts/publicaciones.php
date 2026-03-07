<?php

use Core\App;
use Models\Publicacion;
use Models\Comentario;
use Models\Like;

$db              = App::resolve('Core\Database');
$model           = new Publicacion($db);
$comentarioModel = new Comentario($db);
$likeModel       = new Like($db);

$usuarioId = $_SESSION['user']['idUsuario'] ?? null;

// --- Toggle like ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['_action'] ?? '') === 'like') {
    if (!$usuarioId) {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'error' => 'No autenticado']);
            exit;
        }
        header('Location: /auth');
        exit();
    }

    $id = $_POST['id'] ?? null;
    if ($id) {
        $ahora_tiene_like = $likeModel->toggle($id, $usuarioId);

        // Si la petición es AJAX
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'liked' => $ahora_tiene_like]);
            exit;
        }
    }
    header('Location: /publicaciones');
    exit();
}

// --- Eliminar publicación ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['_method'] ?? '') === 'DELETE') {
    $id   = $_POST['id'] ?? null;
    $post = $id ? $model->find($id) : null;

    if ($post && (int)$post['idUsuario'] === (int)$usuarioId) {
        $model->delete($id);
    }

    header('Location: /publicaciones');
    exit();
}

// --- Nuevo comentario ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['_action'] ?? '') === 'comentar') {
    $idPublicacion = $_POST['idPublicacion'] ?? null;
    $contenido     = trim($_POST['contenido'] ?? '');

    if ($idPublicacion && !empty($contenido) && $usuarioId) {
        $comentarioModel->create($idPublicacion, $usuarioId, $contenido);
        
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true, 
                'user_name' => $_SESSION['user']['Nombre'],
                'texto' => htmlspecialchars($contenido)
            ]);
            exit;
        }
    }
    header('Location: /publicaciones');
    exit();
}

// --- GET: feed ---
$q             = $_GET['q'] ?? '';
$publicaciones = $model->buscar($q);

// Adjuntar comentarios y estado de like del usuario actual
foreach ($publicaciones as &$post) {
    $post['comentarios_data'] = $comentarioModel->porPublicacion($post['id']);
    $post['usuario_dio_like'] = $usuarioId
        ? $likeModel->existe($post['id'], $usuarioId)
        : false;
}
unset($post);

view('posts/publicaciones.view.php', [
    'publicaciones' => $publicaciones,
    'q'             => $q,
]);