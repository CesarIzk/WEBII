<?php $pageTitle = 'Usuarios - Panel Admin MundialFan'; ?>
<?php require_once __DIR__ . '/partials/head.php'; ?>
<?php require_once __DIR__ . '/partials/header.php'; ?>
<?php require_once __DIR__ . '/partials/nav.php'; ?>

<div class="contenedor mt-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-users-cog"></i> Gestión de Usuarios</h2>
    <a href="/admin/dashboard" class="btn btn-secondary">
      <i class="fas fa-arrow-left"></i> Volver al Dashboard
    </a>
  </div>

  <?php if (!empty($success)): ?>
    <div class="alert alert-success alert-dismissible fade show">
      <i class="fas fa-check-circle"></i> <?= htmlspecialchars($success) ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  <?php endif; ?>

  <?php if (!empty($error)): ?>
    <div class="alert alert-danger alert-dismissible fade show">
      <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($error) ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  <?php endif; ?>

  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>ID</th><th>Nombre</th><th>Username</th><th>Email</th>
              <th>País</th><th>Rol</th><th>Estado</th><th>Registro</th><th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($usuarios ?? [] as $u): ?>
              <tr>
                <td><?= $u['id'] ?></td>
                <td><?= htmlspecialchars($u['nombre']) ?></td>
                <td>@<?= htmlspecialchars($u['username']) ?></td>
                <td><?= htmlspecialchars($u['email']) ?></td>
                <td><?= htmlspecialchars($u['pais'] ?? '—') ?></td>
                <td>
                  <span class="badge bg-<?= $u['rol'] === 'admin' ? 'danger' : 'primary' ?>">
                    <?= htmlspecialchars($u['rol']) ?>
                  </span>
                </td>
                <td>
                  <span class="badge bg-<?= $u['activo'] ? 'success' : 'secondary' ?>">
                    <?= $u['activo'] ? 'Activo' : 'Inactivo' ?>
                  </span>
                </td>
                <td><?= htmlspecialchars($u['fecha_registro'] ?? '') ?></td>
                <td>
                  <?php if ($u['id'] === ($_SESSION['user']['id'] ?? null)): ?>
                    <span class="text-muted">Eres tú</span>
                  <?php elseif ($u['activo']): ?>
                    <form method="POST" action="/admin/usuarios/<?= $u['id'] ?>/desactivar" style="display:inline;">
                      <button type="submit" class="btn btn-sm btn-warning"
                              onclick="return confirm('¿Desactivar este usuario?')">
                        <i class="fas fa-ban"></i> Desactivar
                      </button>
                    </form>
                  <?php else: ?>
                    <form method="POST" action="/admin/usuarios/<?= $u['id'] ?>/activar" style="display:inline;">
                      <button type="submit" class="btn btn-sm btn-success">
                        <i class="fas fa-check"></i> Activar
                      </button>
                    </form>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="mt-3 text-muted">
    <small>Total de usuarios: <?= count($usuarios ?? []) ?></small>
  </div>
</div>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
