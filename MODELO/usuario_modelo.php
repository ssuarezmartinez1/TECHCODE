<?php
/**
 * TECHCODE — Modelo de usuario.
 * Consultas relacionadas con la tabla `usuarios`.
 */

require_once __DIR__ . '/conexion.php';

/**
 * Busca un usuario por correo y rol. Devuelve el array del usuario
 * o null si no existe.
 */
function buscarUsuarioPorCorreoYRol(string $correo, string $rol): ?array
{
    $pdo = obtenerConexion();

    $stmt = $pdo->prepare(
        'SELECT id, nombre, correo, contrasena, rol
         FROM usuarios
         WHERE correo = :correo AND rol = :rol
         LIMIT 1'
    );
    $stmt->execute(['correo' => $correo, 'rol' => $rol]);

    $usuario = $stmt->fetch();

    return $usuario ?: null;
}

/**
 * Crea un usuario nuevo. La contraseña ya debe venir hasheada
 * con password_hash(). Devuelve el id insertado.
 */
function crearUsuario(string $nombre, string $correo, string $contrasenaHash, string $rol): int
{
    $pdo = obtenerConexion();

    $stmt = $pdo->prepare(
        'INSERT INTO usuarios (nombre, correo, contrasena, rol)
         VALUES (:nombre, :correo, :contrasena, :rol)'
    );
    $stmt->execute([
        'nombre'     => $nombre,
        'correo'     => $correo,
        'contrasena' => $contrasenaHash,
        'rol'        => $rol,
    ]);

    return (int) $pdo->lastInsertId();
}
