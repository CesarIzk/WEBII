<?php

use Core\App;

$db = App::resolve('Core\Database');
$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: /admin/paises');
    exit();
}

$pais = $db->query(
    "SELECT * FROM paises WHERE idPais = :id",
    ['id' => $id]
)->find();

if (!$pais) {
    header('Location: /admin/paises');
    exit();
}

view('admin/paises_edit.php', [
    'pais'  => $pais,
    'error' => null,
]);