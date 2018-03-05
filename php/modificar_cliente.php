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
    <title>Modificar cliente</title>
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
      if (isset($_POST['modificar'])) {
        $id = $_POST['id'];

        // almaceno en variables los datos para mostrarlas después en los 'value' del formulario
        $conexion = abrirConexion();
        $consulta = "select nombre,apellidos,direccion,telefono1,telefono2,nombre_usuario,pass 
                     from clientes
                     where id='$id'";

        $datos_cliente = mysqli_query($conexion, $consulta);

        if (!$datos_cliente) {
          echo "No se han encontrado los datos del usuario en la BD";
          header("location:../php/clientes.php");
        } else {
          $num_filas = mysqli_num_rows($datos_cliente);
          while ($fila = mysqli_fetch_array($datos_cliente,MYSQLI_ASSOC)) {
            $nom = $fila['nombre'];
            $ape = $fila['apellidos'];
            $dir = $fila['direccion'];
            $t1 = $fila['telefono1'];
            $t2 = $fila['telefono2'];
            $usuario = $fila['nombre_usuario'];
            $password = $fila['pass'];
          }
        }
        mysqli_close($conexion);
      
    ?>

    <!-- Formulario de modificación de usuario -->
    <div class="container-fluid menu-inicio">
      <div class="row">
        <div class="col-xs-12 col-md-8 col-md-offset-2">
          <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 align="center">Modificar cliente</h4>
              </div>
              <div class="panel-body">
                <form class="form-horizontal" action="#" method="post">
                  <div class="form-group">
                    <label class=" col-sm-2">ID:</label>
                    <div class="col-sm-10">
                     <input class="form-control" type="text" name="id" value="<?php echo $id; ?>" readonly >
                    </div>
                  </div>
                  <div class="form-group">
                    <label class=" col-sm-2">Nombre:</label>
                    <div class="col-sm-10">
                      <input class="form-control" type="text" name="nom_mod" value="<?php echo $nom;?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2">Apellidos:</label>
                    <div class="col-sm-10">
                      <input class="form-control" type="text" name="ape_mod" value="<?php echo $ape;?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2">Dirección:</label>
                    <div class="col-sm-10">
                      <input class="form-control" type="text" name="dir_mod" value="<?php echo $dir;?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2">Tlf 1:</label>
                    <div class="col-sm-10">
                      <input class="form-control" type="text" name="tel1_mod" value="<?php echo $t1;?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2">Tlf 2:</label>
                    <div class="col-sm-10">
                      <input class="form-control" type="text" name="tel2_mod" 
                      value="<?php if ($t2) {echo $t2;} ?>"> <!-- PREGUNTAR!! -->
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2">Usuario:</label>
                    <div class="col-sm-10">
                      <input class="form-control" type="text" name="usuario" 
                      value="<?php echo $usuario;?>"> 
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2">Contraseña:</label>
                    <div class="col-sm-10">
                      <input class="form-control" type="text" name="password" 
                      placeholder="Si desea modificar la contraseña escriba la nueva contraseña aquí"> 
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12 col-sm-offset-4">
                      <div class="col-sm-2">
                        <input class="form-control btn-primary" type="submit" name="guardar" value="Guardar">
                      </div>
                      <div class="col-sm-2">
                        <a href="./clientes.php" class="btn btn-danger">Cancelar</a>
                      </div>
                    </div>
                  </div>
                </form>

                <!-- Código PHP que actualiza los datos en la BD -->
                <?php 
              }
                  // si pulsa en cancelar se le redirige a la sección clientes
                  if (isset($_POST['cancelar'])) {
                    echo "<META HTTP-EQUIV='REFRESH'CONTENT='1;URL=clientes.php'>";
                  }

                  // si decide guardar los cambios
                  if (isset($_POST['guardar'])) {

                    if ($_POST['password'] == '') {
                      // no se modifica la contraseña
                      $id = $_POST['id'];                    
                      $nombre = $_POST['nom_mod'];
                      $apellidos = $_POST['ape_mod'];
                      $direccion = $_POST['dir_mod'];
                      $tel1 = $_POST['tel1_mod'];
                      $tel2 = $_POST['tel2_mod'];
                      $usuario = $_POST['usuario'];

                      $conexion = abrirConexion();
                      $actualizar = "update clientes set nombre='$nombre',apellidos='$apellidos',direccion='$direccion',telefono1='$tel1',telefono2='$tel2', nombre_usuario='$usuario' where id='$id'";

                      if (mysqli_query($conexion,$actualizar)) {
                        echo "<div class='alert alert-success col-sm-6 col-sm-offset-3' align='center'>
                            <b>Datos actualizados correctamente</b> 
                          </div>";

                        echo "<META HTTP-EQUIV='REFRESH'CONTENT='1;URL=clientes.php'>";
                      } else {
                        echo "<div class='container-fluid'><div class='row'><div class='alert alert-danger col-sm-6 col-sm-offset-3' align='center'>
                        <h4><strong>¡Error!</strong> No se han podido actualizar los datos</h4>
                      </div></div></div>";
                      }
                      
                    } else {
                      // si se modifica
                      $id = $_POST['id'];                    
                      $nombre = $_POST['nom_mod'];
                      $apellidos = $_POST['ape_mod'];
                      $direccion = $_POST['dir_mod'];
                      $tel1 = $_POST['tel1_mod'];
                      $tel2 = $_POST['tel2_mod'];
                      $usuario = $_POST['usuario'];
                      $password = $_POST['password'];
                  
                      $password = md5(md5($password));

                      $conexion = abrirConexion();
                      $actualizar = "update clientes set nombre='$nombre',apellidos='$apellidos',direccion='$direccion',telefono1='$tel1',telefono2='$tel2', nombre_usuario='$usuario',pass='$password' where id='$id'";

                      if (mysqli_query($conexion,$actualizar)) {
                        echo "<div class='alert alert-success col-sm-6 col-sm-offset-3' align='center'>
                            <b>Datos actualizados correctamente</b> 
                          </div>";

                        echo "<META HTTP-EQUIV='REFRESH'CONTENT='1;URL=clientes.php'>";
                      } else {
                        echo "<div class='container-fluid'><div class='row'><div class='alert alert-danger col-sm-6 col-sm-offset-3' align='center'>
                        <h4><strong>¡Error!</strong> No se han podido actualizar los datos</h4>
                      </div></div></div>";
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