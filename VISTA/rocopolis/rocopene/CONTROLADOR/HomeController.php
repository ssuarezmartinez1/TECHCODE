<?php
// controllers/HomeController.php
require_once __DIR__ . '/../models/Plan.php';

class HomeController {

    public function index() {
        // Obtenemos los planes desde la base de datos a través del Modelo
        $planes = Plan::obtenerTodos();

        // Cargamos la vista de inicio
        require_once __DIR__ . '/../views/home.php';
    }
}
?>