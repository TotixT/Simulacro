<?php
    if(isset($_POST['guardar'])){
        require_once("detalleCotizacion.php");
        $Detalle = new Detalle();
        $Detalle-> setCotizacion_ID($_POST['idCotizacion']);
        $Detalle-> setProducto_Alquilado($_POST['productoDetalle']);
        $Detalle-> setFecha_Alquiler($_POST['fechaDetalle']);
        $Detalle-> setHora_Alquiler($_POST['horaDetalle']);
        $Detalle-> setPrecioxDia($_POST['precioxDia']);
        $Detalle-> setTotalCotizacion($_POST['totalDetalle']);
        $Detalle-> insertData();
        echo "<script> alert('Los datos fueron guardados Satisfactoriamente'); document.location='detallecotizaciones.php' </script>";

    }
?>