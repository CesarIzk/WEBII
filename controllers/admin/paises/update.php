<?php

use Core\App;

$db = App::resolve('Core\Database');
$id = $_POST['id'] ?? null;

if (!$id) {
    header('Location: /admin/paises');
    exit();
}

$nombre          = trim($_POST['nombre']          ?? '');
$continente      = trim($_POST['continente']      ?? '');
$titulos         = (int)($_POST['titulos']         ?? 0);
$participaciones = (int)($_POST['participaciones'] ?? 0);
$entrenador      = trim($_POST['entrenador']      ?? '');
$mejorJugador    = trim($_POST['mejorJugador']    ?? '');
$bandera         = trim($_POST['bandera']         ?? '');
$descripcion     = trim($_POST['descripcion']     ?? '');
$historia        = trim($_POST['historia']        ?? '');

if (empty($nombre)) {
    $pais = $db->query("SELECT * FROM paises WHERE idPais = :id", ['id' => $id])->find();
    view('admin/paises_edit.php', [
        'pais'  => $pais,
        'error' => 'El nombre es obligatorio.',
    ]);
    exit();
}

$db->query(
    "UPDATE paises
     SET nombre = :nombre, continente = :continente, titulos = :titulos,
         participaciones = :participaciones, entrenador = :entrenador,
         mejorJugador = :mejorJugador, bandera = :bandera,
         descripcion = :descripcion, historia = :historia
     WHERE idPais = :id",
    compact('nombre','continente','titulos','participaciones',
            'entrenador','mejorJugador','bandera','descripcion','historia','id')
);

header('Location: /admin/paises?success=País actualizado correctamente');
exit();