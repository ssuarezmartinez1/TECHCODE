<?php
// models/Plan.php
require_once __DIR__ . '/../config/conexion.php';

class Plan {
    private $id;
    private $titulo;
    private $precio;
    private $icono;
    private $detalles;

    // Método para obtener todos los planes desde MySQL
    public static function obtenerTodos() {
        $conexion = new Conexion();
        $db = $conexion->getConexion();
        $query = $db->query('SELECT * FROM planes');

        if (!$query) {
            throw new RuntimeException('Error al consultar planes: ' . $db->error);
        }

        $planes = $query->fetch_all(MYSQLI_ASSOC);

        foreach ($planes as &$plan) {
            $plan['detalles'] = isset($plan['detalles'])
                ? explode(',', $plan['detalles'])
                : [];
        }

        return $planes;
    }
}
?>