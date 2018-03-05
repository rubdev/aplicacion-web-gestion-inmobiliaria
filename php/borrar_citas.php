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
    <title>Borrar citas</title>
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
    <?php tipoMenu() ?>

    <!-- Borrar citas -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 cabecera-form">
          <div class="panel-group menu-inicio">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h2 align="center">Borrar una cita</h2>
              </div>
              <div class="panel-body">
                <p align="center">Seleccione la cita que desea borrar</p>

                <!-- Código PHP que muestra las noticias con la opción de borrar -->
                <?php 
                  //fecha actual para controlar que no se borra una cita ya pasada
                  $fecha_actual = date('Y-m-d');
  
                  $conexion = abrirConexion();
                  $consulta = "select * from citas where fecha >= '$fecha_actual' order by fecha asc";

                  $datos = mysqli_query($conexion,$consulta);

                  if (!$datos) {
                    echo "Error, no se han podido cargar los datos de las citas";
                  } else {
                    echo "<div class='col-xs-12 col-sm-8 col-sm-offset-2'>";
                    echo "<div class='table-responsive'>";
                    echo "<table class='table table-striped'";
                    echo "<thead><tr><th>Fecha</th><th>Hora</th><th>Motivo</th><th>Lugar</th><th>Cliente</th><th>¿Eliminar?</th></tr></thead>";
                    while ($fila = mysqli_fetch_array($datos,MYSQLI_ASSOC)) {
                      if ($fila['fecha'] >= $fecha_actual) {
                        
                      }
                      echo "<tbody><tr><td>$fila[fecha]</td><td>$fila[hora]</td><td>$fila[motivo]</td><td>$fila[lugar]</td><td>$fila[id_cliente]</td>
                      <td><form action='#' method='post'><input type='hidden' name='id' value='$fila[id]'><input class='form-control btn btn-md btn-danger' type='submit' name='borrar' value='Eliminar'></form></td></tr></tbody>";
                    }
                    echo "</table></div></div>";
                  }
                  mysqli_close($conexion);
                 ?>

                 <!-- Código PHP que borra la cita -->
                 <?php 
                    if (isset($_POST['borrar'])) {
                      $id = $_POST['id'];
                      $conexion = abrirConexion();
                      $borrar = "delete from citas where id='$id'";
                      if (mysqli_query($conexion,$borrar)) {
                        echo "<div class='alert alert-success col-sm-6 col-sm-offset-3' align='center'>
                            <strong>Cita borrada correctamente</strong> 
                          </div>";
                        echo "<META HTTP-EQUIV='REFRESH'CONTENT='3;URL=citas.php'>";
                      } else {
                        echo "<p>¡Error! No se ha podido borrar la cita...</p>";
                        echo "<META HTTP-EQUIV='REFRESH'CONTENT='3;URL=citas.php'>";
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