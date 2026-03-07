<?php

use Core\App;

$db = App::resolve('Core\Database');

$nombre              = trim($_POST['nombre']               ?? '');
$email               = trim($_POST['email']                ?? '');
$username            = trim($_POST['username']             ?? '');
$password            = $_POST['password']                  ?? '';
$confirmNew          = $_POST['confirm_new_password']      ?? '';
$confirmAdminPass    = $_POST['confirm_admin_password']    ?? '';

$error   = null;
$success = null;

// Validaciones
if (empty($nombre) || empty($email) || empty($username) || empty($password)) {
    $error = 'Por favor completa todos los campos.';

} elseif ($password !== $confirmNew) {
    $error = 'Las contraseñas del nuevo administrador no coinciden.';

} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = 'El correo no tiene un formato válido.';

} else {
    // Verificar contraseña del admin actual
    $adminActual = $db->query(
        "SELECT contrasena FROM users WHERE idUsuario = :id",
        ['id' => $_SESSION['user']['idUsuario']]
    )->find();

    if (!$adminActual || $adminActual['contrasena'] !== $confirmAdminPass) {
        $error = 'Tu contraseña de confirmación es incorrecta.';

    } else {
        // Verificar que email y username no estén en uso
        $emailExiste    = $db->query("SELECT idUsuario FROM users WHERE email    = :v", ['v' => $email])->find();
        $usernameExiste = $db->query("SELECT idUsuario FROM users WHERE username = :v", ['v' => $username])->find();

        if ($emailExiste) {
            $error = 'Ya existe una cuenta con ese correo.';
        } elseif ($usernameExiste) {
            $error = 'Ese nombre de usuario ya está en uso.';
        } else {
            $db->query(
                "INSERT INTO users (Nombre, username, email, contrasena, rol)
                 VALUES (:nombre, :username, :email, :contrasena, 'admin')",
                [
                    'nombre'     => $nombre,
                    'username'   => $username,
                    'email'      => $email,
                    'contrasena' => $password,
                ]
            );

            $success = "Administrador '{$nombre}' creado correctamente.";
        }
    }
}

view('admin/crear-admin.php', [
    'error'   => $error,
    'success' => $success,
]);
