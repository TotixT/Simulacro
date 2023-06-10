<?php
    require_once("cotizacion.php");
    $record = new Cotizacion();
    if(isset($_GET['Cotizacion_ID']) && isset($_GET['req']) ){
        if($_GET['req'] == "delete"){
            $record->setCotizacion_ID($_GET['Cotizacion_ID']);
            $record->deleteData();
            echo "<script> alert('Los Datos Fueron Borrados Exitosamente'); document.location='cotizaciones.php' </script>";
        }
    }
?>