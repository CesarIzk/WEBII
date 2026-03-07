<?php

use Core\App;

$db = App::resolve('Core\Database');

$codigo          = trim($_POST['codigo']          ?? '');
$nombre          = trim($_POST['nombre']          ?? '');
$continente      = trim($_POST['continente']      ?? '');
$titulos         = (int)($_POST['titulos']         ?? 0);
$participaciones = (int)($_POST['participaciones'] ?? 0);
$entrenador      = trim($_POST['entrenador']      ?? '');
$mejorJugador    = trim($_POST['mejorJugador']    ?? '');
$bandera         = trim($_POST['bandera']         ?? '');
$descripcion     = trim($_POST['descripcion']     ?? '');
$historia        = trim($_POST['historia']        ?? '');

if (empty($codigo) || empty($nombre)) {
    view('admin/paises_crear.php', [
        'error' => 'El código y el nombre son obligatorios.',
    ]);
    exit();
}

$existe = $db->query(
    "SELECT idPais FROM paises WHERE codigo = :codigo",
    ['codigo' => $codigo]
)->find();

if ($existe) {
    view('admin/paises_crear.php', [
        'error' => 'Ya existe un país con ese código.',
    ]);
    exit();
}

$db->query(
    "INSERT INTO paises
        (codigo, nombre, continente, titulos, participaciones,
         entrenador, mejorJugador, bandera, descripcion, historia)
     VALUES
        (:codigo, :nombre, :continente, :titulos, :participaciones,
         :entrenador, :mejorJugador, :bandera, :descripcion, :historia)",
    compact('codigo','nombre','continente','titulos','participaciones',
            'entrenador','mejorJugador','bandera','descripcion','historia')
);

header('Location: /admin/paises?success=País creado correctamente');
exit();