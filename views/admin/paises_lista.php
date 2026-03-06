<?php $pageTitle = 'Países - Panel Admin MundialFan'; ?>
<?php require_once __DIR__ . '/partials/head.php'; ?>
<?php require_once __DIR__ . '/partials/header.php'; ?>
<?php require_once __DIR__ . '/partials/nav.php'; ?>

<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2><i class="fas fa-flag"></i> Administración de Países</h2>
    <a href="/admin/paises/crear" class="btn btn-primary">
      <i class="fas fa-plus"></i> Nuevo País
    </a>
  </div>

  <?php if (!empty($success)): ?>
    <div class="alert alert-success alert-dismissible fade show">
      <i class="fas fa-check-circle"></i> <?= htmlspecialchars($success) ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  <?php endif; ?>

  <div class="card shadow">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped table-hover mt-2">
          <thead class="table-dark">
            <tr>
              <th>Bandera</th><th>Nombre</th><th>Continente</th>
              <th>Títulos</th><th>Participaciones</th><th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($paises)): ?>
              <tr><td colspan="6" class="text-center">No hay países registrados.</td></tr>
            <?php else: ?>
              <?php foreach ($paises as $p): ?>
                <tr>
                  <td>
                    <?php if (!empty($p['bandera'])): ?>
                      <img src="<?= htmlspecialchars($p['bandera']) ?>" alt="Bandera"
                           style="height:24px; border-radius:2px;">
                    <?php else: ?>
                      —
                    <?php endif; ?>
                  </td>
                  <td><?= htmlspecialchars($p['nombre']) ?></td>
                  <td><?= htmlspecialchars($p['continente'] ?? '—') ?></td>
                  <td><?= $p['titulos'] ?? 0 ?></td>
                  <td><?= $p['participaciones'] ?? 0 ?></td>
                  <td>
                    <a href="/admin/paises/<?= $p['codigo'] ?>/editar" class="btn btn-sm btn-warning">
                      <i class="fas fa-edit"></i> Editar
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
