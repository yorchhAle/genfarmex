<?php
require_once __DIR__ . '../../../config/db.php';
// Incluye el archivo de configuración de la base de datos. Se asume que 'db.php' contiene la lógica para establecer la conexión con la base de datos.

class Usuario {
    // Define la clase Usuario, que interactúa con la base de datos para obtener información de los usuarios.

    private $conn;
    // Variable privada para almacenar la conexión a la base de datos.

    public function __construct() {
        $this->conn = getConnection();
        // En el constructor, establece la conexión a la base de datos llamando a la función `getConnection` de db.php.
    }

    public function obtenerPorUsuario($usuario) {
        // Método para obtener la información de un usuario específico basado en su nombre de usuario.

        $sql = "SELECT usuario, pass, tipoUsuario FROM usuarios WHERE usuario = ?";
        // Prepara una consulta SQL que selecciona el nombre de usuario, la contraseña y el tipo de usuario de la tabla `usuarios` donde el nombre de usuario coincide con el proporcionado.

        $stmt = $this->conn->prepare($sql);
        // Prepara la consulta SQL para ser ejecutada de manera segura.

        $stmt->bind_param("s", $usuario);
        // Asocia el valor del parámetro `usuario` a la consulta, utilizando el tipo de dato "s" (string).

        $stmt->execute();
        // Ejecuta la consulta preparada.

        return $stmt->get_result()->fetch_assoc();
        // Devuelve el resultado de la consulta en forma de un arreglo asociativo. Esto devolverá los datos del usuario si se encuentra.
    }
}
?>
