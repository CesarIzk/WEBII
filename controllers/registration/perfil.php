<?php
$model = new users($db);
$datosUsuario = $model->find($_SESSION['user_id']); // Ejemplo de uso

view('registration/perfil.view.php', [
    'usuario' => $datosUsuario
]);