<?php
require_once __DIR__ . '/../../controllers/admincontrollers/controller_informacion.php';

$controlador = new InformacionController();
$controlador->manejarSolicitud();
