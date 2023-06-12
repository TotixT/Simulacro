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
  require_once("cotizacion.php");
  $data = new Cotizacion();
  $all = $data->selectAll();
  $Empleados = $data->selectEmpleados();
  $Clientes = $data->selectClientes();
  //print_r($all);
  //print_r($Empleados);
  //print_r($Clientes);
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Facturas</title>
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
        <h3 style="margin-bottom: 2rem;">Cotizacion.</h3>
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
        <h2>Cotizacion</h2>
        <button class="btn-m" data-bs-toggle="modal" data-bs-target="#registrarCotizaciones"><i class="bi bi-person-add " style="color: rgb(255, 255, 255);" ></i></button>
      </div>
      <div class="menuTabla contenedor2">
        <table class="table table-primary table-hover ">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">ID DEL EMPLEADO</th>
              <th scope="col">ID DEL CLIENTE</th>
              <th scope="col">FECHA</th>
              <th scope="col">ELIMINAR</th>
              <th scope="col">EDITAR</th>
              <th scope="col">DETALLES</th>
            </tr>
          </thead>
          <tbody class="" id="tabla">

            <!-- ///////Llenado DInamico desde la Base de Datos -->
            <?php
            foreach($all as $key=> $val){
            ?>
            <tr>
              <td><?php echo $val['Cotizacion_ID'] ?></td>
              <td><?php echo $val['Nombre'] ?></td>
              <td><?php echo $val['Nombre_Cliente'] ?></td>
              <td><?php echo $val['Fecha'] ?></td>
              <td>  
                <a class="btn btn-danger" href="borrarCotizaciones.php?Cotizacion_ID=<?=$val['Cotizacion_ID']?>&req=delete">Borrar</a>
              </td>
              <td>
                <a class="btn btn-warning" href="editarCotizaciones.php?Cotizacion_ID=<?=$val['Cotizacion_ID']?>">Editar</a>
              </td>
              <td>
                <a class="btn btn-primary" href="../Detalles/detalleCotizaciones.php?Cotizacion_ID=<?=$val['Cotizacion_ID']?>">Detalles</a>
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
      <h3>Detalle Cotizacion</h3>
      <p>Cargando...</p>
      <form method="POST">
        <input class="btn btn-danger" type="submit" name="LogOut" id="LogOut" value="Cerrar Sesion">
      </form>
       <!-- ///////Generando la grafica -->

    </div>





    <!-- /////////Modal de registro de nuevo estuiante //////////-->
    <div class="modal fade" id="registrarCotizaciones" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="backdrop-filter: blur(5px)">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" >
        <div class="modal-content" >
          <div class="modal-header" >
            <h1 class="modal-title fs-5" id="exampleModalLabel">Nueva Factura</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" style="background-color: rgb(231, 253, 246);">
            <form class="col d-flex flex-wrap" action="registrarCotizaciones.php" method="post">
              <div class="mb-1 col-12">
                <label for="idEmpleado" class="form-label">Id del Empleado</label>
                <select id="idEmpleado" name="idEmpleado" class="form-control">
                  <!-- Metodo Cristian Luna = De la funcion que contiene ambas tablas de la DB, cuando se llaman
                            las divide y parte, seccionandolas en dos variables distintas, cada una conteniendo un dato especifico. -->
                          <?php 
                          foreach ($Empleados as $nombre){ 
                            $nombreId = $nombre['Empleados_ID'];  
                            $nombreNombre = $nombre['Nombre'];
                            ?>
                            <option value="<?php echo intval($nombreId) ?>"><?php echo $nombreNombre?></option>
                            
                          <?php } ?>
                        </select>
              </div>

              <div class="mb-1 col-12">
                <label for="idCliente" class="form-label">Id del Cliente</label>
                <select id="idCliente" name="idCliente" class="form-control">
                  <!-- Metodo Santiago Lopez Garcia = De la funcion que contiene ambas tablas de la DB, cuando se llaman 
                          directamente se instancian sobre la funcion base que viene y en esa misma variable, 
                              se llama la tabla requerida-->
                <?php foreach ($Clientes as $key=> $Clientes){ ?>
                            <option value="<?php echo $Clientes["Clientes_ID"]?>"><?php echo $Clientes["Nombre_Cliente"]?></option>
                          <?php } ?>
                        </select>
              </div>

              <div class="mb-1 col-12">
                <label for="fechaCotizacion" class="form-label">Fecha</label>
                <input 
                  type="date"
                  id="fechaCotizacion"
                  name="fechaCotizacion"
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