<?php

use Core\App;

$db = App::resolve('Core\Database');

$fechaInicio = $_GET['fecha_inicio'] ?? date('Y-m-01');
$fechaFin    = $_GET['fecha_fin'] ?? date('Y-m-d');

// --- Métricas generales ---
$totalUsuarios = $db->query(
    "SELECT COUNT(*) AS t FROM users"
)->find()['t'] ?? 0;

$totalPublicaciones = $db->query(
    "SELECT COUNT(*) AS t FROM publicaciones"
)->find()['t'] ?? 0;

$totalLikes = $db->query(
    "SELECT COALESCE(SUM(likes),0) AS t FROM publicaciones"
)->find()['t'] ?? 0;

$likesPromedio = $totalPublicaciones > 0
    ? round($totalLikes / $totalPublicaciones, 1)
    : 0;


// --- Comparación mensual ---
$mesInicioAnterior = date('Y-m-01', strtotime('-1 month'));
$mesFinAnterior    = date('Y-m-t', strtotime('-1 month'));

$mesInicioActual = date('Y-m-01');
$mesFinActual    = date('Y-m-d');

$uMesAnt = $db->query(
    "SELECT COUNT(*) AS t FROM users 
     WHERE fechaRegistro BETWEEN :i AND :f",
    [
        'i' => $mesInicioAnterior,
        'f' => $mesFinAnterior
    ]
)->find()['t'] ?? 0;

$uMesAct = $db->query(
    "SELECT COUNT(*) AS t FROM users 
     WHERE fechaRegistro BETWEEN :i AND :f",
    [
        'i' => $mesInicioActual,
        'f' => $mesFinActual
    ]
)->find()['t'] ?? 0;

$pMesAnt = $db->query(
    "SELECT COUNT(*) AS t FROM publicaciones 
     WHERE postdate BETWEEN :i AND :f",
    [
        'i' => $mesInicioAnterior,
        'f' => $mesFinAnterior . ' 23:59:59'
    ]
)->find()['t'] ?? 0;

$pMesAct = $db->query(
    "SELECT COUNT(*) AS t FROM publicaciones 
     WHERE postdate BETWEEN :i AND :f",
    [
        'i' => $mesInicioActual,
        'f' => $mesFinActual . ' 23:59:59'
    ]
)->find()['t'] ?? 0;


// --- Métricas finales ---
$metricas = [
    'total_usuarios'      => $totalUsuarios,
    'total_publicaciones' => $totalPublicaciones,
    'total_likes'         => $totalLikes,
    'likes_promedio'      => $likesPromedio,

    'usuarios_pct' => $uMesAnt > 0
        ? round((($uMesAct - $uMesAnt) / $uMesAnt) * 100, 1)
        : 0,

    'publicaciones_pct' => $pMesAnt > 0
        ? round((($pMesAct - $pMesAnt) / $pMesAnt) * 100, 1)
        : 0,
];


// --- Reporte diario ---
$detalles = $db->query(
    "SELECT 
        fecha,
        nuevosUsuarios AS nuevos_usuarios,
        nuevasPublicaciones AS nuevas_publicaciones,
        totalLikes AS total_likes,
        0 AS usuarios_activos
     FROM vw_reporte_diario
     WHERE fecha BETWEEN :inicio AND :fin
     ORDER BY fecha ASC",
    [
        'inicio' => $fechaInicio,
        'fin'    => $fechaFin
    ]
)->get();


// --- Top usuarios ---
$topUsuarios = $db->query(
    "SELECT 
        username,
        totalPublicaciones AS posts
     FROM vw_promedio_interacciones
     ORDER BY totalPublicaciones DESC
     LIMIT 10"
)->get();


// --- Top publicaciones ---
$topPublicaciones = $db->query(
    "SELECT 
        texto,
        likes,
        username
     FROM vw_top_publicaciones
     LIMIT 10"
)->get();


// --- Enviar datos a la vista ---
view('admin/reportes.php', [
    'metricas'         => $metricas,
    'detalles'         => $detalles,
    'topUsuarios'      => $topUsuarios,
    'topPublicaciones' => $topPublicaciones
]);