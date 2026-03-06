<?php
// Título de la página (se usa en head.php)
$pageTitle = 'MundialFan - Todo sobre el Mundial de Fútbol';

require_once 'partials/head.php';
require_once 'partials/header.php';
require_once 'partials/nav.php';
?>

<section class="hero">
    <div class="hero-slideshow">
      <div class="hero-slide"></div>
      <div class="hero-slide"></div>
      <div class="hero-slide"></div>
    </div>

    <div class="hero-contenido">
      <h2>Vive la Emoción del Mundial</h2>
      <p>Todo lo que necesitas saber sobre el mayor evento de fútbol del planeta. Noticias, estadísticas, resultados y mucho más.</p>
    </div>

    <div class="hero-indicators">
      <span class="hero-indicator"></span>
      <span class="hero-indicator"></span>
      <span class="hero-indicator"></span>
    </div>
</section>

<section class="caracteristicas">
  <div class="contenedor">
    <h2 class="titulo-seccion">Todo sobre el Mundial</h2>

    <div class="caracteristicas-grid">
      <a class="caracteristica caracteristica--link" href="campeonatos.php">
        <i class="fas fa-trophy"></i>
        <h3>Campeonatos</h3>
        <p>Explora la historia, campeones y ediciones del Mundial.</p>
      </a>

      <a class="caracteristica caracteristica--link" href="stats.php">
        <i class="fas fa-chart-bar"></i>
        <h3>Estadísticas</h3>
        <p>Tablas, grupos 2026 y estadísticas generales del torneo.</p>
      </a>

      <a class="caracteristica caracteristica--link" href="chat.php">
        <i class="fas fa-comments"></i>
        <h3>Chat</h3>
        <p>Habla con amigos y grupos.</p>
      </a>

      <a class="caracteristica caracteristica--link" href="equipo.php">
        <i class="fas fa-users"></i>
        <h3>Equipos</h3>
        <p>Consulta selecciones y fichas de equipos.</p>
      </a>

      <a class="caracteristica caracteristica--link" href="publicaciones.php">
        <i class="fas fa-newspaper"></i>
        <h3>Publicaciones</h3>
        <p>Posts, noticias y contenido de la comunidad.</p>
      </a>
    </div>
  </div>
</section>

<?php require_once 'partials/footer.php'; ?>

</body>
</html>