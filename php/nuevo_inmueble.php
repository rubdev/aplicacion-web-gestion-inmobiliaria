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
    <title>Modificar inmuebles</title>
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
    <script src="../js/validar_nuevo_inmueble.js"></script>
  </head>
  <body>
    
    <!-- Menú de navegación -->
    <?php tipoMenu(); ?>

     <!-- Nuevo inmbueble -->
    <div class="container-fluid menu-inicio">
      <div class="row">
        <div class="col-xs-12 col-md-6 col-md-offset-3">
          <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h2 align="center">Nuevo inmueble</h2>
              </div>
              <div class="panel-body">
                 <form class="form-horizontal" action="#" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label class=" col-sm-2">ID:</label>
                    <div class="col-sm-10">
                      <?php 
                        $con = abrirConexion();
                        $consulta = "select auto_increment from information_schema.tables where table_schema='inmobiliaria' and table_name='inmuebles'";
                        $datos = mysqli_query($con, $consulta);
                        $array = mysqli_fetch_array($datos, MYSQLI_NUM);
                        echo "<td><input class='form-control' type='text' name='id' value = '$array[0]' readonly></td>";
                       ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class=" col-sm-2">Dirección:</label>
                    <div class="col-sm-10">
                      <input id="dir" class="form-control" type="text" name="direccion" autofocus><span></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class=" col-sm-2">Descripción:</label>
                    <div class="col-sm-10">
                      <textarea id="des" class="form-control" name="descripcion" rows="5"></textarea><span></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class=" col-sm-2">Precio:</label>
                    <div class="col-sm-10">
                      <input id="pre" class="form-control" type="text" name="precio"><span></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class=" col-sm-2">ID Cliente:</label>
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
                              echo "<option value=$fila[id]>$fila[nombre] $fila[apellidos]</option>";
                            }
                          }                     
                          mysqli_close($conexion);
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class=" col-sm-2">Imagen:</label>
                    <div class="col-sm-10">
                      <input class="form-control" type="file" name="imagen">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12 col-sm-offset-4">
                      <div class="col-sm-2">
                        <input id="nuevo_inmueble" class="form-control btn-primary" type="submit" name="nuevo_inmueble" value="Añadir">
                      </div>
                      <div class="col-sm-2">
                        <a href="./inmuebles.php" class="btn btn-danger">Cancelar</a>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!-- Código PHP para añadir un nuevo inmueble -->
          <?php 
             if (isset($_POST['nuevo_inmueble'])) {
                $direccion = $_POST['direccion'];
                $descripcion = $_POST['descripcion'];
                $precio = $_POST['precio'];
                $id_cliente = $_POST['id_cliente'];
                $id = $_POST['id'];

                $imagen = $_FILES['imagen']['name'];
                $imagen_tmp = $_FILES['imagen']['tmp_name'];
                $imagen_type = $_FILES['imagen']['type'];
                $img_correcto = false;

                //compruebo sea que sea una imagen
                if ($imagen_type != "image/jpeg" && $imagen_type != "image/png") {
                  echo "<div class='container-fluid'><div class='row'><div class='alert alert-danger col-sm-6 col-sm-offset-3' align='center'>
                            <h4><strong>¡Error!</strong>Tipo de imagen no válido</h4><h5>Formatos válidos <b>.png</b> o <b>.jpeg</b></h5>
                          </div></div></div>";
                }

                // subo la imagen al servidor

                if (!file_exists("./img_inmuebles")) {
                  mkdir("./img_inmuebles");
                }

                // creo la ruta donde guardar la foto dependiendo del tipo que sea
                if ($imagen_type == "image/png") {
                  $ruta_img = "./img_inmuebles/$id".".png";//."$direccion.png"
                } else if ($imagen_type == "image/jpeg"){
                  $ruta_img = "./img_inmuebles/$id".".jpg";//."$direccion.jpeg";
                } 
                

                // guardo la foto en el servidor
                if (move_uploaded_file($imagen_tmp, $ruta_img)) {
                  $img_correcto = true;
                } else {
                 echo "<div class='alert alert-success col-sm-6 col-sm-offset-3' align='center'>
                            <strong>Error al subir la imagen del inmueble al servidor</strong> 
                          </div>";
                  echo "<META HTTP-EQUIV='REFRESH'CONTENT='2;URL=inmuebles.php'>";
                }

                // añado el inmueble a la BD si se ha subido la imagen correctamente
                
                if ($img_correcto) {

                  $conexion = abrirConexion();

                  $insertar = "insert into inmuebles (id,direccion,descripcion,precio,id_cliente,imagen)
                        values (null, '$direccion', '$descripcion', '$precio', '$id_cliente', '$ruta_img')";

                  $datos = mysqli_query($conexion, $insertar);

                  if ($datos) {
                    echo "<div class='alert alert-success col-sm-6 col-sm-offset-3' align='center'>
                            <strong>Inmuebles añadido correctamente</strong> 
                          </div>";
                    echo "<META HTTP-EQUIV='REFRESH'CONTENT='3;URL=inmuebles.php'>";
                  } else {
                    echo "<div class='container-fluid'><div class='row'><div class='alert alert-danger col-sm-6 col-sm-offset-3' align='center'>
                            <h4><strong>¡Error!</strong>No ha sido posible añadir el inmueble</h4>
                          </div></div></div>";
                    echo "<META HTTP-EQUIV='REFRESH'CONTENT='2;URL=inmuebles.php'>";
                  }
                }
              }
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