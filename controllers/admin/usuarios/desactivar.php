<?php

use Core\App;

$db = App::resolve('Core\Database');
$id = $_POST['id'] ?? null;

// No permitir que el admin se desactive a sí mismo
$usuarioActualId = $_SESSION['user']['idUsuario'] ?? null;
if ($id && (int)$id === (int)$usuarioActualId) {
    header('Location: /admin/usuarios?error=No puedes desactivarte a ti mismo');
    exit();
}

if ($id) {
    $db->query(
        "UPDATE users SET estado = 'inactivo' WHERE idUsuario = :id",
        ['id' => $id]
    );
}

header('Location: /admin/usuarios?success=Usuario desactivado correctamente');
exit();
