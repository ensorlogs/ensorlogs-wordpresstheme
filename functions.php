<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

function ensorlogs_enqueue_styles() {
  wp_enqueue_style(
    'ensorlogs-style',
    get_stylesheet_uri(),
    [],
    '0.1'
  );
}
add_action( 'wp_enqueue_scripts', 'ensorlogs_enqueue_styles' );