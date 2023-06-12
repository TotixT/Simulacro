<?php
  require_once("../Login/LoginEmpleado.php");
  session_start();

  if(isset($_POST['LogOut'])){
    unset($_SESSION['Empleados_ID']);
    unset($_SESSION['Usuario']);
    header('Location:../Login/loginRegister.php');
  }
  if(!$_SESSION['Usuario']){
    header('Location:../Login/loginRegister.php');
  }
  require_once("cliente.php");
  $data = new Cliente();
  $all = $data->selectAll();

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Clientes</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">


  <link rel="stylesheet" type="text/css" href="../../FrontEnd/css/styles.css">

</head>

<body>
  <div class="contenedor">

    <div class="parte-izquierda">

      <div class="perfil">
        <h3 style="margin-bottom: 2rem;">Clientes.</h3>
        <img src="../images/Diseño sin título.png" alt="" class="imagenPerfil">
        <h3><?php echo $_SESSION['Usuario']?></h3>
      </div>
      <div class="menus">
        <a href="../Clientes/clientes.php" style="display: flex;gap:1px;">
          <i class="bi bi-people"></i>
          <h3 style="margin: 0px;font-weight: 800;">Clientes</h3>
        </a>
        <a href="../Empleados/empleados.php" style="display: flex;gap:1px;">
          <i class="bi bi-people"></i>
          <h3 style="margin: 0px;font-weight: 800;">Empleados</h3>
        </a>
        <a href="../Cotizacion/cotizaciones.php" style="display: flex;gap:1px;">
          <i class="bi bi-people"></i>
          <h3 style="margin: 0px;font-weight: 800;">Cotizaciones</h3>
        </a>
        <a href="../Detalles/detalleCotizaciones.php" style="display: flex;gap:1px;">
          <i class="bi bi-people"></i>
          <h3 style="margin: 0px;font-weight: 800;">Detalle</h3>
        </a>
       


      </div>
    </div>

    <div class="parte-media">
      <div style="display: flex; justify-content: space-between;">
        <h2>Cliente</h2>
        <button class="btn-m" data-bs-toggle="modal" data-bs-target="#registrarClientes"><i class="bi bi-person-add " style="color: rgb(255, 255, 255);" ></i></button>
      </div>
      <div class="menuTabla contenedor2">
        <table class="table table-primary table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">NOMBRE CLIENTE</th>
              <th scope="col">DIRECCION CLIENTE</th>
              <th scope="col">TELEFONO CLIENTE</th>
              <th scope="col">ELIMINAR</th>
              <th scope="col">EDITAR</th>
            </tr>
          </thead>
          <tbody class="" id="tabla">

            <!-- ///////Llenado DInamico desde la Base de Datos -->
            <?php
            foreach($all as $key=> $val){
            ?>
            <tr>
              <td><?php echo $val['Clientes_ID'] ?></td>
              <td><?php echo $val['Nombre_Cliente'] ?></td>
              <td><?php echo $val['Direccion_Cliente'] ?></td>
              <td><?php echo $val['Telefono_Cliente'] ?></td>
              <td>  
                <a class="btn btn-danger" href="borrarClientes.php?Clientes_ID=<?=$val['Clientes_ID']?>&req=delete">Borrar</a>
              </td>
              <td>
                <a class="btn btn-warning" href="editarClientes.php?Clientes_ID=<?=$val['Clientes_ID']?>">Editar</a>
              </td>
            </tr>
          </tbody>
        <?php
            }
            ?>
        </table>

      </div>


    </div>

    <div class="parte-derecho " id="detalles">
      <h3>Detalle Clientes</h3>
      <p>Cargando...</p>
      <form method="POST">
        <input class="btn btn-danger" type="submit" name="LogOut" id="LogOut" value="Cerrar Sesion">
      </form>
       <!-- ///////Generando la grafica -->

    </div>





    <!-- /////////Modal de registro de nuevo estuiante //////////-->
    <div class="modal fade" id="registrarClientes" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="backdrop-filter: blur(5px)">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" >
        <div class="modal-content" >
          <div class="modal-header" >
            <h1 class="modal-title fs-5" id="exampleModalLabel">Nuev@ Cliente</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" style="background-color: rgb(231, 253, 246);">
            <form class="col d-flex flex-wrap" action="registrarClientes.php" method="post">
              <div class="mb-1 col-12">
                <label for="nombreCliente" class="form-label">Nombre Cliente</label>
                <input 
                  type="text"
                  id="nombreCliente"
                  name="nombreCliente"
                  class="form-control"  
                />
              </div>

              <div class="mb-1 col-12">
                <label for="direccionCliente" class="form-label">Direccion Cliente</label>
                <input 
                  type="text"
                  id="direccionCliente"
                  name="direccionCliente"
                  class="form-control"  
                />
              </div>

              <div class="mb-1 col-12">
                <label for="telefonoCliente" class="form-label">Telefono Cliente</label>
                <input 
                  type="number"
                  id="telefonoCliente"
                  name="telefonoCliente"
                  class="form-control"  
                />
              </div>

              <div class=" col-12 m-2">
                <input type="submit" class="btn btn-primary" value="Guardar" name="guardar"/>
              </div>
            </form>  
         </div>       
        </div>
      </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
      crossorigin="anonymous"></script>


</body>

</html>