<style>
    /* =========================================================
   ESTILOS GLOBALES DE LA NAVBAR Y MENÚ DE PUNTOS NEÓN
========================================================= */

header.navbar {
    overflow: visible !important;
}

/* Contenedor lateral derecho de la barra */
header.navbar .navbar-side {
    display: flex;
    align-items: center;
    gap: 15px;
    position: relative;
}

/* Contenedor del menú desplegable */
header.navbar .nav-dropdown {
    position: relative;
    display: flex;
    align-items: center;
    height: 100%;
}

/* Botón de la cuadrícula de 9 puntos neón */
header.navbar .nav-dropdown-toggle {
    display: grid !important;
    grid-template-columns: repeat(3, 4px) !important;
    grid-template-rows: repeat(3, 4px) !important;
    gap: 4px !important;
    padding: 10px 12px !important;
    background: rgba(10, 12, 20, 0.6) !important;
    border: 1px solid rgba(255, 90, 0, 0.3) !important;
    border-radius: 8px !important;
    cursor: pointer !important;
    transition: all 0.25s ease !important;
    align-items: center !important;
    justify-content: center !important;
    height: 38px;
    width: 38px;
    box-sizing: border-box !important;
    outline: none !important;
}

/* Los 9 puntos individuales */
header.navbar .nav-dropdown-toggle span {
    display: block !important;
    width: 4px !important;
    height: 4px !important;
    background-color: rgba(255, 255, 255, 0.8) !important;
    border-radius: 50% !important;
    box-shadow: 0 0 3px rgba(255, 90, 0, 0.5) !important;
    transition: background-color 0.25s ease, box-shadow 0.25s ease !important;
}

/* Efecto hover e iluminación al presionar/enfocar el botón */
header.navbar .nav-dropdown-toggle:hover,
header.navbar .nav-dropdown-toggle:focus,
header.navbar .nav-dropdown.active .nav-dropdown-toggle,
header.navbar .nav-dropdown:focus-within .nav-dropdown-toggle {
    border-color: var(--orange, #ff5a00) !important;
    box-shadow: 0 0 12px rgba(255, 90, 0, 0.4) !important;
}

header.navbar .nav-dropdown-toggle:hover span,
header.navbar .nav-dropdown-toggle:focus span,
header.navbar .nav-dropdown.active .nav-dropdown-toggle span,
header.navbar .nav-dropdown:focus-within .nav-dropdown-toggle span {
    background-color: #fff !important;
    box-shadow: 0 0 6px var(--orange, #ff5a00) !important;
}

/* Menú desplegable flotante */
header.navbar .nav-dropdown-menu {
    position: absolute;
    top: calc(100% + 8px);
    right: 0;
    left: auto;
    transform: translateY(-8px);
    min-width: 245px;
    padding: 9px;
    display: flex;
    flex-direction: column;
    gap: 4px;
    background: rgba(8, 8, 8, .98);
    border: 1px solid rgba(255, 90, 0, 0.28);
    border-radius: 8px;
    box-shadow: 0 20px 55px rgba(0, 0, 0, .48), 0 0 30px rgba(255, 90, 0, .06);
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
    transition: opacity .2s ease, transform .2s ease, visibility .2s ease;
    z-index: 9999;
}

/* Activación por foco o por clase 'active' de JS */
header.navbar .nav-dropdown:focus-within .nav-dropdown-menu,
header.navbar .nav-dropdown.active .nav-dropdown-menu {
    opacity: 1;
    visibility: visible;
    pointer-events: auto;
    transform: translateY(0);
}

/* Enlaces del menú desplegable */
header.navbar .nav-dropdown-menu a {
    display: block !important;
    width: 100% !important;
    box-sizing: border-box !important;
    padding: 11px 13px !important;
    color: #b8bec8 !important;
    text-decoration: none !important;
    font-size: 12px !important;
    font-weight: 600 !important;
    white-space: nowrap !important;
    border-radius: 6px !important;
    border: 1px solid transparent !important;
    transition: color .25s ease, border-color .25s ease, box-shadow .25s ease !important;
}

header.navbar .nav-dropdown-menu a::before {
    display: none !important;
}

header.navbar .nav-dropdown-menu a:hover {
    color: #fff !important;
    background: transparent !important;
    border-color: var(--orange, #ff5a00) !important;
    box-shadow: 0 0 10px rgba(255, 90, 0, 0.35), inset 0 0 5px rgba(255, 90, 0, 0.15) !important;
}

/* =========================================================
   RESPONSIVE PARA MÓVILES
========================================================= */
@media (max-width: 900px) {
    header.navbar .navbar-side {
        width: 100%;
        flex-direction: column;
        align-items: stretch;
    }

    header.navbar .nav-dropdown {
        width: 100%;
        flex-direction: column;
        align-items: stretch;
    }

    header.navbar .nav-dropdown-toggle {
        width: 100% !important;
        height: auto !important;
        justify-content: center !important;
        padding: 12px !important;
    }

    header.navbar .nav-dropdown-menu {
        position: static !important;
        transform: none !important;
        display: none;
        width: 100% !important;
        min-width: 0 !important;
        box-shadow: none !important;
        margin-top: 4px;
        opacity: 1 !important;
        visibility: visible !important;
        pointer-events: auto !important;
    }

    header.navbar .nav-dropdown:focus-within .nav-dropdown-menu,
    header.navbar .nav-dropdown.active .nav-dropdown-menu {
        display: flex !important;
    }

    header.navbar .nav-dropdown-menu a {
        white-space: normal !important;
    }
}


</style>

<?php require_once __DIR__ . '/../MODELO/navbar_sesion.php'; ?>
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta
        name="description"
        content="TechCode - Desarrollo de software y soluciones digitales."
    >

    <title>TechCode | Desarrollo de software</title>

    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="shared.css">

    <meta name="theme-color" content="#050711">
    <meta name="color-scheme" content="dark">
    <meta property="og:title" content="TECHCODE | Tecnología que transforma ideas">
    <meta property="og:description" content="Desarrollo de software, diseño y soluciones digitales.">

</head>


<body class="tc-home-only">


<!-- =====================================================
     PRELOADER
===================================================== -->

<div class="preloader" id="preloader">

    <div class="preloader-brand">
        <img src="../MODELO/techcode-mark.png" alt="Logo de TechCode">
        <span>TECH <strong>CODE</strong></span>
    </div>

    <div class="preloader-bar">
        <span></span>
    </div>

</div>


<!-- =====================================================
     NAVBAR
===================================================== -->

<?php include_once __DIR__ . '/../VISTA/layouts/header.php'; ?>


<!-- =====================================================
     INICIO TECHCODE
===================================================== -->

<section class="tc-hero" id="inicio">

    <div class="tc-hero-background" aria-hidden="true"></div>
    <div class="tc-hero-shade" aria-hidden="true"></div>

    <div class="tc-hero-content">


        <div class="tc-hero-text">

            <!-- Marca pequeña -->
            <div class="tc-hero-brand">
                <img src="../MODELO/techcode-mark.png" alt="Logo de TechCode">
                <span>TECH <b>CODE</b></span>
            </div>

            <h1>
                Tecnología que
                <span>transforma ideas.</span>
            </h1>

            <p>
                Desarrollamos soluciones digitales para empresas y negocios
                que buscan crecer, innovar y avanzar con tecnología.
            </p>

            <div class="tc-hero-actions">
                <a href="servicios/servicios.php" class="tc-btn-primary">
                    Conocer servicios
                    <span>↗</span>
                </a>

                <a href="proyectos/proyectos.php" class="tc-btn-secondary">
                    Ver proyectos
                    <span>→</span>
                </a>
            </div>

        </div>

    </div>

</section>


</main>

<script src="../CONTROLADOR/ui.js"></script>
<script src="../CONTROLADOR/script.js?v=2"></script>
<script>
// Fallback: el preloader nunca debe bloquear la página.
window.addEventListener('load', function () {
    const preloader = document.getElementById('preloader');
    if (!preloader) return;
    preloader.classList.add('preloader-hidden');
    setTimeout(function () { preloader.remove(); }, 700);
});
</script>
</body>
</html>
