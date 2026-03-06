<?php $pageTitle = 'MundialFan - Campeonatos'; ?>
<?php require_once __DIR__ . '/../partials/head.php'; ?>
<?php require_once __DIR__ . '/../partials/header.php'; ?>
<?php require_once __DIR__ . '/../partials/nav.php'; ?>

<section class="hero hero-campeonatos">
  <div class="hero-slideshow">
    <div class="hero-slide"></div>
    <div class="hero-slide"></div>
    <div class="hero-slide"></div>
  </div>
  <div class="hero-contenido">
    <h2>Vive la Emoción del Mundial</h2>
    <p>Todo lo que necesitas saber sobre el mayor evento de fútbol del planeta. Noticias, estadísticas, resultados y mucho más.</p>
  </div>
</section>

<!-- HISTORIA -->
<section id="info" class="caracteristicas">
  <div class="contenedor">
    <h2 class="titulo-seccion">Historia del Mundial de Fútbol</h2>
    <p>
      El Mundial de Fútbol es el torneo internacional más importante del fútbol, organizado cada cuatro años por la FIFA.
      Desde 1930, millones de aficionados siguen a sus selecciones nacionales en busca de la gloria.
    </p>
  </div>
</section>

<!-- EDICIONES -->
<section id="ediciones" class="caracteristicas">
  <div class="contenedor">
    <h2 class="titulo-seccion">Ediciones del Mundial</h2>

    <div class="filtro-ediciones">
      <input
        type="text"
        id="filtroInput"
        placeholder="Buscar por año, sede o campeón..."
        class="input-filtro"
        onkeyup="filtrarEdiciones()"
      >
    </div>

    <section class="wc-result">
      <div class="wc-card">
        <div class="wc-card__head">
          <h2>Resultado de búsqueda: <span>Brasil 2014</span></h2>
        </div>
        <div class="wc-grid">
          <div class="wc-box">
            <h3>Final</h3>
            <ul class="wc-list">
              <li><strong>Campeón:</strong> Alemania</li>
              <li><strong>Subcampeón:</strong> Argentina</li>
              <li><strong>3er lugar:</strong> Países Bajos</li>
              <li><strong>4to lugar:</strong> Brasil</li>
            </ul>
          </div>
          <div class="wc-box">
            <h3>Top 10 selecciones (más exitosas) y fase de eliminación</h3>
            <ol class="wc-list wc-list--ol">
              <li><strong>Alemania</strong> — Campeón</li>
              <li><strong>Argentina</strong> — Subcampeón</li>
              <li><strong>Países Bajos</strong> — 3er lugar</li>
              <li><strong>Brasil</strong> — 4to lugar</li>
              <li><strong>Colombia</strong> — Eliminado en cuartos</li>
              <li><strong>Bélgica</strong> — Eliminado en cuartos</li>
              <li><strong>Francia</strong> — Eliminado en cuartos</li>
              <li><strong>Costa Rica</strong> — Eliminado en cuartos</li>
              <li><strong>Chile</strong> — Eliminado en octavos</li>
              <li><strong>México</strong> — Eliminado en octavos</li>
            </ol>
          </div>
          <div class="wc-box wc-box--full">
            <h3>Jugadores más destacados (premios FIFA)</h3>
            <div class="wc-pills">
              <span class="wc-pill"><strong>Balón de Oro:</strong> Lionel Messi</span>
              <span class="wc-pill"><strong>Bota de Oro (goleador):</strong> James Rodríguez (6)</span>
              <span class="wc-pill"><strong>Guante de Oro:</strong> Manuel Neuer</span>
              <span class="wc-pill"><strong>Mejor Joven:</strong> Paul Pogba</span>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</section>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
