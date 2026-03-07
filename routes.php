<?php

// ============================================================
// RUTAS PÚBLICAS
// ============================================================
$router->get('/', 'controllers/index.php');
$router->get('/about', 'controllers/about.php');
$router->get('/contact', 'controllers/contact.php');

// ============================================================
// AUTENTICACIÓN
// ============================================================
$router->get('/login', 'controllers/registration/auth.php')->only('guest');
$router->post('/login', 'controllers/registration/auth.php')->only('guest');
$router->post('/logout', 'controllers/registration/logout.php')->only('auth');
$router->get('/auth', 'controllers/registration/auth.php');
// Perfil y configuración
$router->get('/perfil', 'controllers/registration/perfil.php')->only('auth');
$router->get('/configuracion', 'controllers/registration/configuracion.php')->only('auth');
$router->post('/configuracion', 'controllers/registration/configuracion.php')->only('auth');

// ============================================================
// FÚTBOL
// ============================================================
$router->get('/equipo', 'controllers/futbol/equipo.php');
$router->get('/equipo/{slug}', 'controllers/futbol/equipo-detalle.php');
$router->get('/campeonatos', 'controllers/futbol/campeonatos.php');
$router->get('/stats', 'controllers/futbol/stats.php');

// ============================================================
// PUBLICACIONES
// ============================================================
$router->get('/publicaciones', 'controllers/posts/publicaciones.php');
$router->get('/crear-publicacion', 'controllers/posts/crear-publicacion.php')->only('auth');
$router->post('/publicaciones', 'controllers/posts/crear-publicacion.php')->only('auth');
$router->delete('/publicaciones', 'controllers/posts/publicaciones.php')->only('auth');

// ============================================================
// SOCIAL
// ============================================================
$router->get('/chat', 'controllers/social/chat.php');


// ============================================================
// ADMINISTRACIÓN
// ============================================================
$router->get('/admin', 'controllers/admin/dashboard.php')->only('auth');
$router->get('/admin/dashboard', 'controllers/admin/dashboard.php')->only('auth');

// Países
$router->get('/admin/paises', 'controllers/admin/paises/index.php')->only('auth');
$router->get('/admin/paises/crear', 'controllers/admin/paises/create.php')->only('auth');
$router->post('/admin/paises', 'controllers/admin/paises/store.php')->only('auth');
$router->get('/admin/paises/edit', 'controllers/admin/paises/edit.php')->only('auth');
$router->patch('/admin/paises', 'controllers/admin/paises/update.php')->only('auth');
$router->delete('/admin/paises', 'controllers/admin/paises/destroy.php')->only('auth');

// Usuarios
$router->get('/admin/usuarios', 'controllers/admin/usuarios/index.php')->only('auth');
$router->post('/admin/usuarios/activar', 'controllers/admin/usuarios/activar.php')->only('auth');
$router->post('/admin/usuarios/desactivar', 'controllers/admin/usuarios/desactivar.php')->only('auth');

// Publicaciones admin
$router->get('/admin/publicaciones', 'controllers/admin/publicaciones/index.php')->only('auth');
$router->get('/admin/publicaciones/detalle', 'controllers/admin/publicaciones/show.php')->only('auth');
$router->post('/admin/publicaciones/ocultar', 'controllers/admin/publicaciones/ocultar.php')->only('auth');
$router->post('/admin/publicaciones/mostrar', 'controllers/admin/publicaciones/mostrar.php')->only('auth');

// Reportes
$router->get('/admin/reportes', 'controllers/admin/reportes/index.php')->only('auth');

// Crear Admin
$router->get('/admin/crear-admin', 'controllers/admin/usuarios/create.php')->only('auth');
$router->post('/admin/crear-admin', 'controllers/admin/usuarios/store.php')->only('auth');
