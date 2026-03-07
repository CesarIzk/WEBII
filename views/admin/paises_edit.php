<?php $pageTitle = 'Editar País - Panel Admin MundialFan'; ?>
<?php require_once __DIR__ . '/partials/head.php'; ?>
<?php require_once __DIR__ . '/partials/header.php'; ?>
<?php require_once __DIR__ . '/partials/nav.php'; ?>

<div class="container mt-4">
  <div class="d-flex align-items-center gap-3 mb-3">
    <a href="/admin/paises" class="btn btn-secondary">
      <i class="fas fa-arrow-left"></i>
    </a>
    <h2 class="m-0"><i class="fas fa-edit"></i> Editar País: <?= htmlspecialchars($pais['nombre'] ?? '') ?></h2>
  </div>

  <?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <form method="POST" action="/admin/paises">
    <input type="hidden" name="_method" value="PATCH">
    <input type="hidden" name="id" value="<?= htmlspecialchars($pais['idPais'] ?? '') ?>">
    <div class="row mt-3">
      <div class="col-md-6">
        <label class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control"
               value="<?= htmlspecialchars($pais['nombre'] ?? '') ?>">
      </div>
      <div class="col-md-6">
        <label class="form-label">Continente</label>
        <input type="text" name="continente" class="form-control"
               value="<?= htmlspecialchars($pais['continente'] ?? '') ?>">
      </div>
    </div>

    <div class="row mt-3">
      <div class="col-md-4">
        <label class="form-label">Títulos</label>
        <input type="number" name="titulos" class="form-control"
               value="<?= htmlspecialchars($pais['titulos'] ?? 0) ?>">
      </div>
      <div class="col-md-4">
        <label class="form-label">Participaciones</label>
        <input type="number" name="participaciones" class="form-control"
               value="<?= htmlspecialchars($pais['participaciones'] ?? 0) ?>">
      </div>
      <div class="col-md-4">
        <label class="form-label">Entrenador</label>
        <input type="text" name="entrenador" class="form-control"
               value="<?= htmlspecialchars($pais['entrenador'] ?? '') ?>">
      </div>
    </div>

    <div class="mt-3">
      <label class="form-label">Mejor Jugador</label>
      <input type="text" name="mejorJugador" class="form-control"
             value="<?= htmlspecialchars($pais['mejorJugador'] ?? '') ?>">
    </div>

    <div class="mt-3">
      <label class="form-label">Bandera (URL)</label>
      <input type="text" name="bandera" class="form-control"
             value="<?= htmlspecialchars($pais['bandera'] ?? '') ?>">
    </div>

    <div class="mt-3">
      <label class="form-label">Descripción</label>
      <textarea name="descripcion" rows="3" class="form-control"><?= htmlspecialchars($pais['descripcion'] ?? '') ?></textarea>
    </div>

    <div class="mt-3">
      <label class="form-label">Historia</label>
      <textarea name="historia" rows="5" class="form-control"><?= htmlspecialchars($pais['historia'] ?? '') ?></textarea>
    </div>

    <button class="btn btn-success mt-4">
      <i class="fas fa-save"></i> Guardar Cambios
    </button>
  </form>
</div>

<?php require_once __DIR__ . '/partials/footer.php'; ?>