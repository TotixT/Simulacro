<?php
    if(isset($_POST['guardar'])){
        require_once("cotizacion.php");
        $categoria = new Cotizacion();
        $categoria-> setidEmpleados($_POST['idEmpleado']);
        $categoria-> setConstructora($_POST['constructora']);
        $categoria-> setFecha($_POST['fecha']);
        $categoria-> insertData();
        echo "<script> alert('Los datos fueron guardados Satisfactoriamente'); document.location='cotizaciones.php' </script>";

    }
?>