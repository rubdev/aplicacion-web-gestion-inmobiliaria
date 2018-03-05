<?php 
  include "../php/funciones.php";
  session_start();
  if ($_SESSION['tipo'] == 'u') {
   echo "<META HTTP-EQUIV='REFRESH'CONTENT='0;URL=../index.php'>";
  } else if ($_SESSION['tipo'] == 'a') {
    echo "<META HTTP-EQUIV='REFRESH'CONTENT='0;URL=../index.php'>";
  } else {

  }

  if (isset($_POST['acceder'])) {
    $usuario = $_POST['nick'];
    $pass = $_POST['password'];

    $md5 = md5(md5($pass));

    $con = abrirConexion();
    $sql = "select id, nombre, apellidos from clientes where nombre_usuario='$usuario' and pass='$md5'";

    $consulta = mysqli_query($con,$sql);

    if ($consulta) {
      if (mysqli_num_rows($consulta) > 0) {
        $fila = mysqli_fetch_array($consulta,MYSQLI_ASSOC);
        $_SESSION['id_usuario'] = $fila['id'];

        if ($usuario == 'admin') {
          $_SESSION['tipo'] = 'a';
          $_SESSION['nombre'] = 'Administrador';
        } else {
          $_SESSION['tipo'] = 'u';
          $_SESSION['nombre'] = $fila['nombre'].' '.$fila['apellidos'];
        }

        if (isset($_POST['check'])) {
          $datos = session_encode();
          setcookie('datos', $datos, time()+(15*24*60*60), '/');
        }

        echo "<div class='alert alert-success col-sm-6 col-sm-offset-3' align='center'>
                        <strong>¡Acceso correcto!</strong> 
                      </div>";

                echo "<META HTTP-EQUIV='REFRESH'CONTENT='1;URL=../index.php'>";

      } else {
        echo "<div class='container-fluid'><div class='row'><div class='alert alert-danger col-sm-6 col-sm-offset-3' align='center'>
                    <h4><strong>¡Error!</strong> Usuario o contraseña incorrectos</h4>
                  </div></div></div>";
      }
    } else {
      echo "<div class='container-fluid'><div class='row'><div class='alert alert-danger col-sm-6 col-sm-offset-3' align='center'>
                    <h4><strong>¡Error!</strong> Usuario o contraseña incorrectos</h4>
                  </div></div></div>";
    }

  }

 ?>
 <!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acceder</title>
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
    <!-- Documento php con funciones -->
    
  </head>
  <body>
    
    <!-- Menú de navegación -->
    <nav class='menu navbar navbar-inverse navbar-fixed-top texto'>
          <div class='container-fluid'>
            <div class='navbar-header'>
              <button type="button" class="n-resp navbar-toggle " data-toggle="collapse" data-target="#nav-responsive">
                <span class="icon-bar b-resp"></span>
                <span class="icon-bar b-resp"></span>
                <span class="icon-bar b-resp"></span>                        
              </button>
              <a href='../index.php'><img src='../logo.png' alt='inmobiliaria' width='20%'></a>
            </div>
            <div class="collapse navbar-collapse" id="nav-responsive">
            <ul class='nav navbar-nav navbar-right'>
              
              <li><a href='../php/inmuebles.php'><span class='glyphicon glyphicon-briefcase'></span> Inmuebles</a></li>
              <li><a href='../php/contacto.php'><span class='glyphicon glyphicon-envelope'></span> Contacto</a></li>
              <li class='active'><a href='http://localhost/inmobiliaria/php/acceder.php'><span class='glyphicon glyphicon-log-in'></span> Acceder</a></li>
            </ul>
            </div>
          </div>
    </nav>
    
    <!-- Formulario de acceso -->
    <div class='container-fluid cabecera-form-cli'>
      <div class='row'>
        <div class='col-sm-6 col-sm-offset-3'>
          <h2 align='center'>Acceder a la aplicación</h2>
          <div class='panel panel-default '>
            <div class='panel-body'>
              <form action="#" method="post" class="form-horizontal">
                <div class="form-group">
                  <label class="col-sm-3 col-sm-offset-2">Usuario</label>
                  <div class="col-sm-6">
                    <input class="form-control" type="text" name="nick">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 col-sm-offset-2">Contraseña</label>
                  <div class="col-sm-6">
                    <input class="form-control" type="password" name="password">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 col-sm-offset-2">¿Mantener sesión abierta?</label>
                  <div class="checkbox">
                  <input type="checkbox" value="open" name="check">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-9 col-sm-offset-2">
                    <input class="form-control btn-primary" type="submit" name="acceder" value="Acceder">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- footer -->
    <footer class="navbar-nav navbar-inverse">
      <p align="center"><a class="aweb" href="mapa_web.php">Mapa web</a> | Estamos en Av. Doctor Oloriz, 6 (Granada) | Teléfono: 611622633 | Email: info@inmobiliaria.com</p>
    </footer>
  </body>
</html>