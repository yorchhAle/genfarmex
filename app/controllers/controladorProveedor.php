<?php
require_once '../models/modeloProveedores.php';

class ProveedorController {
    private $modeloProveedores;

    public function __construct() {
        $this->modeloProveedores = new ModeloProveedores();
    }

    // Crear un descuento
    public function crearProveedor($nombre, $contacto,$telefono,$email,$direccion) {
        return $this->modeloProveedores->crearProveedor($nombre, $contacto,$telefono,$email,$direccion);
    }

    // Obtener todos los descuentos
    public function obtenerProveedores() {
        return $this->modeloProveedores->obtenerProveedores();
    }

    // Actualizar un proveedores
    public function actualizarProveedor($idproveedores, $nombre, $contacto,$telefono,$email,$direccion) {
        return $this->modeloProveedores->actualizarProveedor($idproveedores, $nombre, $contacto,$telefono,$email,$direccion);
    }

    // Eliminar un proveedor
    public function eliminarProveedor($idproveedores) {
        return $this->modeloProveedores->eliminarProveedor($idproveedores);
    }
}
?>