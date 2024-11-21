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
        $usuarioPorCorreo = $this->modeloUs->obtenerUsuarioPorCorreo($correo);
        if ($usuarioPorCorreo) {
            echo "<script>alert('El correo ya está registrado.'); window.location.href='../views/cUsuarios.php';</script>";
            return false;
        }

        // Validar que el teléfono no esté duplicado
        $usuarioPorTelefono = $this->modeloUs->obtenerUsuarioPorTelefono($telefono);
        if ($usuarioPorTelefono) {
            echo "<script>alert('El número de teléfono ya está registrado.'); window.location.href='../views/cUsuarios.php';</script>";
            return false;
        }


        $idUsuario = $this->modeloUs->crearUs($nombre, $apellido, $usuario, $pass, $correo, $telefono, $direccion, $tipoUsuario);
        if (!$idUsuario) {
            echo "Error: User creation failed.";
            return false;
        } else {
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

    public function listarClientes()
    {
        $usuarios = $this->modeloUs->obtenerUsuariosConDatosAdicionales();
        return array_filter($usuarios, function ($usuario) {
            return strtolower($usuario['tipoUsuario']) === 'cliente';
        });
    }

    public function listarAdmins()
    {
        $usuarios = $this->modeloUs->obtenerUsuariosConDatosAdicionales();
        return array_filter($usuarios, function ($usuario) {
            return strtolower($usuario['tipoUsuario']) == 'admin';
        });
    }

    public function obtenerClienteConUsuario($idUsuario)
    {
        return $this->modeloUs->obtenerClienteConUsuario($idUsuario);
    }

    public function obtenerAdminConUsuario($idUsuario)
    {
        return $this->modeloUs->obtenerAdminConUsuario($idUsuario);
    }

    public function obtenerUsuarioPorNombre($usuario)
    {
        return $this->modeloUs->obtenerUsuarioPorNombre($usuario);
    }

    public function obtenerUsuarioC()
    {
        return $this->modeloUs->obtenerUsuariosC();
    }

    public function obtenerUsuariosA()
    {
        return $this->modeloUs->obtenerUsuariosA();
    }

    public function obtenerUsuarios($idUsuario)
    {
        return $this->modeloUs->obtenerUsuarioPorID($idUsuario);
    }

    public function actualizarUsuario($idUsuario, $nombre, $apellido, $usuario, $contrasena, $email, $telefono, $direccion, $tipoUsuario, $datosAdicionales)
    {
        try {

            // Actualizar usuario
            $this->modeloUs->actualizarUsuario($idUsuario, $nombre, $apellido, $usuario, $contrasena, $email, $telefono, $direccion, $tipoUsuario);

            // Actualizar según el tipo
            if ($tipoUsuario == 'cliente') {
                $this->modeloUs->actualizarCliente($idUsuario, $datosAdicionales['credito'], $datosAdicionales['estatus']);
            } elseif ($tipoUsuario == 'empleado') {
                $this->modeloUs->actualizarEmpleado($idUsuario, $datosAdicionales['puesto'], $datosAdicionales['fechaContrato'], $datosAdicionales['salario']);
            } elseif ($tipoUsuario == 'admin') {
                $this->modeloUs->actualizarAdmin($idUsuario, $datosAdicionales['estatus'], $datosAdicionales['observaciones'], $datosAdicionales['fechaAlta'],);
            }

            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }


    public function eliminarUsuario($idUsuario)
    {
        return $this->modeloUs->eliminarUsuarioConDatos($idUsuario);
    }
}
