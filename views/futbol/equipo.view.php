<?php $pageTitle = 'MundialFan - Equipos'; ?>
<?php require_once __DIR__ . '/../partials/head.php'; ?>
<?php require_once __DIR__ . '/../partials/header.php'; ?>
<?php require_once __DIR__ . '/../partials/nav.php'; ?>

<section class="hero hero-equipos">
  <div class="hero-contenido">
    <h2>Equipos del Mundial</h2>
    <p>Selecciona un país para ver su historia, logros y material multimedia.</p>
  </div>
</section>

<section class="caracteristicas">
  <div class="contenedor">
    <h2 class="titulo-seccion">Explora las Selecciones Nacionales</h2>

    <?php if (!empty($paises)): ?>
      <!-- Selector de país -->
      <div class="selector-pais mb-4">
        <label for="paisSelect">Selecciona un país:</label>
        <select id="paisSelect" onchange="redirigirPais()" class="form-select">
          <option value="">-- Elegir --</option>
          <?php foreach ($paises as $pais): ?>
            <option value="/equipo/<?= $pais['slug'] ?>">
              <?= htmlspecialchars($pais['nombre']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <!-- Galería de banderas -->
      <div class="paises-grid">
        <?php foreach ($paises as $pais): ?>
          <article class="team-card">
            <a class="team-card__link" href="/equipo/<?= $pais['slug'] ?>"
               aria-label="Ver información de <?= htmlspecialchars($pais['nombre']) ?>">
              <img class="team-card__flag" src="/<?= htmlspecialchars($pais['bandera']) ?>"
                   alt="Bandera de <?= htmlspecialchars($pais['nombre']) ?>">
              <h3 class="team-card__name"><?= htmlspecialchars($pais['nombre']) ?></h3>
              <p class="team-card__meta"><?= htmlspecialchars($pais['confederacion']) ?></p>
            </a>
          </article>
        <?php endforeach; ?>
      </div>

    <?php else: ?>
      <p class="text-center text-muted py-5">
        No hay países registrados actualmente.
        El administrador puede agregarlos desde el panel de administración.
      </p>
    <?php endif; ?>
  </div>
</section>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
