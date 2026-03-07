<?php $pageTitle = 'Nuevo País - Panel Admin MundialFan'; ?>
<?php require_once __DIR__ . '/partials/head.php'; ?>
<?php require_once __DIR__ . '/partials/header.php'; ?>
<?php require_once __DIR__ . '/partials/nav.php'; ?>

<div class="container mt-4">
  <div class="d-flex align-items-center gap-3 mb-3">
    <a href="/admin/paises" class="btn btn-secondary">
      <i class="fas fa-arrow-left"></i>
    </a>
    <h2 class="m-0"><i class="fas fa-plus-circle"></i> Agregar Nuevo País</h2>
  </div>
  <p class="text-muted">Completa los campos para registrar un nuevo país en la base de datos.</p>

  <?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <form method="POST" action="/admin/paises">
    <div class="row mt-3">
      <div class="col-md-4">
        <label class="form-label">Código (slug)</label>
        <input type="text" name="codigo" class="form-control"
               placeholder="ej. argentina, brasil"
               value="<?= htmlspecialchars($_POST['codigo'] ?? '') ?>" required>
      </div>
      <div class="col-md-4">
        <label class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control"
               placeholder="Nombre del país"
               value="<?= htmlspecialchars($_POST['nombre'] ?? '') ?>" required>
      </div>
      <div class="col-md-4">
        <label class="form-label">Continente</label>
        <input type="text" name="continente" class="form-control"
               placeholder="Ej. América del Sur"
               value="<?= htmlspecialchars($_POST['continente'] ?? '') ?>">
      </div>
    </div>

    <div class="row mt-3">
      <div class="col-md-4">
        <label class="form-label">Títulos</label>
        <input type="number" name="titulos" class="form-control"
               value="<?= htmlspecialchars($_POST['titulos'] ?? '0') ?>">
      </div>
      <div class="col-md-4">
        <label class="form-label">Participaciones</label>
        <input type="number" name="participaciones" class="form-control"
               value="<?= htmlspecialchars($_POST['participaciones'] ?? '0') ?>">
      </div>
      <div class="col-md-4">
        <label class="form-label">Entrenador</label>
        <input type="text" name="entrenador" class="form-control"
               placeholder="Nombre del entrenador actual"
               value="<?= htmlspecialchars($_POST['entrenador'] ?? '') ?>">
      </div>
    </div>

    <div class="mt-3">
      <label class="form-label">Mejor Jugador</label>
      <input type="text" name="mejorJugador" class="form-control"
             placeholder="Ej. Lionel Messi"
             value="<?= htmlspecialchars($_POST['mejorJugador'] ?? '') ?>">
    </div>

    <div class="mt-3">
      <label class="form-label">Bandera (URL)</label>
      <input type="text" name="bandera" class="form-control"
             placeholder="https://flagcdn.com/w320/ar.png"
             value="<?= htmlspecialchars($_POST['bandera'] ?? '') ?>">
    </div>

    <div class="mt-3">
      <label class="form-label">Descripción</label>
      <textarea name="descripcion" rows="3" class="form-control"
                placeholder="Breve descripción del país o su selección."><?= htmlspecialchars($_POST['descripcion'] ?? '') ?></textarea>
    </div>

    <div class="mt-3">
      <label class="form-label">Historia</label>
      <textarea name="historia" rows="5" class="form-control"
                placeholder="Historia deportiva del país."><?= htmlspecialchars($_POST['historia'] ?? '') ?></textarea>
    </div>

    <button class="btn btn-success mt-4">
      <i class="fas fa-save"></i> Guardar País
    </button>
  </form>
</div>

<?php require_once __DIR__ . '/partials/footer.php'; ?>