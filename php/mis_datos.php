<?php 
    
    include "funciones.php";
    session_start(); 
    comprobarUsuario();

  ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mis datos personales</title>
    <!-- CSS de Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
    <!-- Mi CSS -->
    <link rel="stylesheet" href="../css/mis-estilos.css">
    <!-- librerías opcionales que activan el soporte de HTML5 para IE8 -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Librería jQuery requerida por los plugins de JavaScript -->
    <script src="http://code.jquery.com/jquery.js"></script>
 
    <!-- Todos los plugins JavaScript de Bootstrap (también puedes
         incluir archivos JavaScript individuales de los únicos
         plugins que utilices) -->
    <script src="../js/bootstrap.min.js"></script>
  </head>
  <body>
    
    <!-- Menú de navegación -->
    <?php tipoMenu(); ?>

    <!-- Se muestran los datos del usuario -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 menu-inicio">
          <h2 align="center" style="margin-top: 50px;">Estos son tus datos de cliente</h2>
          
            <p align="center"><b>Podrás modificar tu dirección, teléfono o contraseña</b></p>
            <?php 

              $id = $_SESSION['id_usuario'];
              //echo $id;

              $con = abrirConexion();
              $sql = "select * from clientes where id='$id'";

              $consulta = mysqli_query($con,$sql);

              if (!$consulta) {
                echo "Error al hacer la consulta en BD... :(";
              } else {
                $fila = mysqli_fetch_array($consulta,MYSQLI_ASSOC);
                $nom = $fila['nombre'];
                $ape = $fila['apellidos'];
                $dir = $fila['direccion'];
                $t1 = $fila['telefono1'];
                $t2 = $fila['telefono2'];
                $usu = $fila['nombre_usuario'];
                $pass = $fila['pass'];
              }

             ?>
              <form action="#" method="post" accept-charset="utf-8">
                <div class="panel panel-default">
                 <div class="panel-body">
                   <div class="form-group">
                      <div class="col-sm-2">
                        <label>Nombre</label>
                      </div>
                      <div class="col-sm-10">
                       <input class="form-control" type="text" name="nombre" value="<?php echo $nom; ?>" readonly>
                      </div>
                   </div>
                   <div class="form-group">
                      <div class="col-sm-2">
                        <label>Apellidos</label>
                      </div>
                      <div class="col-sm-10">
                       <input class="form-control" type="text" name="apellidos" value="<?php echo $ape; ?>" readonly>
                      </div>
                   </div>
                   <div class="form-group">
                      <div class="col-sm-2">
                        <label>Dirección</label>
                      </div>
                      <div class="col-sm-10">
                       <input class="form-control" type="text" name="direccion" value="<?php echo $dir; ?>">
                      </div>
                   </div>
                   <div class="form-group">
                      <div class="col-sm-2">
                        <label>Teléfono 1</label>
                      </div>
                      <div class="col-sm-10">
                       <input class="form-control" type="text" name="tel1" value="<?php echo $t1; ?>">
                      </div>
                   </div>
                   <div class="form-group">
                      <div class="col-sm-2">
                        <label>Teléfono 2</label>
                      </div>
                      <div class="col-sm-10">
                       <input class="form-control" type="text" name="tel2" value="<?php echo $t2; ?>">
                      </div>
                   </div>
                   <div class="form-group">
                      <div class="col-sm-2">
                        <label>Usuario</label>
                      </div>
                      <div class="col-sm-10">
                       <input class="form-control" type="text" name="usuario" value="<?php echo $usu; ?>" readonly>
                      </div>
                   </div>
                   <div class="form-group">
                      <div class="col-sm-2">
                        <label>Contraseña</label>
                      </div>
                      <div class="col-sm-10">
                       <input class="form-control" type="text" name="password" placeholder="Si desea cambiar su contraseña escriba una nueva aquí">
                      </div>
                   </div>
                   <div>
                     <br>.
                   </div>
                   <div class="form-group">
                    <div class="col-sm-12 col-sm-offset-4">
                      <div class="col-sm-2">
                        <input class="form-control btn-primary" type="submit" name="guardar" value="Guardar">
                      </div>
                      <div class="col-sm-2">
                        <a href="../index.php" class="btn btn-danger">Cancelar</a>
                      </div>
                    </div>
                  </div>
                 </div>
               </div>
              </form>
              
              <?php 

               if (isset($_POST['cancelar'])) {
                 echo "<META HTTP-EQUIV='REFRESH'CONTENT='0;URL=../mis_datos.php'>";
               }

               if (isset($_POST['guardar'])) {
                 
                if ($_POST['password'] == '') {
                  $direccion = $_POST['direccion'];
                  $telefono1 = $_POST['tel1'];
                  $telefono2 = $_POST['tel2'];

                  $con = abrirConexion();
                  $sql = "UPDATE clientes SET direccion='$direccion', telefono1='$telefono1', telefono2='$telefono2' WHERE id='$id'";

                  if (mysqli_query($con,$sql)) {
                    echo "<div class='alert alert-success col-sm-6 col-sm-offset-3' align='center'>
                        <b>Datos actualizados correctamente</b> 
                      </div>";

                    echo "<META HTTP-EQUIV='REFRESH'CONTENT='1;URL=mis_datos.php'>";
                  } else {
                    echo "<div class='container-fluid'><div class='row'><div class='alert alert-danger col-sm-6 col-sm-offset-3' align='center'>
                    <h4><strong>¡Error!</strong> No se han podido actualizar los datos</h4>
                  </div></div></div>";
                  }

                } else {
                  $direccion = $_POST['direccion'];
                  $telefono1 = $_POST['tel1'];
                  $telefono2 = $_POST['tel2'];
                  $password = $_POST['password'];
                  
                  $password = md5(md5($password));

                  $con = abrirConexion();
                  $sql = "UPDATE clientes SET direccion='$direccion', telefono1='$telefono1', telefono2='$telefono2', pass='$password' WHERE id='$id'";

                  if (mysqli_query($con,$sql)) {
                    echo "<div class='alert alert-success col-sm-6 col-sm-offset-3' align='center'>
                        <b>Datos actualizados correctamente</b> 
                      </div>";

                    echo "<META HTTP-EQUIV='REFRESH'CONTENT='1;URL=mis_datos.php'>";
                  } else {
                    echo "<div class='container-fluid'><div class='row'><div class='alert alert-danger col-sm-6 col-sm-offset-3' align='center'>
                    <h4><strong>¡Error!</strong> No se han podido actualizar los datos</h4>
                  </div></div></div>";
                  }
                }

               }

               ?>

        </div>
      </div>
    </div>

    <!-- footer -->
    <footer class="navbar-nav navbar-inverse">
      <p align="center">Estamos en Av. Doctor Oloriz, 6 (Granada) | Teléfono: 611622633 | Email: info@inmobiliaria.com</p>
    </footer>
  </body>
</html>