<?php

use Core\App;

$db = App::resolve('Core\Database');

$success = null;
$error   = null;

$usuarios = $db->query(
    "SELECT idUsuario AS id, Nombre AS nombre, username, email,
            pais, rol, estado,
            (estado = 'activo') AS activo,
            fechaRegistro AS fecha_registro
     FROM users
     ORDER BY fechaRegistro DESC"
)->get();

view('admin/usuarios.php', [
    'usuarios' => $usuarios,
    'success'  => $_GET['success'] ?? null,
    'error'    => $_GET['error']   ?? null,
]);
