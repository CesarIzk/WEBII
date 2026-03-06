<?php $pageTitle = 'Crear Administrador - Panel Admin MundialFan'; ?>
<?php require_once __DIR__ . '/partials/head.php'; ?>
<?php require_once __DIR__ . '/partials/header.php'; ?>
<?php require_once __DIR__ . '/partials/nav.php'; ?>

<div class="container mt-5 mb-5">
  <div class="d-flex align-items-center gap-3 mb-4">
    <a href="/admin/usuarios" class="btn btn-secondary">
      <i class="fas fa-arrow-left"></i>
    </a>
    <h2 class="m-0"><i class="fas fa-user-shield"></i> Crear Nuevo Administrador</h2>
  </div>

  <?php if (!empty($error)): ?>
    <div class="alert alert-danger">
      <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($error) ?>
    </div>
  <?php endif; ?>

  <?php if (!empty($success)): ?>
    <div class="alert alert-success">
      <i class="fas fa-check-circle"></i> <?= htmlspecialchars($success) ?>
    </div>
  <?php endif; ?>

  <div class="card shadow">
    <div class="card-body">
      <form method="POST" action="/admin/crear-admin">
        <div class="row mb-3">
          <div class="col-md-6">
            <label class="form-label">Nombre completo</label>
            <input type="text" name="nombre" class="form-control"
                   value="<?= htmlspecialchars($_POST['nombre'] ?? '') ?>" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Correo electrónico</label>
            <input type="email" name="email" class="form-control"
                   value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label class="form-label">Nombre de usuario</label>
            <input type="text" name="username" class="form-control"
                   value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" required>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label class="form-label">Contraseña del nuevo administrador</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Confirmar contraseña del nuevo administrador</label>
            <input type="password" name="confirm_new_password" class="form-control" required>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label class="form-label">Confirma tu contraseña (admin actual)</label>
            <input type="password" name="confirm_admin_password" class="form-control" required>
            <small class="text-muted">
              Ingresa tu propia contraseña para autorizar la creación del nuevo administrador.
            </small>
          </div>
        </div>

        <div class="d-flex justify-content-end gap-2">
          <a href="/admin/usuarios" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Cancelar
          </a>
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Crear Administrador
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
