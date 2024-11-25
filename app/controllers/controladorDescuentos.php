<?php
require_once '../models/ModeloDescuentos.php';

class DescuentoController {
    private $modeloDescuentos;

    public function __construct() {
        // Inicializa el modelo de descuentos
        $this->modeloDescuentos = new ModeloDescuentos();
    }

    // Crear un descuento
    public function crearDescuento($nombre, $porcentaje, $fechaCreacion) {
        // Verificar si ya existe un descuento con el mismo nombre
        if ($this->modeloDescuentos->existeNombreDescuento($nombre)) {
            return false; // Retorna falso si el nombre ya existe
        }
        // Si no existe, crea un nuevo descuento
        return $this->modeloDescuentos->crearDescuento($nombre, $porcentaje, $fechaCreacion);
    }

    // Obtener todos los descuentos
    public function obtenerDescuentos() {
        // Obtiene y retorna todos los descuentos desde el modelo
        return $this->modeloDescuentos->obtenerDescuentos();
    }

    // Actualizar un descuento
    public function actualizarDescuento($idDescuento, $nombre, $porcentaje, $fechaCreacion) {
        // Llama al modelo para actualizar el descuento
        return $this->modeloDescuentos->actualizarDescuento($idDescuento, $nombre, $porcentaje, $fechaCreacion);
    }

    // Eliminar un descuento
    public function eliminarDescuento($idDescuento) {
        // Llama al modelo para eliminar el descuento
        return $this->modeloDescuentos->eliminarDescuento($idDescuento);
    }
}
?>
