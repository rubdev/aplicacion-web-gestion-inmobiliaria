<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Noticias</title>
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
    <?php include "../php/funciones.php"; ?>
  </head>
  <body>
    
    <!-- Menú de navegación -->
    <nav class='menu navbar navbar-inverse'>
          <div class='container-fluid'>
            <div class='navbar-header'>
              
              <img src="../logo.png" alt="inmobiliaria" width="20%">
            </div>
            <ul class='nav navbar-nav'>
              <li><a href='../index.php'><span class='glyphicon glyphicon-home'></span> Inicio</a></li>
              <li class="active"><a href='../php/noticias.php'><span class='glyphicon glyphicon-bullhorn'></span> Noticias</a></li>
              <li><a href='../php/clientes.php'><span class='glyphicon glyphicon-user'></span> Clientes</a></li>
              <li><a href='../php/inmuebles.php'><span class='glyphicon glyphicon-briefcase'></span> Inmuebles</a></li>
              <li ><a href='../php/citas.php'><span class='glyphicon glyphicon-calendar'></span> Citas</a></li>
              <li><a href='#'><span class='glyphicon glyphicon-envelope'></span> Contacto</a></li>
            </ul>
            <ul class='nav navbar-nav navbar-right'>
              <li><a href='#'><span class='glyphicon glyphicon-log-in'></span> Acceder</a></li>
            </ul>
          </div>
    </nav>

    <!-- Recojo los datos de la noticia -->
    <?php 
      if (isset($_POST['ver'])) {
        $id = $_POST['id'];
        $conexion = abrirConexion();
        $consulta = "select * from noticias where id='$id'";
        $noticia = mysqli_query($conexion,$consulta);

        if (!$noticia) {
          echo "¡Error! No se ha podido acceder a la noticia :(";
        } else {
          while ($fila = mysqli_fetch_array($noticia, MYSQLI_ASSOC)) {
            $titular = $fila['titular'];
            $contenido = $fila['contenido'];
            $imagen = $fila['imagen'];
            $fecha = $fila['fecha'];
          }
        }
        mysqli_close($conexion);
      }
     ?>
    
    <!-- Muestro la noticia -->
    <div class="container-fluid cabecera-noticia">
      <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
          <center><img src="<?php echo $imagen; ?>" img-align="center" width="60%"></center>
          <div class="contenido-noticia">
            <h1><b><?php echo $titular; ?></b></h1>
                <p align="justify"><?php echo $contenido; ?></p>
                <p><b>Fecha de publicación: </b><?php echo $fecha; ?></p>
                <a class="btn btn-info" href="./noticias.php">Volver a <b>noticias</b></a>
          </div>
        </div>
      </div>
    </div>
    
    <!-- footer -->
    <footer class="navbar-nav navbar-inverse footer-noticia">
      <p align="center">Estamos en Av. Doctor Oloriz, 6 (Granada) | Teléfono: 611622633 | Email: info@inmobiliaria.com</p>
    </footer>
  </body>
</html>