document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('logsFilterForm');
  if (!form) return;

  form.querySelectorAll('select').forEach(select => {
    select.addEventListener('change', () => {
      form.submit();
    });
  });
});



// FILTROS
const filterBtns = document.querySelectorAll(".filter-btn");
const cards = document.querySelectorAll(".log-card");

filterBtns.forEach(btn => {
  btn.addEventListener("click", () => {

    filterBtns.forEach(b => b.classList.remove("active"));
    btn.classList.add("active");

    const filter = btn.dataset.filter;

    cards.forEach(card => {
      if (filter === "all") {
        card.style.display = "block";
      } else {
        card.style.display =
          card.dataset.type === filter ? "block" : "none";
      }
    });
  });
});

// MARCAR COMPLETADOS (desde localStorage)
cards.forEach(card => {
  const logId = card.dataset.logId;
  const saved = localStorage.getItem(`ensorlog_progress_${logId}`);

  if (saved) {
    const state = JSON.parse(saved);
    if (state.solucion) {
      const badge = card.querySelector(".log-completed-badge");
      if (badge) badge.hidden = false;
    }
  }
});


document.addEventListener("DOMContentLoaded", () => {

  const buttons = document.querySelectorAll(".filter-btn");
  const cards = document.querySelectorAll(".log-card");

  buttons.forEach(button => {

    button.addEventListener("click", () => {

      buttons.forEach(btn => btn.classList.remove("active"));
      button.classList.add("active");

      const filter = button.dataset.filter;

      cards.forEach(card => {

        if (filter === "all") {
          card.style.display = "block";
        } else {
          card.style.display =
            card.dataset.type === filter ? "block" : "none";
        }

      });

    });

  });

});

document.addEventListener("DOMContentLoaded", () => {

  const levelFilter = document.getElementById("filter-level");
  const durationFilter = document.getElementById("filter-duration");
  const topicFilter = document.getElementById("filter-topic");
  const cards = document.querySelectorAll(".log-card");

  function filterLogs() {

    const level = levelFilter.value;
    const duration = durationFilter.value;
    const topic = topicFilter.value;

    cards.forEach(card => {

      const matchLevel = !level || card.dataset.level === level;
      const matchDuration = !duration || card.dataset.duration === duration;
      const matchTopic = !topic || card.dataset.topic === topic;

      if (matchLevel && matchDuration && matchTopic) {
        card.style.display = "block";
      } else {
        card.style.display = "none";
      }

    });
  }

  levelFilter.addEventListener("change", filterLogs);
  durationFilter.addEventListener("change", filterLogs);
  topicFilter.addEventListener("change", filterLogs);

});