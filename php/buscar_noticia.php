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
    <title>Buscar noticias</title>
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

    <!-- Buscar noticia por titular -->
    <div class="container-fluid menu-inicio">
      <div class="row">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2">
          <div class="panel-group">
            <div class=" panel panel-default" action="#" method="post">
              <div class="panel-heading">
                <h2 align="center">Buscar noticias</h2>
              </div>
              <div class="panel-body">
                <p align="center">Rellene el campo para realizar la búsqueda</p>
                <form class="form-horizontal" action="#" method="post" accept-charset="utf-8">
                  <div class="form-group">
                  <label class=" col-sm-3">Titular de la noticia:</label>
                  <div class="col-sm-9">
                    <input class="form-control" type="text" id="titular" name="titular" autofocus> <span></span>
                  </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input id="buscar" class="form-control btn-primary" type="submit" name="buscar_not" value="Buscar" >
                    </div> 
                  </div>
                </form>
                <?php 
                  if (isset($_POST['buscar_not'])) {
                    $titular = $_POST['titular'];
                    
                    $conexion = abrirConexion();
                    $consulta = "select * from noticias where titular like '%$titular%'";

                    $busqueda = mysqli_query($conexion,$consulta);

                    if (!$busqueda) {
                      echo "No se han encontrado coincidencias...";
                    } else {
                      $num_filas = mysqli_num_rows($busqueda);
                      if ($num_filas == 0) {
                        echo "Sin coincidencias";
                      } else {
                        echo "Se listarán $num_filas noticias relacionadas..."; 
                        echo "<table class='table table-striped'>";
                        echo "<thead><tr><th>Titular</th><th>Fecha de publicación</th><th>Imagen</th><th>Ver</th></tr></thead>";
                        while ($fila = mysqli_fetch_array($busqueda,MYSQLI_ASSOC)) {
                          echo "<tbody><tr><td><strong>$fila[titular]</strong></td><td>$fila[fecha]</td><td><img src='$fila[imagen]' width='150px'></td>
                          <td><form action='ver_noticia.php' method='post'><input type='hidden' name='id' value='$fila[id]'><input class='form-control btn btn-info' type='submit' name='ver' value='Leer Más'></form></td></tr></tbody>";
                        }
                        echo "</table>";
                      }

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