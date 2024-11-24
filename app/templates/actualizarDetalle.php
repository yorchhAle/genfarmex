<?php
    require_once '../models/modeloDetPed.php';

    $modeloDetallePedido = new ModeloDetPed();


    $id = $_POST['id'];
    $canti = $_POST['cantidad'];
    $idProd = $_POST['idProd'];
    if($modeloDetallePedido->actualizarDetPed($id,$canti, $idProd)){

    }else{

    }   
?>