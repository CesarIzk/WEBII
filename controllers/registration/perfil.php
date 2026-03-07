<?php

use Core\App;
use Models\User;
use Models\Publicacion;

$db             = App::resolve('Core\Database');
$userModel      = new User($db);
$postModel      = new Publicacion($db);

$usuarioActual  = $_SESSION['user']['idUsuario'] ?? null;

// Si se visita el perfil de otro usuario (?id=X), mostrar ese; si no, el propio
$idPerfil       = $_GET['id'] ?? $usuarioActual;

$perfil        = $userModel->find($idPerfil);
$publicaciones = $postModel->buscarPorUsuario($idPerfil);
$usuarios      = $userModel->buscar($_GET['q'] ?? '', $usuarioActual);

view('registration/perfil.view.php', [
    'perfil'        => $perfil,
    'publicaciones' => $publicaciones,
    'usuarios'      => $usuarios,
]);