<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Mini Juego | TechCode</title>

    <link rel="stylesheet" href="mini-juego.css">


<link rel="stylesheet" href="../shared.css">
</head>

<body>

    <!-- FONDO -->

    <div class="background-grid"></div>

    <!-- NAVBAR -->

    <header class="navbar">

        <a href="../index.php" class="logo">
            <span>TECH</span><strong>CODE</strong>
        </a>

        <a href="../proyectos/proyectos.php"
           class="back-btn">
            ← Volver a proyectos
        </a>

    </header>


    <!-- JUEGO -->

    <main class="game-container">

        <div class="game-header">

            <span class="eyebrow">
                // TECHCODE ARCADE
            </span>

            <h1>
                SPACE
                <span>RUNNER</span>
            </h1>

            <p>
                Controla la nave y evita los obstáculos.
            </p>

        </div>


        <!-- INFORMACIÓN -->

        <div class="game-info">

            <div>
                <span>PUNTOS</span>
                <strong id="score">10000</strong>
            </div>

            <div>
                <span>RÉCORD</span>
                <strong id="highScore">0</strong>
            </div>

        </div>


        <!-- CANVAS -->

        <div class="game-box">

            <canvas id="gameCanvas"
                    width="800"
                    height="500">
            </canvas>

            <div id="startScreen" class="start-screen">

                <div class="pixel-icon">
                    🚀
                </div>

                <h2>SPACE RUNNER</h2>

                

                <button id="startBtn">
                    INICIAR JUEGO
                </button>

            </div>


            <div id="gameOverScreen"
                 class="game-over hidden">

                <span>GAME OVER</span>

                <h2 id="finalScore">
                    0
                </h2>

                <button id="restartBtn">
                    JUGAR DE NUEVO
                </button>

            </div>

        </div>


        <!-- CONTROLES -->

        

    </main>


    <script src="../../CONTROLADOR/mini-juego.js"></script>

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

</body>

</html>