<?php 

    include "../php/funciones.php";
    session_start(); 
    comprobarAdmin();

  ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Añadir cliente</title>
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
     <!-- Validación javascript de datos -->
    <script src="../js/validar_nuevo_cliente.js"></script>

  </head>
  <body>
    
    <!-- Menú de navegación-->
    <?php tipoMenu(); ?>

    <!-- Nuevo cliente -->
    <div class="container-fluid menu-inicio">
      <div class="row">
        <div class="col-xs-12 col-md-8 col-md-offset-2">
          <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h2 align="center">Nuevo cliente</h2>
              </div>
              <div class="panel-body">
                <form class="form-horizontal" action="#" method="post">
                  <div class="form-group">
                    <label class=" col-sm-2">ID:</label>
                    <div class="col-sm-10">
                      <?php 
                        $con = abrirConexion();
                        $consulta = "select auto_increment from information_schema.tables where table_schema='inmobiliaria' and table_name='clientes'";
                        $datos = mysqli_query($con, $consulta);
                        $array = mysqli_fetch_array($datos, MYSQLI_NUM);
                        echo "<td><input class='form-control' type='text' name='direccion' value = $array[0] readonly></td>";
                       ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class=" col-sm-2">Nombre:</label>
                    <div class="col-sm-10">
                      <input class="form-control" type="text" name="nom" id="nombre" autofocus><span></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2">Apellidos:</label>
                    <div class="col-sm-10">
                      <input class="form-control" type="text" name="ape" id="apellidos"><span></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2">Dirección:</label>
                    <div class="col-sm-10">
                      <input class="form-control" type="text" name="dir" id="direccion"><span></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2">Tlf 1:</label>
                    <div class="col-sm-10">
                      <input class="form-control" type="text" name="tel1" id="telefono1"><span></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2">Tlf 2:</label>
                    <div class="col-sm-10">
                      <input class="form-control" type="text" name="tel2" id="telefono2"><span></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2">Usuario:</label>
                    <div class="col-sm-10">
                      <input class="form-control" type="text" name="n_us" id="n_us"><span></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2">Constraseña:</label>
                    <div class="col-sm-10">
                      <input class="form-control" type="text" name="pass" id="pass"><span></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12 col-sm-offset-4">
                      <div class="col-sm-2">
                        <input class="form-control btn-primary" id="nuevo_cliente" type="submit" name="nuevo_cliente" value="Añadir">
                      </div>
                      <div class="col-sm-2">
                        <a href="./clientes.php" class="btn btn-danger">Cancelar</a>
                      </div>
                    </div>
                  </div> 
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Código PHP para añadir un nuevo cliente -->
    <?php 

        if (isset($_POST['cancelar'])) {
          header("url=/clientes.php");
        }

        if (isset($_POST['nuevo_cliente'])) {
          $nombre = $_POST['nom'];
          $apellidos = $_POST['ape'];
          $direccion = $_POST['dir'];
          $tel1 = $_POST['tel1'];
          $tel2 = $_POST['tel2'];
          $usuario = $_POST['n_us'];
          $password = $_POST['pass'];

          $password = md5(md5($password));

          $conexion = abrirConexion();

          $insertar = "insert into clientes (id,nombre,apellidos,direccion,telefono1,telefono2,nombre_usuario,pass) 
                values (null,'$nombre','$apellidos','$direccion','$tel1','$tel2','$usuario','$password')";

          if (mysqli_query($conexion,$insertar)) {
            echo "<div class='alert alert-success col-sm-6 col-sm-offset-3' align='center'>
                        <strong>Cliente añadido correctamente</strong> 
                      </div>";
            echo "<META HTTP-EQUIV='REFRESH'CONTENT='2;URL=clientes.php'>";
          } else {
            echo "<div class='container-fluid'><div class='row'><div class='alert alert-danger col-sm-6 col-sm-offset-3' align='center'>
                    <h4><strong>¡Error!</strong>No ha sido posible añadir el cliente</h4>
                  </div></div></div>";
            echo "<META HTTP-EQUIV='REFRESH'CONTENT='2;URL=clientes.php'>";
          }
        mysqli_close($conexion);
        }
     ?>
     
    <!-- footer -->
    <footer class="navbar-nav navbar-inverse footer-clientes">
      <p align="center">Estamos en Av. Doctor Oloriz, 6 (Granada) | Teléfono: 611622633 | Email: info@inmobiliaria.com</p>
    </footer>

  </body>
</html>