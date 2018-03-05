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
    <title>Buscar clientes</title>
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

    <!-- Buscar un cliente -->
    <div class="container-fluid menu-inicio">
      <div class="row">
        <div class="col-xs-12 col-md-8 col-md-offset-2">
           <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h2 align="center">Buscar un cliente</h2>
              </div>
              <div class="panel-body">
                <p align="center">Rellene el campo o campos por los que quiere realizar la búsqueda</p>
                <form class="form-horizontal" action="#" method="post">
                  <div class="form-group">
                    <label class=" col-sm-2">Nombre:</label>
                    <div class="col-sm-10">
                      <input class="form-control" type="text" name="nombre" autofocus>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class=" col-sm-2">Apellidos:</label>
                    <div class="col-sm-10">
                      <input class="form-control" type="text" name="apellidos">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class=" col-sm-2">Tlf:</label>
                    <div class="col-sm-10">
                      <input class="form-control" type="text" name="telefono">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input class="form-control btn-primary" type="submit" name="buscar_usu" value="Buscar">
                    </div> 
                  </div>
                </form>
                
                <!-- Código PHP que busca usuarios en la BD -->
                <?php 

                  if (isset($_POST['buscar_usu'])) {
                    $nombre = $_POST['nombre'];
                    $apellidos = $_POST['apellidos'];
                    $telefono = $_POST['telefono'];

                    if ($nombre == "") { // si no hay nombre compruebo el ape y tlf
                      //echo "no hay nombre ";

                      if ($apellidos == "") {
                        //echo " - tampoco apellidos";

                        if ($telefono == "") {
                          //echo " - ni telefono";
                        } else {
                          //echo " - pero si telefono";
                          // busco sólo por telefono
                          $con = abrirConexion();
                          $sql = "select * from clientes where telefono1 like '%$telefono%'";

                          $btel = mysqli_query($con,$sql);

                          if (!$btel) {
                            echo "Error al consultar DB - telefono";
                            echo "<META HTTP-EQUIV='REFRESH'CONTENT='3;URL=clientes.php'>";
                          } else {
                            $num_filas = mysqli_num_rows($btel);
                            if ($num_filas == 0) {
                              echo "No se ha encontrado ningún apellido";
                            } else {
                              echo "<table class='table table-striped'";
                              echo "<thead><tr><th>ID</th><th>Nombre</th><th>Apellidos</th><th>Dirección</th><th>Telefono 1</th><th>Telefono 2</th></tr></thead>";
                              while ($fila = mysqli_fetch_array($btel)) {
                                echo "<tbody><tr><td>$fila[id]</td><td>$fila[nombre]</td><td>$fila[apellidos]</td><td>$fila[direccion]</td><td>$fila[telefono1]</td><td>$fila[telefono2]</td></tr></tbody>";
                              }
                              echo "</table>";
                            }
                          }
                        }
                      } else {
                        //echo "no hay nombre, si apellidos";
                        if ($telefono == "") {
                          //echo " - solo apellidos";
                          // busco por apellidos

                          $con = abrirConexion();
                          $sql = "select * from clientes where apellidos like '%$apellidos%'";

                          $bapellidos = mysqli_query($con,$sql);

                          if (!$bapellidos) {
                            echo "Error al consultar DB - apellidos";
                            echo "<META HTTP-EQUIV='REFRESH'CONTENT='3;URL=clientes.php'>";
                          } else {
                            $num_filas = mysqli_num_rows($bapellidos);
                            if ($num_filas == 0) {
                              echo "No se ha encontrado ningún apellido";
                            } else {
                              echo "<table class='table table-striped'";
                              echo "<thead><tr><th>ID</th><th>Nombre</th><th>Apellidos</th><th>Dirección</th><th>Telefono 1</th><th>Telefono 2</th></tr></thead>";
                              while ($fila = mysqli_fetch_array($bapellidos)) {
                                echo "<tbody><tr><td>$fila[id]</td><td>$fila[nombre]</td><td>$fila[apellidos]</td><td>$fila[direccion]</td><td>$fila[telefono1]</td><td>$fila[telefono2]</td></tr></tbody>";
                              }
                              echo "</table>";
                            }
                          }

                        } else {
                          //echo " - Hay apellidos y telefono";
                          // busco por apellidos y telefono

                          $con = abrirConexion();
                          $sql = "select * from clientes where apellidos like '%$apellidos%' and telefono1 like '%$telefono%'";

                          $bapetel = mysqli_query($con,$sql);

                          if (!$bapetel) {
                            echo "Error al consultar DB - apellidos|teléfono";
                            echo "<META HTTP-EQUIV='REFRESH'CONTENT='3;URL=clientes.php'>";
                          } else {
                            $num_filas = mysqli_num_rows($bapetel);
                            if ($num_filas == 0) {
                              echo "No se ha encontrado ningún apellido y teléfono";
                            } else {
                              echo "<table class='table table-striped'";
                              echo "<thead><tr><th>ID</th><th>Nombre</th><th>Apellidos</th><th>Dirección</th><th>Telefono 1</th><th>Telefono 2</th></tr></thead>";
                              while ($fila = mysqli_fetch_array($bapetel)) {
                                echo "<tbody><tr><td>$fila[id]</td><td>$fila[nombre]</td><td>$fila[apellidos]</td><td>$fila[direccion]</td><td>$fila[telefono1]</td><td>$fila[telefono2]</td></tr></tbody>";
                              }
                              echo "</table>";
                            }
                          }
                        }
                      }

                    } else { // si hay nombre compruebo el ape y tlf
                      //echo "hay nombre";

                      if ($apellidos == "") {
                       // echo "-no apellidos";

                        
                        if ($telefono == "") {
                         // echo "-ni telefono";
                          //busco sólo por nombre 

                          $con = abrirConexion();
                          $sql = "select * from clientes where nombre like '%$nombre%'";

                          $nom = mysqli_query($con,$sql);

                          if (!$nom) {
                            echo "Error al consultar DB - nombre";
                            echo "<META HTTP-EQUIV='REFRESH'CONTENT='3;URL=clientes.php'>";
                          } else {
                            $num_filas = mysqli_num_rows($nom);
                            if ($num_filas == 0) {
                              echo "No se ha encontrado ningún nombre y apellido";
                            } else {
                              echo "<table class='table table-striped'";
                              echo "<thead><tr><th>ID</th><th>Nombre</th><th>Apellidos</th><th>Dirección</th><th>Telefono 1</th><th>Telefono 2</th></tr></thead>";
                              while ($fila = mysqli_fetch_array($nom)) {
                                echo "<tbody><tr><td>$fila[id]</td><td>$fila[nombre]</td><td>$fila[apellidos]</td><td>$fila[direccion]</td><td>$fila[telefono1]</td><td>$fila[telefono2]</td></tr></tbody>";
                              }
                              echo "</table>";
                            }
                          }



                        } else {
                         // echo "-y telefono";
                          //busco por nombre y telefono

                          $con = abrirConexion();
                          $sql = "select * from clientes where nombre like '%$nombre%' and telefono1 like '%$telefono%'";

                          $bnomtel = mysqli_query($con,$sql);

                          if (!$bnomtel) {
                            echo "Error al consultar DB - nombre";
                            echo "<META HTTP-EQUIV='REFRESH'CONTENT='3;URL=clientes.php'>";
                          } else {
                            $num_filas = mysqli_num_rows($bnomtel);
                            if ($num_filas == 0) {
                              echo "No se ha encontrado ningún nombre y apellido";
                            } else {
                              echo "<table class='table table-striped'";
                              echo "<thead><tr><th>ID</th><th>Nombre</th><th>Apellidos</th><th>Dirección</th><th>Telefono 1</th><th>Telefono 2</th></tr></thead>";
                              while ($fila = mysqli_fetch_array($bnomtel)) {
                                echo "<tbody><tr><td>$fila[id]</td><td>$fila[nombre]</td><td>$fila[apellidos]</td><td>$fila[direccion]</td><td>$fila[telefono1]</td><td>$fila[telefono2]</td></tr></tbody>";
                              }
                              echo "</table>";
                            }
                          }
                        }

                      } else {
                        echo "-y apellidos";
                        if ($telefono == "" ) {
                          echo "-pero no telefono";
                          // busco por nombre y apellidos

                          $con = abrirConexion();
                          $sql = "select * from clientes where nombre like '%$nombre%' and apellidos like '%$apellidos%'";

                          $bnomape = mysqli_query($con,$sql);

                          if (!$bnomape) {
                            echo "Error al consultar DB - nombre|apellidos";
                            echo "<META HTTP-EQUIV='REFRESH'CONTENT='3;URL=clientes.php'>";
                          } else {
                            $num_filas = mysqli_num_rows($bnomape);
                            if ($num_filas == 0) {
                              echo "No se ha encontrado ningún nombre y apellido";
                            } else {
                              echo "<table class='table table-striped'";
                              echo "<thead><tr><th>ID</th><th>Nombre</th><th>Apellidos</th><th>Dirección</th><th>Telefono 1</th><th>Telefono 2</th></tr></thead>";
                              while ($fila = mysqli_fetch_array($bnomape)) {
                                echo "<tbody><tr><td>$fila[id]</td><td>$fila[nombre]</td><td>$fila[apellidos]</td><td>$fila[direccion]</td><td>$fila[telefono1]</td><td>$fila[telefono2]</td></tr></tbody>";
                              }
                              echo "</table>";
                            }
                          }


                        } else {
                          echo "-también telefono";
                          // busco por nombre apellidos y telefono

                          $con = abrirConexion();
                          $sql = "select * from clientes where nombre like '%$nombre%' and apellidos like '%$apellidos%' and telefono1 like '%$telefono%'";

                          $bnomapetel = mysqli_query($con,$sql);

                          if (!$bnomapetel) {
                            echo "Error al consultar DB - nombre|apellidos";
                            echo "<META HTTP-EQUIV='REFRESH'CONTENT='3;URL=clientes.php'>";
                          } else {
                            $num_filas = mysqli_num_rows($bnomapetel);
                            if ($num_filas == 0) {
                              echo "No se ha encontrado ningún nombre y apellido";
                            } else {
                              echo "<table class='table table-striped'";
                              echo "<thead><tr><th>ID</th><th>Nombre</th><th>Apellidos</th><th>Dirección</th><th>Telefono 1</th><th>Telefono 2</th></tr></thead>";
                              while ($fila = mysqli_fetch_array($bnomapetel)) {
                                echo "<tbody><tr><td>$fila[id]</td><td>$fila[nombre]</td><td>$fila[apellidos]</td><td>$fila[direccion]</td><td>$fila[telefono1]</td><td>$fila[telefono2]</td></tr></tbody>";
                              }
                              echo "</table>";
                            }
                          }
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

    <!-- footer -->
    <footer class="navbar-nav navbar-inverse footer-clientes">
      <p align="center">Estamos en Av. Doctor Oloriz, 6 (Granada) | Teléfono: 611622633 | Email: info@inmobiliaria.com</p>
    </footer>
  </body>
</html>