<?php $pageTitle = 'MundialFan - Crear Publicación'; ?>
<?php require_once __DIR__ . '/../partials/head.php'; ?>
<?php require_once __DIR__ . '/../partials/header.php'; ?>
<?php require_once __DIR__ . '/../partials/nav.php'; ?>

<div class="contenedor">
  <div class="header-seccion">
    <h2 class="titulo-seccion">✍️ Crear Nueva Publicación</h2>
    <a href="/publicaciones" class="btn-volver">← Volver a publicaciones</a>
  </div>

  <form id="formPublicacion" method="POST" action="/publicaciones" enctype="multipart/form-data" class="form-publicacion">

    <!-- Texto -->
    <div class="form-group">
      <label for="texto"><i>💭</i> ¿Qué estás pensando?</label>
      <textarea
        id="texto" name="texto" rows="5" maxlength="500"
        placeholder="Comparte tus opiniones sobre el Mundial, tu equipo favorito, momentos históricos..."
        required
      ><?= htmlspecialchars($_POST['texto'] ?? '') ?></textarea>
      <small class="contador-caracteres">0/500 caracteres</small>
      <?php if (!empty($errors['texto'])): ?>
        <p class="text-danger mt-1" style="font-size:13px;"><?= $errors['texto'] ?></p>
      <?php endif; ?>
    </div>

    <!-- Categoría -->
    <div class="form-group">
      <label for="categoria"><i>📂</i> Categoría</label>
      <select name="idCategoria" id="categoria" class="form-select" required>
        <option value="">Selecciona una categoría</option>
        <?php foreach ($categorias ?? [] as $cat): ?>
          <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['nombre']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <!-- Tipo de contenido -->
    <div class="form-group">
      <label><i>🎨</i> Tipo de contenido:</label>
      <div class="tipo-contenido">
        <label class="radio-card">
          <input type="radio" name="tipoContenido" value="texto" checked>
          <span class="radio-content">
            <span class="radio-icon">📝</span>
            <span class="radio-text">Solo texto</span>
          </span>
        </label>
        <label class="radio-card">
          <input type="radio" name="tipoContenido" value="imagen">
          <span class="radio-content">
            <span class="radio-icon">🖼️</span>
            <span class="radio-text">Con imagen</span>
          </span>
        </label>
        <label class="radio-card">
          <input type="radio" name="tipoContenido" value="video">
          <span class="radio-content">
            <span class="radio-icon">🎥</span>
            <span class="radio-text">Con video</span>
          </span>
        </label>
      </div>
    </div>

    <!-- Upload imagen -->
    <div class="form-group archivo-upload" id="imagenUpload" style="display:none;">
      <label for="imagen"><i>🖼️</i> Subir Imagen</label>
      <div class="upload-area">
        <input type="file" id="imagen" name="archivo" accept="image/jpeg,image/png,image/gif,image/webp">
        <div class="upload-placeholder">
          <span class="upload-icon">📸</span>
          <p>Arrastra una imagen aquí o haz clic para seleccionar</p>
          <small>JPG, PNG, GIF o WEBP • Máximo 5MB</small>
        </div>
      </div>
      <div class="preview" id="imagenPreview"></div>
      <?php if (!empty($errors['archivo'])): ?>
        <p class="text-danger mt-1" style="font-size:13px;"><?= $errors['archivo'] ?></p>
      <?php endif; ?>
    </div>

    <!-- Upload video -->
    <div class="form-group archivo-upload" id="videoUpload" style="display:none;">
      <label for="video"><i>🎥</i> Subir Video</label>
      <div class="upload-area">
        <input type="file" id="video" name="archivo" accept="video/mp4,video/quicktime,video/x-msvideo">
        <div class="upload-placeholder">
          <span class="upload-icon">🎬</span>
          <p>Arrastra un video aquí o haz clic para seleccionar</p>
          <small>MP4, MOV o AVI • Máximo 50MB</small>
        </div>
      </div>
      <div class="preview" id="videoPreview"></div>
    </div>

    <!-- Acciones -->
    <div class="form-actions">
      <button type="submit" class="btn-publicar">
        <span class="btn-icon">✓</span>
        <span class="btn-text">Publicar</span>
      </button>
      <a href="/publicaciones" class="btn-cancelar">
        <span class="btn-icon">✕</span>
        <span class="btn-text">Cancelar</span>
      </a>
    </div>

    <div id="mensaje" class="mensaje" style="display:none;"></div>
  </form>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>