<?php $pageTitle = 'Reportes - Panel Admin MundialFan'; ?>
<?php require_once __DIR__ . '/partials/head.php'; ?>
<?php require_once __DIR__ . '/partials/header.php'; ?>
<?php require_once __DIR__ . '/partials/nav.php'; ?>

<div class="container-fluid mt-4">
  <h2 class="mb-4"><i class="fas fa-chart-line"></i> Reportes y Estadísticas</h2>

  <!-- Filtros -->
  <div class="card shadow mb-4">
    <div class="card-body">
      <form method="GET" action="/admin/reportes" class="row g-3">
        <div class="col-md-3">
          <label class="form-label">Fecha Inicio</label>
          <input type="date" class="form-control" name="fecha_inicio"
                 value="<?= htmlspecialchars($_GET['fecha_inicio'] ?? '') ?>">
        </div>
        <div class="col-md-3">
          <label class="form-label">Fecha Fin</label>
          <input type="date" class="form-control" name="fecha_fin"
                 value="<?= htmlspecialchars($_GET['fecha_fin'] ?? '') ?>">
        </div>
        <div class="col-md-3">
          <label class="form-label">Tipo de Reporte</label>
          <select class="form-select" name="tipo">
            <?php foreach (['general' => 'General', 'usuarios' => 'Solo Usuarios', 'publicaciones' => 'Solo Publicaciones', 'actividad' => 'Actividad'] as $val => $label): ?>
              <option value="<?= $val ?>" <?= ($_GET['tipo'] ?? 'general') === $val ? 'selected' : '' ?>>
                <?= $label ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-md-3 d-flex align-items-end gap-2">
          <button type="submit" class="btn btn-primary flex-fill">
            <i class="fas fa-search"></i> Generar
          </button>
          <button type="button" class="btn btn-success" onclick="exportarCSV()">
            <i class="fas fa-download"></i>
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Métricas -->
  <div class="row g-4 mb-4">
    <div class="col-md-4">
      <div class="card shadow">
        <div class="card-body text-center">
          <i class="fas fa-users fa-3x text-primary mb-3"></i>
          <h3><?= $metricas['total_usuarios'] ?? 0 ?></h3>
          <p class="text-muted">Total Usuarios Registrados</p>
          <small class="text-success">
            <i class="fas fa-arrow-up"></i> <?= $metricas['usuarios_pct'] ?? 0 ?>% vs mes anterior
          </small>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card shadow">
        <div class="card-body text-center">
          <i class="fas fa-file-alt fa-3x text-success mb-3"></i>
          <h3><?= $metricas['total_publicaciones'] ?? 0 ?></h3>
          <p class="text-muted">Total Publicaciones</p>
          <small class="text-success">
            <i class="fas fa-arrow-up"></i> <?= $metricas['publicaciones_pct'] ?? 0 ?>% vs mes anterior
          </small>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card shadow">
        <div class="card-body text-center">
          <i class="fas fa-heart fa-3x text-danger mb-3"></i>
          <h3><?= $metricas['total_likes'] ?? 0 ?></h3>
          <p class="text-muted">Total Interacciones (Likes)</p>
          <small class="text-info">
            <i class="fas fa-chart-line"></i> Promedio: <?= $metricas['likes_promedio'] ?? 0 ?> por post
          </small>
        </div>
      </div>
    </div>
  </div>

  <!-- Gráficos -->
  <div class="row g-4 mb-4">
    <div class="col-md-6">
      <div class="card shadow">
        <div class="card-header">
          <h5 class="mb-0"><i class="fas fa-chart-bar"></i> Usuarios por País</h5>
        </div>
        <div class="card-body"><canvas id="paisesChart"></canvas></div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card shadow">
        <div class="card-header">
          <h5 class="mb-0"><i class="fas fa-chart-pie"></i> Tipos de Contenido</h5>
        </div>
        <div class="card-body"><canvas id="contenidoChart"></canvas></div>
      </div>
    </div>
  </div>

  <!-- Tabla detallada -->
  <div class="card shadow mb-4">
    <div class="card-header">
      <h5 class="mb-0"><i class="fas fa-table"></i> Detalles del Período Seleccionado</h5>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped table-hover" id="reportTable">
          <thead>
            <tr>
              <th>Fecha</th><th>Nuevos Usuarios</th><th>Nuevas Publicaciones</th>
              <th>Total Likes</th><th>Usuarios Activos</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($detalles ?? [] as $d): ?>
              <tr>
                <td><?= htmlspecialchars($d['fecha']) ?></td>
                <td><?= $d['nuevos_usuarios'] ?></td>
                <td><?= $d['nuevas_publicaciones'] ?></td>
                <td><?= $d['total_likes'] ?></td>
                <td><?= $d['usuarios_activos'] ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Top 10 -->
  <div class="row g-4 mt-2">
    <div class="col-md-6">
      <div class="card shadow">
        <div class="card-header">
          <h5 class="mb-0"><i class="fas fa-trophy"></i> Top 10 Usuarios Más Activos</h5>
        </div>
        <div class="card-body">
          <ol class="list-group list-group-numbered">
            <?php foreach ($topUsuarios ?? [] as $u): ?>
              <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                  <strong>@<?= htmlspecialchars($u['username']) ?></strong><br>
                  <small class="text-muted"><?= htmlspecialchars($u['nombre']) ?></small>
                </div>
                <span class="badge bg-primary rounded-pill"><?= $u['posts'] ?> posts</span>
              </li>
            <?php endforeach; ?>
          </ol>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card shadow">
        <div class="card-header">
          <h5 class="mb-0"><i class="fas fa-fire"></i> Top 10 Publicaciones Más Populares</h5>
        </div>
        <div class="card-body">
          <ol class="list-group list-group-numbered">
            <?php foreach ($topPublicaciones ?? [] as $p): ?>
              <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                  <strong><?= htmlspecialchars(substr($p['texto'], 0, 60)) ?>...</strong><br>
                  <small class="text-muted">Por @<?= htmlspecialchars($p['autor']) ?></small>
                </div>
                <span class="badge bg-danger rounded-pill">
                  <i class="fas fa-heart"></i> <?= $p['likes'] ?>
                </span>
              </li>
            <?php endforeach; ?>
          </ol>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
