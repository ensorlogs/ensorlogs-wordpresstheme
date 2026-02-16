<?php
/* Template Name: About EnsorLogs */
get_header();
?>

<section class="about-hero">
  <div class="about-hero-inner">


    <h1 class="about-typing">
      <span id="about-typing-text"></span>
    </h1>

    <p class="about-subtitle">
      Analizo problemas reales, tomo decisiones bajo incertidumbre
      y documento el proceso completo
      
      EnsorLogs es mi laboratorio público de aprendizaje continuo.
    </p>

  </div>
</section>


<!-- IDENTIDAD -->
<section class="about-section">
  <div class="about-container">

    <div class="about-card large">
      <h2>¿Qué es EnsorLogs?</h2>

      <p>
        EnsorLogs no es un blog tradicional. No es una colección de tutoriales optimizados
        para SEO ni contenido diseñado para agradar algoritmos.
      </p>

      <p>
        Es una bitácora técnica donde documento problemas reales que enfrenté,
        decisiones que tuve que tomar y las consecuencias de ejecutarlas, todo mientras me acompañas.
      </p>

      <p>
        Aquí no explico teoría aislada. Trato de analizar contexto,
        Evalúar caminos posibles y documento el criterio detrás de cada elección.
      </p>
    </div>

  </div>
</section>


<!-- FILOSOFÍA -->
<section class="about-section">
  <div class="about-container">

    <div class="about-grid">

      <div class="about-card philosophy">
        <h3>> Pensar</h3>
        <p>
          Antes de escribir una línea de código o resolver una situacion tecnica, hay que entender el problema.
          Aquí podras ver como evaluo situaciones reales y las identifico.
          Para ayudarme a entender como puedo resolverlo
        </p>
      </div>

      <div class="about-card philosophy">
        <h3>> Decidir</h3>
        <p>
          En informática no siempre hay una única respuesta correcta.
          En cada LOG verás cómo comparo opciones, evalúo riesgos
          y tomo decisiones técnicas que afectan en la realidad.
        </p>
      </div>

      <div class="about-card philosophy">
        <h3>> Ejecutar</h3>
        <p>
          Aprender-Haciendo es la base de EnsorLogs.
          No solo verás una teoría: verás cómo se implementa,
          qué falló en el camino y qué resultados reales obtienes.
        </p>
      </div>

    </div>

  </div>
</section>


<!-- REDES / WIDGET AREA -->
<section class="about-section alt">
  <div class="about-container">

    <div class="about-card large">
      <h2>Real Logs = Real Life</h2>

      <p>
        Además de los LOGS publicados aquí, comparto procesos,
        decisiones y reflexiones en mis redes.
      </p>

      <div class="social-widgets">

        <!-- Instagram Widget -->
        <div class="about-card gradient-border social-card instagram-card">
        

          <div class="instagram-embed" style="margin-top:0px;">
            <blockquote 
              class="instagram-media" 
              data-instgrm-permalink="https://www.instagram.com/ensor.logs/" 
              data-instgrm-version="14"
              style="background:#FFF; border:0; border-radius:12px; margin:0 auto; max-width:540px; width:100%;">
            </blockquote>
          </div>
           <a href="https://www.instagram.com/ensor.logs/" 
             target="_blank" 
             class="social-follow-btn">
             Seguir @ensor.logs
          </a>
        </div>
         

        <!-- Threads Widget -->
        <div class="about-card gradient-border social-card threads-card">
          <div class="widget-placeholder">
            <p>Widget Threads aquí</p>
          </div>
        </div>
      </div>

    </div>

  </div>
<style>
.gradient-border {
  position: relative;
  background: linear-gradient(145deg, #1f2933, #111827);
  border-radius: 28px;
  padding: 40px;
  overflow: hidden;
}

.gradient-border::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  height: 6px;
  width: 100%;
  background: linear-gradient(
    90deg,
    #F5C35C,
    #E1A067,
    #A8BE7B
  );
}

.gradient-border h3 {
  color: #ffffff;
  font-weight: 800;
}

.gradient-border p {
  color: #d1d5db;
}

.social-follow-btn {
  display: inline-block;
  margin-top: 16px;
  padding: 10px 20px;
  background: #EDB952;
  color: #2E2E2E;
  font-weight: 700;
  border-radius: 12px;
  text-decoration: none;
  transition: 0.3s ease;
}

.social-follow-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(0,0,0,0.25);
}
</style>
</section>


<!-- CIERRE -->
<section class="about-section">
  <div class="about-container">

    <div class="about-card large center">
      <h2>Esto no es contenido perfecto.</h2>
      <p>
        Es contenido real. Con decisiones imperfectas.
        Con aprendizaje auténtico. Con evolución constante.
      </p>
    
      <div class="about-youtube">
      
        <div class="youtube-wrapper">
          <iframe 
            src="https://www.youtube.com/embed/?listType=user_uploads&list=TU_USUARIO_AQUI"
            title="Canal de YouTube Ensor"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            allowfullscreen>
          </iframe>
        </div>
      </div>
    </div>

  </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function() {

  const text = "Hola... Me llamo Ensor.";
  const target = document.getElementById("about-typing-text");

  if (!target) return;

  target.textContent = ""; // limpia antes de escribir

  let i = 0;

  function type() {
    if (i < text.length) {
      target.textContent += text.charAt(i);
      i++;
      setTimeout(type, 55);
    }
  }

  type();

});
</script>

<script async src="https://www.instagram.com/embed.js"></script>
<?php get_footer(); ?>