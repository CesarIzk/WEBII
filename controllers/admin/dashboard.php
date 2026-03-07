<?php

use Core\App;

$db = App::resolve('Core\Database');

// --- Estadísticas generales (usa la vista vw_estadisticas_generales) ---
$statsRaw = $db->query("SELECT * FROM vw_estadisticas_generales")->find();

$stats = [
    'total_usuarios'      => $statsRaw['totalUsuarios']     ?? 0,
    'total_publicaciones' => $statsRaw['totalPublicaciones'] ?? 0,
    'total_comentarios'   => $statsRaw['totalComentarios']   ?? 0,
    'total_likes'         => $statsRaw['totalLikes']         ?? 0,

    'usuarios_hoy'      => $db->query(
        "SELECT COUNT(*) AS total FROM users WHERE DATE(fechaRegistro) = CURDATE()"
    )->find()['total'] ?? 0,

    'publicaciones_hoy' => $db->query(
        "SELECT COUNT(*) AS total FROM publicaciones WHERE DATE(postdate) = CURDATE()"
    )->find()['total'] ?? 0,

    'usuarios_activos'  => $db->query(
        "SELECT COUNT(*) AS total FROM vw_usuarios_activos"
    )->find()['total'] ?? 0,

    'contenido_oculto'  => $db->query(
        "SELECT COUNT(*) AS total FROM publicaciones WHERE estado = 'oculto'"
    )->find()['total'] ?? 0,
];

// --- Top usuarios por interacción (usa vw_promedio_interacciones) ---
$topUsuarios = $db->query(
    "SELECT username AS nombre, totalPublicaciones AS publicaciones, promedioInteraccion
     FROM vw_promedio_interacciones
     ORDER BY totalPublicaciones DESC
     LIMIT 5"
)->get();

// --- Actividad reciente (usa vw_publicaciones_detalle) ---
$actividadReciente = $db->query(
    "SELECT autor AS usuario,
            CONCAT('Publicó: ', LEFT(texto, 60), IF(LENGTH(texto) > 60, '...', '')) AS accion,
            postdate AS fecha
     FROM vw_publicaciones_detalle
     ORDER BY postdate DESC
     LIMIT 10"
)->get();

// --- Gráfico últimos 7 días (usa vw_reporte_diario) ---
// La vista tiene ONLY_FULL_GROUP_BY issue — lo desactivamos temporalmente para esta sesión
$db->query("SET SESSION sql_mode = (SELECT REPLACE(@@SESSION.sql_mode, 'ONLY_FULL_GROUP_BY', ''))");

$reporteDiario = $db->query(
    "SELECT fecha, nuevasPublicaciones, totalLikes, nuevosUsuarios
     FROM vw_reporte_diario
     ORDER BY fecha ASC
     LIMIT 7"
)->get();

// Restaurar sql_mode original
$db->query("SET SESSION sql_mode = (SELECT @@GLOBAL.sql_mode)");

// Preparar JSON para Chart.js
$chartLabels        = json_encode(array_column($reporteDiario, 'fecha'));
$chartPublicaciones = json_encode(array_column($reporteDiario, 'nuevasPublicaciones'));
$chartLikes         = json_encode(array_column($reporteDiario, 'totalLikes'));
$chartUsuarios      = json_encode(array_column($reporteDiario, 'nuevosUsuarios'));

view('admin/dashboard.php', [
    'stats'              => $stats,
    'topUsuarios'        => $topUsuarios,
    'actividadReciente'  => $actividadReciente,
    'chartLabels'        => $chartLabels,
    'chartPublicaciones' => $chartPublicaciones,
    'chartLikes'         => $chartLikes,
    'chartUsuarios'      => $chartUsuarios,
]);