<?php
require_once __DIR__ . '../../../config/db.php';

class ModeloProductos {
    private $conn;

    public function __construct() {
        $this->conn = getConnection();
    }

    // Crear un producto
    public function crearProducto($clave, $desc, $exis, $pre) {
        $sql = "INSERT INTO producto (clave, descripcion, existencias, precioUnitario) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssid", $clave, $desc, $exis, $pre);
        return $stmt->execute();
    }

    // Leer todos los productos
    public function obtenerProductos($filt = "", $pagina = 1) {
        $productosPorPagina = 40;
        $offset = ($pagina - 1) * $productosPorPagina;
        
        if ($filt != "") {
            $sql = "SELECT * FROM producto WHERE descripcion LIKE ? LIMIT ? OFFSET ?";
            $stmt = $this->conn->prepare($sql);
            $filt = "%" . $filt . "%";
            $stmt->bind_param("sii", $filt, $productosPorPagina, $offset);
        } else {
            $sql = "SELECT * FROM producto LIMIT ? OFFSET ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ii", $productosPorPagina, $offset);
        }
        
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    // Obtener un producto por ID
    public function obtenerProductoPorId($id) {
        $sql = "SELECT * FROM producto WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Actualizar un producto
    public function actualizarProducto($id, $clave, $desc, $exis, $pre) {
        $sql = "UPDATE producto SET clave = ?, descripcion = ?, existencias = ?, precioUnitario = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssidi", $clave, $desc, $exis, $pre, $id);
        return $stmt->execute();
    }

    // Eliminar un producto
    public function eliminarProducto($id) {
        $sql = "DELETE FROM producto WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function contarProductos($filt = "") {
        if ($filt != "") {
            $sql = "SELECT COUNT(*) as total FROM producto WHERE descripcion LIKE ?";
            $stmt = $this->conn->prepare($sql);
            $filt = "%" . $filt . "%";
            $stmt->bind_param("s", $filt);
        } else {
            $sql = "SELECT COUNT(*) as total FROM producto";
            $stmt = $this->conn->prepare($sql);
        }
        
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['total'];
    }

    public function existeClave($clave) {
        $sql = "SELECT COUNT(*) as total FROM producto WHERE clave = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $clave);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['total'] > 0;
    }
    
    
}
?>
