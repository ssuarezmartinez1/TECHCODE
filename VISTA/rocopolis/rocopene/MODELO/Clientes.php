<?php

class Cliente {

    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function registrar(
        $nombre,
        $apellido,
        $correo,
        $telefono,
        $contrasena
    ) {
        $sql = "INSERT INTO clientes
                (nombre, apellido, correo, telefono, contrasena)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->conexion->prepare($sql);

        $contrasena_segura = password_hash(
            $contrasena,
            PASSWORD_DEFAULT
        );

        return $stmt->execute([
            $nombre,
            $apellido,
            $correo,
            $telefono,
            $contrasena_segura
        ]);
    }
}
?>