<?php
require_once '../controllers/controladorUs.php';
$proveedorController = new UsController();
$clientes = $proveedorController->obtenerUsuarioC();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Proveedores - Genfarmex</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../static/css/proveedores.css">
    <link rel="stylesheet" href="../static/css/header-footer.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <header>
        <div class="logo">
            <img src="../static/images/logo.png" alt="Genfarmex Logo">
            <h1>Genfarmex</h1>
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Buscar...">
            <button>🔍</button>
        </div>
        <button class="logout-button">Cerrar sesión</button>
    </header>

    <div class="main-content">
        <h2>Lista de clientes</h2>

        <table class="table-light">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Usuario</th>
                    <th>Tipo</th>
                    <!-- Campos adicionales -->
                    <th>Credito</th>
                    <th>Puesto</th>
                    <th>Observaciones</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $usuarios = (new UsController())->listarUsuarios();
                foreach ($usuarios as $usuario) {
                    echo "<tr>";
                    echo "<td>{$usuario['idusuario']}</td>";
                    echo "<td>{$usuario['nombre']}</td>";
                    echo "<td>{$usuario['apellido']}</td>";
                    echo "<td>{$usuario['usuario']}</td>";
                    echo "<td>{$usuario['tipoUsuario']}</td>";
                    // Mostrar campos adicionales según el tipo de usuario
                    echo "<td>" . ($usuario['credito'] ?? '-') . "</td>";
                    echo "<td>" . ($usuario['puesto'] ?? '-') . "</td>";
                    echo "<td>" . ($usuario['observaciones'] ?? '-') . "</td>";
                    echo "<td><a href='editarUsuario.php?id={$usuario['idusuario']}'>Editar</a> | <a href='eliminarUsuario.php?id={$usuario['idusuario']}'>Eliminar</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <button onclick="window.location.href='../views/cProveedores.html'" class="back-button">Regresar</button>
    </div>

    <footer>
        <p>Copyright © 2022 Genfarmex - Todos los derechos reservados.</p>
        <a href="aviso_privacidad.php">Aviso de Privacidad</a>
    </footer>
</body>

</html>