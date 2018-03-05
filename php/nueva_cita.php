<?php 

    include "../php/funciones.php";
    session_start(); 
    comprobarAdmin();

    if (isset($_GET['mes'])) {
      $mes = $_GET['mes'];
      $dia = $_GET['dia'];
      $año = $_GET['anio'];
    }

  ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Añadir cita</title>
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
    <script src="../js/validar_nueva_cita.js"></script>
  </head>
  <body>
    
    <!-- Menú de navegación -->
    <?php tipoMenu() ?>

    <!-- Añadir una nueva cita -->
    <div class="container-fluid">
      <div class="row">
      <div class="col-xs-12 col-md-8 col-md-offset-2 cabecera-form">
        <div class="panel-group">
          <div class="panel panel-default menu-inicio">
            <div class="panel-heading">
              <h2 align="center">Añadir cita</h2>
            </div>
              
              <form class="form-horinzontal panel-body" action="#" method="post">
                <div class="form-group">
                    <label class=" col-sm-2">ID:</label>
                    <div class="col-sm-10">
                      <?php 
                        $con = abrirConexion();
                        $consulta = "select auto_increment from information_schema.tables where table_schema='inmobiliaria' and table_name='citas'";
                        $datos = mysqli_query($con, $consulta);
                        $array = mysqli_fetch_array($datos, MYSQLI_NUM);
                        echo "<td><input class='form-control' type='text' name='id' value = $array[0] readonly></td>";
                       ?>
                    </div>
                </div>
                <?php 
                  // aquí compruebo si me han pasado mes por el enlace, si es así muestro la fecha pasada si no se muestra un date para seleccionarla
                  if (isset($_GET['mes'])) {
                    echo "<div class='form-group'>
                  <label class=' col-sm-2'>Fecha:</label>
                  <div class='col-sm-10'>
                    <input id='fecha' class='form-control' type='text' name='fecha' value='$dia/$mes/$año' readonly><span></span>
                  </div>
                </div>";
                  } else {
                    echo "<div class='form-group'>
                  <label class=' col-sm-2'>Fecha:</label>
                  <div class='col-sm-10'>
                    <input id='fecha' class='form-control' type='date' name='fecha' autofocus><span></span>
                  </div>
                </div>";
                  }
                 ?>
                
                <div class="form-group">
                  <label class="col-sm-2">Hora:</label>
                  <div class="col-sm-10">
                    <input id="hora" class="form-control" type="time" name="hora"><span></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2">Motivo:</label>
                  <div class="col-sm-10">
                    <input id="motivo" class="form-control" type="text" name="motivo"><span></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2">Lugar</label>
                  <div class="col-sm-10">
                    <input id="lugar" class="form-control" type="text" name="lugar"><span></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2">ID Cliente:</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="id_cliente">
                        <?php 
                          $conexion = abrirConexion();
                          $consulta = "select id, nombre, apellidos from clientes";
                          $clientes = mysqli_query($conexion,$consulta);
                          
                          if (!$clientes) {
                            echo "Error al ajecutar la consulta";
                          } else {
                            while ($fila = mysqli_fetch_array($clientes,MYSQLI_ASSOC)) {
                              if ($fila['nombre'] != 'disponible') {
                                echo "<option value=$fila[id]>$fila[nombre] $fila[apellidos]</option>";
                              }
                            }
                          }                     
                          mysqli_close($conexion);
                        ?>
                      </select>
                  </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12 col-sm-offset-4">
                      <div class="col-sm-2">
                        <input id="nueva_cita" class="form-control btn-primary" type="submit" name="nueva_cita" value="Añadir cita">
                      </div>
                      <div class="col-sm-2">
                        <a href="./citas.php" class="btn btn-danger">Cancelar</a>
                      </div>
                    </div>
                </div>
              </form>
            
          </div>
        </div>
      </div>
      </div>
    </div>

    <!-- Código PHP que añade una nueva cita -->
    <?php 
    
      if (isset($_POST['cancelar'])) {
        header('Location: citas.php');
      }
      if (isset($_POST['nueva_cita'])) {

        // si isset de mes o dia pongo la fecha pasada por enlace, si no la del date de html
        if (isset($_GET['mes'])) {
          $fecha = $año."/".$mes."/".$dia;
        } else {
          $fecha = $_POST['fecha'];
        }

        
        $hora = $_POST['hora'];
        $motivo = $_POST['motivo'];
        $lugar = $_POST['lugar'];
        $id_cliente = $_POST['id_cliente'];

        // fecha actual
        $actual = date('Y-m-d');
        $marca_actual = strtotime($actual);
        $marca_fecha = strtotime($fecha);

        // hago la inserción si la fecha de la cita no es un día ya pasado
        if ($marca_fecha >= $marca_actual) {
            
            $conexion = abrirConexion();

            $insertar = "insert into citas (id,fecha,hora,motivo,lugar,id_cliente)
                  values (null,'$fecha','$hora','$motivo','$lugar','$id_cliente')";

            if (mysqli_query($conexion,$insertar)) {
             echo "<div class='alert alert-success col-sm-6 col-sm-offset-3' align='center'>
                            <strong>Cita añadida correctamente</strong> 
                          </div>";
              echo "<META HTTP-EQUIV='REFRESH'CONTENT='2;URL=citas.php'>";
            } else {
               echo "<div class='container-fluid'><div class='row'><div class='alert alert-danger col-sm-6 col-sm-offset-3' align='center'>
                            <h4><strong>¡Error!</strong>No se ha podido añadir la cita</h4>
                          </div></div></div>";
              echo "<META HTTP-EQUIV='REFRESH'CONTENT='2;URL=citas.php'>";
            }

            mysqli_close($conexion);
        } else {
          echo "La fecha introducída no es una fecha válida";
          echo "<META HTTP-EQUIV='REFRESH'CONTENT='3;URL=citas.php'>";
        }

        
        }
     ?>

    <!-- footer -->
    <footer class="navbar-nav navbar-inverse">
      <p align="center">Estamos en Av. Doctor Oloriz, 6 (Granada) | Teléfono: 611622633 | Email: info@inmobiliaria.com</p>
    </footer>
  </body>
</html>