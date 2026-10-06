<?php

session_start();

require_once "config/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $correo = $_POST["correo"];
    $contrasena = $_POST["contrasena"];

    $sql = "SELECT * FROM usuarios WHERE correo = ?";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();

    $resultado = $stmt->get_result();

    if ($resultado->num_rows == 1) {

        $usuario = $resultado->fetch_assoc();

        if (password_verify(
            $contrasena,
            $usuario["contrasena"]
        )) {

            $_SESSION["usuario"] = $usuario["nombre"];

            echo "Inicio de sesión exitoso";

        } else {
            echo "Contraseña incorrecta";
        }

    } else {
        echo "El usuario no existe";
    }
}
?>