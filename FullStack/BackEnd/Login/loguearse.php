<?php

    session_start();
    if(isset($_POST['loguearse'])){
        require_once("LoginEmpleados.php");
        $credenciales = new LoginEmpleados();
        $credenciales->setPassword($_POST['password']);
        $credenciales->setEmail($_POST['email']);

        $login = $credenciales->login();

        if($login){
            header('Location:../Cotizaciones/cotizaciones.php');
        } else {
            echo "<script> alert('Password o Email Invalidos!'); document.location='loginRegister.php' </script>";
        }
    }
?>