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
            <li><a href="../templates/carrito.php">Ver carrito</a></li>
            <li><a href="../templates/catalogo.php">Ver catalogo</a></li>

        </ul>
    </div>
</body>
<script src="../static/js/abrirMenu.js"></script>
</html>
