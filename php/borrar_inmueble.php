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
    <title>Borrar inmuebles</title>
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

    <!-- Borrar inmueble -->
    <div class="container-fluid menu-inicio">
      <div class="row">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2">
          <div class="panel-group">
            <div class="panel-default">
              <div class="panel panel-heading">
                <h2 align="center">Borrar un inmueble</h2>
              </div>
              <div class="panel panel-body">
                <p align="center">Seleccione el inmueble que desea borrar</p>
                <!-- Código PHP que muestra inmubles con las opción de borrar -->
                <?php 
                  $conexion = abrirConexion();
                  $consulta = "select id,direccion,imagen from inmuebles";

                  $datos = mysqli_query($conexion,$consulta);

                  if (!$datos) {
                    echo "Error, no se han podido cargar datos de los inmuebles";
                  } else {
                     echo "<div class='col-xs-12 col-md-8 col-md-offset-2'>";
                     echo "<div class='table-responsive'>";
                     echo "<table class='table table-striped'";
                     echo "<thead><tr><th>Dirección</th><th>Imagen</th><th>¿Eliminar?</th></tr></thead>";
                    while ($fila = mysqli_fetch_array($datos,MYSQLI_ASSOC)) {
                       echo "<tbody><tr><td>$fila[direccion]</td><td><img src='$fila[imagen]' style='width:150px'></td>
                        <td><form action='#' method='post'><input type='hidden' name='id' value='$fila[id]'><input class='form-control btn btn-md btn-danger' type='submit' name='borrar' value='Eliminar'></form></td></tr></tbody>";
                    } 
                    echo "</div></table></div>";
                  }
                  mysqli_close($conexion);
                 ?>
                 <!-- Código PHP que borra el inmueble -->
                 <?php 
                    if (isset($_POST['borrar'])) {
                      $id = $_POST['id'];

                      $conexion = abrirConexion();
                      $img = "select imagen from inmuebles where id='$id'";

                      $url = mysqli_query($conexion,$img);

                      // compruebo si tengo la ruta de la imagen del inmueble
                      if (!$url) {
                        echo "Error al consulta la ruta de la imagen en la BD";
                      } else {
                        $fila = mysqli_fetch_array($url,MYSQLI_ASSOC);
                        echo $fila['imagen'];
                        // elimino la imagen del servidor
                        if (!unlink($fila['imagen'])) {
                          echo "No se ha podido borrar la imagen del servidor";
                        } else {
                          echo "Imagen del inmueble borrada del servidor correctamente...";
                        }
                      }

                      // una vez borrada la imagen del server procedo a borrar el inmueble de la BD
                      $borrado = "delete from inmuebles where id='$id'";

                      $borrar = mysqli_query($conexion,$borrado);

                      if ($borrar) {
                        echo "<div class='alert alert-success col-sm-6 col-sm-offset-3' align='center'>
                            <strong>Inmueble borrado correctamente</strong> 
                          </div>";
                        echo "<META HTTP-EQUIV='REFRESH'CONTENT='3;URL=inmuebles.php'>";
                      } else {
                        echo "Error al eliminar el inmueble, se le redirigirá a la página de inmuebles...";
                        echo "<META HTTP-EQUIV='REFRESH'CONTENT='3;URL=inmuebles.php'>";
                      }

                      mysqli_close($conexion);
                    }
                  ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- footer -->
    <footer class="navbar-nav navbar-inverse">
      <p align="center">Estamos en Av. Doctor Oloriz, 6 (Granada) | Teléfono: 611622633 | Email: info@inmobiliaria.com</p>
    </footer>
  </body>
</html>