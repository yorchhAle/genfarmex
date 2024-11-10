<?php
require_once '../models/modeloUs.php';

class UsController
{
    private $modeloUs;

    public function __construct()
    {
        $this->modeloUs = new ModeloUs();
    }
    public function crearUsuario($nombre, $apellido, $usuario, $pass, $correo, $telefono, $direccion, $tipoUsuario, $datosAdicionales)
    {
        $idUsuario = $this->modeloUs->crearUs($nombre, $apellido, $usuario, $pass, $correo, $telefono, $direccion, $tipoUsuario);
        if (!$idUsuario) {
            echo "Error: User creation failed.";
            return false;
        }else{
            echo "ID de usuario creado: " . $idUsuario; 
        }

        if ($idUsuario) {
            // Según el tipo de usuario, insertar los datos adicionales en la tabla correspondiente
            if ($tipoUsuario == 'cliente') {
                $credito = $datosAdicionales['credito'];
                $estatus = $datosAdicionales['estatus'];
                $fechaCreacion = $datosAdicionales['fechaCreacion'];
                return $this->modeloUs->crearCliente($idUsuario, $credito, $estatus, $fechaCreacion);
            } elseif ($tipoUsuario == 'empleado') {
                $puesto = $datosAdicionales['rol'];
                $fechaContrato = $datosAdicionales['fechaContrato'];
                $salario = $datosAdicionales['salario'];
                return $this->modeloUs->crearEmpleado($idUsuario, $puesto, $fechaContrato, $salario);
            } elseif ($tipoUsuario == 'admin') {
                $fechaContrato = $datosAdicionales['fechaCreacion'];
                $estatus = $datosAdicionales['estatus'];
                $observaciones = $datosAdicionales['observaciones'];
                return $this->modeloUs->crearAdmin($idUsuario, $fechaContrato, $estatus, $observaciones);
            }
        } else {
            echo "Error al crear el usuario principal.";
            return false; // Error en la creación del usuario
        }
    }

    public function listarUsuarios()
    {
        return $this->modeloUs->obtenerUsuariosConDatosAdicionales();
    }

    public function obtenerUsuarioPorNombre($usuario)
    {
        return $this->modeloUs->obtenerUsuarioPorNombre($usuario);
    }

    public function obtenerUsuarioC()
    {
        return $this->modeloUs->obtenerUsuariosC();
    }

    public function obtenerUsuarios($idUsuario)
    {
        $modelo = new ModeloUs();
        return $modelo->obtenerUsuarioPorID($idUsuario);
    }

    public function actualizarUsuario($idUsuario, $nombre, $apellido, $usuario, $contrasena, $email, $telefono, $direccion, $tipoUsuario, $datosAdicionales)
    {
        $this->modeloUs->actualizarUsuario($idUsuario, $nombre, $apellido, $usuario, $contrasena, $email, $telefono, $direccion, $tipoUsuario);

        if ($tipoUsuario === 'cliente') {
            $this->modeloUs->actualizarCliente($idUsuario, $datosAdicionales['credito'], $datosAdicionales['estatus']);
        } elseif ($tipoUsuario === 'empleado') {
            $this->modeloUs->actualizarEmpleado($idUsuario, $datosAdicionales['puesto'], $datosAdicionales['fechaContrato'], $datosAdicionales['salario']);
        } elseif ($tipoUsuario === 'admin') {
            $this->modeloUs->actualizarAdmin($idUsuario, $datosAdicionales['estatus'], $datosAdicionales['observaciones']);
        }
    }

    public function eliminarUsuario($idUsuario)
    {
        return $this->modeloUs->eliminarUsuarioConDatos($idUsuario);
    }
}
