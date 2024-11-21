<?php include '../../src/config/database.php' ?>
<?php
header('Content-Type:application/xls');
header('Content-Disposition: attachment; filename=reporte.xls');

?>
<h1>Consultar servicios y Precios</h1>
<table class="table table-striped table-dark">
    <thead>
        <tr>
            <td>ID</td>
            <td>SERVICIO</td>
            <td>COSTO</td>
        </tr>
    </thead>
    <?php
    $consulta = "SELECT *FROM servicios;";
    $result = mysqli_query($conn, $consulta);
    while ($row = mysqli_fetch_array($result)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['nombre']; ?></td>
            <td><?php echo $row['precio']; ?></td>
        </tr>
    <?php } ?>
</table>