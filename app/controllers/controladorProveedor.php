<?php
require_once '../models/modeloProveedores.php'; // Incluir el archivo del modelo de proveedores

class ProveedorController {
    private $modeloProveedores; // Declarar la propiedad para el modelo de proveedores

    // Constructor de la clase ProveedorController
    public function __construct() {
        // Crear una nueva instancia del modelo de proveedores
        $this->modeloProveedores = new ModeloProveedores();
    }

    // Crear un proveedor
    public function crearProveedor($nombre, $contacto, $telefono, $email, $direccion) {
        // Validar si ya existe un proveedor con el mismo correo, teléfono o dirección
        if ($this->modeloProveedores->validarExistencia($telefono, $email, $direccion)) {
            return "Error: El correo, teléfono o dirección ya están registrados."; // Si ya existe, devolver mensaje de error
        }
        
        // Si no existe, proceder a crear el proveedor en la base de datos
        return $this->modeloProveedores->crearProveedor($nombre, $contacto, $telefono, $email, $direccion);
    }

    // Obtener todos los proveedores
    public function obtenerProveedores() {
        // Llamar al modelo para obtener todos los proveedores registrados
        return $this->modeloProveedores->obtenerProveedores();
    }

    // Actualizar un proveedor
    public function actualizarProveedor($idProveedor, $nombreP, $contactoP, $telefonoP, $correoP, $direccionP) {
        // Llamar al modelo para actualizar los datos del proveedor con el ID proporcionado
        return $this->modeloProveedores->actualizarProveedor($idProveedor, $nombreP, $contactoP, $telefonoP, $correoP, $direccionP);
    }

    // Eliminar un proveedor
    public function eliminarProveedor($idProveedor) {
        // Llamar al modelo para eliminar el proveedor con el ID proporcionado
        return $this->modeloProveedores->eliminarProveedor($idProveedor);
    }

    // Obtener un proveedor por su ID
    public function obtenerProveedorPorId($idProveedores) {
        // Llamar al modelo para obtener los detalles de un proveedor por su ID
        return $this->modeloProveedores->obtenerProveedorPorId($idProveedores);
    }
}
?>
