<?php require_once __DIR__ . '/../../MODELO/navbar_sesion.php'; ?>
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Nosotros | TechCode</title>

    <link rel="stylesheet" href="nosotros.css">

    <link rel="stylesheet" href="../shared.css">


    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap"
          rel="stylesheet">

</head>



<?php include_once __DIR__ . '/../layouts/header.php'; ?>
 

<main>


<!-- =====================================================
     HERO
===================================================== -->

<section class="about-hero">


    <div class="hero-content">

        <span class="eyebrow">
            // QUIÉNES SOMOS
        </span>


        <h1>

              <span class="neon-word">soluciones.</span>

            <span>
                TechCode.
            </span>

        </h1>


        <p>

            Somos un equipo enfocado en crear soluciones
            digitales que conectan tecnología, creatividad
            e innovación para transformar ideas en proyectos
            reales.

        </p>


        <div class="hero-buttons">

            <a href="../servicios/servicios.php"
               class="primary-btn">

                Conoce nuestros servicios →

            </a>


            <a href="#historia"
               class="secondary-btn">

                Conócenos

            </a>

        </div>

    </div>




</main>


<!-- =====================================================
     FOOTER
===================================================== -->

<footer>


    <div class="footer-logo">

        <a href="../index.php" class="logo">

            <span>
                TECH
            </span>

            <strong>
                CODE
            </strong>

        </a>


        <p>
            Tecnología que convierte ideas
            en soluciones.
        </p>

    </div>


    <div class="footer-info">

        <span>
            © 2026 TechCode
        </span>

        <span>
            Desarrollo · Innovación · Tecnología
        </span>

    </div>

</footer>


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