-- =========================================================
-- TECHCODE — BASE DE DATOS
-- Ejecutar este script en phpMyAdmin o con `mysql -u root -p < database.sql`
-- =========================================================

CREATE DATABASE IF NOT EXISTS techcode
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE techcode;

CREATE TABLE IF NOT EXISTS usuarios (
    id            INT AUTO_INCREMENT PRIMARY KEY,
    nombre        VARCHAR(100)        NOT NULL,
    correo        VARCHAR(150)        NOT NULL UNIQUE,
    contrasena    VARCHAR(255)        NOT NULL, -- hash generado con password_hash()
    rol           ENUM('administrador','cliente') NOT NULL DEFAULT 'cliente',
    creado_en     DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Los usuarios de prueba NO se insertan aquí porque el hash de la
-- contraseña debe generarse con la función password_hash() real de PHP.
-- Después de importar este archivo, ejecuta en el navegador:
--   http://localhost/Tech_Code/MODELO/seed_usuarios.php
-- eso crea 2 cuentas de prueba (una administrador y una cliente) con
-- contraseñas hasheadas correctamente. Bórralo después de usarlo.
