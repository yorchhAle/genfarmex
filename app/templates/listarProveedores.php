<?php
require_once '../controllers/controladorProveedor.php';
$proveedorController = new ProveedorController();
$proveedores = $proveedorController->obtenerProveedores();
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
        <h2>Lista de Proveedores</h2>

        <table class="table-light">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Contacto</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Dirección</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($proveedores as $proveedor): ?>
                    <tr>
                        <td><?php echo $proveedor['idproveedores']; ?></td>
                        <td><?php echo $proveedor['nombreP']; ?></td>
                        <td><?php echo $proveedor['contactoP']; ?></td>
                        <td><?php echo $proveedor['telefonoP']; ?></td>
                        <td><?php echo $proveedor['correoP']; ?></td>
                        <td><?php echo $proveedor['direccionP']; ?></td>
                        <td class="actions">
                            <a href='eliminarProveedor.php?id=<?php echo $proveedor['idproveedores']; ?>'>Eliminar</a> |
                            <a href='actualizarProveedor.php?id=<?php echo $proveedor['idproveedores']; ?>'>Actualizar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
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