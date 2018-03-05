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
    <title>Modificar citas</title>
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

    <!-- Modificar cita -->
    <?php 

        if (isset($_POST['modificar'])) {
          $id = $_POST['id'];
          
          $conexion = abrirConexion();
          $sql = "select fecha,hora,motivo,lugar,id_cliente from citas where id='$id'";

          $datos = mysqli_query($conexion,$sql);

          if (!$datos) {
            echo "Error al consultar datos a la BD";
          } else {
            $fila = mysqli_fetch_array($datos,MYSQLI_ASSOC);

            $fecha = $fila['fecha'];
            $hora = $fila['hora'];
            $motivo = $fila['motivo'];
            $lugar = $fila['lugar'];
            $id_cliente = $fila['id_cliente'];
          }

     ?>

     <div class="container-fluid menu-inicio">
       <div class="row">
         <div class="col-xs-12 col-sm-8 col-sm-offset-2 cabecera-form">
           <div class="panel-group">
             <div class="panel panel-default">
               <div class="panel-heading">
                 <h4 align="center">Modificar Cita</h4>
               </div>
               <div class="panel-body">
                 <form class="form-horizontal" action="#" method="post">
                  <div class="form-group">
                    <label class=" col-sm-2">ID:</label>
                    <div class="col-sm-10">
                     <input class="form-control" type="text" name="id_new" value="<?php echo $id; ?>" readonly >
                    </div>
                  </div>
                  <div class="form-group">
                    <label class=" col-sm-2">Fecha:</label>
                    <div class="col-sm-10">
                     <input class="form-control" type="date" name="fecha_new" value="<?php echo $fecha; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class=" col-sm-2">Hora:</label>
                    <div class="col-sm-10">
                     <input class="form-control" type="time" name="hora_new" value="<?php echo $hora; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class=" col-sm-2">Motivo:</label>
                    <div class="col-sm-10">
                     <input class="form-control" type="text" name="motivo_new" value="<?php echo $motivo; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class=" col-sm-2">Lugar:</label>
                    <div class="col-sm-10">
                     <input class="form-control" type="text" name="lugar_new" value="<?php echo $lugar; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class=" col-sm-2">Cliente:</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="id_cliente_new">
                        <?php 
                          $conexion = abrirConexion();
                          $consulta = "select id, nombre from clientes";
                          $clientes = mysqli_query($conexion,$consulta);
                          
                          if (!$clientes) {
                            echo "Error al ajecutar la consulta";
                          } else {
                            while ($fila = mysqli_fetch_array($clientes,MYSQLI_ASSOC)) {
                              if ($fila['nombre'] != 'disponible') {
                                echo "<option value=$fila[id]>$fila[nombre]</option>";
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
                        <input class="form-control btn-primary" type="submit" name="mod_cita" value="Modificar">
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
     </div>
      
    <!-- PHP que modifica las citas en la BD -->
    <?php 
      }

        if (isset($_POST['mod_cita'])) {
          $id_new = $_POST['id_new'];
          $fecha_new = $_POST['fecha_new'];
          $hora_new = $_POST['hora_new'];
          $motivo_new = $_POST['motivo_new'];
          $lugar_new = $_POST['lugar_new'];
          $id_cliente_new = $_POST['id_cliente_new'];

          $con = abrirConexion();
          $sql = "update citas set fecha='$fecha_new',hora='$hora_new',motivo='$motivo_new',lugar='$lugar_new',id_cliente='$id_cliente_new' where id='$id_new'";

          $actualizar = mysqli_query($con,$sql);

          if (!$actualizar) {
            echo "<div class='alert alert-success col-sm-6 col-sm-offset-3' align='center'>
                            <strong>Cita modificada correctamente</strong> 
                          </div>";
            echo "<META HTTP-EQUIV='REFRESH'CONTENT='2;URL=citas.php'>";
          } else {
           echo "<div class='container-fluid'><div class='row'><div class='alert alert-danger col-sm-6 col-sm-offset-3' align='center'>
                            <h4><strong>¡Error!</strong>No se ha podido modificar la cita</h4>
                          </div></div></div>";
            echo "<META HTTP-EQUIV='REFRESH'CONTENT='2;URL=citas.php'>";
          }

          mysqli_close($con);

        }
     ?>

    <!-- footer -->
    <footer class="navbar-nav navbar-inverse">
      <p align="center">Estamos en Av. Doctor Oloriz, 6 (Granada) | Teléfono: 611622633 | Email: info@inmobiliaria.com</p>
    </footer>
  </body>
</html>