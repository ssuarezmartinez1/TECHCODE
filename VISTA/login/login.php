<?php
require_once __DIR__ . '/../../MODELO/auth_guard.php';
require_once __DIR__ . '/../../MODELO/navbar_sesion.php';

$rolActivo = $_GET['rol'] ?? ($_SESSION['login_rol_error'] ?? 'cliente');
if (!in_array($rolActivo, ['administrador', 'cliente'], true)) {
    $rolActivo = 'cliente';
}

$error = $_SESSION['login_error'] ?? null;
unset($_SESSION['login_error'], $_SESSION['login_rol_error']);

// Si ya hay sesión activa, no tiene sentido ver el login: al panel.
if (haySesionActiva()) {
    $destino = $_SESSION['usuario_rol'] === 'administrador' ? '../admin/panel.php' : '../cliente/panel.php';
    header('Location: ' . $destino);
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Iniciar sesión | TechCode</title>
	<link rel="stylesheet" href="login.css">
	<link rel="stylesheet" href="../shared.css">
</head>
<body class="tc-inner-page">
	<header class="navbar" id="navbar">
		<a href="../index.php" class="logo tc-brand-logo">
        <img src="../../MODELO/techcode-mark.png" alt="TechCode">
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
			<a href="login.php" class="login-btn active"><span>Iniciar sesión</span><b>↗</b></a>
			<button class="menu-btn" id="menuBtn" aria-label="Abrir menú">
				<span></span><span></span><span></span>
			</button>
		</div>
	</header>

	<main class="login-page">
		<section class="login-card">
			<span class="eyebrow">// ACCESO TECHCODE</span>
			<h1>Bienvenido<br><span>de nuevo.</span></h1>
			<p>Accede a tu espacio de trabajo digital.</p>

			<div class="login-tabs">
				<button type="button" class="login-tab <?= $rolActivo === 'cliente' ? 'is-active' : '' ?>" data-tab="cliente">
					Cliente
				</button>
				<button type="button" class="login-tab <?= $rolActivo === 'administrador' ? 'is-active' : '' ?>" data-tab="administrador">
					Administrador
				</button>
			</div>

			<?php if ($error): ?>
				<div class="form-message form-message-error form-message-show shake">
					<?= htmlspecialchars($error) ?>
				</div>
			<?php endif; ?>

			<div class="login-panel <?= $rolActivo === 'cliente' ? 'is-active' : '' ?>" data-panel="cliente">
				<form action="../../CONTROLADOR/auth_controlador.php" method="POST">
					<input type="hidden" name="rol" value="cliente">

					<label for="correo-cliente">Correo electrónico</label>
					<input id="correo-cliente" name="correo" type="email" placeholder="tu@correo.com" required>

					<label for="clave-cliente">Contraseña</label>
					<div class="password-field">
						<input id="clave-cliente" name="contrasena" type="password" placeholder="password" required>
						
					</div>

					<button type="submit">Entrar como cliente</button>
				</form>

			</div>

			<div class="login-panel <?= $rolActivo === 'administrador' ? 'is-active' : '' ?>" data-panel="administrador">
				<form action="../../CONTROLADOR/auth_controlador.php" method="POST">
					<input type="hidden" name="rol" value="administrador">

					<label for="correo-admin">Correo electrónico</label>
					<input id="correo-admin" name="correo" type="email" placeholder="" required>

					<label for="clave-admin">Contraseña</label>
					<div class="password-field">
						<input id="clave-admin" name="contrasena" type="password" placeholder="" required>
						
					</div>

					<button type="submit">Entrar como administrador</button>
				</form>

				
			</div>

		</section>
	</main>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

    const selectors = [
        "main > section", ".hero > *", ".contact > *", ".projects > .project",
        ".project-info > *", ".contact-data > div", ".contact-box > *",
        ".services > *", ".service-card", ".about-card", ".feature-card",
        ".stat", "form", ".login-box", ".game-container > *"
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
    } else {
        const observer = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("tc-visible");
                    obs.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12, rootMargin: "0px 0px -50px 0px" });
        elements.forEach(el => observer.observe(el));
    }

    document.querySelectorAll("button, .login-btn, .back-btn").forEach(btn => {
        btn.addEventListener("mousedown", () => btn.style.transform = "translateY(1px) scale(.98)");
        btn.addEventListener("mouseup", () => btn.style.transform = "");
        btn.addEventListener("mouseleave", () => btn.style.transform = "");
    });

    // Pestañas Administrador / Cliente
    const tabs = document.querySelectorAll(".login-tab");
    const panels = document.querySelectorAll(".login-panel");
    tabs.forEach(tab => {
        tab.addEventListener("click", () => {
            const target = tab.dataset.tab;
            tabs.forEach(t => t.classList.toggle("is-active", t === tab));
            panels.forEach(p => p.classList.toggle("is-active", p.dataset.panel === target));
        });
    });

    // Mostrar/ocultar contraseña
    document.querySelectorAll(".toggle-password").forEach(btn => {
        btn.addEventListener("click", () => {
            const input = btn.parentElement.querySelector("input");
            const showing = input.type === "text";
            input.type = showing ? "password" : "text";
            btn.textContent = showing ? "Ver" : "Ocultar";
        });
    });
});
</script>

<script src="../../CONTROLADOR/ui.js"></script>

</body>
</html>
