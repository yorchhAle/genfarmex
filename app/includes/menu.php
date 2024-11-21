<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../static/css/menu.css">
</head>

<body>
    <button class="open-btn" onclick="toggleMenu()">☰ </button>

    <!-- Menú Lateral -->
    <div class="menuLateral" id="sidebar">
        <button class="close-btn" onclick="toggleMenu()">×</button>
        <ul>
            <li><a href="../templates/gestionesPanel.php">Gestiones</a></li>
            <li><a href="../templates/reportesPanel.php">Generar reportes</a></li>
            <li><a href="#">Generar consultas</a></li>
            <li><a href="../templates/panel.php">Generar respaldo de BD</a></li>
            <li><a href="../templates/panel.php">Ir al panel principal</a></li>
        </ul>
    </div>
</body>
<script src="../static/js/abrirMenu.js"></script>
</html>
