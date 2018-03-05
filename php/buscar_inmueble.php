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
    <title>Buscar inmuebles</title>
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
    
    <!-- Menú de navegación-->
    <?php tipoMenu(); ?>
    
    <!-- Buscar inmueble -->
    <div class="container-fluid menu-inicio col-sm-8 col-sm-offset-2">
      <div class="row">
        <div class="col-xs-12">
        <div class="col-xs-12">
          <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h2 align="center">Buscar inmuebles</h2>
              </div>
              <div class="panel-body">
                <p align="center">Rellene el campo o campos por los que quiere realizar la búsqueda</p>
                <form class="form-horizontal" action="#" method="post">
                  <div class="form-group">
                    <label class=" col-sm-2">Dirección:</label>
                    <div class="col-sm-10">
                      <input class="form-control" type="text" name="direccion" autofocus>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class=" col-sm-2">Disponibilidad:</label>
                    <div class="col-sm-5 col-lg-offset-1">
                        <select class="form-control" name="disp">
                          <option value="si">Disponible</option>
                          <option value="no">No disponible</option>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class=" col-sm-2">Precio:</label>
                    <div class="col-sm-10">
                      <input class="form-control" type="text" name="precio">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input class="form-control btn-primary" type="submit" name="buscar_inm" value="Buscar">
                    </div> 
                  </div>
                </form>

                <!-- Código PHP que busca usuarios en la BD -->
                <?php 

                  if (isset($_POST['buscar_inm'])) {
                    $direccion = $_POST['direccion'];
                    $disponibilidad = $_POST['disp'];
                    $precio = $_POST['precio'];

                    
                    if ($direccion == "") {
                      
                      if ($precio == "") {
                        
                        // busco por disponibilidad
                        if ($disponibilidad == "si") {
                          
                          // SI disponibilidad

                          $con = abrirConexion();
                          $sql = "select * from inmuebles where id_cliente='0'";

                          $bdisp = mysqli_query($con,$sql);

                          if (!$bdisp) {
                            echo "Error al consultar BD - Disponibilidad SI";
                          } else {
                            echo "<table class='table table-striped'>";
                            echo "<thead><tr><th>Dirección</th><th>Precio</th><th>Imagen</th><th>Ver</th></tr></thead>";
                            while ($fila = mysqli_fetch_array($bdisp,MYSQLI_ASSOC)) {
                              echo "<tbody><tr><td>$fila[direccion]</td><td>$fila[precio]</td><td><img src='$fila[imagen]' width='150px'></td>
                            <td><form action='ver_inmueble.php' method='post'><input type='hidden' name='id' value='$fila[id]'><input class='form-control btn-primary' type='submit' name='ver' value='Ver'></form></td>
                            </tr></tbody>";
                            }
                            echo "<table>";
                          }
                          mysqli_close($con);

                        } else {
                          
                          // No disponibilidad

                          $con = abrirConexion();
                          $sql = "select * from inmuebles where id_cliente!='0'";

                          $bdisp = mysqli_query($con,$sql);

                          if (!$bdisp) {
                            echo "Error al consultar BD - Disponibilidad NO";
                          } else {
                            echo "<table class='table table-striped'>";
                            echo "<thead><tr><th>Dirección</th><th>Precio</th><th>Imagen</th><th>Ver</th></tr></thead>";
                            while ($fila = mysqli_fetch_array($bdisp,MYSQLI_ASSOC)) {
                              echo "<tbody><tr><td>$fila[direccion]</td><td>$fila[precio]</td><td><img src='$fila[imagen]' width='150px'></td>
                            <td><form action='ver_inmueble.php' method='post'><input type='hidden' name='id' value='$fila[id]'><input class='form-control btn-primary' type='submit' name='ver' value='Ver'></form></td>
                            </tr></tbody>";
                            }
                            echo "<table>";
                          }
                          mysqli_close($con);
                        }

                      } else {
                        
                        // busco por precio y disponibilidad

                        if ($disponibilidad == "si") {
                          echo " - si disponibilidad";
                          // disponibilidad SI

                          $con = abrirConexion();
                          $sql = "select * from inmuebles where precio like '%$precio%' and id_cliente='0'";

                          $bpredisp = mysqli_query($con,$sql);
                          if (!$bpredisp) {
                            echo "Error al consultar BD - Disponibilidad SI y PRECIO";
                          } else {
                            echo "<table class='table table-striped'>";
                            echo "<thead><tr><th>Dirección</th><th>Precio</th><th>Imagen</th><th>Ver</th></tr></thead>";
                            while ($fila = mysqli_fetch_array($bpredisp,MYSQLI_ASSOC)) {
                              echo "<tbody><tr><td>$fila[direccion]</td><td>$fila[precio]</td><td><img src='$fila[imagen]' width='150px'></td>
                            <td><form action='ver_inmueble.php' method='post'><input type='hidden' name='id' value='$fila[id]'><input class='form-control btn-primary' type='submit' name='ver' value='Ver'></form></td>
                            </tr></tbody>";
                            }
                            echo "<table>";
                          }
                          mysqli_close($con);

                        } else {
                          
                          // disponibilidad NO

                          $con = abrirConexion();
                          $sql = "select * from inmuebles where precio like '%$precio%' and id_cliente!='0'";

                          $bpredisp = mysqli_query($con,$sql);
                          if (!$bpredisp) {
                            echo "Error al consultar BD - Disponibilidad SI y PRECIO";
                          } else {
                            echo "<table class='table table-striped'>";
                            echo "<thead><tr><th>Dirección</th><th>Precio</th><th>Imagen</th><th>Ver</th></tr></thead>";
                            while ($fila = mysqli_fetch_array($bpredisp,MYSQLI_ASSOC)) {
                              echo "<tbody><tr><td>$fila[direccion]</td><td>$fila[precio]</td><td><img src='$fila[imagen]' width='150px'></td>
                            <td><form action='ver_inmueble.php' method='post'><input type='hidden' name='id' value='$fila[id]'><input class='form-control btn-primary' type='submit' name='ver' value='Ver'></form></td>
                            </tr></tbody>";
                            }
                            echo "<table>";
                          }
                          mysqli_close($con);
                        }
                      }
                    } else {
                      
                      if ($precio == "") {
                        
                        // busco por dirección y disponibilidad

                        if ($disponibilidad == "si") {
                          
                          // disponibilidad SI

                          $con = abrirConexion();
                          $sql = "select * from inmuebles where direccion like '%$direccion%' and id_cliente='0'";

                          $bdirdisp = mysqli_query($con,$sql);

                          if (!$bdirdisp) {
                            echo "Error al consultar BD - DIRECCIÓN SI y DISPONIBILIDAD SI";
                          } else {
                            echo "<table class='table table-striped'>";
                            echo "<thead><tr><th>Dirección</th><th>Precio</th><th>Imagen</th><th>Ver</th></tr></thead>";
                            while ($fila = mysqli_fetch_array($bdirdisp,MYSQLI_ASSOC)) {
                              echo "<tbody><tr><td>$fila[direccion]</td><td>$fila[precio]</td><td><img src='$fila[imagen]' width='150px'></td>
                            <td><form action='ver_inmueble.php' method='post'><input type='hidden' name='id' value='$fila[id]'><input class='form-control btn-primary' type='submit' name='ver' value='Ver'></form></td>
                            </tr></tbody>";
                            }
                            echo "<table>";
                          }
                          mysqli_close($con);
                        } else {
                          
                          // disponibilidad no

                          $con = abrirConexion();
                          $sql = "select * from inmuebles where direccion like '%$direccion%' and id_cliente!='0'";

                          $bdirdisp = mysqli_query($con,$sql);

                          if (!$bdirdisp) {
                            echo "Error al consultar BD - DIRECCIÓN SI y DISPONIBILIDAD NO";
                          } else {
                            echo "<table class='table table-striped'>";
                            echo "<thead><tr><th>Dirección</th><th>Precio</th><th>Imagen</th><th>Ver</th></tr></thead>";
                            while ($fila = mysqli_fetch_array($bdirdisp,MYSQLI_ASSOC)) {
                              echo "<tbody><tr><td>$fila[direccion]</td><td>$fila[precio]</td><td><img src='$fila[imagen]' width='150px'></td>
                            <td><form action='ver_inmueble.php' method='post'><input type='hidden' name='id' value='$fila[id]'><input class='form-control btn-primary' type='submit' name='ver' value='Ver'></form></td>
                            </tr></tbody>";
                            }
                            echo "<table>";
                          }
                          mysqli_close($con);
                        }

                      } else {
                        
                        // busco por dirección, precio, disponibilidad

                        if ($disponibilidad == "si") {
                          
                          // Disponibilidad SI

                          $con = abrirConexion();
                          $sql = "select * from inmuebles where direccion like '%$direccion%' and precio like '%$precio%' and id_cliente='0'";

                          $bdirdispre = mysqli_query($con,$sql);

                          if (!$bdirdispre) {
                            echo "Error al consultar BD - DIRECCIÓN SI y DISPONIBILIDAD SI, PRECIO SI";
                          } else {
                            echo "<table class='table table-striped'>";
                            echo "<thead><tr><th>Dirección</th><th>Precio</th><th>Imagen</th><th>Ver</th></tr></thead>";
                            while ($fila = mysqli_fetch_array($bdirdispre,MYSQLI_ASSOC)) {
                              echo "<tbody><tr><td>$fila[direccion]</td><td>$fila[precio]</td><td><img src='$fila[imagen]' width='150px'></td>
                            <td><form action='ver_inmueble.php' method='post'><input type='hidden' name='id' value='$fila[id]'><input class='form-control btn-primary' type='submit' name='ver' value='Ver'></form></td>
                            </tr></tbody>";
                            }
                            echo "<table>";
                          }
                          mysqli_close($con);
                        } else {
                          
                          // Disponibilidad NO

                          $con = abrirConexion();
                          $sql = "select * from inmuebles where direccion like '%$direccion%' and precio like '%$precio%' and id_cliente!='0'";

                          $bdirdispre = mysqli_query($con,$sql);

                          if (!$bdirdispre) {
                            echo "Error al consultar BD - DIRECCIÓN SI y DISPONIBILIDAD SI, PRECIO SI";
                          } else {
                            echo "<table class='table table-striped'>";
                            echo "<thead><tr><th>Dirección</th><th>Precio</th><th>Imagen</th><th>Ver</th></tr></thead>";
                            while ($fila = mysqli_fetch_array($bdirdispre,MYSQLI_ASSOC)) {
                              echo "<tbody><tr><td>$fila[direccion]</td><td>$fila[precio]</td><td><img src='$fila[imagen]' width='150px'></td>
                            <td><form action='ver_inmueble.php' method='post'><input type='hidden' name='id' value='$fila[id]'><input class='form-control btn-primary' type='submit' name='ver' value='Ver'></form></td>
                            </tr></tbody>";
                            }
                            echo "<table>";
                          }
                          mysqli_close($con);
                        }
                      }
                    }
                  }
                ?>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>
    <!-- footer -->
    <footer class="navbar-nav navbar-inverse">
      <p align="center">Estamos en Av. Doctor Oloriz, 6 (Granada) | Teléfono: 611622633 | Email: info@inmobiliaria.com</p>
  </body>
</html>