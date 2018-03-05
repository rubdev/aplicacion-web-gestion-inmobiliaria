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
    <title>Inmuebles</title>
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

    <!-- Botones de funciones añadir, borrar, buscar -->
    <div class="container-fluid menu-inicio">
      <div class="row">
        <div class="col-xs-12">
          <nav class="navbar ">
            <div class="container-fluid">
              <ul class="nav navbar-nav navbar-center margen-cont" align="center">
                <li><a type="button" class="btn btn-primary btn-md" href="nuevo_inmueble.php">Añadir inmueble</a></li>
                <li><a type="button" class="btn btn-primary btn-md" href="borrar_inmueble.php">Borrar inmueble</a></li>
                <li><a type="button" class="btn btn-primary btn-md" href="buscar_inmueble.php">Buscar inmueble</a></li>
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </div>

    
    <!-- Muestra una tabla con los inmuebles almacenados en la BD -->
    <div class="container-fluid ">
      <div class="row">
        <div class="col-xs-12">
          <h2 class="margen-citas" align="center">Inmuebles almacenados</h2>
          <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="table-responsive">
                <div class="table table-hover">
                  <!-- Código PHP que muestra el listado de inmuebles -->
                  <?php 
                      $conexion = abrirConexion();
                      $mostrar = "select id,direccion, descripcion, precio, id_cliente, imagen
                                  from inmuebles";
                      $datos = mysqli_query($conexion,$mostrar);
                      if (!$datos) {
                        echo "No hay datos que mostrar";
                      } else {
                        $num_filas = mysqli_num_rows($datos);

                        if ($num_filas == 0) {
                          echo "No hay ningún inmueble almacenado";
                        } else {
                          echo "<p><strong>Número de clientes almacenados:</strong> $num_filas</p>";
                          echo "<table class='table table-hover'";
                          echo "<thead><tr><th>ID</th><th>Dirección</th><th>Precio</th><th>Imagen</th><th>Disponibilidad</th><th>Ver inmueble</th><th>Modificar inmueble</th></tr></thead>";
                          while ($fila = mysqli_fetch_array($datos,MYSQLI_ASSOC)) {
                            // si es el usuario 'disponible' muestro cartel de disponible
                            if ($fila['id_cliente'] == 0) {
                              echo "<tbody><tr><td>$fila[id]</td><td>$fila[direccion]</td><td>$fila[precio] €</td><td><img src='$fila[imagen]' style='width:150px''></td><td><button type='button' class='btn btn-success'>Disponible</button></td></td>
                            <td><form action='ver_inmueble.php' method='post'><input type='hidden' name='id' value='$fila[id]'><input class='form-control btn-primary' type='submit' name='ver' value='Ver'></form></td>
                            <td><form action='modificar_inmueble.php' method='get'><input type='hidden' name='id' value='$fila[id]'><input class='form-control btn-primary' type='submit' name='modificar' value='Modificar'></form></td></tr></tbody>";
                            } else {
                              echo "<tbody><tr><td>$fila[id]</td><td>$fila[direccion]</td><td>$fila[precio] €</td><td><img src='$fila[imagen]' style='width:150px''></td><td><button type='button' class='btn btn-danger'>No disponible</button></td></td>
                                    <td><form action='ver_inmueble.php' method='post'><input type='hidden' name='id' value='$fila[id]'><input class='form-control btn-primary' type='submit' name='ver' value='Ver'></form></td>
                                    <td><form action='modificar_inmueble.php' method='get'><input type='hidden' name='id' value='$fila[id]'><input class='form-control btn-primary' type='submit' name='modificar' value='Modificar'></form></td></tr></tbody>";
                            }
                          }
                          echo "</table>";
                        }
                      }
                      mysqli_close($conexion); 
                   ?>
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- footer -->
    <footer class="navbar-nav navbar-inverse">
      <p align="center"><a class="aweb" href="../inmobiliaria/php/mapa_web.php">Mapa web</a> | Estamos en Av. Doctor Oloriz, 6 (Granada) | Teléfono: 611622633 | Email: info@inmobiliaria.com</p>
    </footer>
  </body>
</html>