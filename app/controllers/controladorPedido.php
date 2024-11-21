<?php
require_once '../models/modeloPed.php';

class DetController {
    private $modeloDetPed;

    public function __construct() {
        $this->modeloDetPed = new ModeloDetPed();
    }

    // Crear un detallePedido
    public function crearDetPed($canti, $pre, $idPed,$id) {
        
        return $this->modeloDetPed->crearDetPed($canti, $pre, $idPed,$id);
    }

    // Obtener todos los Detalles de un pedido
    public function obtenerDetPed($pedido) {
        return $this->modeloDetPed->obtenerDetPed($pedido);
    }

    // Actualizar un detalle
    public function actualizarDetPed($iddetallepedido, $cantidad) {
        return $this->modeloDetPed->actualizarDetPed($iddetallepedido, $cantidad);
    }

    // Eliminar un detalle
    public function eliminarDetalle($iddetallepedido) {
        return $this->modeloDetPed->eliminarDetPed($iddetallepedido);
    }
}
?>