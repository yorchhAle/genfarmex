<?php
require_once __DIR__ . '../../../config/db.php';

class ModeloUs
{
    private $conn;

    public function __construct()
    {
        $this->conn = getConnection();
    }

    // Crear un usuario
    public function crearUs($nombre, $apellido, $usuario, $pass, $correo, $telefono, $direccion, $tipoUsuario) {
        $sql = "INSERT INTO usuarios (nombre, apellido, usuario, pass, correo, telefono, direccion, tipoUsuario) VALUES (?,?,?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssssss", $nombre, $apellido, $usuario, $pass, $correo, $telefono, $direccion, $tipoUsuario);
        if ($stmt->execute()) {
            return $stmt->insert_id;
        }
        return false;
    }

    // Leer todos los usuario
    public function obtenerUsuarios()
    {
        $sql = "SELECT * FROM usuarios";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Actualizar un usuario
    public function actualizarUs($id, $nombre, $apellido, $usuario, $pass,  $correo, $telefono, $direccion, $tipoUsuario)
    {
        $sql = "UPDATE usuarios SET nombre = ?, apellido = ?, usuario = ?, pass = ?,correo = ?, telefono = ?, direccion = ?, tipoUsuario = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssssssi", $nombre, $apellido, $usuario, $pass, $correo, $telefono, $direccion, $tipoUsuario, $id);
        return $stmt->execute();
    }

    // Eliminar un usuario
    public function eliminarUs($id)
    {
        $sql = "DELETE FROM usuarios WHERE idusuario = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function obtenerUsuarioPorNombre($nombreUsuario) {
        $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE usuario = ?");
        $stmt->bind_param("s", $nombreUsuario);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function crearCliente($usuarioId, $credito, $estatus, $fechaCreacion) {
        $stmt = $this->conn->prepare("INSERT INTO clientes (creditoC, estatusC, fechaRegistro,idusuario) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss" , $credito, $estatus, $fechaCreacion,$usuarioId);
        return $stmt->execute();
    }
    public function obtenerUsuariosC()
    {
        $sql = "SELECT * FROM clientes";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerUsuariosConDatosAdicionales() {
        $query = "
            SELECT u.*, c.creditoC, c.estatusC AS estatus_cliente, e.rol, e.fechaContratacion, e.sueldo, a.estatus AS estatus_admin, a.observaciones
            FROM usuarios u
            LEFT JOIN clientes c ON u.idusuario = c.idusuario
            LEFT JOIN empleados e ON u.idusuario = e.idusuario
            LEFT JOIN administradores a ON u.idusuario = a.idusuario
        ";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Método para empleado
    public function crearEmpleado($usuarioId, $puesto, $fechaContrato, $salario) {
        $stmt = $this->conn->prepare("INSERT INTO empleados (rol, fechaContratacion, sueldo,idusuario) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $puesto, $fechaContrato, $salario, $usuarioId);
        return $stmt->execute();
    }

    // Método para admin
    public function crearAdmin($usuarioId, $fechaContrato, $estatus, $observaciones) {
        // Asegúrate de que la fecha esté en el formato correcto
        $fechaContrato = date('Y-m-d', strtotime($fechaContrato));
        $stmt = $this->conn->prepare("INSERT INTO administradores (fechaAlta, estatus, observaciones, idusuario) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $fechaContrato, $estatus, $observaciones, $usuarioId);
        return $stmt->execute();
    }

    public function obtenerUsuarioPorID($idUsuario) {
        $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE idusuario = ?");
        $stmt->bind_param("i", $idUsuario);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function actualizarUsuario($idUsuario, $nombre, $apellido, $usuario, $contrasena, $email, $telefono, $direccion, $tipoUsuario) {
        $stmt = $this->conn->prepare("UPDATE usuarios SET nombre = ?, apellido = ?, usuario = ?, contrasena = ?, email = ?, telefono = ?, direccion = ?, tipoUsuario = ? WHERE idusuario = ?");
        $stmt->bind_param("ssssssssi", $nombre, $apellido, $usuario, $contrasena, $email, $telefono, $direccion, $tipoUsuario, $idUsuario);
        $stmt->execute();
    }
    public function actualizarCliente($idUsuario, $credito, $estatus) {
        $stmt = $this->conn->prepare("UPDATE clientes SET credito = ?, estatus = ? WHERE idusuario = ?");
        $stmt->bind_param("dsi", $credito, $estatus, $idUsuario);
        $stmt->execute();
    }
    public function actualizarEmpleado($idUsuario, $puesto, $fechaContrato, $salario) {
        $stmt = $this->conn->prepare("UPDATE empleados SET puesto = ?, fechaContrato = ?, salario = ? WHERE idusuario = ?");
        $stmt->bind_param("ssdi", $puesto, $fechaContrato, $salario, $idUsuario);
        $stmt->execute();
    }

    public function actualizarAdmin($idUsuario, $estatus, $observaciones) {
        $stmt = $this->conn->prepare("UPDATE administradores SET estatus = ?, observaciones = ? WHERE idusuario = ?");
        $stmt->bind_param("ssi", $estatus, $observaciones, $idUsuario);
        $stmt->execute();
    }
    
    

    public function eliminarUsuarioConDatos($idUsuario) {
        // Eliminar datos en tablas adicionales y luego en usuarios
        $this->conn->begin_transaction();
        
        $this->conn->query("DELETE FROM clientes WHERE idusuario = $idUsuario");
        $this->conn->query("DELETE FROM empleados WHERE idusuario = $idUsuario");
        $this->conn->query("DELETE FROM administradores WHERE idusuario = $idUsuario");
        $this->conn->query("DELETE FROM usuarios WHERE idusuario = $idUsuario");
        
        $this->conn->commit();
    }
}
