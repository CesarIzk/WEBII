<?php

use Core\App;

$db = App::resolve('Core\Database');
$id = $_POST['id'] ?? null;

if ($id) {
    $db->query(
        "UPDATE users SET estado = 'activo' WHERE idUsuario = :id",
        ['id' => $id]
    );
}

header('Location: /admin/usuarios?success=Usuario activado correctamente');
exit();
