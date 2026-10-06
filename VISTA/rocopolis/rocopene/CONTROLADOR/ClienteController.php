
<?php

require_once __DIR__ . "/../config/conexion.php";
require_once __DIR__ . "/../MODELO/Cliente.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nombre = trim($_POST["nombre"] ?? "");
    $apellido = trim($_POST["apellido"] ?? "");
    $correo = trim($_POST["correo"] ?? "");
    $telefono = trim($_POST["telefono"] ?? "");
    $contrasena = $_POST["contrasena"] ?? "";

    if (
        empty($nombre) ||
        empty($apellido) ||
        empty($correo) ||
        empty($contrasena)
    ) {
        die("Completa todos los campos obligatorios.");
    }

    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        die("El correo no es válido.");
    }

    try {
        $cliente = new Cliente($conexion);

        $cliente->registrar(
            $nombre,
            $apellido,
            $correo,
            $telefono,
            $contrasena
        );

        echo "Registro exitoso. Ya apareces en la base de datos.";

    } catch (PDOException $e) {

        if ($e->getCode() == 23000) {
            echo "Ese correo ya está registrado.";
        } else {
            echo "Error al registrar: " . $e->getMessage();
        }
    }
}
?>