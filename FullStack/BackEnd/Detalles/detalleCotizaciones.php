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
    require_once("detallecotizacion.php");
    $data = new Detalle();
    $all = $data->selectAll();
    $Cotizacion = $data->selectCotizacion();
    //print_r($all);

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


  <link rel="stylesheet" type="text/css" href="../../FrontEnd/css/estilos.css">

</head>

<body>
  <div class="contenedor">

    <div class="parte-izquierda">

      <div class="perfil">
        <h3 style="margin-bottom: 2rem;">Detalle Cotizacion.</h3>
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
        <button class="btn-m" data-bs-toggle="modal" data-bs-target="#registrarDetalles"><i class="bi bi-person-add " style="color: rgb(255, 255, 255);" ></i></button>
      </div>
      <div class="menuTabla contenedor2">
        <table class="table table-custom ">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">PRODUCTO ALQUILADO</th>
              <th scope="col">FECHA</th>
              <th scope="col">HORA</th>
              <th scope="col">PRECIO X DIA</th>
              <th scope="col">TOTAL</th>
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
              <td><?php echo $val['Cotizacion_ID'] ?></td>
              <td><?php echo $val['Producto_Alquilado'] ?></td>
              <td><?php echo $val['Fecha_Alquiler'] ?></td>
              <td><?php echo $val['Hora_Alquiler'] ?></td>
              <td><?php echo $val['PrecioxDia'] ?></td>
              <td><?php echo $val['TotalCotizacion'] ?></td>
              <td>  
                <a class="btn btn-danger" href="borrardetalleCotizaciones.php?Detalle_ID=<?=$val['Detalle_ID']?>&req=delete">Borrar</a>
              </td>
              <td>
                <a class="btn btn-warning" href="editardetalleCotizaciones.php?Detalle_ID=<?=$val['Detalle_ID']?>">Editar</a>
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
    <div class="modal fade" id="registrarDetalles" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="backdrop-filter: blur(5px)">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" >
        <div class="modal-content" >
          <div class="modal-header" >
            <h1 class="modal-title fs-5" id="exampleModalLabel">Nueva Factura</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" style="background-color: rgb(231, 253, 246);">
            <form class="col d-flex flex-wrap" action="registrarDetalles.php" method="post">
              <div class="mb-1 col-12">
                <label for="idCotizacion" class="form-label">Id de la Cotizacion</label>
                <select id="idCotizacion" name="idCotizacion" class="form-control">
                  <!-- Metodo Cristian Luna = De la funcion que contiene ambas tablas de la DB, cuando se llaman
                            las divide y parte, seccionandolas en dos variables distintas, cada una conteniendo un dato especifico. -->
                          <?php 
                          foreach ($Cotizacion as $Coti){ 
                            $CotiId = $Coti['Cotizacion_ID'];  
                            $CotiVal = $Coti['Cotizacion_ID'];
                            ?>
                            <option value="<?php echo intval($CotiId) ?>"><?php echo $CotiVal?></option>
                            
                          <?php } ?>
                        </select>
              </div>

              <div class="mb-1 col-12">
                <label for="productoDetalle" class="form-label">Producto Alquilado</label>
                <input 
                  type="text"
                  id="productoDetalle"
                  name="productoDetalle"
                  class="form-control"  
                />
              </div>

              <div class="mb-1 col-12">
                <label for="fechaDetalle" class="form-label">Fecha</label>
                <input 
                  type="date"
                  id="fechaDetalle"
                  name="fechaDetalle"
                  class="form-control"  
                />
              </div>

              <div class="mb-1 col-12">
                <label for="horaDetalle" class="form-label">Hora</label>
                <input 
                  type="time"
                  id="horaDetalle"
                  name="horaDetalle"
                  class="form-control"  
                />
              </div>

              <div class="mb-1 col-12">
                <label for="precioxDia" class="form-label">Precio x Dia</label>
                <input 
                  type="text"
                  id="precioxDia"
                  name="precioxDia"
                  class="form-control"  
                />
              </div>

              <div class="mb-1 col-12">
                <label for="totalDetalle" class="form-label">Total</label>
                <input 
                  type="text"
                  id="totalDetalle"
                  name="totalDetalle"
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