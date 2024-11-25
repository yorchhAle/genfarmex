<?php include '../../src/config/database.php' ?>
<?php
header('Content-Type:application/xls');
header('Content-Disposition: attachment; filename=reporte.xls');

?>
<h1>Consultar usuarios</h1>
<table class="table table-striped table-dark">
    <thead>
        <tr>
            <td>ID</td>
            <td>USUARIO</td>
            <td>CONTRASEÑA</td>
        </tr>
    </thead>
    <?php   
    $consulta = "SELECT id, usuario,contrasena from usuarios;";
    $result = mysqli_query($conn, $consulta);
    while ($row = mysqli_fetch_array($result)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['usuario']; ?></td>
            <td><?php echo $row['contrasena']; ?></td>
        </tr>
    <?php } ?>
</table>