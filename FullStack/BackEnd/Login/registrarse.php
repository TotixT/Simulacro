<?php
ini_set("display_errors", 1);

ini_set("display_startup_errors", 1);

error_reporting(E_ALL);

    if(isset($_POST['registrarse'])){
        require_once("RegistroEmpleado.php");
        $RegistroEmpleado = new RegistroEmpleado();
        $RegistroEmpleado-> setNombre($_POST['nombre']);
        $RegistroEmpleado-> setEmail($_POST['email']);
        $RegistroEmpleado-> setUsuario($_POST['usuario']);
        $RegistroEmpleado-> setPassword($_POST['password']);
        $RegistroEmpleado-> setDireccion($_POST['direccion']);
        $RegistroEmpleado-> setTelefono($_POST['telefono']);

        if($RegistroEmpleado->checkUser($_POST['email'])){
            echo "<script> alert('Usuario existente!'); document.location='loginRegister.php' </script>";
        } else {
            $RegistroEmpleado-> insertData();
            if($RegistroEmpleado){
                echo "<script> alert('User creado Satisfactoriamente Satisfactoriamente'); document.location='../Clientes/clientes.php' </script>";
            }
            
                
        }
        

    }
?>
