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
    <title>Borrar noticias</title>
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
    <!-- Validación javascript -->
    <script src="../js/validar_buscar_noticia.js"></script>
  </head>
  <body>
    
    <!-- Menú de navegación -->
    <?php tipoMenu(); ?>

    <!-- Borrar noticia -->
    <div class="container-fluid menu-inicio">
      <div class="row">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2">
          <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h2 align="center">Borrar una noticia</h2>
              </div>
              <div class="panel-body">
                <p align="center">Seleccione el inmueble que desea borrar</p>

                <!-- Código PHP que muestra las noticias con la opción de borrar -->
                <?php 
                  $conexion = abrirConexion();
                  $consulta = "select id,titular from noticias";

                  $datos = mysqli_query($conexion,$consulta);

                  if (!$datos) {
                    echo "Error, no se han podido cargar los datos de las noticas";
                  } else {
                    echo "<div class='col-xs-12 col-sm-8 col-sm-offset-2'>";

                    echo "<table class='table table-striped'";
                    echo "<thead><tr><th>ID</th><th>Titular</th><th>¿Eliminar?</th></tr></thead>";
                    while ($fila = mysqli_fetch_array($datos,MYSQLI_ASSOC)) {
                      echo "<tbody><tr><td>$fila[id]</td><td>$fila[titular]</td>
                      <td><form action='#' method='post'><input type='hidden' name='id' value='$fila[id]'><input class='form-control btn btn-md btn-danger' type='submit' name='borrar' value='Eliminar'></form></td></tr></tbody>";
                    }
                    echo "</table>
                      <a align='center' href='./noticias.php' class='btn btn-danger'>Cancelar</a>
                    </div>";
                  }
                  mysqli_close($conexion);
                 ?>
                 <!-- Código PHP que borra la noticia -->
                 <?php 
                    if (isset($_POST['borrar'])) {
                      $id = $_POST['id'];
                      $conexion = abrirConexion();
                      $borrar = "delete from noticias where id='$id'";
                      if (mysqli_query($conexion,$borrar)) {
                       echo "<div class='alert alert-success col-sm-6 col-sm-offset-3' align='center'>
                            <strong>Noticia borrada correctamente</strong> 
                          </div>";
                        echo "<META HTTP-EQUIV='REFRESH'CONTENT='3;URL=noticias.php'>";
                      } else {
                        echo "<p>¡Error! No se ha podido borrar la noticia...</p>";
                        echo "<META HTTP-EQUIV='REFRESH'CONTENT='3;URL=noticias.php'>";
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