<?php $pageTitle = 'MundialFan - Publicaciones'; ?>
<?php require_once __DIR__ . '/../partials/head.php'; ?>
<?php require_once __DIR__ . '/../partials/header.php'; ?>
<?php require_once __DIR__ . '/../partials/nav.php'; ?>

<div class="contenedor mt-5">

  <?php if (!empty($_GET['q'])): ?>
    <p class="text-center text-muted mb-4">
      Mostrando resultados para "<strong><?= htmlspecialchars($_GET['q']) ?></strong>"
      (<?= count($publicaciones ?? []) ?> resultados)
    </p>
  <?php endif; ?>

  <!-- Buscador / Filtros -->
  <form class="d-flex flex-wrap justify-content-center gap-3 mb-4" method="GET" action="/publicaciones">
    <input type="text" name="q" class="form-control"
           placeholder="Buscar publicaciones..."
           value="<?= htmlspecialchars($_GET['q'] ?? '') ?>"
           style="max-width:250px;">

    <select name="categoria" class="form-select" style="max-width:220px;">
      <option value="">Todas las categorías</option>
      <?php foreach ($categorias ?? [] as $cat): ?>
        <option value="<?= $cat['id'] ?>" <?= ($_GET['categoria'] ?? '') == $cat['id'] ? 'selected' : '' ?>>
          <?= htmlspecialchars($cat['nombre']) ?>
        </option>
      <?php endforeach; ?>
    </select>

    <select name="orden" class="form-select" style="max-width:220px;">
      <option value="reciente" <?= ($_GET['orden'] ?? '') === 'reciente'  ? 'selected' : '' ?>>Más recientes</option>
      <option value="populares" <?= ($_GET['orden'] ?? '') === 'populares' ? 'selected' : '' ?>>Más populares</option>
    </select>

    <button class="btn btn-primary px-3">
      <i class="fas fa-search"></i> Buscar
    </button>
  </form>
</div>

<!-- Lista de publicaciones -->
<?php foreach ($publicaciones ?? [] as $post): ?>
  <article class="mf-post mf-post--narrow card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body">
      <div class="d-flex align-items-center gap-2 mb-2">
        <img src="/<?= htmlspecialchars($post['autor_avatar'] ?? 'imagenes/default-profile.jpg') ?>"
             alt="Avatar" style="width:40px;height:40px;border-radius:999px;object-fit:cover;">
        <div>
          <strong><?= htmlspecialchars($post['autor_nombre']) ?></strong>
          <div style="font-size:12px;opacity:.75;"><?= htmlspecialchars($post['fecha']) ?></div>
        </div>
      </div>

      <p class="mb-2"><?= htmlspecialchars($post['texto']) ?></p>

      <?php if (!empty($post['imagen'])): ?>
        <img src="/<?= htmlspecialchars($post['imagen']) ?>" alt="Imagen de publicación"
             class="img-fluid rounded-4 border" style="max-height:340px;object-fit:cover;width:100%;">
      <?php endif; ?>

      <div class="d-flex gap-3 mt-3" style="font-size:14px;opacity:.9;">
        <button type="button" class="btn btn-sm btn-outline-primary">
          <i class="fas fa-thumbs-up me-1"></i> Like
        </button>
        <button type="button" class="btn btn-sm btn-outline-secondary">
          <i class="fas fa-comment me-1"></i> Comentar
        </button>
      </div>

      <hr class="my-3">

      <!-- Caja de comentario -->
      <div class="d-flex gap-2 align-items-start">
        <img src="/imagenes/default-profile.jpg" alt="Tu avatar"
             style="width:34px;height:34px;border-radius:999px;object-fit:cover;">
        <div class="flex-grow-1">
          <textarea class="form-control" rows="2" placeholder="Escribe un comentario..."></textarea>
          <div class="d-flex justify-content-end mt-2">
            <button type="button" class="btn btn-primary btn-sm">Publicar comentario</button>
          </div>
        </div>
      </div>

      <!-- Comentarios -->
      <?php if (!empty($post['comentarios'])): ?>
        <div class="mt-3">
          <?php foreach ($post['comentarios'] as $com): ?>
            <div class="d-flex gap-2 mb-2">
              <img src="/<?= htmlspecialchars($com['avatar'] ?? 'imagenes/default-profile.jpg') ?>"
                   alt="Avatar" style="width:30px;height:30px;border-radius:999px;object-fit:cover;">
              <div class="p-2 rounded-4 border" style="background:var(--bg);">
                <strong style="font-size:13px;"><?= htmlspecialchars($com['nombre']) ?></strong>
                <div style="font-size:13px;"><?= htmlspecialchars($com['texto']) ?></div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </article>
<?php endforeach; ?>

<div id="load-more-trigger" style="height:40px;"></div>

<!-- Modal de publicación -->
<div id="modal-post" class="zzz-modal">
  <div class="zzz-modal-content">
    <button class="zzz-close">&times;</button>
    <div id="modal-body"></div>
  </div>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
