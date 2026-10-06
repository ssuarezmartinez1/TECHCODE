<?php
/**
 * TECHCODE — Controlador de autenticación real.
 * Recibe el POST del formulario de login (login.php), valida contra
 * MySQL con password_verify() y abre una sesión real de PHP.
 * No hay accesos simulados ni localStorage.
 */

require_once __DIR__ . '/../MODELO/conexion.php';
require_once __DIR__ . '/../MODELO/usuario_modelo.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function irALoginConError(string $rol, string $mensaje): void
{
    $_SESSION['login_error'] = $mensaje;
    $_SESSION['login_rol_error'] = $rol;
    header('Location: ../VISTA/login/login.php?rol=' . urlencode($rol));
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../VISTA/login/login.php');
    exit;
}

$rol    = $_POST['rol'] ?? '';
$correo = trim($_POST['correo'] ?? '');
$clave  = $_POST['contrasena'] ?? '';

if (!in_array($rol, ['administrador', 'cliente'], true)) {
    irALoginConError('cliente', 'Tipo de acceso inválido.');
}

if ($correo === '' || $clave === '') {
    irALoginConError($rol, 'Completa correo y contraseña.');
}

$usuario = buscarUsuarioPorCorreoYRol($correo, $rol);

if (!$usuario || !password_verify($clave, $usuario['contrasena'])) {
    irALoginConError($rol, 'Correo, contraseña o tipo de acceso incorrectos.');
}

// Credenciales correctas: regenerar el id de sesión (seguridad) y guardar datos.
session_regenerate_id(true);

$_SESSION['usuario_id']     = $usuario['id'];
$_SESSION['usuario_nombre'] = $usuario['nombre'];
$_SESSION['usuario_correo'] = $usuario['correo'];
$_SESSION['usuario_rol']    = $usuario['rol'];

unset($_SESSION['login_error'], $_SESSION['login_rol_error']);

if ($usuario['rol'] === 'administrador') {
    header('Location: ../VISTA/admin/panel.php');
} else {
    header('Location: ../VISTA/cliente/panel.php');
}
exit;
