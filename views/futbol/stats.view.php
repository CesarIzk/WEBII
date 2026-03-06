<?php $pageTitle = 'MundialFan - Estadísticas'; ?>
<?php require_once __DIR__ . '/../partials/head.php'; ?>
<?php require_once __DIR__ . '/../partials/header.php'; ?>
<?php require_once __DIR__ . '/../partials/nav.php'; ?>

<main class="stats2026 contenedor">
  <section class="stats2026__head">
    <h1>Estadísticas • Mundial 2026</h1>
  </section>

  <!-- TABLAS DE GRUPOS -->
  <section class="stats2026__section">
    <h2>Fase de Grupos (12 grupos)</h2>
    <div class="groups-grid">
      <?php
      $grupos = ['A','B','C','D','E','F','G','H','I','J','K','L'];
      foreach ($grupos as $letra):
        $equipos = $tablas[$letra] ?? [];
      ?>
        <article class="table-card">
          <h3>Grupo <?= $letra ?></h3>
          <div class="table-wrap">
            <table class="mf-table">
              <thead>
                <tr>
                  <th>Pos</th><th>Equipo</th><th>PJ</th><th>G</th><th>E</th><th>P</th>
                  <th>GF</th><th>GC</th><th>DG</th><th>Pts</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($equipos)): ?>
                  <?php foreach ($equipos as $i => $eq): ?>
                    <tr>
                      <td><?= $i + 1 ?></td>
                      <td><?= htmlspecialchars($eq['nombre']) ?></td>
                      <td><?= $eq['pj'] ?></td><td><?= $eq['g'] ?></td>
                      <td><?= $eq['e'] ?></td><td><?= $eq['p'] ?></td>
                      <td><?= $eq['gf'] ?></td><td><?= $eq['gc'] ?></td>
                      <td><?= $eq['dg'] ?></td><td><?= $eq['pts'] ?></td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <?php for ($i = 1; $i <= 4; $i++): ?>
                    <tr><td><?= $i ?></td><td>—</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>
                  <?php endfor; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- FASE FINAL -->
  <section class="stats2026__section">
    <h2>Fase Final (eliminación directa)</h2>
    <div class="table-card">
      <div class="table-wrap">
        <table class="mf-table">
          <thead>
            <tr>
              <th>Ronda</th><th>Partido</th><th>Equipo 1</th>
              <th>Marcador</th><th>Equipo 2</th><th>Fecha</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($faseFinal)): ?>
              <?php foreach ($faseFinal as $p): ?>
                <tr>
                  <td><?= htmlspecialchars($p['ronda']) ?></td>
                  <td><?= $p['num'] ?></td>
                  <td><?= htmlspecialchars($p['equipo1']) ?></td>
                  <td><?= htmlspecialchars($p['marcador'] ?? '—') ?></td>
                  <td><?= htmlspecialchars($p['equipo2']) ?></td>
                  <td><?= htmlspecialchars($p['fecha'] ?? '—') ?></td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <?php foreach ([['Dieciseisavos',1],['Dieciseisavos',2],['Octavos',1],['Cuartos',1],['Semifinal',1],['Final',1],['3er lugar',1]] as [$r,$n]): ?>
                <tr><td><?= $r ?></td><td><?= $n ?></td><td>—</td><td>—</td><td>—</td><td>—</td></tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- ESTADÍSTICA GENERAL -->
  <section class="stats2026__section">
    <h2>Estadística general (goles / amarillas / rojas)</h2>
    <div class="table-card">
      <div class="table-wrap">
        <table class="mf-table">
          <thead>
            <tr><th>Equipo</th><th>Goles</th><th>Amarillas</th><th>Rojas</th></tr>
          </thead>
          <tbody>
            <?php if (!empty($statsGenerales)): ?>
              <?php foreach ($statsGenerales as $s): ?>
                <tr>
                  <td><?= htmlspecialchars($s['nombre']) ?></td>
                  <td><?= $s['goles'] ?></td>
                  <td><?= $s['amarillas'] ?></td>
                  <td><?= $s['rojas'] ?></td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <?php for ($i = 0; $i < 5; $i++): ?>
                <tr><td>—</td><td>0</td><td>0</td><td>0</td></tr>
              <?php endfor; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
