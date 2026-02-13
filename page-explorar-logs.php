<?php
/*
Template Name: Explorar Logs
*/
get_header();
?>

<main class="logs-library">

  <!-- HERO -->
  <section class="logs-hero">
    <h1>📚 Explora todos los Logs</h1>
    <p>Casos reales. Decisiones técnicas. Soluciones explicadas paso a paso.</p>
  </section>

  <!-- FILTROS REALES -->
  <section class="logs-filters-advanced">

    <div class="filter-group">
      <label>Nivel</label>
      <select id="filter-level">
        <option value="">Todos</option>
        <option value="Primaria">Primaria</option>
        <option value="Secundaria">Secundaria</option>
        <option value="FP">FP</option>
      </select>
    </div>

    <div class="filter-group">
      <label>Duración</label>
      <select id="filter-duration">
        <option value="">Todas</option>
        <option value="5 minutos">5 minutos</option>
        <option value="10 minutos">10 minutos</option>
        <option value="15 minutos">15 minutos</option>
      </select>
    </div>

    <div class="filter-group">
      <label>Tema</label>
      <select id="filter-topic">
        <option value="">Todos</option>
        <option value="Conceptual">Conceptual</option>
        <option value="WordPress">WordPress</option>
        <option value="Ciberseguridad">Ciberseguridad</option>
      </select>
    </div>

  </section>

  <!-- GRID -->
  <section class="logs-grid">

    <?php
    $logs = new WP_Query([
      'post_type' => 'log',
      'posts_per_page' => -1,
      'orderby' => 'date',
      'order' => 'DESC'
    ]);

    if ($logs->have_posts()) :
      while ($logs->have_posts()) : $logs->the_post();

        $duration = get_field('log_duration');
        $topic = get_field('log_topic');
        $level = get_field('log_level');
        $log_number = get_post_meta(get_the_ID(), 'log_number', true);
    ?>

      <article class="log-card"
        data-level="<?php echo esc_attr($level); ?>"
        data-duration="<?php echo esc_attr($duration); ?>"
        data-topic="<?php echo esc_attr($topic); ?>">

        <a href="<?php the_permalink(); ?>" class="log-card-inner">

          <div class="log-card-header">
            <span class="log-number">
              LOG <?php echo esc_html($log_number); ?>
            </span>
          </div>

          <h3 class="log-card-title">
            <?php the_title(); ?>
          </h3>

          <div class="log-card-meta">

            <?php if ($duration): ?>
              <span class="meta-item">
                ⏱ <?php echo esc_html($duration); ?>
              </span>
            <?php endif; ?>

            <?php if ($level): ?>
              <span class="meta-item tag tag-level">
                <?php echo esc_html($level); ?>
              </span>
            <?php endif; ?>

            <?php if ($topic): ?>
              <span class="meta-item tag tag-topic">
                <?php echo esc_html($topic); ?>
              </span>
            <?php endif; ?>

          </div>

          <span class="log-card-link">
            Leer log →
          </span>

        </a>

      </article>

    <?php
      endwhile;
      wp_reset_postdata();
    else :
      echo "<p>No hay logs disponibles.</p>";
    endif;
    ?>

  </section>

</main>

<?php get_footer(); ?>