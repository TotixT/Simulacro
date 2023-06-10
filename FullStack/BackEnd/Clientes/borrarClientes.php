<?php
    require_once("cliente.php");
    $record = new Cliente();
    if(isset($_GET['Clientes_ID']) && isset($_GET['req']) ){
        if($_GET['req'] == "delete"){
            $record->setClientes_ID($_GET['Clientes_ID']);
            $record->deleteData();
            echo "<script> alert('Los Datos Fueron Borrados Exitosamente'); document.location='clientes.php' </script>";
        }
    }
?>