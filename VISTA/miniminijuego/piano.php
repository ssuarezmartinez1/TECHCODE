<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>TechCode Pink Piano</title>

    <link rel="stylesheet" href="piano.css">

<link rel="stylesheet" href="../shared.css">
</head>

<body>

    <main class="desktop">

        <section class="window">

            <header class="window-bar">

                <div class="window-title">
                    <span class="window-logo">TC</span>
                    TECHCODE_PINK_PIANO.exe
                </div>

                <div class="window-controls">
                    <button type="button" id="pianoMinimizeBtn" class="win-ctrl" aria-label="Minimizar">—</button>
                    <button type="button" id="pianoMaximizeBtn" class="win-ctrl" aria-label="Maximizar">□</button>
                    <button type="button" id="pianoCloseBtn" class="win-ctrl" aria-label="Cerrar y volver a Proyectos">×</button>
                </div>

            </header>


            <div class="window-content">

                <section class="intro">

                    <div class="intro-text">

                        <p class="eyebrow">
                            MINI GAME / LOCAL EDITION
                        </p>

                        <h1>
                            PINK<br>
                            <span>PIANO</span>
                        </h1>

                        <p class="description">
                            Presiona las teclas rosadas antes de que lleguen
                            al final. No dejes que ninguna se escape.
                        </p>

                    </div>


                    <div class="instructions">

                        <h3>¿CÓMO JUGAR?</h3>

                        <p>Haz clic en las teclas rosadas.</p>
                        <p>También puedes usar A, d, z y c.</p>
                        <p>Consigue la mayor puntuación.</p>

                    </div>

                </section>


                <section class="game-panel">

                    <div class="game-header">

                        <div>
                            ESTADO:
                            <strong id="status">LISTO</strong>
                        </div>

                        <div>
                            PUNTOS:
                            <strong id="score">1000</strong>
                        </div>

                        <div>
                            RÉCORD:
                            <strong id="best">0000</strong>
                        </div>

                    </div>


                    <div class="game-area">

                        <div class="lane-labels">
                            <span>A</span>
                            <span>d</span>
                            <span>z</span>
                            <span>c</span>
                        </div>

                        <div
                            id="pianoBoard"
                            class="piano-board">

                        </div>

                        <div
                            id="message"
                            class="game-message">

                            PRESIONA INICIAR PARA JUGAR

                        </div>

                    </div>


                    <div class="buttons">

                        <button
                            id="startBtn"
                            class="btn btn-primary">

                            INICIAR JUEGO

                        </button>

                        <button
                            id="pauseBtn"
                            class="btn btn-secondary">

                            PAUSAR

                        </button>

                        <button
                            id="resetBtn"
                            class="btn btn-secondary">

                            REINICIAR

                        </button>

                    </div>

                </section>


                <footer class="footer-info">

                    <span>
                        TECHCODE DIGITAL STUDIO
                    </span>

                    <span>
                        100% LOCAL · NO CONNECTIONS
                    </span>

                </footer>

            </div>

        </section>

    </main>


    <script src="../../CONTROLADOR/piano.js"></script>

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

    // Controles de la ventana falsa: minimizar, maximizar y cerrar
    const windowEl = document.querySelector(".window");
    const desktopEl = document.querySelector(".desktop");
    const minimizeBtn = document.getElementById("pianoMinimizeBtn");
    const maximizeBtn = document.getElementById("pianoMaximizeBtn");
    const closeBtn = document.getElementById("pianoCloseBtn");
    const windowBar = document.querySelector(".window-bar");

    if (minimizeBtn && windowEl) {
        minimizeBtn.addEventListener("click", () => {
            windowEl.classList.toggle("minimized");
        });
    }

    if (windowBar && windowEl) {
        windowBar.addEventListener("dblclick", () => {
            windowEl.classList.remove("minimized");
        });
    }

    if (maximizeBtn && desktopEl) {
        maximizeBtn.addEventListener("click", () => {
            desktopEl.classList.toggle("maximized");
        });
    }

    if (closeBtn) {
        closeBtn.addEventListener("click", () => {
            window.location.href = "../proyectos/proyectos.php";
        });
    }
});
</script>

</body>

</html>
<script src="../../CONTROLADOR/piano.js"></script>