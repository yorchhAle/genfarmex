<?php
require_once '../models/ModeloDescuentos.php';

class DescuentoController {
    private $modeloDescuentos;

    public function __construct() {
        $this->modeloDescuentos = new ModeloDescuentos();
    }

    // Crear un descuento
    public function crearDescuento($nombre, $porcentaje, $fechaCreacion) {
        return $this->modeloDescuentos->crearDescuento($nombre, $porcentaje, $fechaCreacion);
    }

    // Obtener todos los descuentos
    public function obtenerDescuentos() {
        return $this->modeloDescuentos->obtenerDescuentos();
    }

    // Actualizar un descuento
    public function actualizarDescuento($idDescuento, $nombre, $porcentaje, $fechaCreacion) {
        return $this->modeloDescuentos->actualizarDescuento($idDescuento, $nombre, $porcentaje, $fechaCreacion);
    }

    // Eliminar un descuento
    public function eliminarDescuento($idDescuento) {
        return $this->modeloDescuentos->eliminarDescuento($idDescuento);
    }
}
?>
