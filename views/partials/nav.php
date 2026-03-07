<nav>
    <div class="nav-wrap">
      <button class="menu-toggle" aria-label="Menú">
        <i class="fas fa-bars"></i>
      </button>

      <ul class="navbar" id="navbar-menu">
        <li><a href="/"><i class="fas fa-home"></i> <span>Inicio</span></a></li>
        <li><a href="/campeonatos"><i class="fas fa-trophy"></i> <span>Campeonatos</span></a></li>
        <li><a href="/equipo"><i class="fas fa-users"></i> <span>Equipos</span></a></li>
        <li><a href="/publicaciones"><i class="fas fa-calendar-alt"></i> <span>Publicaciones</span></a></li>
        <li><a href="/stats"><i class="fas fa-chart-bar"></i> <span>Estadísticas</span></a></li>
        <li><a href="/chat"><i class="fas fa-comments"></i> <span>Chat</span></a></li>
      </ul>

      <div class="auth-buttons">
        <a href="/crear-publicacion" class="btn-crear-post" title="Nueva Publicación">
          <i class="fas fa-plus-circle"></i> <span>Publicar</span>
        </a>

        <?php if (!empty($_SESSION['user'])): ?>
          <a href="/perfil" class="user-profile">
            <div class="user-avatar">
              <?= strtoupper(substr(htmlspecialchars($_SESSION['user']['Nombre'] ?? 'U'), 0, 1)) ?>
            </div>
            <span><?= htmlspecialchars($_SESSION['user']['Nombre'] ?? 'Usuario') ?></span>
          </a>

          <?php if (($_SESSION['user']['rol'] ?? '') === 'admin'): ?>
            <a href="/admin" class="btn btn-warning btn-sm" title="Panel de Administración">
              <i class="fas fa-shield-halved"></i>
            </a>
          <?php endif; ?>

          <form action="/logout" method="post" class="d-inline">
            <button type="submit" class="btn btn-danger btn-sm">
              <i class="fas fa-sign-out-alt"></i>
            </button>
          </form>
        <?php else: ?>
          <a href="/auth" class="btn-login">
            <i class="fas fa-sign-in-alt"></i> <span>Ingresar</span>
          </a>
        <?php endif; ?>
      </div>
    </div>
</nav>