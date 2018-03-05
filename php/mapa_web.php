<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mapa web</title>
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
    <!-- Documento php con funciones -->
    <?php include "funciones.php"; ?>
  </head>
  <body>
    
    <!-- Menú de navegación -->
    <nav class='menu navbar navbar-inverse navbar-fixed-top texto'>
            <div class='container-fluid'>
              <div class='navbar-header'>
                <button type='button' class='n-resp navbar-toggle ' data-toggle='collapse' data-target='#nav-responsive'>
                  <span class='icon-bar b-resp'></span>
                  <span class='icon-bar b-resp'></span>
                  <span class='icon-bar b-resp'></span>                        
                </button>
                <img src='../logo.png' alt='inmobiliaria' width='20%'>
              </div>
              <div class='collapse navbar-collapse' id='nav-responsive'>
              <ul class='nav navbar-nav navbar-right'>
                <li><a href='../index.php'><span class='glyphicon glyphicon-home'></span> Inicio</a></li>
                <li><a href='ver_todos.php'><span class='glyphicon glyphicon-briefcase'></span> Inmuebles</a></li>
                <li><a href='contacto.php'><span class='glyphicon glyphicon-envelope'></span> Contacto</a></li>
                <li><a href='acceder.php'><span class='glyphicon glyphicon-log-in'></span> Acceder</a></li>
              </ul>
              </div>
            </div>
      </nav>
    
    <!-- Mapa web -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12 menu-inicio " align="center">
          <h2>Mapa web</h2>
          <h3><a href="../index.php">Inicio</a><br></h3>
          <h3><a href="ver_todos.php">Inmuebles</a><br></h3>
          <h3><a href="contacto.php">Contacto</a><br></h3>
          <h3><a href="acceder.php">Acceder</a></h3>
        </div>
      </div>
    </div>
    
    <!-- footer -->
    <footer class="navbar-nav navbar-inverse">
      <p align="center"><a class="aweb" href="../php/mapa_web.php">Mapa web</a> | Estamos en Av. Doctor Oloriz, 6 (Granada) | Teléfono: 611622633 | Email: info@inmobiliaria.com</p>
    </footer>
  </body>
</html>