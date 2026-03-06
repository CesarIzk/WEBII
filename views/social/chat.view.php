<?php $pageTitle = 'MundialFan - Chat'; ?>
<?php require_once __DIR__ . '/../partials/head.php'; ?>
<?php require_once __DIR__ . '/../partials/header.php'; ?>
<?php require_once __DIR__ . '/../partials/nav.php'; ?>

<main class="chat-page">
  <div class="chat-shell">
    <!-- Sidebar -->
    <aside class="chat-sidebar" aria-label="Lista de chats">
      <div class="chat-sidebar__top">
        <h2 class="chat-sidebar__title">Chats</h2>
        <button class="chat-icon-btn" type="button" title="Nuevo chat">
          <i class="fas fa-pen-to-square"></i>
        </button>
      </div>
      <div class="chat-sidebar__search">
        <div class="chat-search">
          <i class="fas fa-search"></i>
          <input type="text" placeholder="Buscar en chats..." aria-label="Buscar chats">
        </div>
      </div>
      <ul class="chat-list">
        <li>
          <a class="chat-item chat-item--active" href="#" aria-current="page">
            <img class="chat-avatar" src="/imagenes/default-profile.jpg" alt="Avatar de Ana">
            <div class="chat-item__meta">
              <div class="chat-item__row"><p class="chat-item__name">Ana</p></div>
              <p class="chat-item__preview">¿Listo para ver el partido?</p>
            </div>
            <span class="chat-badge" title="Mensajes sin leer">2</span>
          </a>
        </li>
        <li>
          <a class="chat-item" href="#">
            <img class="chat-avatar" src="/imagenes/messi.jpg" alt="Avatar de Leo">
            <div class="chat-item__meta">
              <div class="chat-item__row"><p class="chat-item__name">Leo</p></div>
              <p class="chat-item__preview">Te pasé el video, échale ojo</p>
            </div>
          </a>
        </li>
        <li>
          <a class="chat-item" href="#">
            <img class="chat-avatar" src="/imagenes/estadio.png" alt="Grupo MundialFan">
            <div class="chat-item__meta">
              <div class="chat-item__row"><p class="chat-item__name">Grupo: MundialFan</p></div>
              <p class="chat-item__preview">Carlos: ¿quién trae las apuestas?</p>
            </div>
          </a>
        </li>
        <li>
          <a class="chat-item" href="#">
            <img class="chat-avatar" src="/imagenes/default-profile.jpg" alt="Avatar de Carlos">
            <div class="chat-item__meta">
              <div class="chat-item__row"><p class="chat-item__name">Carlos</p></div>
              <p class="chat-item__preview">Va, nos vemos en el estadio.</p>
            </div>
          </a>
        </li>
      </ul>
    </aside>

    <!-- Conversación -->
    <section class="chat-main" aria-label="Conversación">
      <div class="chat-topbar">
        <div class="chat-topbar__left">
          <img class="chat-avatar" src="/imagenes/default-profile.jpg" alt="Avatar de Ana">
          <div class="chat-topbar__title"><h2>Ana</h2></div>
        </div>
      </div>

      <div class="chat-messages">
        <div class="msg-row msg-row--them">
          <img class="chat-avatar--msg" src="/imagenes/default-profile.jpg" alt="Avatar de Ana">
          <div class="msg msg--them">
            <div class="msg-bubble">¿Listo para el partido? Si quieres armamos grupo con los demás 👀</div>
          </div>
        </div>
        <div class="msg-row msg-row--me">
          <div class="msg msg--me">
            <div class="msg-bubble">Sii. Pásame el grupo y te mando una foto del estadio.</div>
          </div>
        </div>
        <div class="msg-row msg-row--me">
          <div class="msg msg--me">
            <div class="msg-bubble">
              <div class="msg-media">
                <img src="/imagenes/estadio.png" alt="Imagen enviada">
              </div>
            </div>
          </div>
        </div>
        <div class="msg-row msg-row--them">
          <img class="chat-avatar--msg" src="/imagenes/default-profile.jpg" alt="Avatar de Ana">
          <div class="msg msg--them">
            <div class="msg-bubble">
              Mira este clip
              <div class="msg-media">
                <video controls src="/videos/1761027309_Rashica.mp4"></video>
              </div>
            </div>
          </div>
        </div>
      </div>

      <form class="chat-composer" action="#" method="post">
        <input id="chat-attach-input" type="file" accept="image/*,video/*" multiple hidden>
        <label class="chat-attach" for="chat-attach-input" title="Adjuntar foto o video">
          <i class="fas fa-paperclip"></i>
        </label>
        <textarea class="chat-input" rows="1" placeholder="Escribe un mensaje..." aria-label="Escribir mensaje"></textarea>
        <button class="chat-send" type="button" title="Enviar">
          <i class="fas fa-paper-plane"></i> <span>Enviar</span>
        </button>
      </form>
    </section>
  </div>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
