<?php $pageTitle = 'MundialFan - Acceso y Registro'; ?>
<?php require_once __DIR__ . '/../partials/head.php'; ?>
<?php require_once __DIR__ . '/../partials/header.php'; ?>
<?php require_once __DIR__ . '/../partials/nav.php'; ?>

<main class="contenedor" style="padding: 2rem 0 2.5rem;">
  <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
    <h2 class="m-0">Acceso y Registro</h2>
  </div>

  <div class="row g-4">

    <!-- LOGIN -->
    <div class="col-12 col-lg-6">
      <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">
          <h3 class="h5 mb-3"><i class="fas fa-right-to-bracket me-2"></i>Iniciar sesión</h3>
          <form action="/login" method="post">
            <input type="hidden" name="action" value="login">

            <div class="row g-3">
              <div class="col-12">
                <input class="form-control" name="email" type="email" placeholder="Correo electrónico" required>
              </div>
              <div class="col-12">
                <input class="form-control" name="password" type="password" placeholder="Contraseña" required>
              </div>
            </div>

            <?php if (isset($errors['login'])): ?>
              <p class="text-danger mt-2 small"><?= htmlspecialchars($errors['login']) ?></p>
            <?php endif; ?>

            <?php if (isset($_GET['registered'])): ?>
              <p class="text-success mt-2 small">Cuenta creada con éxito. Ya podés iniciar sesión.</p>
            <?php endif; ?>

            <button class="btn btn-outline-primary w-100 mt-3" type="submit">Iniciar sesión</button>
          </form>
        </div>
      </div>
    </div>

    <!-- REGISTRO -->
    <div class="col-12 col-lg-6">
      <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">
          <h3 class="h5 mb-3"><i class="fas fa-user-plus me-2"></i>Crear cuenta</h3>
          <form action="/login" method="post">
            <input type="hidden" name="action" value="register">

            <div class="row g-3">
              <div class="col-12">
                <input class="form-control" name="nombre" placeholder="Nombre completo" required>
              </div>
              <div class="col-12">
                <input class="form-control" name="correo" type="email" placeholder="Correo electrónico" required>
              </div>
              <div class="col-md-6">
                <input class="form-control" name="fecha_nacimiento" type="date" required>
              </div>
              <div class="col-md-6">
                <select class="form-select" name="genero" required>
                  <option value="">Género</option>
                  <option value="M">Masculino</option>
                  <option value="F">Femenino</option>
                </select>
              </div>
              <div class="col-md-6">
                <input class="form-control" name="password" type="password" placeholder="Contraseña" required>
              </div>
              <div class="col-md-6">
                <input class="form-control" name="password_confirm" type="password" placeholder="Confirmar" required>
              </div>
            </div>

            <?php if (isset($errors['register'])): ?>
              <p class="text-danger mt-2 small"><?= htmlspecialchars($errors['register']) ?></p>
            <?php endif; ?>

            <button class="btn btn-outline-primary w-100 mt-3" type="submit">Registrarme</button>
          </form>
        </div>
      </div>
    </div>

  </div>
  <?php if (isset($_SESSION['user'])): ?>
<script>
    console.log('Sesión iniciada:', <?= json_encode($_SESSION['user']) ?>);
</script>
<?php endif; ?>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>