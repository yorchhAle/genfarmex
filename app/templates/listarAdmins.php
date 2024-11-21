<?php
require_once '../controllers/controladorUs.php';
$proveedorController = new UsController();
$clientes = $proveedorController->obtenerUsuariosA();
?>
<?php
session_start();
if (!isset($_SESSION['tipoUsuario']) || $_SESSION['tipoUsuario'] !== 'admin') {
    header("Location: inicioSesion.html");
    exit;
}
?>
<?php include '../includes/header.php'; ?> <!-- Incluir el encabezado -->

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Admins - Genfarmex</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../static/css/read.css">
</head>

<body>
    <?php include '../includes/menu.php'; ?> <!-- Incluir el menú -->

    <div class="container main-content">
        <h2>Lista de administradores</h2>

        <table class="table table-light tabla-descuentos">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Usuario</th>
                    <th>Contraseña</th>
                    <th>Correo</th>
                    <th>Telefono</th>
                    <th>Tipo</th>
                    <th>Actualizar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $clientes = (new UsController())->listarAdmins();
                foreach ($clientes as $cliente) {
                    echo "<tr>";
                    echo "<td>{$cliente['idusuario']}</td>";
                    echo "<td>{$cliente['nombre']}</td>";
                    echo "<td>{$cliente['apellido']}</td>";
                    echo "<td>{$cliente['usuario']}</td>";
                    echo "<td>{$cliente['pass']}</td>";
                    echo "<td>{$cliente['correo']}</td>";
                    echo "<td>{$cliente['telefono']}</td>";
                    echo "<td>{$cliente['tipoUsuario']}</td>";
                    echo "<td class='acciones'>";
                    echo "<a href='actualizarAdmis.php?id={$cliente['idusuario']}' class='btn actualizar' aria-label='Editar cliente'>Editar</a>";
                    echo "</td>";
                    echo "<td class='acciones'>";
                    echo "<a href='eliminarUsuario.php?id={$cliente['idusuario']}' 
                             class='btn eliminar' 
                             aria-label='Eliminar cliente' 
                             onclick='return confirmarEliminacion();'>Eliminar</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <button class="back-button" onclick="history.back()">Regresar</button>
    </div>

    <script>
        function confirmarEliminacion() {
            return confirm("¿Estás seguro de que deseas eliminar este usuario?");
        }
    </script>

</body>

</html>
<?php include '../includes/footer.php'; ?> <!-- Incluir el pie de página -->