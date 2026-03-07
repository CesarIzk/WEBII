<?php

use Core\App;
use Models\Publicacion;

$db    = App::resolve('Core\Database');
$model = new Publicacion($db);

$id = $_POST['id'] ?? null;

if ($id) {
    $model->cambiarEstado($id, 'publico');
    $_SESSION['flash_success'] = 'Publicación publicada nuevamente.';
}

header('Location: /admin/publicaciones');
exit();
