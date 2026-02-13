<?php get_header(); ?>

<main class="logs-library">

  <!-- HERO -->
  <section class="logs-hero">
    <h1>Resultados de búsqueda</h1>
    <p>
      <?php
        printf(
          'Mostrando resultados para: <strong>%s</strong>',
          esc_html(get_search_query())
        );
      ?>
    </p>
  </section>

  <!-- GRID RESULTADOS -->
  <div class="logs-grid">

    <?php if (have_posts()) : ?>
      
      <?php while (have_posts()) : the_post(); ?>
        
        <?php if (get_post_type() === 'log') : ?>
        <article class="log-card">
          <a href="<?php the_permalink(); ?>" class="log-card-inner">
            
            <?php $log_number = get_post_meta(get_the_ID(), 'log_number', true); ?>
            <?php if ($log_number) : ?>
              <span class="log-number">
                LOG <?php echo esc_html($log_number); ?>
              </span>
            <?php endif; ?>

            <h3 class="log-card-title"><?php the_title(); ?></h3>

            <div class="log-card-meta">
              <?php if (get_field('log_topic')) : ?>
                <span class="tag tag-topic">
                  <?php the_field('log_topic'); ?>
                </span>
              <?php endif; ?>

              <?php if (get_field('log_duration')) : ?>
                <span class="meta-item">
                  ⏱ <?php the_field('log_duration'); ?>
                </span>
              <?php endif; ?>
            </div>

            <span class="log-card-link">Ver log →</span>

          </a>
        </article>
        <?php endif; ?>

      <?php endwhile; ?>

    <?php else : ?>

      <div class="log-card" style="text-align:center;">
        <h3 class="log-card-title">No se encontraron logs relacionados</h3>
        <p style="margin-top:10px; opacity:0.7;">
          Intenta con otra palabra clave o explora los logs disponibles.
        </p>
      </div>

    <?php endif; ?>

  </div>

</main>

<?php get_footer(); ?>