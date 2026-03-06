<?php

use Core\Database;
use Models\User;

$config = require base_path('config.php');
$db = new Database($config['database']);
$userModel = new User($db);

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $action = $_POST['action'] ?? '';

    if ($action === 'login') {
        $email    = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $user = $userModel->attempt($email, $password);

   if ($user) {
    error_log('Sesión iniciada: ' . $user['email'] . ' | Nombre: ' . $user['Nombre']);
    login($user);
    header('location: /');
    exit();
}else{
     error_log('No se encontro user');
}

        $errors['login'] = 'Correo o contraseña incorrectos.';

    } elseif ($action === 'register') {

        if ($_POST['password'] !== $_POST['password_confirm']) {
            $errors['register'] = 'Las contraseñas no coinciden.';
        } else {
            $userModel->create([
                'nombre'           => trim($_POST['nombre'] ?? ''),
                'correo'           => trim($_POST['correo'] ?? ''),
                'password'         => $_POST['password'],
                'fecha_nacimiento' => $_POST['fecha_nacimiento'] ?? '',
                'genero'           => $_POST['genero'] ?? '',
            ]);

            header('location: /login?registered=true');
            exit();
        }
    }
}

view('registration/auth.view.php', [
    'errors' => $errors
]);