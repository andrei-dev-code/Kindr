/* =========================
   KINDR - MAIN JS
   Interactions + UX polish
========================= */

/* Smooth scroll fallback + enhancement */
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener("click", function (e) {
    e.preventDefault();

    const target = document.querySelector(this.getAttribute("href"));
    if (target) {
      target.scrollIntoView({
        behavior: "smooth",
        block: "start"
      });
    }
  });
});

/* =========================
   SCROLL REVEAL (simple version)
========================= */

const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add("show");
    }
  });
}, {
  threshold: 0.1
});

document.querySelectorAll(".card, .glass, .section-title").forEach(el => {
  el.classList.add("hidden");
  observer.observe(el);
});

/* =========================
   MOUSE GLOW EFFECT
========================= */

const glow = document.createElement("div");
glow.style.position = "fixed";
glow.style.width = "200px";
glow.style.height = "200px";
glow.style.borderRadius = "50%";
glow.style.pointerEvents = "none";
glow.style.background = "radial-gradient(circle, rgba(124,77,255,0.2), transparent 70%)";
glow.style.filter = "blur(30px)";
glow.style.zIndex = "1";
document.body.appendChild(glow);

document.addEventListener("mousemove", (e) => {
  glow.style.left = `${e.clientX - 100}px`;
  glow.style.top = `${e.clientY - 100}px`;
});

/* =========================
   CARD HOVER INTENSITY
========================= */

document.querySelectorAll(".card").forEach(card => {
  card.addEventListener("mousemove", (e) => {
    const rect = card.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;

    card.style.transform = `
      perspective(600px)
      rotateX(${(y - rect.height / 2) / 20}deg)
      rotateY(${-(x - rect.width / 2) / 20}deg)
      scale(1.02)
    `;
  });

  card.addEventListener("mouseleave", () => {
    card.style.transform = "translateY(0) scale(1)";
  });
});

/* =========================
   OPTIONAL: CONSOLE BRANDING
========================= */

console.log("%cKindr Coming Soon 🚀", "color:#7c4dff;font-size:16px;font-weight:bold;");
