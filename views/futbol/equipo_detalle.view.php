<?php $pageTitle = 'MundialFan - ' . htmlspecialchars($pais['nombre'] ?? 'Equipo'); ?>
<?php require_once __DIR__ . '/../partials/head.php'; ?>
<?php require_once __DIR__ . '/../partials/header.php'; ?>
<?php require_once __DIR__ . '/../partials/nav.php'; ?>

<main class="contenedor" style="padding: 2rem 0 2.5rem;">
  <a href="/equipo" style="text-decoration:none; display:inline-flex; gap:8px; align-items:center; opacity:.85;">
    <i class="fas fa-arrow-left"></i> Volver a Equipos
  </a>

  <?php if (empty($pais)): ?>
    <!-- País sin información -->
    <section class="hero hero-pais" style="background: linear-gradient(135deg, #333, #111);">
      <div class="overlay"></div>
      <div class="hero-contenido text-center">
        <p class="text-muted">🚧 Este país aún no tiene información registrada.</p>
      </div>
    </section>
    <section class="caracteristicas">
      <div class="contenedor text-center py-5">
        <p class="text-muted mb-4">Aún no hay datos sobre este país, pero el equipo de administración está trabajando en ello.</p>
        <a href="/equipo" class="btn btn-outline-primary">
          <i class="fas fa-arrow-left"></i> Volver a Equipos
        </a>
      </div>
    </section>

  <?php else: ?>
    <section class="card shadow-sm border-0 rounded-4 mt-3 overflow-hidden">
      <!-- Banner con colores del país -->
      <div style="height:160px; background: <?= htmlspecialchars($pais['banner_css'] ?? 'linear-gradient(90deg,#333,#111)') ?>;"></div>

      <div class="card-body p-4">
        <div class="d-flex flex-column flex-md-row align-items-md-end gap-3" style="margin-top:-70px;">
          <img src="/<?= htmlspecialchars($pais['bandera']) ?>"
               alt="Bandera de <?= htmlspecialchars($pais['nombre']) ?>"
               style="width:140px;height:96px;object-fit:cover;border-radius:14px;border:6px solid var(--surface);">
          <div class="flex-grow-1">
            <h1 class="m-0" style="font-size:26px;"><?= htmlspecialchars($pais['nombre']) ?></h1>
            <p class="m-0" style="opacity:.8;"><?= htmlspecialchars($pais['confederacion']) ?></p>
          </div>
        </div>

        <hr class="my-4">

        <div class="row g-3">
          <div class="col-12 col-md-4">
            <div class="p-3 rounded-4 border" style="background:var(--bg);">
              <strong>Entrenador:</strong> <?= htmlspecialchars($pais['entrenador'] ?? '—') ?>
            </div>
          </div>
          <div class="col-12 col-md-4">
            <div class="p-3 rounded-4 border" style="background:var(--bg);">
              <strong>Capitán:</strong> <?= htmlspecialchars($pais['capitan'] ?? '—') ?>
            </div>
          </div>
          <div class="col-12 col-md-4">
            <div class="p-3 rounded-4 border" style="background:var(--bg);">
              <strong>Ranking:</strong> <?= htmlspecialchars($pais['ranking'] ?? '—') ?>
            </div>
          </div>
          <div class="col-12">
            <div class="p-3 rounded-4 border" style="background:var(--bg);">
              <strong>Descripción:</strong>
              <div style="opacity:.9; margin-top:6px;"><?= htmlspecialchars($pais['descripcion'] ?? '') ?></div>
            </div>
          </div>
        </div>

        <h2 class="h5 mt-4 mb-3"><i class="fas fa-list me-2"></i>Plantilla / Jugadores</h2>
        <div class="table-responsive">
          <table class="table table-hover align-middle">
            <thead>
              <tr>
                <th>Jugador</th><th>Posición</th><th>Dorsal</th>
                <th>Goles</th><th>Amarillas</th><th>Rojas</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($jugadores)): ?>
                <?php foreach ($jugadores as $j): ?>
                  <tr>
                    <td><?= htmlspecialchars($j['nombre']) ?></td>
                    <td><?= htmlspecialchars($j['posicion']) ?></td>
                    <td><?= htmlspecialchars($j['dorsal']) ?></td>
                    <td><?= $j['goles'] ?></td>
                    <td><?= $j['amarillas'] ?></td>
                    <td><?= $j['rojas'] ?></td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr><td>—</td><td>—</td><td>—</td><td>0</td><td>0</td><td>0</td></tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>

        <?php if (!empty($pais['galeria'])): ?>
          <h3 class="h5 mt-4 mb-3">Galería</h3>
          <div class="galeria">
            <?php foreach ($pais['galeria'] as $img): ?>
              <img src="/<?= htmlspecialchars($img) ?>" alt="Imagen" class="rounded shadow-sm">
            <?php endforeach; ?>
          </div>
        <?php endif; ?>

        <?php if (!empty($pais['videos'])): ?>
          <h3 class="h5 mt-4 mb-3">Videos</h3>
          <div class="videos">
            <?php foreach ($pais['videos'] as $vid): ?>
              <iframe src="<?= htmlspecialchars($vid) ?>" frameborder="0" allowfullscreen class="shadow-sm"></iframe>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
    </section>
  <?php endif; ?>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
