<?php get_header(); ?>

    <!-- SECCCION HERO -->

<section class="hero">
  <div class="hero-inner">

    <h1>Aprende informática desde problemas reales.</h1>

    <p class="hero-subtitle">
      Encuentra el problema → Solucionalo → Aprende de él
    </p>

    <form role="search" method="get" class="hero-search" action="<?php echo home_url('/'); ?>">
      <input
        type="search"
        name="s"
        placeholder="Buscar un log…"
        value="<?php echo get_search_query(); ?>"
      />
      <input type="hidden" name="post_type" value="log">
      <button type="submit">Buscar</button>
    </form>

  </div>
</section>

    <!-- SECCION : HOW WORK -->

<section class="how-notes">
  <div class="how-notes-inner">

    <h2>¿Cómo funciona EnsorLogs?</h2>

    <div class="how-notes-grid">

      <div class="how-note note-comprende">
        <div class="note-header">
          <i class="fa-solid fa-book-open"></i>
          <strong>Comprende el LOG</strong>
        </div>
        <p>Encuentra un log y entiende el contexto .</p>
      </div>

      <div class="how-note note-practica">
        <div class="note-header">
          <i class="fa-solid fa-code"></i>
          <strong>Toma una decisión</strong>
        </div>
        <p>Ponte en mi lugar y decide qué harías tú.</p>
      </div>

      <div class="how-note note-evalua">
        <div class="note-header">
          <i class="fa-solid fa-circle-check"></i>
          <strong>Descubre la solución</strong>
        </div>
        <p>Contrasta tu decisión con lo que me funcionó.</p>
      </div>

    </div>

  </div>
</section>

 <!-- SECCION : FILTROS LOGS -->
<section class="logs-filters">
  <form method="get" class="logs-filters-form" action="<?php echo home_url('/'); ?>">
    <input type="hidden" name="post_type" value="log">
    <?php if (!empty($_GET['s'])) : ?>
      <input type="hidden" name="s" value="<?php echo esc_attr($_GET['s']); ?>">
    <?php endif; ?>

    <select name="nivel">
      <option value="">Nivel</option>
      <option value="FP Grado Superior" <?php selected($_GET['nivel'] ?? '', 'FP Grado Superior'); ?>>
        FP Grado Superior
      </option>
      <option value="FP Grado Medio" <?php selected($_GET['nivel'] ?? '', 'FP Grado Medio'); ?>>
        FP Grado Medio
      </option>
      <option value="ESO" <?php selected($_GET['nivel'] ?? '', 'ESO'); ?>>
        ESO
      </option>
    </select>

    <select name="duracion">
      <option value="">Duración</option>
      <option value="5 minutos" <?php selected($_GET['duracion'] ?? '', '5 minutos'); ?>>
        5 minutos
      </option>
      <option value="10 minutos" <?php selected($_GET['duracion'] ?? '', '10 minutos'); ?>>
        10 minutos
      </option>
      <option value="15 minutos" <?php selected($_GET['duracion'] ?? '', '15 minutos'); ?>>
        15 minutos
      </option>
    </select>

    <select name="tema">
      <option value="">Tema</option>
      <option value="Debug" <?php selected($_GET['tema'] ?? '', 'Debug'); ?>>
        Debug
      </option>
      <option value="WordPress" <?php selected($_GET['tema'] ?? '', 'WordPress'); ?>>
        WordPress
      </option>
      <option value="PHP" <?php selected($_GET['tema'] ?? '', 'PHP'); ?>>
        PHP
      </option>
    </select>

    <button type="submit">Filtrar</button>

  </form>
</section>

<!-- SECCION : RESULTADOS LOGS -->
<section class="logs-results">

<?php
$meta_query = [];

if (!empty($_GET['nivel'])) {
  $meta_query[] = [
    'key'   => 'log_level',
    'value' => sanitize_text_field($_GET['nivel']),
  ];
}

if (!empty($_GET['duracion'])) {
  $meta_query[] = [
    'key'   => 'log_duration',
    'value' => sanitize_text_field($_GET['duracion']),
  ];
}

if (!empty($_GET['tema'])) {
  $meta_query[] = [
    'key'   => 'log_topic',
    'value' => sanitize_text_field($_GET['tema']),
  ];
}

$args = [
  'post_type'      => 'log',
  'posts_per_page' => 6,
  'orderby'        => 'date',
  'order'          => 'DESC',
  'meta_query'     => $meta_query,
];

$query = new WP_Query($args);
?>

<?php if ($query->have_posts()) : ?>
  <div class="logs-grid">

    <?php while ($query->have_posts()) : $query->the_post(); ?>

      <article class="log-card">

        <div class="log-code">
          💬 LOG <?php echo esc_html(get_field('log_number')); ?>
        </div>

        <h3 class="log-title">
          <a href="<?php the_permalink(); ?>">
            <?php the_title(); ?>
          </a>
        </h3>

        <div class="log-meta">
          <?php if (get_field('log_level')) : ?>
            <span>📘 <?php the_field('log_level'); ?></span>
          <?php endif; ?>

          <?php if (get_field('log_duration')) : ?>
            <span>⏱ <?php the_field('log_duration'); ?></span>
          <?php endif; ?>
        </div>

        <?php if (get_field('log_topic')) : ?>
          <div class="log-tags">
            <span class="tag"><?php the_field('log_topic'); ?></span>
          </div>
        <?php endif; ?>

      </article>

    <?php endwhile; wp_reset_postdata(); ?>

  </div>

<?php else : ?>
  <p class="no-results">No hay logs con esos filtros.</p>
<?php endif; ?>

</section>


  <!-- SECCION : ABOUT -->

<section class="ensorlogs-about">

  <div class="ensorlogs-about-grid">

    <!-- COLUMNA IZQUIERDA -->
    <div class="about-box">
      <?php if ( has_custom_logo() ) : ?>
  <div class="about-logo">
    <?php echo get_custom_logo(); ?>
  </div>
<?php endif; ?>

      <h3>Esto es EnsorLogs.</h3>

      <p>
       
No son tutoriales. Son decisiones reales que tuve que tomar. Cada Log es un problema real
donde tú decides conmigo qué hacer antes de ver la solución.
      </p>
<div class="about-social">
  <a href="https://github.com/ensorlogs" target="_blank" aria-label="GitHub">
    <i class="fab fa-github"></i>
  </a>
  <a href="https://www.linkedin.com/in/ensorsanchez/ target="_blank" aria-label="LinkedIn">
    <i class="fab fa-linkedin"></i>
  </a>
  <a href="https://www.instagram.com/ensor.logs/" target="_blank" aria-label="Instagram">
    <i class="fab fa-instagram"></i>
  </a>
  <a href="#" target="_blank" aria-label="YouTube">
    <i class="fab fa-youtube"></i>
  </a>
</div>
      <a href="<?php echo esc_url(home_url('/logs')); ?>" class="btn-primary">
        Sobre Mi
      </a>

    </div>

    <!-- COLUMNA DERECHA -->
    <div class="about-box">

      <h3>Qué encontrarás en cada Log</h3>

      <ul class="log-features">
        <li class="feature-yellow">
          <span></span>
          Un problema real que me pasó
        </li>
        <li class="feature-orange">
          <span></span>
          El punto exacto donde algo no cuadraba
        </li>
        <li class="feature-green">
          <span></span>
          Una decisión que debes tomar para resolverlo
        </li>
        <li class="feature-quiz">
          <span></span>
          Una conclusión que puedes aplicar en tus proyectos
        </li>
      </ul>

      <a href="<?php echo esc_url(home_url('/logs')); ?>" class="btn-primary">
        Ver todos los logs
      </a>

    </div>

  </div>

</section>



<?php get_footer(); ?>