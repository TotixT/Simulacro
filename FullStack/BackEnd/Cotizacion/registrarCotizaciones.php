<?php
    if(isset($_POST['guardar'])){
        require_once("cotizacion.php");
        $cotizacion = new Cotizacion();
        $cotizacion-> setEmpleados_ID($_POST['idEmpleado']);
        $cotizacion-> setClientes_ID($_POST['idCliente']);
        $cotizacion-> setFecha($_POST['fechaCotizacion']);
        $cotizacion-> insertData();
        echo "<script> alert('Los datos fueron guardados Satisfactoriamente'); document.location='cotizaciones.php' </script>";

    }
?>