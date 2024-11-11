<?php
require_once '../controllers/controladorProveedor.php';
$proveedorController = new ProveedorController();

if (isset($_GET['id'])) {
    $idProveedor = $_GET['id'];
    $proveedor = null;

    // Obtener datos del proveedor específico
    foreach ($proveedorController->obtenerProveedores() as $prov) {
        if ($prov['idproveedores'] == $idProveedor) {
            $proveedor = $prov;
            break;
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = $_POST['nombre'];
        $contacto = $_POST['contacto'];
        $telefono = $_POST['telefono'];
        $email = $_POST['correo'];
        $direccion = $_POST['direccion'];

        // Llamar al controlador para actualizar el proveedor
        $proveedorController->actualizarProveedor($idProveedor, $nombre, $contacto, $telefono, $email, $direccion);

        // Redireccionar después de actualizar
        header("Location: actualizarProveedor.php");
        exit;
    }
} else {
    echo "ID de proveedor no especificado.";
    exit;
}
?>
<?php include '../includes/header.php'; ?> <!-- Incluir el encabezado -->

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Proveedor</title>
    
    <link rel="stylesheet" href="../static/css/update.css">
</head>

<body>
    <?php include '../includes/menu.php'; ?> <!-- Incluir el menú -->
    <h2>Actualizar Proveedor</h2>

    <div class="form-container">
        <?php if ($proveedor): ?>
            <form method="POST" action="">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" value="<?php echo $proveedor['nombreP']; ?>" required>

                <label for="contacto">Contacto:</label>
                <input type="text" name="contacto" id="contacto" value="<?php echo $proveedor['contactoP']; ?>" required>

                <label for="telefono">Teléfono:</label>
                <input type="text" name="telefono" id="telefono" value="<?php echo $proveedor['telefonoP']; ?>" required>

                <label for="correo">Correo Electrónico:</label>
                <input type="text" name="correo" id="correo" value="<?php echo $proveedor['correoP']; ?>" required>

                <label for="direccion">Dirección:</label>
                <input type="text" name="direccion" id="direccion" value="<?php echo $proveedor['direccionP']; ?>" required>

                <button type="submit" class="btn-submit">Actualizar Proveedor</button>
                
            </form>
        <?php else: ?>
            <p>No se encontró el proveedor.</p>
        <?php endif; ?>
    </div>
</body>

</html>
<?php include '../includes/footer.php'; ?> <!-- Incluir el pie de página -->