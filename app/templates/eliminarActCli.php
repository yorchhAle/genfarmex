<?php
require_once '../controllers/controladorUs.php';
$proveedorController = new UsController();
$clientes = $proveedorController->obtenerUsuarioC();
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
    <title>Lista de clientes - Genfarmex</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../static/css/read.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</head>

<body>
    <?php include '../includes/menu.php'; ?> <!-- Incluir el menú -->

    <div class="container">
        <h2>Lista de Clientes</h2>

        <table class="table table-light tabla-descuentos">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Usuario</th>
                    <th>Contraseña</th>
                    <th>Tipo</th>
                    <th>Credito</th>
                    <th>Actividad</th>
                    <th>Actualizar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $clientes = (new UsController())->listarClientes();
                ?>
            <tbody>
                <?php
                foreach ($clientes as $cliente) {
                    echo "<tr>";
                    echo "<td>{$cliente['idusuario']}</td>";
                    echo "<td>{$cliente['nombre']}</td>";
                    echo "<td>{$cliente['apellido']}</td>";
                    echo "<td>{$cliente['usuario']}</td>";
                    echo "<td>{$cliente['pass']}</td>";
                    echo "<td>{$cliente['tipoUsuario']}</td>";
                    echo "<td>{$cliente['creditoC']}</td>";
                    echo "<td>{$cliente['estatus_cliente']}</td>";
                    echo "<td class='acciones'>";
                    echo "<a href='actualizarClientes.php?id={$cliente['idusuario']}' class='btn actualizar'>Editar</a>";
                    echo "</td>";
                    echo "<td class='acciones'>";
                    echo "<a href='eliminarUsuario.php?id={$cliente['idusuario']}' class='btn eliminar'>Eliminar</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>

            </tbody>
        </table>

        <button class="back-button" onclick="history.back()">Regresar</button>
    </div>

</body>

</html>
<?php include '../includes/footer.php'; ?> <!-- Incluir el pie de página -->