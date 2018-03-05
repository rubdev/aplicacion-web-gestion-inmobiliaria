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
    <title>Mis citas</title>
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
          <h2 align="center" style="margin-top: 50px;">Echa un vistazo a tus citas</h2>
          <p align="center"><b>Tus próximas citas aparecen marcadas en <span style="color:green">verde</span> y la pasadas en <span style="color:#baa35f">amarillo</span></b></p>
          <div class="col-xs-12 col-sm-8 col-sm-offset-2">
            <?php 
              
              $actual = date('Y-m-d');
              $marca_actual = strtotime($actual); 

              $id_cliente = $_SESSION['id_usuario'];
              $con = abrirConexion();
              $sql = "select * from citas where id_cliente='$id_cliente' order by fecha desc";

              $consulta = mysqli_query($con,$sql);

              if (!$consulta) {
                echo "Error al realizar la consulta sql...";
              } else {
                $num_filas = mysqli_num_rows($consulta);

                if ($num_filas == 0) {
                  echo "<div class='alert alert-warning warning-new col-sm-6 col-sm-offset-3' align='center'>
                        <h2>No tienes ninguna cita programada</h2>
                      </div>";
                } else {
                  echo "<div class='table-responsive'>";
                  echo "<table class='table table-hover'>";
                  echo "<thead><tr><th>Fecha</th><th>Hora</th><th>Motivo</th><th>Lugar</th></tr></thead>";
                  echo "<tbody>";
                  while ($fila = mysqli_fetch_array($consulta,MYSQLI_ASSOC)) {
                    $marca_cita = strtotime($fila['fecha']);
                    $marca_hora = strtotime($fila['hora']);
                    $f_formateada = date("d-m-Y",$marca_cita);
                    $h_formateada = date("G:i",$marca_hora);
                    if ($marca_cita >= $marca_actual ) { // en verde (son las futuras citas)
                      echo "<tr class='success'><td>$f_formateada</td><td>$h_formateada</td><td>$fila[motivo]</td><td>$fila[lugar]</td></tr>";
                    } else { // en amarillo (son las citas ya pasadas)
                      echo "<tr class='warning'><td>$f_formateada</td><td>$h_formateada</td><td>$fila[motivo]</td><td>$fila[lugar]</td></tr>";
                    }
                  }
                  echo "</tbody>";
                  echo "</table></div>"; //responsive, table-hover 
                }
              }
              mysqli_close($con);
             ?>
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