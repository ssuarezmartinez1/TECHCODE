<?php
require_once __DIR__ . '/../../MODELO/auth_guard.php';
exigirSesion('administrador');
require_once __DIR__ . '/../../MODELO/navbar_sesion.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel administrador | TechCode</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../shared.css">
    <link rel="stylesheet" href="../account.css">
</head>
<body class="tc-account-page">

<header class="navbar" id="navbar">
    <a href="../index.php" class="logo tc-account-navbar-logo">
        <img src="../../MODELO/techcode-mark.png" alt="Logo de TechCode">
        <span>TECH</span><strong>CODE</strong>
    </a>

    <nav id="navLinks">
        <a href="../index.php">Inicio</a>
        <a href="../nosotros/nosotros.php">Nosotros</a>
        <a href="../servicios/servicios.php">Servicios</a>
        <a href="../proyectos/proyectos.php">Proyectos</a>
        <a href="../resultados/resultados.php">Resultados</a>
        <a href="../contacto/contacto.php">Contacto</a>
    </nav>

    <div class="navbar-side">
        <span class="tc-account-user">Hola, <strong><?= htmlspecialchars($_SESSION['usuario_nombre']) ?></strong></span>
        <?= botonSesionNavbar('../') ?>
        <button class="menu-btn" id="menuBtn" aria-label="Abrir menú">
            <span></span><span></span><span></span>
        </button>
    </div>
</header>

<main class="tc-account-main">
    <div class="tc-account-watermark" aria-hidden="true">
        <img src="../../MODELO/techcode-mark.png" alt="">
    </div>

    <section class="tc-account-card">
        <div class="tc-account-eyebrow">// PANEL ADMINISTRADOR</div>
        <h1>Bienvenido,<br><span><?= htmlspecialchars(explode(' ', $_SESSION['usuario_nombre'])[0]) ?>.</span></h1>
        <p class="tc-account-intro">
            Sesión real verificada contra MySQL. Rol: <strong>administrador</strong>.
            Correo: <?= htmlspecialchars($_SESSION['usuario_correo']) ?>
        </p>

        <div class="tc-account-panel">
            <div class="tc-account-panel-top">
                <div class="tc-account-avatar"><?= strtoupper(substr($_SESSION['usuario_nombre'], 0, 1)) ?></div>
                <p>
                    Desde este panel el equipo de TechCode puede gestionar
                    <strong>proyectos</strong>, <strong>clientes</strong> y <strong>contenido del sitio</strong>.
                    Estas secciones pueden ampliarse según lo que necesite el negocio.
                </p>
            </div>

            <div class="tc-account-actions">
                <a href="../index.php" class="tc-account-secondary">Volver al sitio</a>
                <a href="../../CONTROLADOR/logout.php" class="tc-account-primary">Cerrar sesión&nbsp; ↗</a>
            </div>
        </div>
    </section>
</main>

<script src="../../CONTROLADOR/ui.js"></script>
</body>
</html>
