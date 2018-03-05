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
    <title>Citas</title>
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
    <!-- Menú con las funciones de admin -->
    <div class="container-fluid menu-inicio">
      <div class="row">
        <div class="col-xs-12">
          <nav class="navbar ">
            <div class="container-fluid">
              <ul class="nav navbar-nav navbar-center margen-cont" align="center">
                <li><a type="button" class="btn btn-primary btn-md" href="nueva_cita.php">Añadir cita</a></li>
                <li><a type="button" class="btn btn-primary btn-md" href="borrar_citas.php">Borrar citas</a></li>
                <li><a type="button" class="btn btn-primary btn-md" href="buscar_citas.php">Buscar citas</a></li>
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </div>
      

     
    <!-- Muestro calendario y muestro las citas y opción de modificar -->
    <div class="container-fluid">
      <div class="row">
      
        <!-- Citas y Modificar -->
        <div class="col-xs-12 col-md-6">
          <h2 class="margen-citas" align="center">Próximas citas</h2>
          <?php 

            $actual = date('Y-m-d');
            $marca_actual = strtotime($actual); 

            $conexion = abrirConexion();
            $sql = "select citas.id,citas.fecha,citas.hora,citas.motivo,citas.lugar, clientes.nombre,clientes.telefono1 
                    from citas inner join clientes
                    on citas.id_cliente = clientes.id
                    order by fecha desc";

            $mostrar = mysqli_query($conexion,$sql);

            if (!$mostrar) {
              echo "Error al hacer la consulta a la BD";
            } else {
              $num_filas = mysqli_num_rows($mostrar);
              if ($num_filas == 0) {
                echo "No hay citas para mostrar";
              } else {
                echo "<p align='center'><b>Se han listado $num_filas citas</b></p>";
                echo "<div class='table-responsive'>";
                echo "<table class='table table-striped table-hover'";
                echo "<thead><tr><th>Fecha</th><th>Hora</th><th>Motivo</th><th>Lugar</th><th>Cliente</th><th>Teléfono</th><th>Modificar</th></tr></thead>";
                while ($fila = mysqli_fetch_array($mostrar,MYSQLI_ASSOC)) {
                  $marca_cita = strtotime($fila['fecha']);
                  $marca_hora = strtotime($fila['hora']);
                  $f_formateada = date("d-m-Y",$marca_cita);
                  $h_formateada = date("G:i",$marca_hora);

                  if ($marca_cita > $marca_actual) {
                    echo "<tbody><tr class='success'><td>$f_formateada</td><td>$h_formateada</td><td>$fila[motivo]</td><td>$fila[lugar]</td><td>$fila[nombre]</td><td>$fila[telefono1]</td>
                      <td><form action='modificar_cita.php' method='post'><input type='hidden' name='id' value='$fila[id]'><input class='form-control btn btn-md btn-primary' type='submit' name='modificar' value='Modificar'></form></td></tr></tbody>";
                  } else {
                    echo "<tbody><tr class='warning'><td>$f_formateada</td><td>$h_formateada</td><td>$fila[motivo]</td><td>$fila[lugar]</td><td>$fila[nombre]</td><td>$fila[telefono1]</td><td>No se puede modificar</td></tr></tbody>";
                  }

                  
                }
                echo "</table></div>";
              }

            }
           ?>
           <!-- Script que ejecuta el popover del ojo para ver las citas de ese día -->
           <script>
              $(document).ready(function(){
                  $('[data-toggle="popover"]').popover();   
              });
            </script>
        </div>

         <!-- Calendario -->
          <div class="col-xs-12 col-md-6">
            <h2 class="margen-citas" align="center">Calendario</h2>
            
            <!-- PHP que muestra el calendario del mes pedido -->
            <?php 
              if(isset($_GET['mes']))
              {
                $dia = "01";
                $mes = $_GET['mes'];
                if($mes == 0)
                {
                  $mes = 12;
                  $anio = $_GET['anio']-1;
                }
                elseif($mes == 13)
                {
                  $mes=1;
                  $anio = $_GET['anio']+1;
                }
                else
                  $anio = $_GET['anio'];
              }
              else
              {
                $mes = date('m');
                $anio = date('Y');
                $dia = date('d');
              }
              if($mes < 10) $mes = "0$mes";
            mostrarCalendario($dia, $mes, $anio);?>

          </div>

      </div>
    </div>

    <!-- footer -->
    <footer class="navbar-nav navbar-inverse">
      <p align="center"><a class="aweb" href="../inmobiliaria/php/mapa_web.php">Mapa web</a> | Estamos en Av. Doctor Oloriz, 6 (Granada) | Teléfono: 611622633 | Email: info@inmobiliaria.com</p>
    </footer>
  </body>
</html>