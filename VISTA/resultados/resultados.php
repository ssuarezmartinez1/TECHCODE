<?php require_once __DIR__ . '/../../MODELO/navbar_sesion.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados | TechCode</title>
    <link rel="stylesheet" href="resultados.css">
    <link rel="stylesheet" href="../shared.css">
</head>
<body class="tc-inner-page">

<?php include_once __DIR__ . '/../layouts/header.php'; ?>

<main>

    <section class="resultados-hero">
        <span>// RESULTADOS</span>
        <h1>Impacto real,<br><span>medido en números.</span></h1>
        <p>El trabajo de TechCode se traduce en productos que funcionan, equipos que entregan
        a tiempo y clientes que vuelven. Estos son algunos de los resultados que respaldan
        nuestro trabajo.</p>
    </section>

    <div class="resultados-grid">
        <div class="stat"><strong>40+</strong><span>Proyectos entregados</span></div>
        <div class="stat"><strong>98%</strong><span>Clientes satisfechos</span></div>
        <div class="stat"><strong>15</strong><span>Industrias atendidas</span></div>
        <div class="stat"><strong>24/7</strong><span>Soporte técnico</span></div>
    </div>

    <h2 class="section-title">Casos destacados</h2>
    <div class="resultados-cases">
        <div class="feature-card">
            <h3>Plataforma de gestión interna</h3>
            <p>Sistema a medida que redujo en un 35% el tiempo de procesos administrativos
            de un cliente del sector logístico.</p>
        </div>
        <div class="feature-card">
            <h3>Tienda en línea con panel propio</h3>
            <p>E-commerce con backend real y panel de administración para gestión de
            productos, pedidos y clientes.</p>
        </div>
        <div class="feature-card">
            <h3>Portal de autenticación multi-rol</h3>
            <p>Acceso separado para administradores y clientes, con sesiones seguras y
            paneles independientes por tipo de usuario.</p>
        </div>
    </div>

</main>

<footer>
    <div class="footer-logo">
        <a href="../index.php" class="logo"><span>TECH</span><strong>CODE</strong></a>
        <p>Tecnología que convierte ideas en soluciones.</p>
    </div>
    <div class="footer-info">
        <span>© 2026 TechCode</span>
        <span>Desarrollo · Innovación · Tecnología</span>
    </div>
</footer>

<script src="../../CONTROLADOR/ui.js"></script>

</body>
</html>
