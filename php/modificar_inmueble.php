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
  </head>
  <body>
    
    <!-- Menú de navegación -->
    <?php tipoMenu(); ?>
    
    <!-- Compruebo el id mandado antes de modificar -->

    <?php 
      // $_POST NO FUNCIONA
      if (isset($_GET['modificar'])) {
        $id = $_GET['id'];

        $conexion = abrirConexion();
        $consulta = "select direccion,descripcion,precio,id_cliente,imagen 
                     from inmuebles 
                     where id='$id'";

        $datos_inmuebles = mysqli_query($conexion,$consulta);

        if (!$datos_inmuebles) {
          echo "¡ERROR! No hay datos en la consulta";
          header("location:../php/inmuebles.php");
        } else {
          $num_filas = mysqli_num_rows($datos_inmuebles);
          while ($fila = mysqli_fetch_array($datos_inmuebles,MYSQLI_ASSOC)) {
              $dir = $fila['direccion'];
              $desc = $fila['descripcion'];
              $precio = $fila['precio'];
              $id_cli = $fila['id_cliente'];
              $img = $fila['imagen'];
          }
        }
        mysqli_close($conexion);
    ?>

    <div class="container-fluid menu-inicio">
      <div class="row">
        <div class="col-xs-12 col-md-8 col-md-offset-2 cabecera">
          <div class="panel group">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 align="center">Modificar inmueble</h4>
              </div>
              <div class="panel-body">
                <form class="form-horizontal" action="#" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label class=" col-sm-2">ID:</label>
                    <div class="col-sm-10">
                     <input class="form-control" type="text" name="id" value="<?php echo $id;?>" readonly >
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2">Dirección:</label>
                    <div class="col-sm-10">
                     <input class="form-control" type="text" name="dir_mod" value="<?php echo $dir;?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2">Descripción:</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" name="desc_mod" rows="5"><?php echo $desc;?></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2">Precio:</label>
                    <div class="col-sm-10">
                     <input class="form-control" type="text" name="precio_mod" value="<?php echo $precio;?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class=" col-sm-2">Disponibilidad:</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="id_cliente_mod">
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
                    <div class="col-sm-5">
                      <input class="form-control" type="file" name="imagen_mod">
                    </div>
                    <div class="col-sm-5">
                      <!-- Código PHP que muestra una miniatura de la imagen actual -->
                      <?php 
                        $conexion = abrirConexion();
                        $consulta = "select id, imagen from inmuebles where id='$id'";
                        $imagen = mysqli_query($conexion, $consulta);
                        if (!$imagen) {
                          echo "error al cargar la miniatura...";
                        } else {
                          while($fila = mysqli_fetch_array($imagen,MYSQLI_ASSOC)) {
                            echo "<strong>Imagen actual:</strong><br><img src='$fila[imagen]' width='150px'";
                          }
                        mysqli_close($conexion);
                        }  
                      ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12 col-sm-offset-4">
                      <div class="col-sm-2">
                        <input class="form-control btn-primary" type="submit" name="guardar" value="Guardar">
                      </div>
                      <div class="col-sm-2">
                        <a href="./inmuebles.php" class="btn btn-danger">Cancelar</a>
                      </div>
                    </div>
                  </div>
                </form>

              <!-- Código PHP que modifica el inmueble -->
              <?php 
              }
                  if (isset($_POST['cancelar'])) {
                    header("url=./inmuebles.php");
                  }

                  if (isset($_POST['guardar'])) {
                    $id = $_POST['id'];
                    $direccion = $_POST['dir_mod'];
                    $descripcion = $_POST['desc_mod'];
                    $precio = $_POST['precio_mod'];
                    $id_cliente = $_POST['id_cliente_mod'];

                    $imagen = $_FILES['imagen_mod']['name'];
                    $imagen_tmp = $_FILES['imagen_mod']['tmp_name'];
                    $imagen_type = $_FILES['imagen_mod']['type'];
                    $imagen_size = $_FILES['imagen_mod']['size'];
                    
                    $img_correcto = false;
                    $modificar_imagen = false;

                    // si el tamaño de la imagen es mayor que 0 significa que se quiere modificar
                    if ($imagen_size > 0) {
                      $modificar_imagen = true;
                    }

                    //si no se quiere modificar la imagen se actualizará todo menos esta, en caso contrario también se modificará la imagen
                    if ($modificar_imagen) {
                      
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

                      $conexion = abrirConexion();
                      $actualizar = "update inmuebles set direccion='$direccion',descripcion='$descripcion',precio='$precio',id_cliente='$id_cliente',imagen='$ruta_img' where id='$id'";

                      if (mysqli_query($conexion, $actualizar)) {
                        echo "<div class='alert alert-success col-sm-6 col-sm-offset-3' align='center'>
                            <strong>Inmueble modificado correctamente</strong> 
                          </div>";
                        echo "<META HTTP-EQUIV='REFRESH'CONTENT='3;URL=inmuebles.php'>";
                      } else {
                        echo "<div class='container-fluid'><div class='row'><div class='alert alert-danger col-sm-6 col-sm-offset-3' align='center'>
                                <h4><strong>¡Error!</strong>No ha sido posible modificar el inmueble</h4>
                              </div></div></div>";
                        echo "<META HTTP-EQUIV='REFRESH'CONTENT='2;URL=inmuebles.php'>";
                      }

                    } else {
                      $conexion = abrirConexion();
                      $actualizar = "update inmuebles set direccion='$direccion',descripcion='$descripcion',precio='$precio',id_cliente='$id_cliente' where id='$id'";

                      if (mysqli_query($conexion,$actualizar)) {
                        echo "<div class='alert alert-success col-sm-6 col-sm-offset-3' align='center'>
                            <strong>Inmueble modificado correctamente</strong> 
                          </div>";
                        echo "<META HTTP-EQUIV='REFRESH'CONTENT='3;URL=inmuebles.php'>";
                      } else {
                        echo "<div class='container-fluid'><div class='row'><div class='alert alert-danger col-sm-6 col-sm-offset-3' align='center'>
                                <h4><strong>¡Error!</strong>No ha sido posible modificar el inmueble</h4>
                              </div></div></div>";
                        echo "<META HTTP-EQUIV='REFRESH'CONTENT='2;URL=inmuebles.php'>";
                      }
                      mysqli_close($conexion);
                      header("url=../php/clientes.php");
                      }
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