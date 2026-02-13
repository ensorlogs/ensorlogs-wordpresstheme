<?php get_header(); ?>

<main class="log-single">

<?php while ( have_posts() ) : the_post(); ?>

  <!-- BREADCRUMB -->
  <nav class="log-breadcrumb">
    <a href="<?php echo home_url(); ?>">Inicio</a> /
    <a href="<?php echo get_post_type_archive_link('log'); ?>">Logs</a> /
    <span><?php the_title(); ?></span>
  </nav>

  <!-- LOG HEADER -->
  <section class="log-header">

    <?php
      $log_number = get_field('log_number');
      $duration   = get_field('log_duration');
      $topic      = get_field('log_topic');
      $level      = get_field('log_level');
    ?>

    <div class="log-id">
      💬 LOG <?php echo str_pad((int)$log_number, 3, '0', STR_PAD_LEFT); ?>
    </div>

    <div class="log-title-card">
      <h1><?php the_title(); ?></h1>

      <div class="log-meta">
        <?php if ($duration): ?><span>Duración: <?php echo esc_html($duration); ?></span><?php endif; ?>
        <?php if ($topic): ?><span>Tema: <?php echo esc_html($topic); ?></span><?php endif; ?>
        <?php if ($level): ?><span>Nivel: <?php echo esc_html($level); ?></span><?php endif; ?>
        <span>Publicado: <?php echo get_the_date(); ?></span>
      </div>
    </div>

  </section>

  <!-- CONTEXTO -->
  <?php if (get_field('log_context')) : ?>
  <section class="log-section log-context">
    <header class="log-section-header yellow">Contexto</header>
    <div class="log-section-body">
      <?php the_field('log_context'); ?>
    </div>
  </section>
  <?php endif; ?>

  <!-- PROBLEMA -->
  <?php if (get_field('log_problem')) : ?>
  <section class="log-section log-problem">
    <header class="log-section-header orange">Problema</header>
    <div class="log-section-body">
      <?php the_field('log_problem'); ?>
    </div>
  </section>
  <?php endif; ?>

  <!-- SOLUCIÓN -->
  <?php if (get_field('log_solution')) : ?>
  <section class="log-section log-solution">
    <header class="log-section-header green">Solución</header>
    <div class="log-section-body">
      <?php the_field('log_solution'); ?>
    </div>
  </section>
  <?php endif; ?>

  <!-- CIERRE -->
  <?php if (get_field('log_closure')) : ?>
  <section class="log-section log-closure">
    <header class="log-section-header gray">Cierre</header>
    <div class="log-section-body">
      <?php the_field('log_closure'); ?>
    </div>
  </section>
  <?php endif; ?>

  <!-- QUIZ -->
  <?php if (get_field('log_quiz')) : ?>
  <section class="log-section log-quiz">
    <header class="log-section-header dark">¿Entendiste?</header>
    <div class="log-section-body">
      <?php the_field('log_quiz'); ?>
      <button class="log-quiz-btn">Comprobar</button>
    </div>
  </section>
  <?php endif; ?>

  <!-- COMENTARIOS -->
  <section class="log-comments">
    <?php comments_template(); ?>
  </section>

<?php endwhile; ?>

</main>

<?php get_footer(); ?>