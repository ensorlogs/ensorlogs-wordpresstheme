document.addEventListener("DOMContentLoaded", () => {

  const container = document.querySelector('.log-single');
  if (!container) return;

  const steps = document.querySelectorAll(".log-step");
  const progressFill = document.querySelector(".log-progress-fill");
  const progressText = document.querySelector(".log-progress-percent");
  const phaseText = document.querySelector(".phase-text");
  const phaseIcon = document.querySelector(".phase-icon");

  if (!steps.length) return;

  const logId = window.location.pathname;
  const storageKey = `ensorlog_progress_${logId}`;

  // -------------------------
  // ESTADO
  // -------------------------
  let state = JSON.parse(localStorage.getItem(storageKey)) || {
    contexto: true,
    planteamiento: false,
    quiz: false,
    solucion: false,
  };

  // -------------------------
  // APLICAR ESTADO
  // -------------------------
  function applyState() {

    steps.forEach(step => {
      const key = step.dataset.step;

      if (state[key]) {
        step.classList.add("is-completed");
        step.classList.remove("is-locked");
      }
    });

    const solution = document.querySelector('[data-step="solucion"]');

    if (solution) {
      if (!state.solucion) {
        solution.classList.add("is-locked");
      } else {
        solution.classList.remove("is-locked");
      }
    }

    const completedBlock = document.querySelector(".log-completed");

    if (
      completedBlock &&
      state.contexto &&
      state.planteamiento &&
      state.quiz &&
      state.solucion
    ) {
      completedBlock.hidden = false;
    }


      // ✅ NUEVO BLOQUE
  const completionBlock = document.querySelector(".log-completion");
  const finishBtn = document.querySelector(".log-finish-btn");
  const isFinished = localStorage.getItem(storageKey + "_finished") === "true";

  if (completionBlock) {
    // Mostrar botón cuando ya resolvió quiz + solución
    const canFinish = state.quiz && state.solucion;
    completionBlock.hidden = !canFinish;
  }

  if (finishBtn) {
    if (isFinished) {
      finishBtn.classList.add("completed");
      finishBtn.textContent = "✔ Log completado";
    } else {
      finishBtn.classList.remove("completed");
      finishBtn.textContent = "He Completado y Comprendido el log";
    }
  }
  
    updateProgress();
    

  // 🔒 Control estricto del botón Ver solución
  const showSolutionBtn = document.querySelector(".show-solution-btn");
  const attempts = parseInt(localStorage.getItem(storageKey + "_attempts")) || 0;

  if (showSolutionBtn) {
    const mustShow = !state.quiz && attempts >= 3;

    // Forzamos display real para evitar conflictos CSS
    if (mustShow) {
      showSolutionBtn.style.display = "inline-flex";
      showSolutionBtn.hidden = false;
    } else {
      showSolutionBtn.style.display = "none";
      showSolutionBtn.hidden = true;
    }
  }

  // ✅ Si el quiz ya fue completado, mantener estado visual tras refresh
  const quizBtn = document.querySelector(".log-quiz-btn");
  const feedback = document.querySelector(".quiz-feedback");
  const quizSection = document.querySelector('[data-step="quiz"]');

  if (state.quiz) {

    if (quizBtn) {
      quizBtn.disabled = true;
      quizBtn.textContent = "✓ Respuesta correcta";
    }

    if (feedback) {
      feedback.textContent = "✅ Correcto. Buen razonamiento.";
    }

    // Mantener opción correcta marcada tras refresh
    const correctValue = container?.dataset.quizCorrect;
    if (correctValue) {
      const correctInput = document.querySelector(
        'input[name="quiz"][value="' + correctValue + '"]'
      );
      if (correctInput) {
        correctInput.checked = true;
      }

      // Deshabilitar todas las opciones para evitar cambios
      const allInputs = document.querySelectorAll('input[name="quiz"]');
      allInputs.forEach(input => {
        input.disabled = true;
      });
    }

    if (quizSection) {

      // Forzar estilo verde correcto
      quizSection.classList.add("quiz-success");
      quizSection.classList.remove("is-active");

      // Crear badge si no existe
      if (!quizSection.querySelector(".quiz-completed-badge")) {
        const badge = document.createElement("div");
        badge.className = "quiz-completed-badge";
        badge.textContent = "✔ COMPLETADO";

        const body = quizSection.querySelector(".log-section-body");
        if (body) {
          body.insertBefore(badge, body.firstChild);
        }
      }
    }
  }
    
  }

  // -------------------------
  // PROGRESO
  // -------------------------
  function updateProgress() {

    const stepOrder = ["contexto", "planteamiento", "quiz", "solucion"];
    const total = stepOrder.length;
    const completed = stepOrder.filter(step => state[step]).length;
    const percent = Math.min(100, Math.round((completed / total) * 100));

    if (progressFill) {
      progressFill.style.width = percent + "%";
      progressFill.classList.remove("is-low", "is-mid", "is-high", "is-done");

      if (percent < 40) progressFill.classList.add("is-low");
      else if (percent < 70) progressFill.classList.add("is-mid");
      else if (percent < 100) progressFill.classList.add("is-high");
      else progressFill.classList.add("is-done");
    }

    if (progressText) {
      progressText.textContent = percent + "%";
    }

    // 🔒 Solo mostrar mensaje final si el usuario presionó "Finalizar log"
    if (
      state.contexto &&
      state.planteamiento &&
      state.quiz &&
      state.solucion &&
      localStorage.getItem(storageKey + "_finished") === "true" &&
      phaseIcon &&
      phaseText
    ) {
      phaseIcon.textContent = "🏁";
      phaseText.textContent = "LOG Solucionado, Gracias";
    }
  }

  // -------------------------
// QUIZ + DESBLOQUEO SOLUCIÓN
// -------------------------
const quizBtn = document.querySelector(".log-quiz-btn");
const solution = document.querySelector(".log-solution");
const feedback = document.querySelector(".quiz-feedback");
const showSolutionBtn = document.querySelector(".show-solution-btn");

if (quizBtn && solution) {

  let attempts = parseInt(localStorage.getItem(storageKey + "_attempts")) || 0;
  
 if (showSolutionBtn) {
   const mustShow = !state.quiz && attempts >= 3;

   if (mustShow) {
     showSolutionBtn.style.display = "inline-flex";
     showSolutionBtn.hidden = false;
   } else {
     showSolutionBtn.style.display = "none";
     showSolutionBtn.hidden = true;
   }
 }
  const correct = container?.dataset.quizCorrect;

  quizBtn.addEventListener("click", () => {

    const selected = document.querySelector('input[name="quiz"]:checked');

    if (!selected) {
      feedback.textContent = "Selecciona una respuesta.";
      return;
    }

   attempts++;
localStorage.setItem(storageKey + "_attempts", attempts);

if (selected.value === correct) {

  feedback.textContent = "✅ Correcto. Solución desbloqueada.";
  solution.classList.remove("is-locked");

  if (showSolutionBtn) {
    showSolutionBtn.hidden = true;
  }

  state.quiz = true;
  localStorage.setItem(storageKey + "_attempts", 0);
  state.solucion = true;
  localStorage.setItem(storageKey, JSON.stringify(state));
  applyState();

} else {

  feedback.textContent = "❌ Incorrecto. Intenta de nuevo.";

  if (attempts >= 3 && showSolutionBtn && !state.quiz) {
    showSolutionBtn.style.display = "inline-flex";
    showSolutionBtn.hidden = false;
  }
}
  });

  // 👇 Mostrar solución manualmente
  if (showSolutionBtn) {
    showSolutionBtn.addEventListener("click", () => {

      solution.classList.remove("is-locked");

      state.solucion = true;
      state.quiz = true;
      localStorage.setItem(storageKey + "_attempts", 0);
      localStorage.setItem(storageKey, JSON.stringify(state));
      applyState();

      feedback.textContent = "🔓 Has decidido ver la solución.";
    });
  }
}
  // -------------------------
  // BOTÓN FINALIZAR LOG
  // -------------------------
  const finishBtn = document.querySelector(".log-finish-btn");

  if (finishBtn) {
    finishBtn.addEventListener("click", () => {

      state.contexto = true;
      state.planteamiento = true;
      state.quiz = true;
      state.solucion = true;
      localStorage.removeItem(storageKey + "_attempts");

      localStorage.setItem(storageKey, JSON.stringify(state));
      localStorage.setItem(storageKey + "_finished", "true");
      applyState();

      finishBtn.classList.add("completed");
      finishBtn.textContent = "✔ Log completado";
    });
  }

  // -------------------------
  // FASES SEGÚN VIEWPORT
  // -------------------------
  const phaseMap = {
    contexto: { icon: "🧠", text: "Analizando el problema" },
    planteamiento: { icon: "🛠️", text: "Planteando una solución" },
    quiz: { icon: "🧪", text: "Probando tu razonamiento" },
    solucion: { icon: "🏁", text: "LOG Solucionado, Gracias" }
  };

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const step = entry.target.dataset.step;
          if (phaseMap[step] && phaseIcon && phaseText) {
            if (phaseMap[step] && phaseIcon && phaseText) {

  // 🔒 Si el log está completado, no dejamos que el observer cambie el mensaje
  if (localStorage.getItem(storageKey + "_finished") === "true") {
    return;
  }

  phaseIcon.textContent = phaseMap[step].icon;
  phaseText.textContent = phaseMap[step].text;
}
          }
        }
      });
    },
    { threshold: 0.6 }
  );

  steps.forEach(step => observer.observe(step));

  // -------------------------
  // INICIALIZAR
  // -------------------------
  applyState();

});