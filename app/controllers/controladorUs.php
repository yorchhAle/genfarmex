<?php
// Se incluye el modelo que maneja la interacción con la base de datos.
require_once '../models/modeloUs.php';

class UsController
{
    private $modeloUs;

    // Constructor que inicializa el objeto modeloUs para acceder a los métodos de la clase ModeloUs.
    public function __construct()
    {
        $this->modeloUs = new ModeloUs(); // Instancia del modelo para realizar operaciones de base de datos.
    }

    // Método para crear un nuevo usuario.
    public function crearUsuario($nombre, $apellido, $usuario, $pass, $correo, $telefono, $direccion, $tipoUsuario, $datosAdicionales)
    {
        // Verifica si el correo ya está registrado en la base de datos.
        $usuarioPorCorreo = $this->modeloUs->obtenerUsuarioPorCorreo($correo);
        if ($usuarioPorCorreo) {
            // Si el correo está registrado, se muestra un mensaje de alerta y se redirige al formulario de usuarios.
            echo "<script>alert('El correo ya está registrado.'); window.location.href='../views/cUsuarios.php';</script>";
            return false;
        }

        // Verifica si el teléfono ya está registrado.
        $usuarioPorTelefono = $this->modeloUs->obtenerUsuarioPorTelefono($telefono);
        if ($usuarioPorTelefono) {
            // Si el teléfono está registrado, se muestra un mensaje de alerta y se redirige al formulario de usuarios.
            echo "<script>alert('El número de teléfono ya está registrado.'); window.location.href='../views/cUsuarios.php';</script>";
            return false;
        }

        // Si no hay duplicados, se crea el usuario principal.
        $idUsuario = $this->modeloUs->crearUs($nombre, $apellido, $usuario, $pass, $correo, $telefono, $direccion, $tipoUsuario);
        if (!$idUsuario) {
            // Si ocurre un error al crear el usuario principal, se muestra un mensaje de error.
            echo "Error: User creation failed.";
            return false;
        } else {
            echo "ID de usuario creado: " . $idUsuario; // Muestra el ID del usuario recién creado.
        }

        // Si el usuario se crea correctamente, se insertan los datos adicionales según el tipo de usuario.
        if ($idUsuario) {
            if ($tipoUsuario == 'cliente') {
                // Inserta los datos específicos de un cliente.
                $credito = $datosAdicionales['credito'];
                $estatus = $datosAdicionales['estatus'];
                $fechaCreacion = $datosAdicionales['fechaCreacion'];
                return $this->modeloUs->crearCliente($idUsuario, $credito, $estatus, $fechaCreacion);
            } elseif ($tipoUsuario == 'empleado') {
                // Inserta los datos específicos de un empleado.
                $puesto = $datosAdicionales['rol'];
                $fechaContrato = $datosAdicionales['fechaContrato'];
                $salario = $datosAdicionales['salario'];
                return $this->modeloUs->crearEmpleado($idUsuario, $puesto, $fechaContrato, $salario);
            } elseif ($tipoUsuario == 'admin') {
                // Inserta los datos específicos de un administrador.
                $fechaContrato = $datosAdicionales['fechaCreacion'];
                $estatus = $datosAdicionales['estatus'];
                $observaciones = $datosAdicionales['observaciones'];
                return $this->modeloUs->crearAdmin($idUsuario, $fechaContrato, $estatus, $observaciones);
            }
        } else {
            // Si ocurre un error al crear el usuario, se muestra un mensaje de error.
            echo "Error al crear el usuario principal.";
            return false; // Error en la creación del usuario
        }
    }

    // Método para listar todos los clientes.
    public function listarClientes()
    {
        // Obtiene todos los usuarios con sus datos adicionales y filtra solo los clientes.
        $usuarios = $this->modeloUs->obtenerUsuariosConDatosAdicionales();
        return array_filter($usuarios, function ($usuario) {
            return strtolower($usuario['tipoUsuario']) === 'cliente'; // Filtra por tipo de usuario.
        });
    }

    // Método para listar todos los administradores.
    public function listarAdmins()
    {
        // Obtiene todos los usuarios con sus datos adicionales y filtra solo los administradores.
        $usuarios = $this->modeloUs->obtenerUsuariosConDatosAdicionales();
        return array_filter($usuarios, function ($usuario) {
            return strtolower($usuario['tipoUsuario']) == 'admin'; // Filtra por tipo de usuario.
        });
    }

    // Método para listar todos los empleados.
    public function listarEmpleados()
    {
        // Obtiene los empleados con sus datos adicionales.
        return $this->modeloUs->obtenerEmpleadosConDatos();
    }

    // Método para obtener los detalles de un cliente por su ID de usuario.
    public function obtenerClienteConUsuario($idUsuario)
    {
        return $this->modeloUs->obtenerClienteConUsuario($idUsuario);
    }

    // Método para obtener los detalles de un administrador por su ID de usuario.
    public function obtenerAdminConUsuario($idUsuario)
    {
        return $this->modeloUs->obtenerAdminConUsuario($idUsuario);
    }

    // Método para obtener un usuario por su nombre de usuario.
    public function obtenerUsuarioPorNombre($usuario)
    {
        return $this->modeloUs->obtenerUsuarioPorNombre($usuario);
    }

    // Método para obtener todos los usuarios de tipo cliente.
    public function obtenerUsuarioC()
    {
        return $this->modeloUs->obtenerUsuariosC();
    }

    // Método para obtener todos los usuarios de tipo administrador.
    public function obtenerUsuariosA()
    {
        return $this->modeloUs->obtenerUsuariosA();
    }

    // Método para obtener un usuario específico por su ID.
    public function obtenerUsuarios($idUsuario)
    {
        return $this->modeloUs->obtenerUsuarioPorID($idUsuario);
    }

    // Método para listar los clientes según su estatus.
    public function listarClientesPorEstatus($estatus)
    {
        return $this->modeloUs->obtenerClientesPorEstatus($estatus);
    }

    // Método para actualizar un usuario existente.
    public function actualizarUsuario($idUsuario, $nombre, $apellido, $usuario, $email, $telefono, $direccion, $tipoUsuario, $datosAdicionales)
    {
        try {
            // Actualiza los datos principales del usuario.
            $this->modeloUs->actualizarUsuario($idUsuario, $nombre, $apellido, $usuario, $email, $telefono, $direccion, $tipoUsuario);

            // Actualiza los datos adicionales según el tipo de usuario.
            if ($tipoUsuario == 'cliente') {
                $this->modeloUs->actualizarCliente($idUsuario, $datosAdicionales['credito'], $datosAdicionales['estatus']);
            } elseif ($tipoUsuario == 'empleado') {
                $this->modeloUs->actualizarEmpleado($idUsuario, $datosAdicionales['puesto'], $datosAdicionales['fechaContrato'], $datosAdicionales['salario']);
            } elseif ($tipoUsuario == 'admin') {
                $this->modeloUs->actualizarAdmin($idUsuario, $datosAdicionales['estatus'], $datosAdicionales['observaciones'], $datosAdicionales['fechaAlta']);
            }

            return true;
        } catch (Exception $e) {
            // Captura cualquier excepción y la vuelve a lanzar.
            throw $e;
        }
    }

    // Método para eliminar un usuario junto con sus datos relacionados.
    public function eliminarUsuario($idUsuario)
    {
        return $this->modeloUs->eliminarUsuarioConDatos($idUsuario);
    }

    // Método para obtener usuarios que viven en una dirección específica.
    public function obtenerUsuariosPorDireccion($direccion)
    {
        return $this->modeloUs->obtenerUsuariosPorDireccion($direccion);
    }
}
?>
