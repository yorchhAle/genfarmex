<?php
require_once '../../models/ModeloProductos.php';

class ProductoController {
    private $modeloProductos;

    public function __construct() {
        $this->modeloProductos = new modeloProductos();
    }

    // Crear un producto
    public function crearProducto($clave, $desc, $exis, $pre) {
        if ($this->modeloProductos->existeClave($clave)) {
            return false; // Clave duplicada
        }
        return $this->modeloProductos->crearProducto($clave, $desc, $exis, $pre);
    }
    

    // Obtener todos los productos
    public function mostrarProductos($filtro = "", $pagina = 1) {
        return $this->modeloProductos->obtenerProductos($filtro, $pagina);
    }

    // Obtener un producto por ID
    public function obtenerProductoPorId($id) {
        return $this->modeloProductos->obtenerProductoPorId($id);
    }   

   
    // contar los productos
    public function contarProductos($filtro = "") {
        return $this->modeloProductos->contarProductos($filtro);
    }

    // Actualizar un producto
    public function actualizarProducto($id, $clave, $desc, $exis, $pre) {
        return $this->modeloProductos->actualizarProducto($id, $clave, $desc, $exis, $pre);
    }

    // Eliminar un producto
    public function eliminarProducto($id) {
        return $this->modeloProductos->eliminarProducto($id);
    }

    
    
}
?>
