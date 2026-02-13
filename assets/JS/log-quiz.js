document.addEventListener("DOMContentLoaded", () => {

  const quizSection = document.querySelector('[data-step="quiz"]');
  if (!quizSection) return;

  const quizBtn = quizSection.querySelector(".log-quiz-btn");
  const feedback = quizSection.querySelector(".quiz-feedback");
  const showSolutionBtn = quizSection.querySelector(".show-solution-btn");
  const solutionBlock = document.querySelector('[data-step="solucion"]');;

  const correctAnswer = parseInt(
    document.querySelector("main.log-single")?.dataset.quizCorrect,
    10
  );

  let attempts = 0;

  quizBtn.addEventListener("click", () => {

    const selected = quizSection.querySelector('input[name="quiz"]:checked');

    if (!selected) {
      feedback.textContent = "⚠️ Selecciona una opción antes de comprobar.";
      feedback.className = "quiz-feedback error";
      return;
    }

    const selectedValue = parseInt(selected.value, 10);
    attempts++;

   
   // ✅ RESPUESTA CORRECTA
if (selectedValue === correctAnswer) {

  feedback.textContent = "Correcto. Buen razonamiento.";
  feedback.className = "quiz-feedback success";

  quizSection.classList.remove("quiz-error");
  quizSection.classList.add("quiz-success");

  // Crear badge COMPLETADO si no existe
  if (!quizSection.querySelector(".quiz-completed-badge")) {
    const badge = document.createElement("div");
    badge.className = "quiz-completed-badge";
    badge.textContent = "✔ COMPLETADO";
    quizSection.querySelector(".log-section-body")
      .insertBefore(badge, quizSection.querySelector(".log-section-body").firstChild);
  }

  if (solutionBlock) {
    solutionBlock.classList.remove("is-locked");
  }

  showSolutionBtn.hidden = true;
  document.body.classList.remove("show-hints");
  return;
}

    // ❌ RESPUESTA INCORRECTA
    feedback.textContent = "❌ No es la mejor opción. Puedes revisar las pistas y vuelve a intentarlo.";
    feedback.className = "quiz-feedback error";


     // Cambiar estilos para reflejar el error
    quizSection.classList.remove("quiz-success");
    quizSection.classList.add("quiz-error");

    // Mostrar pistas desde el primer fallo
    document.body.classList.add("show-hints");

    // A partir del Quinto fallo → permitir ver solución
    if (attempts >= 5) {
      showSolutionBtn.hidden = false;
     
    }
  });

  // Mostrar solución manualmente
  showSolutionBtn.addEventListener("click", () => {
    if (solutionBlock) {
      solutionBlock.classList.remove("is-locked");
      solutionBlock.scrollIntoView({ behavior: "smooth" });
    }
  });

});

