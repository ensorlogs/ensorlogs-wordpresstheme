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

        <!-- LOGO / NOMBRE -->
        <div class="site-branding">
            <?php
            if (has_custom_logo()) {
                the_custom_logo();
            } else {
                ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="site-title">
                    ENSOR-LOGS
                </a>
                <?php
            }
            ?>
        </div>
        
<span class="site-name">ENSOR LOGS</span>
       

<!-- MENÚ -->
        <nav class="main-navigation">
  <div class="header-pill">

    <!-- MENÚ -->
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
      Sobre
    </a>
  </li>

</ul>

    <!-- DIVISOR -->
    <span class="pill-divider"></span>

    <!-- BUSCADOR -->
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

    <!-- FLECHA -->
    <span class="pill-arrow">›</span>

  </div>
</nav>

    

    </div>
</header>