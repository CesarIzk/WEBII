<?php

use Core\App;

$db = App::resolve('Core\Database');

$paises = $db->query(
    "SELECT idPais AS id, codigo, nombre, continente,
            titulos, participaciones, bandera
     FROM paises
     ORDER BY nombre ASC"
)->get();

view('admin/paises_lista.php', [
    'paises'  => $paises,
    'success' => $_GET['success'] ?? null,
]);