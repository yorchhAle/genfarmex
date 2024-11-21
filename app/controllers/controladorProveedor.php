<?php
require_once '../models/modeloProveedores.php';
class ProveedorController {
    private $modeloProveedores;

    public function __construct() {
        $this->modeloProveedores = new ModeloProveedores();
    }

    // Crear un proveedor
    public function crearProveedor($nombre, $contacto, $telefono, $email, $direccion) {
        // Validar existencia de correo, teléfono o dirección
        if ($this->modeloProveedores->validarExistencia($telefono, $email, $direccion)) {
            return "Error: El correo, teléfono o dirección ya están registrados.";
        }
        
        return $this->modeloProveedores->crearProveedor($nombre, $contacto, $telefono, $email, $direccion);
    }

    // Obtener todos los proveedores
    public function obtenerProveedores() {
        return $this->modeloProveedores->obtenerProveedores();
    }

    // Actualizar un proveedor
    public function actualizarProveedor($idProveedor, $nombreP, $contactoP, $telefonoP, $correoP, $direccionP) {
        return $this->modeloProveedores->actualizarProveedor($idProveedor, $nombreP, $contactoP, $telefonoP, $correoP, $direccionP);
    }

    // Eliminar un proveedor
    public function eliminarProveedor($idProveedor) {
        return $this->modeloProveedores->eliminarProveedor($idProveedor);
    }

    public function obtenerProveedorPorId($idProveedores) {
        return $this->modeloProveedores->obtenerProveedorPorId($idProveedores);
    }
}
?>
