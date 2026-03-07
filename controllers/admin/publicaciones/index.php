<?php

use Core\App;
use Models\Publicacion;

$db    = App::resolve('Core\Database');
$model = new Publicacion($db);

// --- Ocultar publicación ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['_action'] ?? '') === 'ocultar') {
    $id = $_POST['id'] ?? null;
    if ($id) {
        $model->cambiarEstado($id, 'oculto');
        $_SESSION['flash_success'] = 'Publicación ocultada correctamente.';
    }
    header('Location: /admin/publicaciones');
    exit();
}

// --- Mostrar publicación ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['_action'] ?? '') === 'mostrar') {
    $id = $_POST['id'] ?? null;
    if ($id) {
        $model->cambiarEstado($id, 'publico');
        $_SESSION['flash_success'] = 'Publicación publicada nuevamente.';
    }
    header('Location: /admin/publicaciones');
    exit();
}

// --- GET: listar todas ---
$raw = $model->allAdmin();

// Mapear campos del modelo a los que espera la vista
$publicaciones = array_map(fn($p) => [
    'id'      => $p['id'],
    'autor'   => $p['autor'],
    'texto'   => $p['texto'],
    'tipo'    => $p['tipoContenido'] ?? 'texto',
    'fecha'   => $p['fecha'],
    'visible' => $p['estado'] === 'publico',
], $raw);

$success = $_SESSION['flash_success'] ?? null;
unset($_SESSION['flash_success']);

view('admin/publicaciones.php', [
    'publicaciones' => $publicaciones,
    'success'       => $success,
]);
