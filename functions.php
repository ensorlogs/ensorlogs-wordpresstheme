<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

/* ==================================================
 * ESTILOS GLOBALES
 * ================================================== */
function ensorlogs_enqueue_global_assets() {

  wp_enqueue_style(
    'ensorlogs-style',
    get_stylesheet_uri(),
    [],
    '1.0'
  );

  wp_enqueue_style(
    'fontawesome',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css'
  );
}
add_action( 'wp_enqueue_scripts', 'ensorlogs_enqueue_global_assets' );


/* ==================================================
 * SOPORTE DEL TEMA
 * ================================================== */
function ensorlogs_theme_setup() {

  add_theme_support('title-tag');
  add_theme_support('custom-logo');

  register_nav_menus([
    'main-menu' => 'Menú principal'
  ]);

}
add_action('after_setup_theme', 'ensorlogs_theme_setup');


/* ==================================================
 * CUSTOM POST TYPE: LOG
 * ================================================== */
function ensorlogs_register_log_cpt() {

  register_post_type('log', [
    'label'         => 'Logs',
    'public'        => true,
    'menu_icon'     => 'dashicons-media-text',
    'supports'      => ['title', 'editor', 'comments'],
    'rewrite'       => ['slug' => 'logs'],
    'has_archive'   => true,
    'show_in_rest'  => true,
  ]);

}
add_action('init', 'ensorlogs_register_log_cpt');


/* ==================================================
 * CSS ESPECÍFICO PARA LOGS
 * ================================================== */
function ensorlogs_enqueue_logs_styles() {

  if (
    is_front_page() ||
    is_post_type_archive('log') ||
    is_singular('log')
  ) {
    wp_enqueue_style(
      'ensorlogs-logs',
      get_template_directory_uri() . '/assets/css/logs.css',
      ['ensorlogs-style'],
      '1.0'
    );
  }

}
add_action('wp_enqueue_scripts', 'ensorlogs_enqueue_logs_styles');


/* ==================================================
 * JS DEL MOTOR DE LOGS (PROGRESO / MECANISMOS)
 * ================================================== */
function ensorlogs_enqueue_logs_scripts() {

  if ( is_singular('log') ) {

    wp_enqueue_script(
      'ensorlogs-log-engine',
      get_template_directory_uri() . '/assets/js/log-engine.js',
      [],
      '1.0',
      true
    );

  }

}
add_action('wp_enqueue_scripts', 'ensorlogs_enqueue_logs_scripts');


/* ==================================================
 * NUMERACIÓN AUTOMÁTICA DE LOGS
 * ================================================== */
function ensorlogs_assign_log_number($post_id) {

  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
  if (wp_is_post_revision($post_id)) return;

  if (get_post_type($post_id) !== 'log') return;

  if (get_post_meta($post_id, 'log_number', true)) return;

  $current = (int) get_option('ensorlogs_log_counter', 0);
  $next    = $current + 1;

  update_post_meta(
    $post_id,
    'log_number',
    str_pad($next, 3, '0', STR_PAD_LEFT)
  );

  update_option('ensorlogs_log_counter', $next);

}
add_action('save_post', 'ensorlogs_assign_log_number');


/* ==================================================
 * JS PARA CONTROLAR EL PROGRESO DEL LOG (PASOS Y MECANISMOS)
 * ================================================== */

function ensorlogs_enqueue_log_progress_script() {
  if (is_singular('log')) {
    wp_enqueue_script(
      'ensorlogs-log-progress',
      get_template_directory_uri() . '/assets/js/log-progress.js',
      [],
      '1.0',
      true
    );
  }
}
add_action('wp_enqueue_scripts', 'ensorlogs_enqueue_log_progress_script');



/* ==================================================
 * JS DEL QUIZ (DECISIÓN / PISTAS / SOLUCIÓN)
 * ================================================== */
function ensorlogs_enqueue_log_quiz_script() {
  if (is_singular('log')) {
    wp_enqueue_script(
      'ensorlogs-log-quiz',
      get_template_directory_uri() . '/assets/js/log-quiz.js',
      [],
      '1.0',
      true
    );
  }
}
add_action('wp_enqueue_scripts', 'ensorlogs_enqueue_log_quiz_script');


/* ==================================================
 * JS PARA FILTRAR LOGS EN ARCHIVO Y HOME
 * ================================================== */

function ensorlogs_assets() {

  wp_enqueue_style(
    'logs-css',
    get_template_directory_uri() . '/assets/css/logs.css',
    [],
    '1.0'
  );

  wp_enqueue_script(
    'logs-filters',
    get_template_directory_uri() . '/assets/js/filters.js',
    [],
    '1.0',
    true
  );

}
add_action('wp_enqueue_scripts', 'ensorlogs_assets');

function ensor_logs_scripts() {
    wp_enqueue_script(
        'logs-filters',
        get_template_directory_uri() . '/assets/JS/filters.js',
        [],
        null,
        true
    );
}
add_action('wp_enqueue_scripts', 'ensor_logs_scripts');


/* ==================================================
 * FUNCIONALIDAD PARA BUSCAR LOGS EN ARCHIVO Y HOME
 * ================================================== */

function ensorlogs_search_only_logs($query) {
    if (!is_admin() && $query->is_main_query() && $query->is_search()) {
        $query->set('post_type', 'log');
    }
}
add_action('pre_get_posts', 'ensorlogs_search_only_logs');