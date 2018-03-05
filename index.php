<?php

  include "php/funciones.php";
  session_start(); 
  comprobarIndex();

?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aplicación Inmobiliaria</title>
    
    <!-- CSS de Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <!-- Mi CSS -->
    <link rel="stylesheet" href="css/mis-estilos.css" media="screen">
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
    <script src="js/bootstrap.min.js"></script>
  </head>
  <body>
    
    <!-- Menú de navegación -->
    <?php tipoMenuIndex(); ?>
    
    <!-- Muestro imagen de un inmueble aleatorio -->
    <div class="container-fluid ">
      <div class="row">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 menu-inicio">
          <h1 align="center">Encuentra tu nuevo hogar</h1>
          <?php 
            $conexion = abrirConexion();
            $coge_imagen = "select imagen from inmuebles";
            $imagenes = array();

            $imagen = mysqli_query($conexion,$coge_imagen);
            
            if (!$imagen) {
              echo "Se ha producido un error al cargar las imagenes";
            } else {
              while ($fila = mysqli_fetch_array($imagen,MYSQLI_ASSOC)) {
                array_push($imagenes,$fila['imagen']);
              }
            }
            mysqli_close($conexion);

            $max = count($imagenes) - 1;
            $azar = rand(0,$max);
            echo "<img src='./php/$imagenes[$azar]' class='img-rounded img-responsive' style='width:100%; align:center; border:solid 0.5px' > ";
          ?> 
        </div>
      </div>
    </div> 

    <!-- Noticias con paneles -->
    <div class="container-fluid pagina">
      <div class="row">
        <div class="col-xs-12">
          <h2 align="center">Últimas noticias</h2>
        </div>
        
          <?php 
              $con = abrirConexion();
              $sql = "select * from noticias order by fecha desc";

              $noticias = mysqli_query($con,$sql);

              if (!$noticias) {
                echo "Ups... Ha ocurrido un error al cargar las noticias :(";
              } else {
                for ($i = 0; $i < 3; $i++) {
                  $fila = mysqli_fetch_array($noticias,MYSQLI_ASSOC);
                  $marca_cita = strtotime($fila['fecha']);
                  $f_formateada = date("d-m-Y",$marca_cita);
                  echo "<div class='col-sm-4'>";
                  echo "<div class='panel panel-default'>";
                  echo "<div class='panel-body tnoticias'>";
                  //muestro info de noticia
                  echo "<img align'center' class='img-responsive' src='./php/$fila[imagen]'>
                        <h4 align='center'><b>$fila[titular]</b></h4>
                        <h5 align='center'>Fecha de publicación: $f_formateada</h5>
                        <form action='./php/ver_noticia.php' method='post'><input type='hidden' name='id' value='$fila[id]'><input class='form-control btn btn-info' type='submit' name='ver' value='Ver más'></form>"; 

                  echo "</div></div></div>"; //cierre de col-sm, panel,panel-body
                }
              }

              mysqli_close($con);
           ?>
        
      </div>
    </div>

    <!-- footer -->
    <footer class="navbar-nav navbar-inverse">
      <p align="center"><a class="aweb" href="../inmobiliaria/php/mapa_web.php">Mapa web</a> | Estamos en Av. Doctor Oloriz, 6 (Granada) | Teléfono: 611622633 | Email: info@inmobiliaria.com</p>
    </footer>
        
  </body>
</html>