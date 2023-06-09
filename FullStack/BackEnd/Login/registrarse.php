<?php
ini_set("display_errors", 1);

ini_set("display_startup_errors", 1);

error_reporting(E_ALL);

    if(isset($_POST['registrarse'])){
        require_once("RegistroEmpleados.php");
        $Empleados = new Empleado();
        $Empleados-> setUsuario($_POST['usuario']);
        $Empleados-> setPassword($_POST['password']);
        $Empleados-> setEmail($_POST['email']);
        if($Empleados->checkUser($_POST['email'])){
            echo "<script> alert('Usuario existente!'); document.location='loginRegister.php' </script>";
        } else {
            $Empleados-> insertData();
            echo "<script> alert('User creado Satisfactoriamente Satisfactoriamente'); document.location='Location:../Cotizaciones/cotizaciones.php' </script>";
        }
        

    }
?>
