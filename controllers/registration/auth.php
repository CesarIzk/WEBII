<?php

use Core\App;
use Models\User;

$db        = App::resolve('Core\Database');
$userModel = new User($db);

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $action = $_POST['action'] ?? '';

    // ─── LOGIN ───────────────────────────────────────────────
    if ($action === 'login') {
        $email    = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            $errors['login'] = 'Por favor completa todos los campos.';
        } else {
            $user = $userModel->attempt($email, $password);

            if ($user) {
                login($user);
                header('Location: /');
                exit();
            }

            $errors['login'] = 'Correo o contraseña incorrectos.';
        }

    // ─── REGISTRO ────────────────────────────────────────────
    } elseif ($action === 'register') {
        $nombre   = trim($_POST['nombre'] ?? '');
        $correo   = trim($_POST['correo'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirm  = $_POST['password_confirm'] ?? '';
        $fecha    = $_POST['fecha_nacimiento'] ?? '';
        $genero   = $_POST['genero'] ?? '';

        if (empty($nombre) || empty($correo) || empty($password)) {
            $errors['register'] = 'Por favor completa todos los campos.';
        } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $errors['register'] = 'El correo no tiene un formato válido.';
        } elseif ($password !== $confirm) {
            $errors['register'] = 'Las contraseñas no coinciden.';
        } elseif ($userModel->findByEmail($correo)) {
            $errors['register'] = 'Ya existe una cuenta con ese correo.';
        } else {
            $userModel->create([
                'nombre'           => $nombre,
                'correo'           => $correo,
                'password'         => $password,
                'fecha_nacimiento' => $fecha,
                'genero'           => $genero,
            ]);

            header('Location: /login?registered=true');
            exit();
        }
    }
}

view('registration/auth.view.php', [
    'errors' => $errors,
]);