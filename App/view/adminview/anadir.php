<?php
require_once __DIR__ . '/../../controllers/anadir_controller.php';

$controller = new AdminController();
$controller->eliminar();
$controller->agregar();
$controller->index();
