<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Página</title>

    <style>
        .navbar{
    height:94px; padding:0 clamp(30px,7vw,110px);
    display:flex; align-items:center; justify-content:space-between; gap:35px;
    position:sticky; top:0; z-index:100;
    background:rgba(5,5,5,.86); border-bottom:1px solid var(--border);
    backdrop-filter:blur(20px);
}
.navbar-side{display:flex; align-items:center; gap:16px;}
.logo{display:inline-flex; align-items:center; text-decoration:none; color:var(--white);
    font-family:'Space Grotesk', sans-serif; font-size:25px; font-weight:500; letter-spacing:-1.5px;}
.logo strong{color:var(--orange); font-weight:700;}
nav{display:flex; align-items:center; gap:clamp(20px,3vw,38px);}
nav a{position:relative; padding:10px 0; color:var(--gray); text-decoration:none; font-size:14px; font-weight:600; transition:color .3s ease;}
nav a:hover, nav a.active{color:var(--white);}
.login-btn{min-height:48px; padding:0 20px; display:inline-flex; align-items:center; justify-content:center; gap:6px;
    color:var(--white); background:transparent; border:1px solid rgba(255,90,0,.65); text-decoration:none;
    font-size:13px; font-weight:700; transition:.35s ease;}
.login-btn:hover{border-color:var(--orange);}
    .navbar {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 80px;
    background: rgba(16, 16, 16, 0.85);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 5%;
    z-index: 1000;
    box-sizing: border-box;
}

.navbar .logo {
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
    font-size: 20px;
    color: #ffffff;
}

.navbar .logo img {
    height: 38px;
    width: auto;
    object-fit: contain;
}

.navbar .logo strong {
    color: #ff5a00;
}
.navbar {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 80px;
    background: transparent;
    
    /* Si quieres que se borre un poco lo que pasa por detrás, puedes mantener el efecto blur: */
    backdrop-filter: blur(8px); 
    -webkit-backdrop-filter: blur(8px);
    
    border-bottom: 1px solid rgba(255, 255, 255, 0.1); 
    /* Línea sutil opcional para separar el contenido */
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 5%;
    z-index: 1000;
    box-sizing: border-box;
}
        /* Limitar el tamaño de la marca/logo en las vistas o secciones donde se desborda */
.navbar .logo img, 
.service-detail .service-logo img {
    max-height: 40px; /* Ajusta la altura máxima a conveniencia */
    width: auto;
    object-fit: contain;
}

/* Si es un elemento decorativo grande que está causando el problema, asegúrate de restringirlo */
.hero-logo-bg,
.tc-hero-logo-bg {
    max-width: 250px; 
    /* O el tamaño adecuado para fondo */
    height: auto;
}
        .navbar .logo {
            color: #ffffff;
            text-decoration: none;
            font-size: 20px;
        }

        .navbar .logo strong {
            color: #ff5a00;
        }
    </style>
</head>
</html>
<header class="navbar" id="navbar">

<a href="../index.php" class="logo">
    <img src="/Techcode/MODELO/techcode-mark.png" 
    <span>TECH</span><strong>CODE</strong>
</a>
<nav id="navLinks">
    <a href="/Techcode/VISTA/index.php">Inicio</a>
    <a href="/Techcode/VISTA/nosotros/nosotros.php">Nosotros</a>
    <a href="/Techcode/VISTA/servicios/servicios.php">Servicios</a>
    <a href="/Techcode/VISTA/proyectos/proyectos.php">Proyectos</a>
    <a href="/Techcode/VISTA/resultados/resultados.php">Resultados</a>
    <a href="/Techcode/VISTA/contacto/contacto.php">Contacto</a>
</nav>
  
    <div class="nav-dropdown">
    <div class="nav-dropdown-toggle" tabindex="0" aria-label="Menú de opciones">
        <span></span><span></span><span></span>
        <span></span><span></span><span></span>
        <span></span><span></span><span></span>
    </div>
 <div class="nav-dropdown-menu">
    <a href="/Techcode/VISTA/index.php">Inicio</a>
    <a href="/Techcode/VISTA/nosotros/forma-trabajo.php">forma de trabajo</a>
    <a href="/Techcode/VISTA/nosotros/mision-vision.php">Misión y Visión</a>
    <a href="/Techcode/VISTA/servicios/aplicaciones.php">aplicaciones</a>
    <a href="/Techcode/VISTA/servicios/bases-de-datos.php">bases de datos</a>
    <a href="/Techcode/VISTA/valores/valores.php">Valores</a>
    <a href="/Techcode/VISTA/servicios/desarrollo-web.php">Desarrollo Web</a>
    <a href="/Techcode/VISTA/servicios/sofware-personalizado.php">Software personalizado</a>
    <a href="/Techcode/VISTA/proyectos/proyectos.php">Portafolio / Proyectos</a>
    <a href="/Techcode/VISTA/resultados/resultados.php">Resultados</a>
    <a href="/Techcode/VISTA/nosotros/trabajemos-juntos.php">trabajemos juntos</a>
    <a href="/Techcode/VISTA/contacto/contacto.php">Contacto</a>
</div>
</div>
        <?= botonSesionNavbar('') ?>

        <button class="menu-btn" id="menuBtn" aria-label="Abrir menú">
            <span></span>
        </button>

    </div>

</header>
