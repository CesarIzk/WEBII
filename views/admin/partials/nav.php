<?php
// Detecta la URI actual para marcar el ítem activo
$currentUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
function adminNavActive(string $path): string {
    global $currentUri;
    return str_starts_with($currentUri, $path) ? 'active' : '';
}
?>
<nav class="admin-nav">
  <div class="nav-wrap d-flex align-items-center justify-content-between">

    <button class="menu-toggle admin-toggle btn btn-outline-light" aria-label="Menú">
      <i class="fas fa-bars"></i>
    </button>

    <ul class="navbar d-flex flex-wrap align-items-center gap-3" id="admin-navbar-menu">
      <li><a href="/admin/dashboard" class="<?= adminNavActive('/admin/dashboard') ?>">
        <i class="fas fa-tachometer-alt"></i> <span>Dashboard</span>
      </a></li>
      <li><a href="/admin/usuarios" class="<?= adminNavActive('/admin/usuarios') ?>">
        <i class="fas fa-users-cog"></i> <span>Usuarios</span>
      </a></li>
      <li><a href="/admin/publicaciones" class="<?= adminNavActive('/admin/publicaciones') ?>">
        <i class="fas fa-file-alt"></i> <span>Publicaciones</span>
      </a></li>
      <li><a href="/admin/paises" class="<?= adminNavActive('/admin/paises') ?>">
        <i class="fas fa-flag"></i> <span>Países</span>
      </a></li>
      <li><a href="/admin/reportes" class="<?= adminNavActive('/admin/reportes') ?>">
        <i class="fas fa-chart-line"></i> <span>Reportes</span>
      </a></li>
      <li><a href="/admin/crear-admin" class="<?= adminNavActive('/admin/crear-admin') ?>">
        <i class="fas fa-user-shield"></i> <span>Crear Admin</span>
      </a></li>
      <li><a href="/">
        <i class="fas fa-globe"></i> <span>Ver Sitio</span>
      </a></li>
    </ul>

    <div class="auth-buttons d-flex align-items-center gap-3">
      <button id="toggle-mode-header" class="toggle-btn btn btn-outline-light" aria-label="Cambiar modo">
        <i class="fas fa-moon"></i>
      </button>

      <div class="dropdown">
        <button
          class="btn btn-light btn-sm d-flex align-items-center gap-2"
          id="adminDropdown"
          data-bs-toggle="dropdown"
          aria-expanded="false"
        >
          <div class="user-avatar rounded-circle text-white d-flex align-items-center justify-content-center"
               style="width:32px; height:32px; background-color:#c0392b;">
            <?= strtoupper(substr($_SESSION['user']['nombre'] ?? '?', 0, 1)) ?>
          </div>
          <span class="d-none d-md-inline text-dark">
            <?= htmlspecialchars($_SESSION['user']['nombre'] ?? '') ?>
          </span>
          <i class="fas fa-chevron-down small text-muted"></i>
        </button>
        <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="adminDropdown">
          <li><a class="dropdown-item" href="/perfil">
            <i class="fas fa-user me-2"></i> Mi Perfil
          </a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item text-danger" href="/logout">
            <i class="fas fa-sign-out-alt me-2"></i> Cerrar Sesión
          </a></li>
        </ul>
      </div>
    </div>

  </div>
</nav>
