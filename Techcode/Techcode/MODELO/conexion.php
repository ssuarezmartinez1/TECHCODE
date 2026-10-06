<?php
/**
 * TECHCODE — Conexión PDO a MySQL.
 * Devuelve un objeto PDO listo para usar, o detiene la ejecución
 * con un mensaje claro si la conexión falla (ej: XAMPP apagado,
 * base de datos no creada todavía, etc).
 */

require_once __DIR__ . '/config.php';

function obtenerConexion(): PDO
{
    static $pdo = null;

    if ($pdo instanceof PDO) {
        return $pdo;
    }

    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;

    try {
        $pdo = new PDO($dsn, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);
        return $pdo;
    } catch (PDOException $e) {
        http_response_code(500);
        die(
            '<div style="font-family:sans-serif;max-width:640px;margin:60px auto;' .
            'padding:24px;border:1px solid #e33;border-radius:8px;color:#a00;background:#fff5f5">' .
            '<h2 style="margin-top:0">No se pudo conectar a la base de datos</h2>' .
            '<p>Verifica que:</p>' .
            '<ul>' .
            '<li>Apache y MySQL estén iniciados en XAMPP.</li>' .
            '<li>La base de datos <code>techcode</code> exista (importa <code>MODELO/database.sql</code>).</li>' .
            '<li>Los datos de <code>MODELO/config.php</code> coincidan con tu MySQL.</li>' .
            '</ul>' .
            '<p style="color:#666;font-size:13px">Detalle técnico: ' . htmlspecialchars($e->getMessage()) . '</p>' .
            '</div>'
        );
    }
}
