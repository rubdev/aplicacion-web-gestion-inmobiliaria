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
    <title>Buscar citas</title>
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
    
    <!--MEnú de navegación-->
    <?php tipoMenu(); ?>
    
    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12 col-md-8 col-md-offset-2 cabecera-form">
          <div class="panel-group menu-inicio">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h2 align="center">Buscar citas</h2>
              </div>
              <div class="panel-body">
                <p align="center">Rellene el campo o campos por los que quiere realizar la búsqueda</p>
                  <form class="form-horizontal" action="#" method="post" accept-charset="utf-8">
                  <div class="form-group">
                    <label class=" col-sm-3 ">Fecha:</label>
                    <div class="col-sm-7">
                      <input class="form-control" type="date" name="fecha" autofocus>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4">Nombre del cliente:</label>
                    <select class="form-control" name="id_cliente">
                        <?php 
                          $conexion = abrirConexion();
                          $consulta = "select id, nombre, apellidos from clientes";
                          $clientes = mysqli_query($conexion,$consulta);
                          
                          if (!$clientes) {
                            echo "Error al ajecutar la consulta";
                          } else {
                            echo "<option></option>";
                            while ($fila = mysqli_fetch_array($clientes,MYSQLI_ASSOC)) {
                              if ($fila['nombre'] != "disponible") {
                                echo "<option value=$fila[id]>$fila[nombre]</option>";
                              }
                              
                            }
                          }                     
                          mysqli_close($conexion);
                        ?>
                    </select>
                  </div>
                  
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input class="form-control btn-primary" type="submit" name="buscar_cita" value="Buscar">
                    </div> 
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- PHP que busca citas en la BD -->
    <?php 

      if (isset($_POST['buscar_cita'])) {

        $fecha = $_POST['fecha'];
        $id_cliente = $_POST['id_cliente'];

        if ($fecha == "") {
          if ($id_cliente == "") {
            // No se realiza ninguna búsqueda porque no ha seleccionado nada
            echo "No ha seleccionado ningún criterio de búsqueda, vuelva a intentarlo";
          } else {
            // Aquí busco solo por el id del cliente
            $conexion = abrirConexion();
            $sql_id = "select * from citas where id_cliente='$id_cliente' order by fecha asc";

            $busca_cliente = mysqli_query($conexion,$sql_id);

            if (!$busca_cliente) {
              echo "Error al conectar BD-1";
            } else {
              $num_filas = mysqli_num_rows($busca_cliente);

              if ($num_filas == 0) {
                echo "No se han encontrado citas";
              } else {
                echo "<table class='table table-striped'>";
                echo "<thead><tr><th>Fecha</th><th>Hora</th><th>Motivo</th><th>Lugar</th></tr></thead>";
                while ($fila = mysqli_fetch_array($busca_cliente,MYSQLI_ASSOC)) {
                  echo "<tbody><tr><td>$fila[fecha]</td><td>$fila[hora]</td><td>$fila[motivo]</td><td>$fila[lugar]</td></tr></tbody>";
                }
                echo "</table>";
              }
            }
            mysqli_close($conexion);
          }
        } else {
          echo $fecha;
          if ($id_cliente == "") {
            // aqui busco solo por la fecha
            $conexion = abrirConexion();
            $sql_fecha = "select * from citas where fecha='$fecha'";

            $busca_fecha = mysqli_query($conexion,$sql_fecha);

            if (!$busca_fecha) {
              echo "Error al conectar BD-2";
            } else {
              $num_filas = mysqli_num_rows($busca_fecha);

              if ($num_filas == 0) {
                echo "No se han encontrado citas";
              } else {
                echo "<table class='table table-striped'>";
                echo "<thead><tr><th>Fecha</th><th>Hora</th><th>Motivo</th><th>Lugar</th></tr></thead>";
                while ($fila = mysqli_fetch_array($busca_fecha,MYSQLI_ASSOC)) {
                  echo "<tbody><tr><td>$fila[fecha]</td><td>$fila[hora]</td><td>$fila[motivo]</td><td>$fila[lugar]</td></tr></tbody>";
                }
                echo "</table>";
              }
            }
            mysqli_close($conexion);

          } else {
            // Aquí busco por FECHA y CLIENTE
            $conexion = abrirConexion();
            $sql_fe_cli = "select * from citas where fecha='$fecha' and id_cliente='$id_cliente'";

            $busca_fe_cli = mysqli_query($conexion,$sql_fe_cli);

            if (!$busca_fe_cli) {
              echo "Error al conectar BD-3";
            } else {
              $num_filas = mysqli_num_rows($busca_fe_cli);

              if ($num_filas == 0) {
                echo "No se han encontrado citas";
              } else {
                echo "<table class='table table-striped'>";
                echo "<thead><tr><th>Fecha</th><th>Hora</th><th>Motivo</th><th>Lugar</th></tr></thead>";
                while ($fila = mysqli_fetch_array($busca_fe_cli,MYSQLI_ASSOC)) {
                echo "<tbody><tr><td>$fila[fecha]</td><td>$fila[hora]</td><td>$fila[motivo]</td><td>$fila[lugar]</td></tr></tbody>";
                }
                 echo "</table>";
              }
            }
          }
          
        } 
      }

     ?>

    <!-- footer -->
    <footer class="navbar-nav navbar-inverse">
      <p align="center">Estamos en Av. Doctor Oloriz, 6 (Granada) | Teléfono: 611622633 | Email: info@inmobiliaria.com</p>
    </footer>
  </body>
</html>