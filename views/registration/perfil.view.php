<?php $pageTitle = 'MundialFan - Perfil'; ?>
<?php require_once __DIR__ . '/../partials/head.php'; ?>
<?php require_once __DIR__ . '/../partials/header.php'; ?>
<?php require_once __DIR__ . '/../partials/nav.php'; ?>

<main class="contenedor" style="padding: 2rem 0 2.5rem;">

  <!-- BUSCADOR DE AMIGOS -->
  <section class="card shadow-sm border-0 rounded-4 mb-4">
    <div class="card-body p-4">
      <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
        <h2 class="h5 m-0"><i class="fas fa-user-group me-2"></i>Buscar usuarios para agregar</h2>
      </div>

      <form action="/perfil" method="get" class="row g-2 align-items-center mb-3">
        <div class="col-12 col-md-8">
          <input class="form-control" type="text" name="q"
                 value="<?= htmlspecialchars($_GET['q'] ?? '') ?>"
                 placeholder="Buscar por usuario, nombre o correo...">
        </div>
        <div class="col-12 col-md-4 d-grid">
          <button class="btn btn-primary" type="submit">
            <i class="fas fa-magnifying-glass me-1"></i> Buscar
          </button>
        </div>
      </form>

      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead>
            <tr>
              <th>Usuario</th>
              <th>Nombre</th>
              <th>Estado</th>
              <th style="width:160px;">Acción</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($usuarios)): ?>
              <?php foreach ($usuarios as $u): ?>
                <tr>
                  <td class="d-flex align-items-center gap-2">
                    <img src="/<?= htmlspecialchars($u['avatar'] ?? 'imagenes/default-profile.jpg') ?>"
                         alt="Avatar"
                         style="width:36px;height:36px;border-radius:999px;object-fit:cover;">
                    <strong>@<?= htmlspecialchars($u['username']) ?></strong>
                  </td>
                  <td><?= htmlspecialchars($u['nombre']) ?></td>
                  <td>
                    <?php if ($u['estado'] === 'amigo'): ?>
                      <span class="badge text-bg-success">Amigo</span>
                    <?php elseif ($u['estado'] === 'pendiente'): ?>
                      <span class="badge text-bg-warning">Solicitud enviada</span>
                    <?php else: ?>
                      <span class="badge text-bg-secondary">No agregado</span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <?php if ($u['estado'] === 'amigo'): ?>
                      <a href="/chat?with=<?= $u['id'] ?>" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-comment-dots me-1"></i> Chat
                      </a>
                    <?php elseif ($u['estado'] === 'pendiente'): ?>
                      <form method="POST" action="/social/amigos">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="usuario_id" value="<?= $u['id'] ?>">
                        <button class="btn btn-outline-danger btn-sm" type="submit">
                          <i class="fas fa-xmark me-1"></i> Cancelar
                        </button>
                      </form>
                    <?php else: ?>
                      <form method="POST" action="/social/agregar">
                        <input type="hidden" name="usuario_id" value="<?= $u['id'] ?>">
                        <button class="btn btn-outline-primary btn-sm" type="submit">
                          <i class="fas fa-user-plus me-1"></i> Agregar
                        </button>
                      </form>
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="4" class="text-center py-3" style="opacity:.65;">
                  <i class="fas fa-user-slash me-2"></i>No se encontraron usuarios.
                </td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- PERFIL (info) -->
  <section class="card shadow-sm border-0 rounded-4 mb-4 overflow-hidden">
    <div style="height:140px; background: linear-gradient(90deg, #b00000 0%, #8b1538 40%, #2d3b87 100%);"></div>

    <div class="card-body p-4">
      <div class="d-flex flex-column flex-md-row align-items-md-end gap-3" style="margin-top:-70px;">
        <img src="/<?= htmlspecialchars($perfil['avatar'] ?? 'imagenes/default-profile.jpg') ?>"
             alt="Foto de perfil"
             style="width:140px;height:140px;border-radius:999px;object-fit:cover;border:6px solid var(--surface);">

    <div class="flex-grow-1">
  <h2 class="m-0 fw-bold" style="font-size: 1.5rem; letter-spacing: -0.5px;">
    <?= htmlspecialchars($perfil['Nombre'] ?? '—') ?>
  </h2>
  <p class="m-0" style="opacity:.7; font-size: 0.95rem;">
    @<?= htmlspecialchars($perfil['username'] ?? '—') ?>
  </p>
</div>

        <div class="d-grid gap-2" style="min-width:220px;">
          <a href="/chat" class="btn btn-outline-primary">
            <i class="fas fa-comments me-1"></i> Ir al chat
          </a>
        </div>
      </div>

      <hr class="my-4">

      <div class="row g-3">
        <div class="col-12 col-md-6">
          <div class="p-3 rounded-4" style="background:var(--bg); border:1px solid var(--border);">
            <p class="m-0">
              <strong><i class="fas fa-envelope me-2"></i>Email:</strong>
              <?= htmlspecialchars($perfil['email'] ?? '—') ?>
            </p>
          </div>
        </div>

        <div class="col-12 col-md-6">
          <div class="p-3 rounded-4" style="background:var(--bg); border:1px solid var(--border);">
            <p class="m-0">
              <strong><i class="fas fa-location-dot me-2"></i>Ubicación:</strong>
              <?= htmlspecialchars($perfil['ciudad'] ?? '—') ?>
            </p>
          </div>
        </div>

        <div class="col-12 col-md-6">
          <div class="p-3 rounded-4" style="background:var(--bg); border:1px solid var(--border);">
            <p class="m-0">
              <strong><i class="fas fa-cake-candles me-2"></i>Nacimiento:</strong>
              <?= htmlspecialchars($perfil['fechaNacimiento'] ?? '—') ?>
            </p>
          </div>
        </div>

        <div class="col-12 col-md-6">
          <div class="p-3 rounded-4" style="background:var(--bg); border:1px solid var(--border);">
            <p class="m-0">
              <strong><i class="fas fa-venus-mars me-2"></i>Género:</strong>
              <?= htmlspecialchars($perfil['genero'] ?? '—') ?>
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- PUBLICACIONES DEL USUARIO -->
  <section class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-4">
      <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
        <h2 class="h5 m-0"><i class="fas fa-newspaper me-2"></i>Mis publicaciones</h2>
        <a class="btn btn-outline-primary btn-sm" href="/crear-publicacion">
          <i class="fas fa-plus me-1"></i> Crear publicación
        </a>
      </div>

      <?php if (!empty($publicaciones)): ?>
        <?php foreach ($publicaciones as $post): ?>
          <article class="card border-0 shadow-sm rounded-4 mb-3">
            <div class="card-body">
              <div class="d-flex align-items-center gap-2 mb-2">
                <img src="/<?= htmlspecialchars($perfil['avatar'] ?? 'imagenes/default-profile.jpg') ?>"
                     alt="Avatar"
                     style="width:36px;height:36px;border-radius:999px;object-fit:cover;">
                <div>
                  <strong><?= htmlspecialchars($perfil['nombre'] ?? '') ?></strong>
                  <div style="font-size:12px; opacity:.65;">
                    <?= htmlspecialchars($post['fecha'] ?? '') ?>
                  </div>
                </div>
              </div>

              <p class="mb-2"><?= htmlspecialchars($post['texto']) ?></p>

              <?php if (!empty($post['imagen'])): ?>
                <img src="/<?= htmlspecialchars($post['imagen']) ?>"
                     alt="Imagen del post"
                     class="img-fluid rounded-4 border"
                     style="max-height:320px; object-fit:cover; width:100%;">
              <?php endif; ?>

              <div class="d-flex gap-3 mt-3" style="font-size:14px; opacity:.85;">
                <span><i class="fas fa-thumbs-up me-1"></i><?= (int)($post['likes'] ?? 0) ?></span>
                <span><i class="fas fa-comment me-1"></i><?= (int)($post['comentarios'] ?? 0) ?></span>
              </div>
            </div>
          </article>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="text-center py-4" style="opacity:.65;">
          <i class="fas fa-newspaper fa-2x mb-2 d-block"></i>
          Aún no hay publicaciones.
        </div>
      <?php endif; ?>

    </div>
  </section>

</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>