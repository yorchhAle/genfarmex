<?php
session_start();
// Inicia una sesión o reanuda la actual, permitiendo el manejo de variables de sesión.

require_once __DIR__ . '/../models/modeloUsuario.php';
// Incluye el archivo que contiene el modelo `Usuario`. Asegúrate de que la ruta sea correcta y el modelo exista.

class AuthController {
    // Define la clase `AuthController` que se encarga de gestionar la autenticación.

    public function login($usuario, $contrasena) {
        // Método para iniciar sesión. Recibe el nombre de usuario y la contraseña como parámetros.

        $usuarioModel = new Usuario();
        // Crea una instancia del modelo `Usuario` que interactúa con la base de datos.

        $usuarioData = $usuarioModel->obtenerPorUsuario($usuario);
        // Llama al método `obtenerPorUsuario` del modelo para buscar los datos del usuario en la base de datos.

        if ($usuarioData) {
            // Verifica si se encontró un usuario con el nombre proporcionado.

            if ($contrasena == $usuarioData['pass']) {
                // Comprueba si la contraseña proporcionada coincide con la almacenada en la base de datos.

                session_start();
                // Inicia o reanuda la sesión para almacenar datos del usuario autenticado.

                $_SESSION['usuario'] = $usuarioData['usuario'];
                // Almacena el nombre de usuario en la sesión.

                $_SESSION['tipoUsuario'] = $usuarioData['tipoUsuario'];
                // Almacena el tipo de usuario (rol) en la sesión.

                // Redirección basada en roles de usuario.
                if ($_SESSION['tipoUsuario'] == 'admin') {
                    header("Location: panel.php");
                    // Si el usuario es administrador, redirige al panel de administración.
                } elseif ($_SESSION['tipoUsuario'] == 'cliente') {
                    header("Location:catalogo.php");
                    // Si el usuario es cliente, redirige al catálogo de productos.
                } elseif ($_SESSION['tipoUsuario'] == 'empleado') {
                    header("Location:reportesPanel.php");
                    // Si el usuario es empleado, redirige al panel de reportes.
                } else {
                    header("Location: login.php");
                    // Si el tipo de usuario no coincide con ninguno, redirige al formulario de inicio de sesión.
                }
                exit;
                // Detiene la ejecución del script después de la redirección.
            } else {
                // Si la contraseña no coincide, muestra un mensaje de error y redirige al formulario de inicio de sesión.
                echo "<script>alert('Contraseña incorrecta.'); window.location.href='../views/inicioSesion.html';</script>";
            }
        } else {
            // Si no se encuentra el usuario en la base de datos, muestra un mensaje de error.
            echo "<script>alert('Usuario no encontrado.'); window.location.href='../views/inicioSesion.html';</script>";
        }
    }
}
?>
