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
    <title>Inmuebles disponibles</title>
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

    <!-- Se muestran los inmuebles comprados por el usuario -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12 menu-inicio">
          <h2 align="center" style="margin-top: 50px;">Todos estos inmuebles están disponibles</h2>
          <?php 
            $id = $_SESSION['id_usuario'];
            $con = abrirConexion();
            $sql = "select * from inmuebles where id_cliente=0";
            $consulta = mysqli_query($con,$sql);

            if (!$consulta) {
              echo "Error al realizar la consulta";
            } else {
              $num_filas = mysqli_num_rows($consulta);
              if ($num_filas == 0) {
                echo "<div class='alert alert-warning warning-new col-sm-6 col-sm-offset-3' align='center'>
                        <h2>Ups... ahora mismo no tenemos ningún inmueble disponible :(</h2>
                      </div>";
              } else {
                while ($fila = mysqli_fetch_array($consulta,MYSQLI_ASSOC)) {
                  echo "<div class='col-sm-4'>";
                  echo "<div class='panel panel-default'>";
                  echo "<div class='panel-body tnoticias'>";
                  echo "<img class='img-responsive' src='$fila[imagen]'>
                        <h2>$fila[direccion]</h2>
                        <h4>$fila[precio] €</h4>
                        <form action='ver_inmueble.php' method='post'><input type='hidden' name='id' value='$fila[id]'><input class='form-control btn btn-info' type='submit' name='ver' value='Ver inmueble'></form>"; //info inmueble
                  echo "</div></div></div>"; //cierre de col-sm, panel,panel-body
                }

              }
            }
            mysqli_close($con);
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