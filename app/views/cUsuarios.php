<?php include '../includes/header.php'; ?> <!-- Incluir el encabezado común del proyecto -->

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuarios - Genfarmex</title>
    <link rel="stylesheet" href="../static/css/create.css">

    <script>
        function toggleAdditionalForm() {
            const tipoUsuario = document.getElementById("tipoUsuario").value;
            const additionalForms = document.querySelectorAll(".additional-form");

            // Ocultar todos los formularios adicionales y eliminar el atributo "required" de sus campos.
            additionalForms.forEach(form => {
                form.style.display = "none";
                form.querySelectorAll("input, select").forEach(input => {
                    input.removeAttribute("required");
                });
            });

            // Mostrar el formulario correspondiente y añadir el atributo "required" a sus campos.
            if (tipoUsuario) {
                const selectedForm = document.getElementById(tipoUsuario + "Form");
                if (selectedForm) {
                    selectedForm.style.display = "block";
                    selectedForm.querySelectorAll("input, select").forEach(input => {
                        input.setAttribute("required", "required");
                    });
                }
            }
        }
    </script>
</head>

<body>
    <?php include '../includes/menu.php'; ?> 
    <!-- Incluye el menú común para la navegación del sitio -->

    <div class="container">
        <div class="logo">
            <img src="../static/img/letrasAzules.png" alt="Genfarmex" class="logo-img">
            <!-- Logo de la empresa -->
        </div>

        <div class="login-box">
            <h2>Crear Usuario</h2>
            <form action="../templates/crearUsuario.php" method="POST" onsubmit="return validateForm()">
                <!-- Formulario principal de creación de usuarios -->

                <!-- Campos comunes para todos los tipos de usuarios -->
                <input type="text" name="nombre" placeholder="Nombre del usuario" required>
                <input type="text" name="app" placeholder="Apellidos" required>
                <input type="text" name="usuario" placeholder="Usuario" required>
                <input type="text" name="pass" placeholder="Contraseña asignada" required>
                <input type="email" name="email" placeholder="Email del usuario" required>
                <input type="tel" name="numeroT" placeholder="Número de teléfono" required pattern="[0-9]{10,15}" title="Ingrese un número de teléfono válido (10 a 15 dígitos)">
                <input type="text" name="direccion" placeholder="Dirección del usuario" required>

                <label for="tipoUsuario">Tipo de Usuario:</label>
                <select name="tipoUsuario" id="tipoUsuario" required onchange="toggleAdditionalForm()">
                    <!-- Selección del tipo de usuario -->
                    <option value="" disabled selected>Seleccione un tipo</option>
                    <option value="cliente">Cliente</option>
                    <option value="admin">Admin</option>
                    <option value="empleado">Empleado</option>
                </select>

                <!-- Formularios específicos según el tipo de usuario -->
                <div id="clienteForm" class="additional-form" style="display: none; margin-top: 15px;">
                    <h3>Crear Cliente</h3>
                    <input type="number" name="credito" placeholder="Crédito del cliente" required>
                    <label for="estatus">Actividad</label>
                    <select name="estatus" id="estatus" required>
                        <option value="" disabled selected>Seleccione un tipo de Actividad</option>
                        <option value="activo">Activo</option>
                        <option value="baja">Baja</option>
                    </select>
                    <input type="date" name="fechaCreacion" required>
                </div>

                <div id="empleadoForm" class="additional-form" style="display: none; margin-top: 15px;">
                    <h3>Crear Empleado</h3>
                    <input type="text" name="rol" placeholder="Puesto del empleado" required>
                    <input type="date" name="fechaContrato" placeholder="Fecha de contratación" required>
                    <input type="text" name="salario" placeholder="Salario" required>
                </div>

                <div id="adminForm" class="additional-form" style="display: none; margin-top: 15px;">
                    <h3>Crear Admin</h3>
                    <input type="date" name="fechaCreacion" required>
                    <label for="estatus">Actividad</label>
                    <select name="estatus" id="estatus" required>
                        <option value="" disabled selected>Seleccione un tipo de Actividad</option>
                        <option value="activo">Activo</option>
                        <option value="baja">Baja</option>
                    </select>
                    <input type="text" name="observaciones" placeholder="Observaciones" required>
                </div>

                <!-- Botones para enviar el formulario o regresar -->
                <button type="submit">Crear Usuario</button>
                <button class="back-button" onclick="history.back()">Regresar</button>
            </form>
        </div>
    </div>

    <!-- Incluye el pie de página común del sitio -->
</body>
<br>

</html>
<?php include '../includes/footer.php'; ?> 

