<?php require_once __DIR__ . '/../../MODELO/navbar_sesion.php'; ?>
<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Contacto | TechCode</title>

<link rel="stylesheet" href="contacto.css">

<link rel="stylesheet" href="../shared.css">


<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Press+Start+2P&display=swap" rel="stylesheet">

</head>

<body class="tc-inner-page">
<?php include_once __DIR__ . '/../layouts/header.php'; ?>


<main>

<section class="contact">

<div class="contact-text">

<span>// CONTACTO</span>

<h1>
Hablemos de tu
	<strong class="neon-word">proyecto.</strong>
</h1>

<p>
¿Tienes una idea, un proyecto o necesitas una solución
tecnológica? Estamos listos para escucharte.
</p>

<div class="contact-data">

<div>
<strong>Email</strong>
<p>techcodeh@gmail.com</p>
</div>

<div>
<strong>WhatsApp</strong>
<p>+57 3170427298</p>
</div>

</div>

</div>


<div class="contact-box">


<h2>¿Listo para comenzar?</h2>

<p>
Cuéntanos brevemente qué necesitas y nos pondremos
en contacto contigo.
</p>

<a href="sergio:techcodeh@gmail.com" class="button">
Enviar correo →
</a>

</div>

</section>

</main>

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