<?php

    session_start();
    if(isset($_POST['loguearse'])){
        require_once("LoginEmpleado.php");
        $credenciales = new LoginEmpleado();
        $credenciales->setEmail($_POST['email']);
        $credenciales->setPassword($_POST['password']);

        $login = $credenciales->login();

        if($login){
            header('Location:../Clientes/clientes.php');
        } else {
            echo "<script> alert('Password o Email Invalidos!'); document.location='loginRegister.php' </script>";
        }
    }
?>