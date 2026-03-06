<?php $pageTitle = 'Dashboard - Panel Admin MundialFan'; ?>
<?php require_once __DIR__ . '/partials/head.php'; ?>
<?php require_once __DIR__ . '/partials/header.php'; ?>
<?php require_once __DIR__ . '/partials/nav.php'; ?>

<div class="container-fluid mt-4">
  <h2 class="mb-4"><i class="fas fa-tachometer-alt"></i> Dashboard</h2>

  <!-- Tarjetas de estadísticas -->
  <div class="row g-4 mb-4">
    <div class="col-md-3">
      <div class="card text-white bg-primary">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h6 class="card-subtitle mb-2">Total Usuarios</h6>
              <h2 class="card-title mb-0"><?= $stats['total_usuarios'] ?? 0 ?></h2>
            </div>
            <i class="fas fa-users fa-3x opacity-50"></i>
          </div>
          <small>+<?= $stats['usuarios_hoy'] ?? 0 ?> hoy</small>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card text-white bg-success">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h6 class="card-subtitle mb-2">Publicaciones</h6>
              <h2 class="card-title mb-0"><?= $stats['total_publicaciones'] ?? 0 ?></h2>
            </div>
            <i class="fas fa-file-alt fa-3x opacity-50"></i>
          </div>
          <small>+<?= $stats['publicaciones_hoy'] ?? 0 ?> hoy</small>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card text-white bg-info">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h6 class="card-subtitle mb-2">Usuarios Activos</h6>
              <h2 class="card-title mb-0"><?= $stats['usuarios_activos'] ?? 0 ?></h2>
            </div>
            <i class="fas fa-user-check fa-3x opacity-50"></i>
          </div>
          <small>Última semana</small>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card text-white bg-warning">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h6 class="card-subtitle mb-2">Contenido Oculto</h6>
              <h2 class="card-title mb-0"><?= $stats['contenido_oculto'] ?? 0 ?></h2>
            </div>
            <i class="fas fa-eye-slash fa-3x opacity-50"></i>
          </div>
          <small>Requiere revisión</small>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card text-white bg-secondary">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h6 class="card-subtitle mb-2">Comentarios Totales</h6>
              <h2 class="card-title mb-0"><?= $stats['total_comentarios'] ?? 0 ?></h2>
            </div>
            <i class="fas fa-comments fa-3x opacity-50"></i>
          </div>
          <small>Actualizados automáticamente</small>
        </div>
      </div>
    </div>
  </div>

  <!-- Gráfico + Top usuarios -->
  <div class="row g-4">
    <div class="col-md-8">
      <div class="card shadow">
        <div class="card-header">
          <h5 class="mb-0"><i class="fas fa-chart-line"></i> Actividad de los últimos 7 días</h5>
        </div>
        <div class="card-body">
          <canvas id="activityChart" height="100"></canvas>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card shadow">
        <div class="card-header">
          <h5 class="mb-0"><i class="fas fa-star"></i> Top Usuarios</h5>
        </div>
        <div class="card-body">
          <div class="list-group list-group-flush">
            <?php foreach ($topUsuarios ?? [] as $i => $u): ?>
              <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                <div class="d-flex align-items-center gap-2">
                  <span class="badge bg-primary rounded-circle d-flex align-items-center justify-content-center"
                        style="width:30px; height:30px;">
                    <?= $i + 1 ?>
                  </span>
                  <div>
                    <strong><?= htmlspecialchars($u['nombre']) ?></strong><br>
                    <small class="text-muted"><?= $u['publicaciones'] ?> publicaciones</small>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Actividad reciente -->
  <div class="row g-4 mt-2">
    <div class="col-12">
      <div class="card shadow">
        <div class="card-header">
          <h5 class="mb-0"><i class="fas fa-clock"></i> Actividad Reciente</h5>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr><th>Usuario</th><th>Acción</th><th>Fecha</th></tr>
              </thead>
              <tbody>
                <?php foreach ($actividadReciente ?? [] as $a): ?>
                  <tr>
                    <td><i class="fas fa-user-circle text-primary me-1"></i><?= htmlspecialchars($a['usuario']) ?></td>
                    <td><?= htmlspecialchars($a['accion']) ?></td>
                    <td><small class="text-muted"><?= htmlspecialchars($a['fecha']) ?></small></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
