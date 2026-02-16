<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <?php wp_head(); ?>
</head>

<body 
  <?php body_class(); ?>
  data-log-id="<?php echo get_the_ID(); ?>"
  data-quiz-correct="<?php the_field('log_quiz_correct'); ?>"
>
<header class="site-header">
    <div class="header-inner">

        <!-- LOGO -->
        <div class="site-branding">
            <?php
            if (has_custom_logo()) {
                the_custom_logo();
            } else {
                ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="site-title">
                    ENSOR.LOGS
                </a>
                <?php
            }
            ?>
        </div>

        <!-- BRANDING TEXT -->
        <div class="branding-text">
            <span class="site-name" id="main-title">ENSOR.LOGS</span>
            <span class="site-tagline" id="main-tagline">Bitácora de decisiones reales.</span>
            <span class="site-terminal" id="terminal-message"></span>
            <div class="global-progress">
                <span class="global-progress-count">0</span>
                <span class="global-progress-label">Logs completados</span>
            </div>
        </div>

        <!-- MENÚ -->
        <nav class="main-navigation">
            <div class="header-pill">

                <ul class="pill-menu">

                    <li>
                        <a href="http://ensorlogs.local/explorar-logs/">
                            <i class="fa-solid fa-list"></i>
                            Logs
                        </a>
                    </li>

                    <li>
                        <a href="/rutas">
                            <i class="fa-regular fa-compass"></i>
                            Rutas
                        </a>
                    </li>

                    <li>
                        <a href="/sobre">
                            <i class="fa-solid fa-circle-info"></i>
                            ¿Ensor?
                        </a>
                    </li>
                    <li>
                        <a href="/podcast">
                            <i class="fa-solid fa-microphone"></i>
                            Podcast
                        </a>
                    </li>

                </ul>

                <span class="pill-divider"></span>

                <form role="search" method="get" class="pill-search" action="<?php echo home_url('/'); ?>">
                    <input
                        type="search"
                        placeholder="Buscar un log…"
                        value="<?php echo get_search_query(); ?>"
                        name="s"
                    />
                    <input type="hidden" name="post_type" value="log" />
                    <button type="submit">Buscar</button>
                </form>

                <span class="pill-arrow">›</span>

            </div>
        </nav>

    </div>
</header>
<script>
document.addEventListener("DOMContentLoaded", function() {

  const messages = [
    "> Inicializando bitácora...",
    "> Registrando decisión crítica...",
    "> Analizando problema real...",
    "> Ejecutando plan de acción...",
    "> Evaluando consecuencias...",
    "> Commit realizado con dudas.",
    "> Debugging decisiones humanas...",
    "> Iterando sobre errores reales...",
    "> Optimizando procesos imperfectos...",
    "> Arquitectura en construcción...",
    "> Refactorizando pensamiento...",
    "> Modo análisis profundo activado.",
    "> Documentando aprendizaje real...",
    "> Sistema en evolución constante...",
    "> Fallo detectado. Ajustando rumbo...",
    "> Pensar antes de ejecutar...",
    "> Construyendo desde la incertidumbre...",
    "> Decisión tomada. Resultado pendiente...",
    "> Log guardado en memoria.",
    "> Ingeniería aplicada a la vida real."
  ];

  const randomMessage = messages[Math.floor(Math.random() * messages.length)];
  const terminal = document.getElementById("terminal-message");

  if (terminal) {
    terminal.textContent = randomMessage;
  }

  /* =========================
     TYPE ONCE TITLE EFFECT
     ========================= */

  const title = document.getElementById("main-title");
  const tagline = document.getElementById("main-tagline");

  function typeOnce(element, text, speed = 40) {
    let i = 0;
    element.textContent = "";
    const interval = setInterval(() => {
      element.textContent += text.charAt(i);
      i++;
      if (i >= text.length) clearInterval(interval);
    }, speed);
  }

  if (title && tagline) {
    const originalTitle = "ENSOR.LOGS";
    const originalTagline = "Bitácora de decisiones reales.";

    typeOnce(title, originalTitle, 90);

    setTimeout(() => {
      typeOnce(tagline, originalTagline, 60);
    }, 900);
  }

  /* =========================
     GLOBAL COMPLETION COUNTER
     ========================= */

  const progressCount = document.querySelector(".global-progress-count");

  if (progressCount) {
    const completedLogs = JSON.parse(localStorage.getItem("completedLogs") || "[]");
    progressCount.textContent = completedLogs.length;
  }

});
</script></body>
</html>