<?php
require_once __DIR__ . '../../../config/db.php'; // Incluir el archivo de configuración para la conexión a la base de datos

class ModeloProductos {
    private $conn; // Propiedad para almacenar la conexión a la base de datos

    // Constructor: Inicializa la conexión a la base de datos
    public function __construct() {
        $this->conn = getConnection(); // Obtener la conexión desde la función getConnection()
    }

    // Crear un producto en la base de datos
    public function crearProducto($clave, $desc, $exis, $pre) {
        // SQL para insertar un nuevo producto en la tabla producto
        $sql = "INSERT INTO producto (clave, descripcion, existencias, precioUnitario) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql); // Preparar la consulta SQL
        $stmt->bind_param("ssid", $clave, $desc, $exis, $pre); // Vincular los parámetros a la consulta
        return $stmt->execute(); // Ejecutar la consulta y retornar el resultado (verdadero o falso)
    }

    // Obtener todos los productos, con soporte para filtro y paginación
    public function obtenerProductos($filt = "", $pagina = 1) {
        $productosPorPagina = 40; // Número de productos a mostrar por página
        $offset = ($pagina - 1) * $productosPorPagina; // Cálculo del desplazamiento para la paginación
        
        // Si hay un filtro, aplicar el filtro en la consulta
        if ($filt != "") {
            $sql = "SELECT * FROM producto WHERE descripcion LIKE ? LIMIT ? OFFSET ?"; // Consulta con filtro
            $stmt = $this->conn->prepare($sql);
            $filt = "%" . $filt . "%"; // Agregar los signos de porcentaje para buscar coincidencias parciales
            $stmt->bind_param("sii", $filt, $productosPorPagina, $offset); // Vincular parámetros
        } else {
            // Si no hay filtro, obtener todos los productos
            $sql = "SELECT * FROM producto LIMIT ? OFFSET ?"; // Consulta sin filtro
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ii", $productosPorPagina, $offset); // Vincular parámetros
        }
        
        $stmt->execute(); // Ejecutar la consulta
        $result = $stmt->get_result(); // Obtener el resultado de la consulta
        return $result->fetch_all(MYSQLI_ASSOC); // Retornar todos los productos como un arreglo asociativo
    }

    // Obtener un producto por su ID
    public function obtenerProductoPorId($id) {
        // Consulta para obtener un producto por su ID
        $sql = "SELECT * FROM producto WHERE id = ?";
        $stmt = $this->conn->prepare($sql); // Preparar la consulta
        $stmt->bind_param("i", $id); // Vincular el parámetro
        $stmt->execute(); // Ejecutar la consulta
        $result = $stmt->get_result(); // Obtener el resultado
        return $result->fetch_assoc(); // Retornar el producto encontrado
    }

    // Actualizar un producto
    public function actualizarProducto($id, $clave, $desc, $exis, $pre) {
        // Consulta para actualizar un producto existente
        $sql = "UPDATE producto SET clave = ?, descripcion = ?, existencias = ?, precioUnitario = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql); // Preparar la consulta
        $stmt->bind_param("ssidi", $clave, $desc, $exis, $pre, $id); // Vincular los parámetros
        return $stmt->execute(); // Ejecutar la consulta y retornar el resultado
    }

    // Eliminar un producto por su ID
    public function eliminarProducto($id) {
        // Consulta para eliminar un producto por su ID
        $sql = "DELETE FROM producto WHERE id = ?";
        $stmt = $this->conn->prepare($sql); // Preparar la consulta
        $stmt->bind_param("i", $id); // Vincular el parámetro
        return $stmt->execute(); // Ejecutar la consulta y retornar el resultado
    }

    // Contar el número total de productos, con soporte para filtro
    public function contarProductos($filt = "") {
        // Si hay un filtro, contar los productos que coinciden con el filtro
        if ($filt != "") {
            $sql = "SELECT COUNT(*) as total FROM producto WHERE descripcion LIKE ?"; // Consulta con filtro
            $stmt = $this->conn->prepare($sql);
            $filt = "%" . $filt . "%"; // Agregar los signos de porcentaje para buscar coincidencias parciales
            $stmt->bind_param("s", $filt); // Vincular el parámetro
        } else {
            // Si no hay filtro, contar todos los productos
            $sql = "SELECT COUNT(*) as total FROM producto"; // Consulta sin filtro
            $stmt = $this->conn->prepare($sql);
        }
        
        $stmt->execute(); // Ejecutar la consulta
        $result = $stmt->get_result(); // Obtener el resultado
        $row = $result->fetch_assoc(); // Obtener la primera fila del resultado
        return $row['total']; // Retornar el número total de productos
    }

    // Verificar si una clave de producto ya existe en la base de datos
    public function existeClave($clave) {
        // Consulta para verificar si ya existe un producto con la misma clave
        $sql = "SELECT COUNT(*) as total FROM producto WHERE clave = ?";
        $stmt = $this->conn->prepare($sql); // Preparar la consulta
        $stmt->bind_param("s", $clave); // Vincular el parámetro
        $stmt->execute(); // Ejecutar la consulta
        $result = $stmt->get_result(); // Obtener el resultado
        $row = $result->fetch_assoc(); // Obtener la primera fila del resultado
        return $row['total'] > 0; // Retornar verdadero si la clave ya existe, falso en caso contrario
    }
}
?>
