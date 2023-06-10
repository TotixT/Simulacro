<?php
    require_once("empleado.php");
    $record = new Empleado();
    if(isset($_GET['Empleados_ID']) && isset($_GET['req']) ){
        if($_GET['req'] == "delete"){
            $record->setEmpleados_ID($_GET['Empleados_ID']);
            $record->deleteData();
            echo "<script> alert('Los Datos Fueron Borrados Exitosamente'); document.location='empleados.php' </script>";
        }
    }
?>