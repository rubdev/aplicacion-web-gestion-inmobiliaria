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
    <title>Añadir noticia</title>
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
    <!-- Validación javascript de datos
    <script src="../js/validar_nueva_noticia.js"></script> -->
  </head>
  <body>
    
    <!-- Menú de navegación -->
    <?php tipoMenu(); ?>

    <!-- Nueva noticia -->
    <div class="container-fluid menu-inicio">
      <div class="row">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2">
          <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h2 align="center">Nueva noticia</h2>
              </div>
              <div class="panel-body">
                 <form class="form-horizontal" action="#" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label class=" col-sm-3">ID:</label>
                    <div class="col-sm-9">
                      <?php 
                          $con = abrirConexion();
                          $consulta = "select auto_increment from information_schema.tables where table_schema='inmobiliaria' and table_name='noticias'";
                          $datos = mysqli_query($con, $consulta);
                          $array = mysqli_fetch_array($datos, MYSQLI_NUM);
                          echo "<td><input class='form-control' type='text' name='id' value = $array[0] readonly></td>";
                       ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3">Titular:</label>
                    <div class="col-sm-9">
                      <input class="form-control" id="titular" type="text" name="titular" autofocus><span></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3">Contenido:</label>
                    <div class="col-sm-9">
                      <textarea class="form-control" id="contenido" name="contenido" rows="5"></textarea><span></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3">Imagen:</label>
                    <div class="col-sm-9">
                      <input class="form-control" id="imagen" type="file" name="imagen">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3">Fecha de publicación:</label>
                    <div class="col-sm-5">
                      <input class="form-control" id="fecha" type="date" name="fecha"><span></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12 col-sm-offset-4">
                      <div class="col-sm-2">
                        <input class="form-control btn-primary" id="nueva_noticia" type="submit" name="nueva_noticia" value="Añadir">
                      </div>
                      <div class="col-sm-2">
                        <a href="./noticias.php" class="btn btn-danger">Cancelar</a>
                      </div>
                    </div>
                  </div>
                 </form>
              </div>
            </div>
          </div>

          <!-- Código PHP que añade una nueva noticia -->
          <?php 
            if (isset($_POST['nueva_noticia'])) {
              $id = $_POST['id'];
              $titular = $_POST['titular'];
              $contenido = $_POST['contenido'];
              $fecha = $_POST['fecha'];

              $imagen = $_FILES['imagen']['name'];
              $imagen_tmp = $_FILES['imagen']['tmp_name'];
               $imagen_type = $_FILES['imagen']['type'];
              
              $img_correcto = false;

              

              if ($imagen_type != "image/jpeg" && $imagen_type != "image/png") {
                echo "¡Tipo de imagen no válido! Formatos admitidos: .jpeg o .png";
                header("url=/inmuebles.php");
              }
              if (!file_exists("./img_noticias")) {
                mkdir("./img_noticias");
              }
              
              // creo la ruta donde guardar la imagen
              if ($imagen_type == "image/png") {
                  $ruta_img = "./img_noticias/$id".".png";//."$direccion.png"
              } else if ($imagen_type == "image/jpeg"){
                  $ruta_img = "./img_noticias/$id".".jpg";//."$direccion.jpeg";
              }

              // guardo la foto en el servidor
              if (move_uploaded_file($imagen_tmp, $ruta_img)) {
                $img_correcto = true;
              } else {
                echo "<div class='container-fluid'><div class='row'><div class='alert alert-danger col-sm-6 col-sm-offset-3' align='center'>
                    <h4><strong>¡Error!</strong>No ha sido posible subir la imagen al servidor</h4>
                  </div></div></div>";
                echo "<META HTTP-EQUIV='REFRESH'CONTENT='3;URL=noticias.php'>";
              }

              if ($img_correcto) {
                $conexion = abrirConexion();
                $insertar = "insert into noticias (id,titular,contenido,imagen,fecha)
                      values (null,'$titular','$contenido','$ruta_img','$fecha')";
                if(mysqli_query($conexion,$insertar)) {
                  echo "<div class='alert alert-success col-sm-6 col-sm-offset-3' align='center'>
                        <strong>Noticia publicada correctamente</strong> 
                      </div>";
                  echo "<META HTTP-EQUIV='REFRESH'CONTENT='2;URL=noticias.php'>";
                } else {
                  echo "<div class='container-fluid'><div class='row'><div class='alert alert-danger col-sm-6 col-sm-offset-3' align='center'>
                    <h4><strong>¡Error!</strong>No ha sido posible publicar la noticia</h4>
                  </div></div></div>";
                  echo "<META HTTP-EQUIV='REFRESH'CONTENT='2;URL=noticias.php'>";
                }
              }
              mysqli_close($conexion);
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