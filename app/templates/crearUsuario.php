<?php
require_once '../controllers/controladorUs.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['app'];
    $usuarioNombre = $_POST['usuario'];
    $contrasena = $_POST['pass'];
    $email = $_POST['email'];
    $telefono = $_POST['numeroT'];
    $direccion = $_POST['direccion'];
    $tipo=$_POST['tipoUsuario'];
    $datosAdicionales = [];

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

    $usuario = new UsController();
    $usuarioExistente = $usuario->obtenerUsuarioPorNombre($usuarioNombre); 
if ($usuarioExistente) {
    echo "<script>alert('El usuario ya existe, elige otro nombre de usuario.'); window.location.href='../views/cUsuarios.php';</script>";
    exit;
}
    if ($usuario->crearUsuario($nombre, $apellido, $usuarioNombre, $contrasena, $email, $telefono, $direccion, $tipo,$datosAdicionales)) {
        echo "<script>alert('Usuario creado exitosamente.'); window.location.href='../views/cUsuarios.php';</script>";
    } else {
        echo "<script>alert('Error al crear el usuario.'); window.location.href='../views/cUsuarios.php';</script>";
    }
}

?>