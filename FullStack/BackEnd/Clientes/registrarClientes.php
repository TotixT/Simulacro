<?php
    if(isset($_POST['guardar'])){
        require_once("cliente.php");
        $categoria = new Cliente();
        $categoria-> setNombre_Cliente($_POST['nombreCliente']);
        $categoria-> setDireccion_Cliente($_POST['direccionCliente']);
        $categoria-> setTelefono_Cliente($_POST['telefonoCliente']);
        $categoria-> insertData();
        echo "<script> alert('Los datos fueron guardados Satisfactoriamente'); document.location='clientes.php' </script>";

    }
?>