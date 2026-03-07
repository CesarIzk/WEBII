<?php

use Core\App;
use Models\User;

$db        = App::resolve('Core\Database');
$userModel = new User($db);

$usuarioActual = $_SESSION['user']['idUsuario'] ?? null;

$perfil        = $userModel->find($usuarioActual);
$publicaciones = $userModel->publicaciones($usuarioActual);
$usuarios      = $userModel->buscar($_GET['q'] ?? '', $usuarioActual);

view('registration/perfil.view.php', [
    'perfil'        => $perfil,
    'publicaciones' => $publicaciones,
    'usuarios'      => $usuarios,
]);