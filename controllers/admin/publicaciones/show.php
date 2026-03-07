<?php

use Core\App;
use Models\Publicacion;

$db    = App::resolve('Core\Database');
$model = new Publicacion($db);

$id   = $_GET['id'] ?? null;
$post = $id ? $model->find($id) : null;

if (!$post) {
    abort(404);
}

view('admin/post-detalle.php', [
    'post' => $post,
]);
