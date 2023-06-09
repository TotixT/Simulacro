<?php
    require_once("cotizacion.php");
    $record = new Cotizacion();
    if(isset($_GET['idCotizacion']) && isset($_GET['req']) ){
        if($_GET['req'] == "delete"){
            $record->setidCotizacion($_GET['idCotizacion']);
            $record->deleteData();
            echo "<script> alert('Los Datos Fueron Borrados Exitosamente'); document.location='cotizaciones.php' </script>";
        }
    }
?>