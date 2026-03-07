<?php

use Core\App;

$db = App::resolve('Core\Database');
$id = $_POST['id'] ?? null;

if ($id) {
    $db->query("DELETE FROM paises WHERE idPais = :id", ['id' => $id]);
}

header('Location: /admin/paises?success=País eliminado correctamente');
exit();