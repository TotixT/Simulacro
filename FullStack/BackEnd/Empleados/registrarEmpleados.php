<?php
    if(isset($_POST['guardar'])){
        require_once("empleado.php");
        $empleado = new Empleado();
        $empleado-> setNombre($_POST['nombreEmpleado']);
        $empleado-> setEmail($_POST['email']);
        $empleado-> setUsuario($_POST['usuario']);
        $empleado-> setPassword($_POST['password']);
        $empleado-> setDireccion($_POST['direccion']);
        $empleado-> setTelefono($_POST['telefono']);
        $empleado-> insertData();
        echo "<script> alert('Los datos fueron guardados Satisfactoriamente'); document.location='empleados.php' </script>";

    }
?>