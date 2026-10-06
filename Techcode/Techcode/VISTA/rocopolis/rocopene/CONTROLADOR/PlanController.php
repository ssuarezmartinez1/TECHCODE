<?php
require_once __DIR__ . '/../MODELO/planes.php';

class PlanController {

    public function mostrarPlanes() {
        $planes = [];
        $error = null;

        try {
            $planes = Plan::obtenerTodos();
        } catch (RuntimeException $exception) {
            $error = $exception->getMessage();
        }

        require_once __DIR__ . '/../VISTA/planes.php';
    }
}
?>