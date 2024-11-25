<?php include '../includes/header.php'; ?> <!-- Incluir el encabezado común del proyecto -->
<?php include '../includes/menu.php'; ?> <!-- Incluir el menú común del proyecto -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Domicilios</title>
    <!-- Enlace al archivo CSS personalizado para estilos específicos -->
    <link rel="stylesheet" href="../static/css/consultas.css">
</head>
<body>
    <!-- Contenedor principal -->
    <div class="container">
        <div class="title">Consulta de Domicilios</div>
        <!-- Formulario para realizar la consulta -->
        <form method="POST" action="consultaDomicilios.php">
            <!-- Campo para ingresar la dirección -->
            <div class="form-group">
                <label for="direccion">Ingrese la dirección:</label>
                <input type="text" id="direccion" name="direccion" placeholder="Ejemplo: Calle 123" required>
            </div>
            <!-- Botón para enviar la consulta -->
            <button type="submit">Consultar</button>
        </form>

        <?php
        // Verificar si el formulario fue enviado mediante POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Incluir el controlador que maneja las consultas de usuarios
            require_once '../controllers/controladorUs.php';
            
            // Obtener el valor de la dirección ingresada en el formulario
            $direccion = $_POST['direccion'];

            // Instanciar el controlador para realizar la consulta
            $controlador = new UsController();
            $resultados = $controlador->obtenerUsuariosPorDireccion($direccion); // Llamar al método para obtener usuarios según dirección

            // Verificar si se encontraron resultados
            if (!empty($resultados)) {
                echo '<div class="result"><strong>Resultados encontrados:</strong>';
                // Recorrer y mostrar cada resultado encontrado
                foreach ($resultados as $usuario) {
                    echo '<div class="result-item">';
                    echo '<p><strong>Nombre:</strong> ' . htmlspecialchars($usuario['nombre']) . '</p>';
                    echo '<p><strong>Apellido:</strong> ' . htmlspecialchars($usuario['apellido']) . '</p>';
                    echo '<p><strong>Correo:</strong> ' . htmlspecialchars($usuario['correo']) . '</p>';
                    echo '<p><strong>Teléfono:</strong> ' . htmlspecialchars($usuario['telefono']) . '</p>';
                    echo '<p><strong>Tipo de usuario:</strong> ' . htmlspecialchars($usuario['tipoUsuario']) . '</p>';
                    echo '</div>';
                }
                echo '</div>';
            } else {
                // Mostrar mensaje si no se encontraron resultados
                echo '<div class="result">No se encontraron usuarios con la dirección ingresada.</div>';
            }
        }
        ?>
    </div>
</body>
</html>

<?php include '../includes/footer.php'; ?> <!-- Incluir el pie de página común del proyecto -->
