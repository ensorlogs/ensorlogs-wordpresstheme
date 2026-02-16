<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<?php
  // Mecanismos pedagógicos activos (ACF checkbox → array seguro)
  $mechanisms = get_field('log_mechanisms');
  if (!is_array($mechanisms)) {
    $mechanisms = [];
  }

  $question     = get_field('pregunta_del_quiz');
  $options_raw  = get_field('log_quiz_options');
  $options      = $options_raw ? array_filter(array_map('trim', explode("\n", $options_raw))) : [];
  $correct      = get_field('log_quiz_correct');
?>

<main class="log-single"
  data-log-id="<?php echo get_the_ID(); ?>"
  data-quiz-correct="<?php echo esc_attr($correct); ?>"
  data-hints="<?php echo esc_attr(str_replace("\n", "||", get_field('log_pistas'))); ?>"
>

  <!-- HEADER -->
  <section class="log-header">

    <div class="log-header-top">

      <nav class="log-breadcrumb">
        <a href="<?php echo home_url(); ?>">Inicio</a> /
        <a href="<?php echo get_post_type_archive_link('log'); ?>">Logs</a> /
        <span><?php the_title(); ?></span>
      </nav>

      <div class="log-id">
        💬 LOG <?php echo esc_html(get_post_meta(get_the_ID(), 'log_number', true)); ?>
      </div>

    </div>

    <div class="log-title-card">
      <h1><?php the_title(); ?></h1>

      <div class="log-meta">
        <?php if (get_field('log_duration')) : ?>
          <span>⏱ <?php the_field('log_duration'); ?></span>
        <?php endif; ?>

        <?php if (get_field('log_topic')) : ?>
          <span class="tag"><?php the_field('log_topic'); ?></span>
        <?php endif; ?>

        <span>📅 <?php echo get_the_date(); ?></span>
      </div>
    </div>
  </section>

  <!-- LOG PROGRESS STICKY (NO TOCADO) -->
  <div class="log-progress-sticky">
    <div class="log-progress-info">
      <strong class="log-progress-title"><?php the_title(); ?></strong>
      <span class="log-progress-meta">
        ⏱ <?php the_field('log_duration'); ?> ·
        <?php the_field('log_topic'); ?> ·
        📅 <?php echo get_the_date(); ?>
      </span>
    </div>

    <div class="log-progress-bar-wrapper">
      <div class="log-progress-bar">
        <span class="log-progress-fill"></span>
      </div>

      <div class="log-progress-phase">
        <span class="phase-icon">🧠</span>
        <span class="phase-text">Analizando el log :</span>
        <span class="log-progress-percent">0%</span>
      </div>
    </div>
  </div>

  <!-- CONTEXTO -->
  <?php if (get_field('log_context')) : ?>
  <section class="log-section log-step is-active" data-step="contexto">
    <div class="log-section-header">Lo que me estaba pasando…</div>
    <div class="log-section-body">
      <?php the_field('log_context'); ?>
    </div>
  </section>
  <?php endif; ?>

  <!-- PLANTEAMIENTO -->
  <?php if (get_field('log_planteamiento')) : ?>
  <section class="log-section log-step" data-step="planteamiento">
    <div class="log-section-header">Aquí fue donde algo no cuadraba…</div>
    <div class="log-section-body">
      <?php the_field('log_planteamiento'); ?>
    </div>
  </section>
  <?php endif; ?>

  <!-- QUIZ -->
  <?php if (!empty($mechanisms) && in_array('quiz', $mechanisms) && !empty($question) && !empty($options)) : ?>
<section class="log-section log-step" data-step="quiz">
  <div class="log-section-header">Si estuvieras en mi lugar, ¿qué harías?</div>
  <div class="log-section-body">

    <p><strong><?php echo esc_html($question); ?></strong></p>

    <form class="log-quiz-form">
      <?php foreach ($options as $index => $option): ?>
        <label>
          <input type="radio" name="quiz" value="<?php echo $index + 1; ?>">
          <?php echo esc_html($option); ?>
        </label><br>
      <?php endforeach; ?>

      <button type="button" class="log-quiz-btn">Comprobar</button>
    </form>

    <div class="quiz-feedback"></div>

    <?php if (in_array('solucion_bloqueada', $mechanisms)) : ?>
      <button class="show-solution-btn" hidden>Ver solución</button>
    <?php endif; ?>

  </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function() {

  const finishBtn = document.querySelector(".log-finish-btn");
  const main = document.querySelector(".log-single");

  if (!finishBtn || !main) return;

  const logId = main.dataset.logId;

  let completedLogs = JSON.parse(localStorage.getItem("completedLogs") || "[]");

  // Si ya estaba completado
  if (completedLogs.includes(logId)) {
    finishBtn.classList.add("is-completed");
    finishBtn.innerHTML = "✔ Log completado";
  }

  finishBtn.addEventListener("click", function() {

    if (!completedLogs.includes(logId)) {
      completedLogs.push(logId);
      localStorage.setItem("completedLogs", JSON.stringify(completedLogs));
    }

    finishBtn.classList.add("is-completed");
    finishBtn.innerHTML = "✔ Log completado";

  });

});
</script>
<?php endif; ?>

  <!-- PISTAS -->
  <?php if (in_array('pistas', $mechanisms) && get_field('log_pistas')) : ?>
  <section class="log-section log-step log-hints" data-step="pistas">
    <div class="log-section-header">Una pista que encontré…</div>
    <div class="log-section-body">
      <?php the_field('log_pistas'); ?>
    </div>
  </section>
  <?php endif; ?>

  <!-- SOLUCIÓN -->
  <?php if (in_array('solucion_bloqueada', $mechanisms) && get_field('log_solution')) : ?>
<section class="log-section log-step log-solution is-locked" data-step="solucion">
  <div class="log-section-header">Solución</div>
  <div class="log-section-body solution-content">
    <?php the_field('log_solution'); ?>
  </div>
</section>
<?php endif; ?>

  <!-- CIERRE -->
  <?php if (get_field('cierre')) : ?>
  <section class="log-section">
    <div class="log-section-header">Qué deberías llevarte de esto</div>
    <div class="log-section-body">
      <?php the_field('cierre'); ?>
    </div>
  </section>
  <?php endif; ?>

    <!-- LOG COMPLETADO -->
  <div class="log-completion" hidden>
  <button class="log-finish-btn">
    <span class="finish-icon">✔</span>
    He Completado y comprendido el log
  </button>
</div>


<section class="related-logs">
  <h3>Continúa practicando otro Log</h3>

  <?php
    $related = new WP_Query([
      'post_type'      => 'log',
      'posts_per_page' => 3,
      'post__not_in'   => [get_the_ID()],
      'orderby'        => 'rand'
    ]);

    if ($related->have_posts()) :
  ?>

    <div class="related-logs-grid">
      <?php while ($related->have_posts()) : $related->the_post(); ?>
        
        <article class="related-log-card">
          <a href="<?php the_permalink(); ?>">
            <h4><?php the_title(); ?></h4>

            <?php if (get_field('log_topic')) : ?>
              <span class="related-log-topic">
                <?php the_field('log_topic'); ?>
              </span>
            <?php endif; ?>

            <span class="related-log-date">
              <?php echo get_the_date(); ?>
            </span>
          </a>
        </article>

      <?php endwhile; ?>
    </div>

  <?php
    wp_reset_postdata();
    endif;
  ?>
</section>




</main>

<?php endwhile; ?>
<?php get_footer(); ?>