<?php
/**
 * Log Header – EnsorLogs
 * Cabecera pedagógica para cada Log
 */
?>

<header class="log-header">

  <!-- Breadcrumb -->
  <nav class="log-breadcrumb">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Inicio</a> /
    <a href="<?php echo esc_url( home_url( '/logs' ) ); ?>">Logs</a> /
    <span><?php the_title(); ?></span>
  </nav>


<!-- LOG ID -->
<?php
$log_number = get_post_meta(get_the_ID(), 'log_number', true);
?>

<div class="log-id">
  💬 LOG <?php echo esc_html($log_number); ?>
</div>



  <!-- Título -->
  <h1 class="log-title"><?php the_title(); ?></h1>

  <!-- Subtítulo (excerpt) -->
  <?php if ( has_excerpt() ) : ?>
    <p class="log-subtitle"><?php echo esc_html( get_the_excerpt() ); ?></p>
  <?php endif; ?>

  <!-- Metadatos -->
  <div class="log-meta">

    <?php
    // Nivel
    $nivel = get_the_terms( get_the_ID(), 'nivel' );
    if ( ! is_wp_error( $nivel ) && ! empty( $nivel ) ) {
      echo '<span class="log-badge badge-nivel">🏫 ' . esc_html( $nivel[0]->name ) . '</span>';
    }

    // Público
    $publico = get_the_terms( get_the_ID(), 'publico' );
    if ( ! is_wp_error( $publico ) && ! empty( $publico ) ) {
      echo '<span class="log-badge badge-publico">👥 ' . esc_html( $publico[0]->name ) . '</span>';
    }

    // Enfoque
    $enfoque = get_the_terms( get_the_ID(), 'enfoque' );
    if ( ! is_wp_error( $enfoque ) && ! empty( $enfoque ) ) {
      echo '<span class="log-badge badge-enfoque">🧠 ' . esc_html( $enfoque[0]->name ) . '</span>';
    }

    // Duración (meta field)
    $duracion = get_post_meta( get_the_ID(), 'duracion', true );
    if ( ! empty( $duracion ) ) {
      echo '<span class="log-badge badge-duracion">⏱ ' . esc_html( $duracion ) . '</span>';
    }
    ?>

  </div>

  <!-- Frase pedagógica -->
  <p class="log-intention">
    Este log documenta un problema real y cómo lo pude resolver. 
  </p>

</header>