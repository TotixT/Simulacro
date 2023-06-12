<?php
    require_once("../Login/LoginEmpleado.php");
    session_start();
    if(!$_SESSION['Usuario']){
      header('Location:../Login/loginRegister.php');
    }
    require_once("detallecotizacion.php");
    $data = new Detalle();
    $Detalle_ID = $_GET['Detalle_ID'];
    $data->setDetalle_ID($Detalle_ID);
    $record = $data->selectOne();
    $Cotizacion2 = $data->selectCotizacion();
    $val = $record[0];
    //print_r($val);
    //print_r($Cotizacion2);

    if(isset($_POST['editar'])){
        $data->setCotizacion_ID($_POST['idsCoti']);
        $data->setProducto_Alquilado($_POST['productoDet']);
        $data->setFecha_Alquiler($_POST['fechaDet']);
        $data->setHora_Alquiler($_POST['horaDet']);
        $data->setPrecioxDia($_POST['precioDet']);
        $data->setTotalCotizacion($_POST['totalDet']);

        $data->update();
        //print_r($data);
        echo "<script> alert('Los Datos fueron Actualizados Exitosamente'); document.location='detalleCotizaciones.php' </script>";
    }
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Actualizar Facturas</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css%22%3E">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">


  <link rel="stylesheet" type="text/css" href="../../FrontEnd/css/styles.css">

</head>

<body>
  <div class="contenedor">

    <div class="parte-izquierda">

      <div class="perfil">
        <h3 style="margin-bottom: 2rem;">Campus Skiller.</h3>
        <img src="../images/Diseño sin título.png" alt="" class="imagenPerfil">
        <h3 ><?php echo $_SESSION['Usuario']?></h3>
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
        <h2 class="m-2">Detalle a Editar</h2>
      <div class="menuTabla contenedor2">
      <form class="col d-flex flex-wrap" action=""  method="post">
              <div class="mb-1 col-11">
                <label for="idsCoti" class="form-label">ID Cotizacion</label>
                <select id="idsCoti" name="idsCoti" class="form-control">
                <option value="">Seleccione la ID del Detalle</option>
                <!-- Metodo Cristian Luna -->
                          <?php foreach ($Cotizacion2 as $Coti2){ 
                            $Coti2Id = $Coti2['Cotizacion_ID'];  
                            $Coti2Val = $Coti2['Cotizacion_ID'];
                            ?>
                            <option value="<?php echo $Coti2Id?>"><?php echo $Coti2Val?></option>
                          <?php } ?>
                        </select>
              </div>

              <div class="mb-1 col-11">
                <label for="productoDet" class="form-label">Producto Alquilado</label>
                <input 
                  type="text"
                  id="productoDet"
                  name="productoDet"
                  class="form-control"
                  value="<?php echo $val["Producto_Alquilado"] ?>"

                />
              </div>

              <div class="mb-1 col-11">
                <label for="fechaDet" class="form-label">Fecha Alquiler</label>
                <input 
                  type="date"
                  id="fechaDet"
                  name="fechaDet"
                  class="form-control"
                  value="<?php echo $val["Fecha_Alquiler"] ?>"

                />
              </div>

              <div class="mb-1 col-11">
                <label for="horaDet" class="form-label">Hora Alquiler</label>
                <input 
                  type="time"
                  id="horaDet"
                  name="horaDet"
                  class="form-control"
                  value="<?php echo $val["Hora_Alquiler"] ?>"

                />
              </div>

              <div class="mb-1 col-11">
                <label for="precioDet" class="form-label">Precio x Dia</label>
                <input 
                  type="text"
                  id="precioDet"
                  name="precioDet"
                  class="form-control"
                  value="<?php echo $val["PrecioxDia"] ?>"

                />
              </div>

              <div class="mb-1 col-11">
                <label for="totalDet" class="form-label">Total Cotizacion</label>
                <input 
                  type="text"
                  id="totalDet"
                  name="totalDet"
                  class="form-control"
                  value="<?php echo $val["TotalCotizacion"] ?>"

                />
              </div>


              <div class=" col-12 m-2">
                <input type="submit" class="btn btn-primary" value="UPDATE" name="editar"/>
              </div>
            </form>
        <div id="charts1" class="charts"> </div>
      </div>
    </div>
<div class="parte-derecho " id="detalles">
      <h3>Detalle Detalles</h3>
      <p>Cargando...</p>
       <!-- ///////Generando la grafica -->

    </div>

  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>




</body>

</html>