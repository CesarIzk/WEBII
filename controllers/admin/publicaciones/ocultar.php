<?php

use Core\App;
use Models\Publicacion;

$db    = App::resolve('Core\Database');
$model = new Publicacion($db);

// El id viene de la URL capturado como query param ?id=X
// o del form como $_POST['id']
$id = $_POST['id'] ?? null;

if ($id) {
    $model->cambiarEstado($id, 'oculto');
    $_SESSION['flash_success'] = 'Publicación ocultada correctamente.';
}

header('Location: /admin/publicaciones');
exit();
