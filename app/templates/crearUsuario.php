<?php
require_once '../controllers/controladorUs.php'; // Incluye el controlador para la gestión de usuarios.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura los datos del formulario enviados por método POST.
    $nombre = $_POST['nombre'];
    $apellido = $_POST['app'];
    $usuarioNombre = $_POST['usuario'];
    $contrasena = $_POST['pass'];
    $email = $_POST['email'];
    $telefono = $_POST['numeroT'];
    $direccion = $_POST['direccion'];
    $tipo = $_POST['tipoUsuario'];
    $datosAdicionales = []; // Array para almacenar los datos específicos según el tipo de usuario.

    // Determina los datos adicionales según el tipo de usuario seleccionado.
    if ($tipo == 'cliente') {
        $datosAdicionales = [
            'credito' => $_POST['credito'],
            'estatus' => $_POST['estatus'],
            'fechaCreacion' => $_POST['fechaCreacion']
        ];
    } elseif ($tipo == 'empleado') {
        $datosAdicionales = [
            'rol' => $_POST['rol'],
            'fechaContrato' => $_POST['fechaContrato'],
            'salario' => $_POST['salario']
        ];
    } elseif ($tipo == 'admin') {
        $datosAdicionales = [
            'fechaCreacion' => $_POST['fechaCreacion'],
            'estatus' => $_POST['estatus'],
            'observaciones' => $_POST['observaciones']
        ];
    }

    $usuario = new UsController(); // Crea una instancia del controlador de usuarios.

    // Verifica si el nombre de usuario ya existe.
    $usuarioExistente = $usuario->obtenerUsuarioPorNombre($usuarioNombre);
    if ($usuarioExistente) {
        // Si existe, muestra un mensaje de alerta y redirige al formulario de creación.
        echo "<script>alert('El usuario ya existe, elige otro nombre de usuario.'); window.location.href='../views/cUsuarios.php';</script>";
        exit;
    }

    // Intenta crear el usuario con los datos proporcionados.
    if ($usuario->crearUsuario($nombre, $apellido, $usuarioNombre, $contrasena, $email, $telefono, $direccion, $tipo, $datosAdicionales)) {
        // Si la creación es exitosa, muestra un mensaje y redirige.
        echo "<script>alert('Usuario creado exitosamente.'); window.location.href='../views/cUsuarios.php';</script>";
    } else {
        // Si falla la creación, muestra un mensaje de error y redirige.
        echo "<script>alert('Error al crear el usuario.'); window.location.href='../views/cUsuarios.php';</script>";
    }
}
?>
