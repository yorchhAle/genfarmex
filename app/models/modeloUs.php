<?php
require_once __DIR__ . '../../../config/db.php';

class ModeloUs
{
    private $conn;

    public function __construct(){
        $this->conn = getConnection();
    }

    // Crear un usuario
    public function crearUs($nombre, $apellido, $usuario, $pass, $correo, $telefono, $direccion, $tipoUsuario)
    {
        $sql = "INSERT INTO usuarios (nombre, apellido, usuario, pass, correo, telefono, direccion, tipoUsuario) VALUES (?,?,?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssssss", $nombre, $apellido, $usuario, $pass, $correo, $telefono, $direccion, $tipoUsuario);
        if ($stmt->execute()) {
            return $stmt->insert_id;
        }
        return false;
    }

    // Leer todos los usuario
    public function obtenerUsuarios(){
        $sql = "SELECT * FROM usuarios";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Actualizar un usuario
    public function actualizarUs($id, $nombre, $apellido, $usuario, $pass,  $correo, $telefono, $direccion, $tipoUsuario){
        $sql = "UPDATE usuarios SET nombre = ?, apellido = ?, usuario = ?, pass = ?,correo = ?, telefono = ?, direccion = ?, tipoUsuario = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssssssi", $nombre, $apellido, $usuario, $pass, $correo, $telefono, $direccion, $tipoUsuario, $id);
        return $stmt->execute();
    }

    // Eliminar un usuario
    public function eliminarUs($id){
        $sql = "DELETE FROM usuarios WHERE idusuario = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function obtenerUsuarioPorNombre($nombreUsuario){
        $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE usuario = ?");
        $stmt->bind_param("s", $nombreUsuario);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function obtenerUsuarioPorCorreo($correo){
        $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE correo = ?");
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    
    public function obtenerUsuarioPorTelefono($telefono){
        $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE telefono = ?");
        $stmt->bind_param("s", $telefono);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function crearCliente($idUsuario, $credito, $estatus, $fechaCreacion) {
        $query = "INSERT INTO clientes (idusuario, creditoC, estatusC, fechaRegistro) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("isss", $idUsuario, $credito, $estatus, $fechaCreacion);
    
        if ($stmt->execute()) {
            return true;
        } else {
            echo "Error al insertar cliente: " . $stmt->error;
            return false;
        }
    }
    
    public function obtenerUsuariosC(){
        $sql = "SELECT * FROM clientes";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerUsuariosA(){
        $sql = "SELECT * FROM administradores";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerUsuariosConDatosAdicionales(){
        $query = "
            SELECT u.*, c.creditoC, c.estatusC AS estatus_cliente, e.rol, e.fechaContratacion, e.sueldo, a.estatus AS estatus_admin, a.fechaAlta AS fechaAlta, a.observaciones
            FROM usuarios u
            LEFT JOIN clientes c ON u.idusuario = c.idusuario
            LEFT JOIN empleados e ON u.idusuario = e.idusuario
            LEFT JOIN administradores a ON u.idusuario = a.idusuario
        ";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerClienteConUsuario($idUsuario){
        $query = "
            SELECT u.nombre, u.apellido, u.usuario, u.pass, u.correo, u.telefono, u.direccion, c.creditoC, c.estatusC, c.fechaRegistro, c.idusuario
            FROM usuarios u LEFT JOIN clientes c ON u.idusuario = c.idusuario
            WHERE u.idusuario = ?
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $idUsuario);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function obtenerAdminConUsuario($idUsuario){
        $query = "
            SELECT u.nombre, u.apellido, u.usuario, u.pass, u.correo, u.telefono, u.direccion, a.fechaAlta, a.estatus, a.observaciones, a.idusuario
            FROM usuarios u LEFT JOIN administradores a ON u.idusuario = a.idusuario
            WHERE u.idusuario = ?
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $idUsuario);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Método para empleado
    public function crearEmpleado($usuarioId, $puesto, $fechaContrato, $salario)
    {
        $stmt = $this->conn->prepare("INSERT INTO empleados (rol, fechaContratacion, sueldo,idusuario) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $puesto, $fechaContrato, $salario, $usuarioId);
        return $stmt->execute();
    }

    // Método para admin
    public function crearAdmin($usuarioId, $fechaContrato, $estatus, $observaciones){
        // Asegúrate de que la fecha esté en el formato correcto
        $fechaContrato = date('Y-m-d', strtotime($fechaContrato));
        $stmt = $this->conn->prepare("INSERT INTO administradores (fechaAlta, estatus, observaciones, idusuario) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $fechaContrato, $estatus, $observaciones, $usuarioId);
        return $stmt->execute();
    }

    public function obtenerUsuarioPorID($idUsuario){
        $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE idusuario = ?");
        $stmt->bind_param("i", $idUsuario);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function actualizarUsuario($idUsuario, $nombre, $apellido, $usuario, $contrasena, $email, $telefono, $direccion, $tipoUsuario){
        $stmt = $this->conn->prepare("UPDATE usuarios SET nombre = ?, apellido = ?, usuario = ?, pass = ?, correo = ?, telefono = ?, direccion = ?, tipoUsuario = ? WHERE idusuario = ?");
        $stmt->bind_param("ssssssssi", $nombre, $apellido, $usuario, $contrasena, $email, $telefono, $direccion, $tipoUsuario, $idUsuario);
        $stmt->execute();
    }
    public function actualizarCliente($idUsuario, $credito, $estatus) {
        $query = "UPDATE clientes SET creditoC = ?, estatusC = ? WHERE idusuario = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssi", $credito, $estatus, $idUsuario);
        if ($stmt->execute()) {
            return true;
        } else {
            echo "Error en actualizarCliente: " . $stmt->error;
            return false;
        }
    }
    
    // Actualización para empleados y administradores
    public function actualizarEmpleado($idUsuario, $rol, $fechaContrato, $sueldo){
        $stmt = $this->conn->prepare("UPDATE empleados SET rol = ?, fechaContratacion = ?, sueldo = ? WHERE idusuario = ?");
        $stmt->bind_param("ssdi", $rol, $fechaContrato, $sueldo, $idUsuario);
        return $stmt->execute();
    }

    public function actualizarAdmin($idUsuario, $estatus, $observaciones,$fechaAlta){
        $stmt = $this->conn->prepare("UPDATE administradores SET estatus = ?, observaciones = ?, fechaAlta = ? WHERE idusuario = ?");
        $stmt->bind_param("sssi", $estatus, $observaciones,$fechaAlta ,$idUsuario);
        return $stmt->execute();
    }



    public function eliminarUsuarioConDatos($idUsuario)
    {
        try {
            $this->conn->begin_transaction();

            // Use prepared statements to prevent SQL injection
            $stmt1 = $this->conn->prepare("DELETE FROM clientes WHERE idusuario = ?");
            $stmt2 = $this->conn->prepare("DELETE FROM empleados WHERE idusuario = ?");
            $stmt3 = $this->conn->prepare("DELETE FROM administradores WHERE idusuario = ?");
            $stmt4 = $this->conn->prepare("DELETE FROM usuarios WHERE idusuario = ?");

            // Bind and execute statements
            foreach ([$stmt1, $stmt2, $stmt3, $stmt4] as $stmt) {
                $stmt->bind_param("i", $idUsuario);
                if (!$stmt->execute()) {
                    throw new Exception("Error Al eliminar ID $idUsuario En una de las tablas.");
                }
            }

            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollback();
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
