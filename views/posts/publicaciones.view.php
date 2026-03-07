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

  <?php foreach ($publicaciones ?? [] as $post): ?>
    <article class="mf-post mf-post--narrow card border-0 shadow-sm rounded-4 mb-4 mx-auto" style="max-width: 600px;">
      <div class="card-body">

        <div class="d-flex align-items-center gap-2 mb-3">
          <img src="/imagenes/default-profile.jpg"
               alt="Avatar" style="width:40px;height:40px;border-radius:50%;object-fit:cover;">
          <div>
            <h6 class="m-0 fw-bold"><?= htmlspecialchars($post['autor']) ?></h6>
            <small class="text-muted" style="font-size:11px;"><?= htmlspecialchars($post['fecha']) ?></small>
          </div>
        </div>

        <p class="mb-3"><?= htmlspecialchars($post['texto']) ?></p>

        <?php if (!empty($post['rutaMulti'])): ?>
          <div class="post-media mb-3">
            <?php if (($post['tipoContenido'] ?? '') === 'video'): ?>
              <video controls class="w-100 rounded-4 border" style="max-height:400px;">
                <source src="/<?= htmlspecialchars($post['rutaMulti']) ?>">
              </video>
            <?php else: ?>
              <img src="/<?= htmlspecialchars($post['rutaMulti']) ?>" alt="Imagen"
                   class="img-fluid rounded-4 border w-100" style="max-height:400px;object-fit:cover;">
            <?php endif; ?>
          </div>
        <?php endif; ?>

        <div class="d-flex align-items-center gap-3 mb-2">
          <?php if (!empty($_SESSION['user'])): ?>
            <form method="POST" action="/publicaciones" class="ajax-like">
              <input type="hidden" name="_action" value="like">
              <input type="hidden" name="id" value="<?= $post['id'] ?>">
              <button type="submit" class="btn btn-sm <?= ($post['usuario_dio_like'] ?? false) ? 'btn-danger' : 'btn-outline-secondary' ?> rounded-pill px-3">
                <i class="<?= ($post['usuario_dio_like'] ?? false) ? 'fas' : 'far' ?> fa-heart me-1"></i>
                <span class="like-count"><?= (int)($post['likes'] ?? 0) ?></span>
              </button>
            </form>
          <?php else: ?>
            <a href="/auth" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
              <i class="far fa-heart me-1"></i> <?= (int)($post['likes'] ?? 0) ?>
            </a>
          <?php endif; ?>

          <span class="text-muted" style="font-size: 14px;">
            <i class="far fa-comment me-1"></i> <?= count($post['comentarios_data'] ?? []) ?> comentarios
          </span>
        </div>

        <hr class="my-3 opacity-25">

        <div class="comments-section-<?= $post['id'] ?> mb-3">
          <?php if (!empty($post['comentarios_data'])): ?>
            <?php foreach ($post['comentarios_data'] as $com): ?>
              <div class="d-flex gap-2 mb-2">
                <img src="/<?= htmlspecialchars($com['avatar'] ?? 'imagenes/default-profile.jpg') ?>"
                     alt="Avatar" style="width:30px;height:30px;border-radius:50%;object-fit:cover;">
                <div class="p-2 rounded-4 bg-light flex-grow-1 border">
                  <div class="d-flex justify-content-between">
                    <strong style="font-size:12px;"><?= htmlspecialchars($com['nombre']) ?></strong>
                    <small class="text-muted" style="font-size:10px;"><?= htmlspecialchars($com['fecha']) ?></small>
                  </div>
                  <div style="font-size:13px;"><?= htmlspecialchars($com['texto']) ?></div>
                </div>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>

        <?php if (!empty($_SESSION['user'])): ?>
          <form method="POST" action="/publicaciones" class="ajax-comment d-flex gap-2">
            <input type="hidden" name="_action" value="comentar">
            <input type="hidden" name="idPublicacion" value="<?= $post['id'] ?>">
            <img src="/imagenes/default-profile.jpg" alt="Tu avatar"
                 style="width:34px;height:34px;border-radius:50%;object-fit:cover;">
            <div class="flex-grow-1">
              <textarea class="form-control form-control-sm rounded-3" name="contenido" rows="1"
                        placeholder="Escribe un comentario..." required></textarea>
              <div class="d-flex justify-content-end mt-2">
                <button type="submit" class="btn btn-primary btn-sm px-3 rounded-pill">
                  <i class="fas fa-paper-plane"></i>
                </button>
              </div>
            </div>
          </form>
        <?php endif; ?>
      </div>
    </article>
  <?php endforeach; ?>

  <?php if (empty($publicaciones)): ?>
    <div class="text-center py-5" style="opacity:.5;">
      <i class="fas fa-newspaper fa-3x mb-3"></i>
      <p>No se encontraron publicaciones.</p>
    </div>
  <?php endif; ?>
</div>
<script src="/js/social.js"></script>
<?php require_once __DIR__ . '/../partials/footer.php'; ?>