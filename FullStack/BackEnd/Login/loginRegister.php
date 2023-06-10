<?php
  require_once("RegistroEmpleado.php");
  $data = new RegistroEmpleado();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <!-- Typografia -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400;600&display=swap" rel="stylesheet">
    <!-- boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- css -->
    <link rel="stylesheet" href="login.css">

</head>
<body>
    <div class="container-m">
        <div class="section1">
         <div class="d-flex justify-content-center align-items-center">
            <img src="img/LogoConstruct.jpg" alt="" class="logo"></div>
            <div class="d-flex justify-content-center align-items-center"><h1 style="font-weight: 800;">BIENVENIDOS</h1></div>
            <div  class="d-flex justify-content-center align-items-center" >
                <form action="loguearse.php" method="POST">
                    <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                        <input 
                          type="text"
                          id="email"
                          name="email"
                          class="form-control"  
                        />
                    </div>
                    <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                        <input 
                          type="password"
                          id="password"
                          name="password"
                          class="form-control"  
                        />
                    </div>
                 
                    <input type="submit" class="btn btn-primary" value="Loguearse" name="loguearse"/>
                  </form>
                  

            </div>      
        </div>
        <div class="section2" id="section2">
             <div class="d-flex justify-content-star " >
                <h1 style="font-weight: 800;font-size:larger;"> Nuevo Registro</h1></div>
          
                
             <div  class="d-flex justify-content-center align-items-center" >
                
                <form action="registrarse.php" method="POST">
                    <h1 class="m-3" style="font-weight: 800;">REGISTRAR USUARIO</h1>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input 
                          type="text"
                          id="nombre"
                          name="nombre"
                          class="form-control"  
                        />
                    </div>
                    <div class="mb-3">
                    <label for="email" class="form-label">Registro Email</label>
                        <input 
                          type="text"
                          id="email"
                          name="email"
                          class="form-control"  
                        />
                    </div>
                    <div class="mb-3">
                        <label for="usuario" class="form-label">Usuario</label>
                        <input 
                          type="text"
                          id="usuario"
                          name="usuario"
                          class="form-control"  
                        />
                    </div>
                    <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                        <input 
                          type="password"
                          id="password"
                          name="password"
                          class="form-control"  
                        />
                    </div>
                    <div class="mb-3">
                        <label for="direccion" class="form-label">Direccion</label>
                        <input 
                          type="text"
                          id="direccion"
                          name="direccion"
                          class="form-control"  
                        />
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Telefono</label>
                        <input 
                          type="text"
                          id="telefono"
                          name="telefono"
                          class="form-control"  
                        />
                    </div>
                    <input type="submit" class="btn btn-primary" value="Registrarse" name="registrarse"/>
                  </form>
      </div>

      <!-- Boostrap -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
     
    
</body>
</html>