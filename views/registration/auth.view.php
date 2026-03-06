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
          <form action="#" method="post" autocomplete="on">
            <div class="mb-3">
              <label class="form-label" for="login-email">Correo</label>
              <input class="form-control" id="login-email" type="email" placeholder="correo@ejemplo.com" required>
            </div>
            <div class="mb-3">
              <label class="form-label" for="login-pass">Contraseña</label>
              <input class="form-control" id="login-pass" type="password" placeholder="••••••••" required>
            </div>
            <button class="btn btn-primary w-100 mt-3" type="button">Entrar</button>
          </form>
        </div>
      </div>
    </div>

    <!-- REGISTRO -->
    <div class="col-12 col-lg-6">
      <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">
          <h3 class="h5 mb-3"><i class="fas fa-user-plus me-2"></i>Crear cuenta</h3>
          <form action="#" method="post" autocomplete="on">
            <div class="row g-3">
              <div class="col-12 col-md-6">
                <label class="form-label" for="reg-name">Nombre</label>
                <input class="form-control" id="reg-name" type="text" placeholder="Tu nombre" required>
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label" for="reg-user">Usuario</label>
                <input class="form-control" id="reg-user" type="text" placeholder="@usuario" required>
              </div>
              <div class="col-12">
                <label class="form-label" for="reg-email">Correo</label>
                <input class="form-control" id="reg-email" type="email" placeholder="correo@ejemplo.com" required>
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label" for="reg-birth">Fecha de nacimiento</label>
                <input class="form-control" id="reg-birth" type="date" required>
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label" for="reg-gender">Género</label>
                <select class="form-select" id="reg-gender" required>
                  <option value="" selected disabled>Selecciona…</option>
                  <option value="M">Masculino</option>
                  <option value="F">Femenino</option>
                  <option value="O">Otro</option>
                  <option value="N">Prefiero no decir</option>
                </select>
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label" for="reg-pass">Contraseña</label>
                <input class="form-control" id="reg-pass" type="password" placeholder="••••••••" required>
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label" for="reg-pass2">Confirmar</label>
                <input class="form-control" id="reg-pass2" type="password" placeholder="••••••••" required>
              </div>
            </div>
            <button class="btn btn-outline-primary w-100 mt-3" type="button">Registrarme</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
