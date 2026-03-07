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

    <select name="orden" class="form-select" style="max-width:220px;">
      <option value="reciente"  <?= ($_GET['orden'] ?? '') === 'reciente'  ? 'selected' : '' ?>>Más recientes</option>
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

      <!-- Autor -->
      <div class="d-flex align-items-center gap-2 mb-2">
        <img src="/imagenes/default-profile.jpg"
             alt="Avatar" style="width:40px;height:40px;border-radius:999px;object-fit:cover;">
        <div>
          <strong><?= htmlspecialchars($post['autor']) ?></strong>
          <div style="font-size:12px;opacity:.75;"><?= htmlspecialchars($post['fecha']) ?></div>
        </div>
      </div>

      <!-- Texto -->
      <p class="mb-2"><?= htmlspecialchars($post['texto']) ?></p>

      <!-- Media -->
      <?php if (!empty($post['rutaMulti'])): ?>
        <?php if (($post['tipoContenido'] ?? '') === 'video'): ?>
          <video controls class="w-100 rounded-4 border" style="max-height:340px;">
            <source src="/<?= htmlspecialchars($post['rutaMulti']) ?>">
          </video>
        <?php else: ?>
          <img src="/<?= htmlspecialchars($post['rutaMulti']) ?>" alt="Imagen"
               class="img-fluid rounded-4 border" style="max-height:340px;object-fit:cover;width:100%;">
        <?php endif; ?>
      <?php endif; ?>

      <!-- Acciones -->
      <div class="d-flex gap-3 mt-3" style="font-size:14px;opacity:.9;">
        <form method="POST" action="/publicaciones/like" class="d-inline">
          <input type="hidden" name="id" value="<?= $post['id'] ?>">
          <button type="submit" class="btn btn-sm btn-outline-primary">
            <i class="fas fa-thumbs-up me-1"></i> <?= (int)($post['likes'] ?? 0) ?>
          </button>
        </form>
        <span class="btn btn-sm btn-outline-secondary" style="cursor:default;">
          <i class="fas fa-comment me-1"></i> <?= count($post['comentarios_data'] ?? []) ?>
        </span>
      </div>

      <hr class="my-3">

      <!-- Comentarios existentes -->
      <?php if (!empty($post['comentarios_data'])): ?>
        <div class="mb-3">
          <?php foreach ($post['comentarios_data'] as $com): ?>
            <div class="d-flex gap-2 mb-2">
              <img src="/<?= htmlspecialchars($com['avatar'] ?? 'imagenes/default-profile.jpg') ?>"
                   alt="Avatar" style="width:30px;height:30px;border-radius:999px;object-fit:cover;">
              <div class="p-2 rounded-4 border flex-grow-1" style="background:var(--bg);">
                <strong style="font-size:13px;"><?= htmlspecialchars($com['nombre']) ?></strong>
                <span style="font-size:11px;opacity:.6;margin-left:6px;"><?= htmlspecialchars($com['fecha']) ?></span>
                <div style="font-size:13px;margin-top:2px;"><?= htmlspecialchars($com['texto']) ?></div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

      <!-- Form nuevo comentario (solo si está logueado) -->
      <?php if (!empty($_SESSION['user'])): ?>
        <form method="POST" action="/publicaciones" class="d-flex gap-2 align-items-start">
          <input type="hidden" name="_action"       value="comentar">
          <input type="hidden" name="idPublicacion" value="<?= $post['id'] ?>">
          <img src="/imagenes/default-profile.jpg" alt="Tu avatar"
               style="width:34px;height:34px;border-radius:999px;object-fit:cover;">
          <div class="flex-grow-1">
            <textarea class="form-control" name="contenido" rows="2"
                      placeholder="Escribe un comentario..." required></textarea>
            <div class="d-flex justify-content-end mt-2">
              <button type="submit" class="btn btn-primary btn-sm">
                <i class="fas fa-paper-plane me-1"></i> Comentar
              </button>
            </div>
          </div>
        </form>
      <?php else: ?>
        <p class="text-center text-muted" style="font-size:13px;">
          <a href="/auth">Inicia sesión</a> para comentar.
        </p>
      <?php endif; ?>

    </div>
  </article>
<?php endforeach; ?>

<?php if (empty($publicaciones)): ?>
  <div class="text-center py-5" style="opacity:.65;">
    <i class="fas fa-newspaper fa-3x mb-3 d-block"></i>
    No hay publicaciones que mostrar.
  </div>
<?php endif; ?>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>