<?php
/**
 * TECHCODE — Botón de sesión para la navbar (real, basado en $_SESSION).
 *
 * Uso en cada página, ANTES de imprimir el <header>:
 *
 *   require_once __DIR__ . '/../MODELO/navbar_sesion.php'; // ajusta la ruta
 *   // luego, dentro del <header>, donde antes iba el <a class="login-btn">:
 *   echo botonSesionNavbar('../');   // ruta relativa hacia la carpeta VISTA
 *
 * El parámetro $raiz es el prefijo relativo desde la página actual
 * hasta la carpeta VISTA (ej: '' en index.php, '../' en nosotros.php,
 * '../../' si estuviera dos niveles más adentro).
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function botonSesionNavbar(string $raiz = ''): string
{
    $activo = isset($_SESSION['usuario_id'], $_SESSION['usuario_rol']);

    if (!$activo) {
        return '<a href="' . $raiz . 'login/login.php" class="login-btn">'
             . '<span>Iniciar sesión</span><b>↗</b></a>';
    }

    $rol      = $_SESSION['usuario_rol'];
    $panelUrl = $rol === 'administrador'
        ? $raiz . 'admin/panel.php'
        : $raiz . 'cliente/panel.php';

    $nombre = htmlspecialchars($_SESSION['usuario_nombre'] ?? 'Mi cuenta');

    return '<a href="' . $panelUrl . '" class="login-btn session-active">'
         . '<span>' . $nombre . '</span><b>↗</b></a>';
}
