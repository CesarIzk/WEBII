<?php $pageTitle = 'Detalle de Publicación - Panel Admin MundialFan'; ?>
<?php require_once __DIR__ . '/partials/head.php'; ?>
<?php require_once __DIR__ . '/partials/header.php'; ?>
<?php require_once __DIR__ . '/partials/nav.php'; ?>

<div class="contenedor mt-5">
  <a href="/admin/publicaciones" class="btn btn-secondary mb-3">
    <i class="fas fa-arrow-left"></i> Volver a Publicaciones
  </a>

  <div class="card shadow">
    <div class="card-header d-flex align-items-center gap-3">
      <?php if (!empty($post['autor_avatar'])): ?>
        <img src="/<?= htmlspecialchars($post['autor_avatar']) ?>"
             alt="Avatar" class="rounded-circle"
             style="width:50px; height:50px; object-fit:cover;">
      <?php else: ?>
        <div class="user-avatar rounded-circle text-white d-flex align-items-center justify-content-center"
             style="width:50px; height:50px; font-size:1.5rem; background:#c0392b;">
          <?= strtoupper(substr($post['autor_nombre'] ?? '?', 0, 1)) ?>
        </div>
      <?php endif; ?>

      <div>
        <h5 class="mb-0"><?= htmlspecialchars($post['autor_nombre'] ?? '') ?></h5>
        <small class="text-muted">@<?= htmlspecialchars($post['autor_username'] ?? '') ?></small><br>
        <small class="text-muted"><i class="fas fa-clock"></i> <?= htmlspecialchars($post['fecha'] ?? '') ?></small>
      </div>
    </div>

    <div class="card-body">
      <p class="card-text" style="font-size:1.1rem; white-space:pre-wrap;">
        <?= htmlspecialchars($post['texto'] ?? '') ?>
      </p>

      <?php if (!empty($post['imagen'])): ?>
        <div class="mt-3">
          <img src="/<?= htmlspecialchars($post['imagen']) ?>"
               alt="Imagen de publicación" class="img-fluid rounded"
               style="max-height:600px; width:auto;">
        </div>
      <?php endif; ?>

      <?php if (!empty($post['video'])): ?>
        <div class="mt-3">
          <video controls class="w-100 rounded" style="max-height:600px;">
            <source src="/<?= htmlspecialchars($post['video']) ?>" type="video/mp4">
            Tu navegador no soporta videos.
          </video>
        </div>
      <?php endif; ?>

      <div class="mt-4 d-flex gap-3">
        <button class="btn btn-outline-primary" id="btn-like" data-post-id="<?= $post['id'] ?? '' ?>">
          <i class="fas fa-heart"></i>
          <span id="like-count"><?= $post['likes'] ?? 0 ?></span> Me gusta
        </button>
        <button class="btn btn-outline-secondary">
          <i class="fas fa-share"></i> Compartir
        </button>
      </div>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
