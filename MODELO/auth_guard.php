<?php
/**
 * TECHCODE — Guardián de sesión.
 * Incluir al inicio de cualquier página privada:
 *
 *   require_once __DIR__ . '/../../MODELO/auth_guard.php';
 *   exigirSesion('administrador');   // o 'cliente'
 *
 * Si no hay sesión activa (o el rol no coincide), redirige al login.
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function haySesionActiva(): bool
{
    return isset($_SESSION['usuario_id'], $_SESSION['usuario_rol']);
}

/**
 * Corta la ejecución y redirige al login si no hay sesión,
 * o si el rol de la sesión no es el requerido.
 */
function exigirSesion(string $rolRequerido): void
{
    if (!haySesionActiva() || $_SESSION['usuario_rol'] !== $rolRequerido) {
        $destino = ($rolRequerido === 'administrador') ? 'administrador' : 'cliente';
        header('Location: /Tech_Code/VISTA/login/login.php?redirigido=' . $destino);
        exit;
    }
}
