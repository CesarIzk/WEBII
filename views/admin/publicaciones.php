<?php $pageTitle = 'Publicaciones - Panel Admin MundialFan'; ?>
<?php require_once __DIR__ . '/partials/head.php'; ?>
<?php require_once __DIR__ . '/partials/header.php'; ?>
<?php require_once __DIR__ . '/partials/nav.php'; ?>

<div class="container-fluid mt-4">
  <h2 class="mb-4">Gestión de Publicaciones</h2>

  <?php if (!empty($success)): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class="fas fa-check-circle"></i> <?= htmlspecialchars($success) ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  <?php endif; ?>

  <div class="card shadow">
    <div class="card-header">
      <h5 class="mb-0">Todas las Publicaciones (Total: <?= count($publicaciones ?? []) ?>)</h5>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
          <thead class="table-dark">
            <tr>
              <th>ID</th><th>Autor</th><th>Contenido</th><th>Tipo</th>
              <th>Fecha</th><th>Estado</th><th class="text-end">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($publicaciones)): ?>
              <tr><td colspan="7" class="text-center">No hay publicaciones para mostrar.</td></tr>
            <?php else: ?>
              <?php foreach ($publicaciones as $post): ?>
                <tr>
                  <td><strong><?= $post['id'] ?></strong></td>
                  <td><?= htmlspecialchars($post['autor']) ?></td>
                  <td style="max-width:300px;">
                    <span class="d-inline-block text-truncate" style="max-width:300px;"
                          title="<?= htmlspecialchars($post['texto']) ?>">
                      <?= htmlspecialchars($post['texto']) ?>
                    </span>
                  </td>
                  <td>
                    <?php if (!empty($post['tipo']) && $post['tipo'] !== 'texto'): ?>
                      <span class="badge bg-secondary"><?= htmlspecialchars($post['tipo']) ?></span>
                    <?php else: ?>
                      <span class="badge bg-light text-dark">Texto</span>
                    <?php endif; ?>
                  </td>
                  <td><?= htmlspecialchars($post['fecha']) ?></td>
                  <td>
                    <?php if ($post['visible']): ?>
                      <span class="badge bg-success">Público</span>
                    <?php else: ?>
                      <span class="badge bg-danger">Oculto</span>
                    <?php endif; ?>
                  </td>
                  <td class="text-end">
                    <?php if ($post['visible']): ?>
                      <form action="/admin/publicaciones/<?= $post['id'] ?>/ocultar" method="POST" class="d-inline">
                        <button type="submit" class="btn btn-warning btn-sm" title="Ocultar publicación">
                          <i class="fas fa-eye-slash"></i>
                        </button>
                      </form>
                    <?php else: ?>
                      <form action="/admin/publicaciones/<?= $post['id'] ?>/mostrar" method="POST" class="d-inline">
                        <button type="submit" class="btn btn-success btn-sm" title="Mostrar publicación">
                          <i class="fas fa-eye"></i>
                        </button>
                      </form>
                    <?php endif; ?>
                    <a href="/admin/publicaciones/<?= $post['id'] ?>" class="btn btn-info btn-sm" title="Ver detalle">
                      <i class="fas fa-external-link-alt"></i>
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
