<?php $pageTitle = 'MundialFan - Crear Publicación'; ?>
<?php require_once __DIR__ . '/../partials/head.php'; ?>
<?php require_once __DIR__ . '/../partials/header.php'; ?>
<?php require_once __DIR__ . '/../partials/nav.php'; ?>

<div class="contenedor">
  <div class="header-seccion">
    <h2 class="titulo-seccion">✍️ Crear Nueva Publicación</h2>
    <a href="/publicaciones" class="btn-volver">← Volver a publicaciones</a>
  </div>

  <form id="formPublicacion" method="POST" action="/crear-publicacion" enctype="multipart/form-data" class="form-publicacion">

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

    <!-- Upload archivo (imagen o video) - un solo input dinámico -->
    <div class="form-group archivo-upload" id="archivoUpload" style="display:none;">
      <label id="archivoLabel"><i>🖼️</i> Subir Imagen</label>
      <div class="upload-area">
        <input type="file" id="archivo" name="archivo" accept="image/jpeg,image/png,image/gif,image/webp">
        <div class="upload-placeholder">
          <span class="upload-icon" id="archivoIcono">📸</span>
          <p id="archivoTexto">Arrastra una imagen aquí o haz clic para seleccionar</p>
          <small id="archivoInfo">JPG, PNG, GIF o WEBP • Máximo 5MB</small>
        </div>
      </div>
      <div class="preview" id="archivoPreview"></div>
      <?php if (!empty($errors['archivo'])): ?>
        <p class="text-danger mt-1" style="font-size:13px;"><?= $errors['archivo'] ?></p>
      <?php endif; ?>
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


<script>
document.addEventListener('DOMContentLoaded', () => {

    const radios       = document.querySelectorAll('input[name="tipoContenido"]');
    const archivoUpload = document.getElementById('archivoUpload');
    const inputArchivo  = document.getElementById('archivo');
    const label         = document.getElementById('archivoLabel');
    const icono         = document.getElementById('archivoIcono');
    const texto         = document.getElementById('archivoTexto');
    const info          = document.getElementById('archivoInfo');
    const preview       = document.getElementById('archivoPreview');

    function actualizarTipo() {
        const tipo = document.querySelector('input[name="tipoContenido"]:checked').value;

        if (tipo === 'texto') {
            archivoUpload.style.display = 'none';
            inputArchivo.value = '';
            preview.innerHTML = '';
            return;
        }

        archivoUpload.style.display = 'block';
        inputArchivo.value = '';
        preview.innerHTML = '';

        if (tipo === 'imagen') {
            label.innerHTML  = '<i>🖼️</i> Subir Imagen';
            icono.textContent = '📸';
            texto.textContent = 'Arrastra una imagen aquí o haz clic para seleccionar';
            info.textContent  = 'JPG, PNG, GIF o WEBP • Máximo 5MB';
            inputArchivo.accept = 'image/jpeg,image/png,image/gif,image/webp';
        } else {
            label.innerHTML  = '<i>🎥</i> Subir Video';
            icono.textContent = '🎬';
            texto.textContent = 'Arrastra un video aquí o haz clic para seleccionar';
            info.textContent  = 'MP4, MOV o AVI • Máximo 50MB';
            inputArchivo.accept = 'video/mp4,video/quicktime,video/x-msvideo';
        }
    }

    radios.forEach(r => r.addEventListener('change', actualizarTipo));
    actualizarTipo();

    // Preview dinámico
    inputArchivo.addEventListener('change', () => {
        const file = inputArchivo.files[0];
        const tipo = document.querySelector('input[name="tipoContenido"]:checked').value;
        preview.innerHTML = '';
        if (!file) return;

        const maxSize = tipo === 'video' ? 50 * 1024 * 1024 : 5 * 1024 * 1024;
        const maxLabel = tipo === 'video' ? '50MB' : '5MB';

        if (file.size > maxSize) {
            preview.innerHTML = `<p style="color:red;font-size:13px;">⚠️ El archivo supera los ${maxLabel}.</p>`;
            inputArchivo.value = '';
            return;
        }

        const url = URL.createObjectURL(file);
        if (tipo === 'imagen') {
            preview.innerHTML = `<img src="${url}" style="max-width:100%;max-height:300px;border-radius:12px;margin-top:10px;border:1px solid #ddd;">`;
        } else {
            preview.innerHTML = `<video controls src="${url}" style="max-width:100%;max-height:300px;border-radius:12px;margin-top:10px;border:1px solid #ddd;"></video>`;
        }
    });

    // Contador de caracteres
    const textarea = document.getElementById('texto');
    const contador = document.querySelector('.contador-caracteres');
    if (textarea && contador) {
        const actualizar = () => contador.textContent = `${textarea.value.length}/500 caracteres`;
        textarea.addEventListener('input', actualizar);
        actualizar();
    }
});
</script>
<?php require_once __DIR__ . '/../partials/footer.php'; ?>