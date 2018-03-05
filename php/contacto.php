<?php session_start() ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contacto</title>
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
    <?php include "../php/funciones.php"; ?>
  </head>
  <body>
    
    <!-- Menú de navegación -->
    <?php tipoMenu(); ?>
    
    <!-- Formulario de contacto -->
    
    <div class="container-fluid menu-inicio">
      <div class="row">
          <h2 align="center">Si quieres ponerte en contacto con nosotros puedes rellenar el siguiente formulario</h2>
          <h2 align="center">Trataremos de responderte lo antes posible</h3>
          <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
              <div class="panel-body">
                <form action="#" method="post" accept-charset="utf-8">
                  <div class="form-group">
                    <label class="col-sm-2" for="nombre">* Nombre</label>
                    <div class="col-sm-10 ">
                      <input class="form-control " type="text" name="nombre" placeholder="escribe aquí tu nombre" autofocus>
                    </div>
                  </div>
                  <br>
                  <div class="form-group">
                    <label class="col-sm-2" for="nombre"> * Email</label>
                    <div class="col-sm-10 ">
                      <input class="form-control" type="text" name="email" placeholder="escribe aquí tu email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2" for="nombre"> Teléfono</label>
                    <div class="col-sm-10 ">
                      <input class="form-control" type="text" name="telefono" placeholder="escribe aquí tu teléfono">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2" for="nombre"> Asunto</label>
                    <div class="col-sm-10 ">
                      <label class="radio-inline">
                        <input type="radio" name="asunto">Pedir información
                      </label>
                      <label class="radio-inline">
                        <input type="radio" name="asunto">Consulta
                      </label>
                      <label class="radio-inline">
                        <input type="radio" name="asunto">Sugerencia
                      </label>
                    </div>
                  </div>
                  . <br>
                  <div class="form-group">
                    <label class=" col-sm-2">* Mensaje</label>
                    <div class="col-sm-10">
                      <textarea id="des" class="form-control" name="descripcion" rows="5"></textarea>
                    </div>
                  </div>
                  . <br>
                  <div class="form-group">
                    <div class="col-sm-12 col-sm-offset-5">
                      <div class="col-sm-2">
                        <input class="form-control btn-primary" type="submit" name="guardar" value="Guardar">
                      </div>
                    </div>
                  </div>
                </form>
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