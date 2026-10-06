<?php require_once __DIR__ . '/../../MODELO/navbar_sesion.php'; ?>
<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Proyectos | TechCode</title>

<link rel="stylesheet" href="proyectos.css">

<link rel="stylesheet" href="../shared.css">


<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Press+Start+2P&display=swap" rel="stylesheet">

</head>

<body class="tc-inner-page">
<?php include_once __DIR__ . '/../layouts/header.php'; ?>

<section class="hero">

<span>// PORTAFOLIO</span>

<h1>
Ideas que se convierten
    <span class="neon-word">en productos.</span>
</h1>

<p>
Una selección de proyectos desarrollados por TechCode.
</p>

</section>


<section class="projects">

<article class="project">

<div class="project-image">
<span>&lt;/&gt;</span>
</div>

<div class="project-info">

<span class="tag">WEB</span>

<h2>Proyecto Alpha</h2>

<p>
Plataforma web diseñada para gestionar procesos
de manera sencilla y eficiente.
</p>

<a href="../rocopolis/rocopene/index.php" class="project-link">
    Ver proyecto →
</a>

</div>

</article>


<!-- MINI JUEGO: PIANO -->
<article class="project game-project piano-project">

    <a href="../miniminijuego/piano.php" class="game-link-card">

        <div class="project-image piano-bg">

            <div class="piano-preview">
                <div class="piano-screen">PINK<br>PIANO</div>
                <div class="piano-keys">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>

        </div>

        <div class="project-info">

            <span class="tag orange">MINI GAME</span>

            <h2>Proyecto Beta</h2>

            <p>
                Juego musical para poner a prueba tus reflejos
                y conseguir la mayor puntuación.
            </p>

            <span class="play-btn">
                Jugar →
            </span>

        </div>

    </a>

</article>


<!-- MINI JUEGO: SPACE RUNNER -->
<article class="project game-project">

    <a href="../mini-juego/mini-juego.php" class="game-link-card">

        <div class="project-image game-bg">

            <div class="game-console">

                <div class="screen">
                    > PLAY
                </div>

                <div class="controls">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>

            </div>


        </div>

        <div class="project-info">

            <span class="tag orange">MINI GAME</span>

            <h2>Zona de Juego</h2>

            <p>
                Entra y prueba nuestros mini juegos creados
                por TechCode.
            </p>

            <span class="play-btn">
                Jugar →
            </span>

        </div>

    </a>

</article>

</section>


<!-- MODAL DE PROYECTO -->

<div class="project-modal-overlay" id="projectModalOverlay">

    <div class="project-modal" role="dialog" aria-modal="true" aria-labelledby="projectModalTitle">

        <button type="button" class="project-modal-close" id="projectModalClose" aria-label="Cerrar">×</button>

        <span class="tag" id="projectModalTag">WEB</span>

        <h2 id="projectModalTitle">Proyecto</h2>

        <p id="projectModalDescription"></p>

        <div class="project-modal-stack">
            <strong>Stack:</strong> <span id="projectModalStack"></span>
        </div>

        <a href="../contacto/contacto.php" class="project-modal-cta">
            Contactar sobre este proyecto →
        </a>

    </div>

</div>


<script>
document.addEventListener("DOMContentLoaded", () => {

    const overlay = document.getElementById("projectModalOverlay");
    const closeBtn = document.getElementById("projectModalClose");
    const titleEl = document.getElementById("projectModalTitle");
    const tagEl = document.getElementById("projectModalTag");
    const descEl = document.getElementById("projectModalDescription");
    const stackEl = document.getElementById("projectModalStack");

    function openModal(trigger) {

        titleEl.textContent = trigger.dataset.title || "Proyecto";
        tagEl.textContent = trigger.dataset.tag || "WEB";
        descEl.textContent = trigger.dataset.description || "";
        stackEl.textContent = trigger.dataset.stack || "";

        overlay.classList.add("open");
        document.body.style.overflow = "hidden";

    }

    function closeModal() {

        overlay.classList.remove("open");
        document.body.style.overflow = "";

    }

    document.querySelectorAll("[data-project-modal]").forEach(btn => {

        btn.addEventListener("click", () => openModal(btn));

    });

    if (closeBtn) closeBtn.addEventListener("click", closeModal);

    if (overlay) {

        overlay.addEventListener("click", event => {

            if (event.target === overlay) closeModal();

        });

    }

    document.addEventListener("keydown", event => {

        if (event.key === "Escape") closeModal();

    });

});
</script>


<!-- TECHCODE ANIMATIONS -->

<script>
document.addEventListener("DOMContentLoaded", () => {
    const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

    // Elementos que aparecen suavemente al entrar en pantalla
    const selectors = [
        "main > section",
        ".hero > *",
        ".contact > *",
        ".projects > .project",
        ".project-info > *",
        ".contact-data > div",
        ".contact-box > *",
        ".services > *",
        ".service-card",
        ".about-card",
        ".feature-card",
        ".stat",
        "form",
        ".login-box",
        ".game-container > *"
    ];

    const elements = [];
    selectors.forEach(selector => {
        document.querySelectorAll(selector).forEach(el => {
            if (!elements.includes(el)) elements.push(el);
        });
    });

    elements.forEach((el, i) => {
        if (el.classList.contains("tc-reveal")) return;
        el.classList.add("tc-reveal");
        el.classList.add("tc-delay-" + ((i % 5) + 1));
    });

    if (reduceMotion) {
        elements.forEach(el => el.classList.add("tc-visible"));
        return;
    }

    const observer = new IntersectionObserver((entries, obs) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("tc-visible");
                obs.unobserve(entry.target);
            }
        });
    }, { threshold: 0.12, rootMargin: "0px 0px -50px 0px" });

    elements.forEach(el => observer.observe(el));

    // Botones: pequeño efecto de presión
    document.querySelectorAll("button, .login-btn, .back-btn").forEach(btn => {
        btn.addEventListener("mousedown", () => btn.style.transform = "translateY(1px) scale(.98)");
        btn.addEventListener("mouseup", () => btn.style.transform = "");
        btn.addEventListener("mouseleave", () => btn.style.transform = "");
    });
});
</script>

<script src="../../CONTROLADOR/ui.js"></script>

</body>
</html>