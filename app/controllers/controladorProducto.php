<?php
require_once '../models/ModeloProductos.php'; // Incluir el modelo de productos

class ProductoController {
    private $modeloProductos; // Declaración de una propiedad para el modelo de productos

    // Constructor: Inicializa el controlador con una instancia del modelo de productos
    public function __construct() {
        $this->modeloProductos = new modeloProductos(); // Crear una instancia del modelo
    }

    // Crear un producto
    public function crearProducto($clave, $desc, $exis, $pre) {
        // Verificar si ya existe un producto con la misma clave
        if ($this->modeloProductos->existeClave($clave)) {
            return false; // Si la clave está duplicada, retornar falso
        }
        // Crear el producto llamando al método del modelo
        return $this->modeloProductos->crearProducto($clave, $desc, $exis, $pre);
    }

    // Obtener todos los productos con un filtro y una página para paginación
    public function mostrarProductos($filtro = "", $pagina = 1) {
        // Llamar al método del modelo que obtiene los productos con el filtro y la paginación
        return $this->modeloProductos->obtenerProductos($filtro, $pagina);
    }

    // Obtener un producto por su ID
    public function obtenerProductoPorId($id) {
        // Llamar al modelo para obtener un producto por su ID
        return $this->modeloProductos->obtenerProductoPorId($id);
    }

    // Contar el total de productos que cumplen con un filtro específico
    public function contarProductos($filtro = "") {
        // Llamar al método del modelo que devuelve el número total de productos
        return $this->modeloProductos->contarProductos($filtro);
    }

    // Actualizar un producto con nuevos valores
    public function actualizarProducto($id, $clave, $desc, $exis, $pre) {
        // Llamar al método del modelo para actualizar un producto con los nuevos valores
        return $this->modeloProductos->actualizarProducto($id, $clave, $desc, $exis, $pre);
    }

    // Eliminar un producto por su ID
    public function eliminarProducto($id) {
        // Llamar al modelo para eliminar un producto
        return $this->modeloProductos->eliminarProducto($id);
    }
}
?>
