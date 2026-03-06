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

        <?php /* LÓGICA COMENTADA TEMPORALMENTE PARA VISUALIZACIÓN FRONT
        <?php if (!empty($_SESSION['user'])): ?>
          <span class="btn btn-sm btn-outline-light">
            <i class="fas fa-user me-1"></i>
            <?= htmlspecialchars($_SESSION['user']['nombre'] ?? 'Usuario') ?>
          </span>
          <a href="logout.php" class="btn btn-danger btn-sm">
            <i class="fas fa-sign-out-alt me-1"></i> <span>Salir</span>
          </a>
        <?php else: ?>
        */ ?>

          <a href="/auth" class="btn btn-primary btn-sm">
            <i class="fas fa-sign-in-alt me-1"></i> <span>Ingresar</span>
          </a>

        <?php /* <?php endif; ?> 
        */ ?>
      </div>
    </div>
</nav>