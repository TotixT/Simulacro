<?php
    require_once("detallecotizacion.php");
    $record = new Detalle();
    if(isset($_GET['Detalle_ID']) && isset($_GET['req']) ){
        if($_GET['req'] == "delete"){
            $record->setDetalle_ID($_GET['Detalle_ID']);
            $record->deleteData();
            echo "<script> alert('Los Datos Fueron Borrados Exitosamente'); document.location='detallecotizaciones.php' </script>";
        }
    }
?>