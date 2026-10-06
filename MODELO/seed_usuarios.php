<?php
/**
 * TECHCODE — Script de siembra de usuarios de prueba.
 *
 * Ejecutar UNA sola vez desde el navegador:
 *   http://localhost/Tech_Code/MODELO/seed_usuarios.php
 *
 * Crea (si no existen ya) dos cuentas de prueba:
 *   Administrador -> admin@techcode.com   / Admin123!
 *   Cliente       -> cliente@techcode.com / Cliente123!
 *
 * Usa password_hash() real de PHP en el momento de la instalación,
 * por eso este archivo debe ejecutarse en un servidor con PHP
 * (no se puede generar el hash de antemano de forma honesta).
 *
 * Por seguridad, bórralo (o renómbralo) después de usarlo.
 */

require_once __DIR__ . '/conexion.php';
require_once __DIR__ . '/usuario_modelo.php';

header('Content-Type: text/html; charset=utf-8');

function sembrar(string $nombre, string $correo, string $contrasenaPlano, string $rol): string
{
    $existente = buscarUsuarioPorCorreoYRol($correo, $rol);

    if ($existente) {
        return "Ya existía: {$correo} ({$rol}) — no se modificó.";
    }

    $hash = password_hash($contrasenaPlano, PASSWORD_DEFAULT);
    crearUsuario($nombre, $correo, $hash, $rol);

    return "Creado: {$correo} ({$rol}) con contraseña «{$contrasenaPlano}».";
}

$resultados = [];
$resultados[] = sembrar('Administrador TechCode', 'admin@techcode.com', 'Admin123!', 'administrador');
$resultados[] = sembrar('Cliente de prueba', 'cliente@techcode.com', 'Cliente123!', 'cliente');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Siembra de usuarios — TechCode</title>
    <style>
        body{font-family:sans-serif;max-width:640px;margin:60px auto;padding:0 20px;color:#222}
        li{margin:8px 0;line-height:1.5}
        .warn{margin-top:24px;padding:14px 18px;background:#fff3e0;border:1px solid #ffb74d;border-radius:6px;font-size:14px}
        a{color:#6a3de8}
    </style>
</head>
<body>
    <h1>Siembra de usuarios de prueba</h1>
    <ul>
        <?php foreach ($resultados as $linea): ?>
            <li><?= htmlspecialchars($linea) ?></li>
        <?php endforeach; ?>
    </ul>
    <div class="warn">
        Por seguridad, borra o renombra este archivo (<code>MODELO/seed_usuarios.php</code>)
        ahora que ya creaste las cuentas de prueba.
    </div>
    <p><a href="../VISTA/login/login.php">Ir a iniciar sesión →</a></p>
</body>
</html>
