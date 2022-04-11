<?php
session_start();
include 'lib/conexion.php';

ini_set('error_reporting', 0);

if (!isset($_SESSION['nomuser'])) {
  header("Location: login.php");
}

if (isset($_SESSION['tipo'])) {
  $admi = "si";
}
?>

<!DOCTYPE html>
<html class="no-js">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Inicio</title>
  <!-- CSS-->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  <!-- <link rel="stylesheet" href="css/fondo.css"> -->

  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link href="css/bootstrap.min.css" rel="stylesheet"> 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" type="text/css" href="css/component.css" />

  <link rel="stylesheet" href="css/fondo.css">

  <link rel=icon href='img/logo-icon.png' sizes="32x32" type="image/png">
  <script>
    (function(e, t, n) {
      var r = e.querySelectorAll("html")[0];
      r.className = r.className.replace(/(^|\s)no-js(\s|$)/, "$1js$2")
    })(document, window, 0);
  </script>
  <!-- Scroll -->
  <script src="js/jquery.min.js"></script>
  <script src="js/jquery.jscroll.js"></script>
  <style type="text/css">
    .scroll {
      width: 100%;
    }

    .scroll .jscroll-loading {
      width: 10%;
      margin: -500px auto;
    }
  </style>
</head>

<!-- color-->
<body class="hold-transition skin-red sidebar-mini">
  <div class="wrapper">

    <!-- Inicio Menu izquierdo -->
    <?php
    $active_inicio = "active";

    include 'lib/barra.php';
    ?>
    <!-- Fin Menu izquierdo-->

    <!-- Inicio interior blanco-->
    <div class="content-wrapper" style="background-image: url(img/madera.png);">

      <!-- Inicio para contenido-->
      <section class="content centro">

        <div class="login-logo" align="center">
          <a align="center" style="color:black"><b style="text-shadow: 2px 2px 5px white">SELECCIONE SUCURSAL A LA QUE DESEA ENVIAR</b></a>
        </div>

        <div class="form-group">
        <a submit="1" class="boton hijo btn-lg" href="enviar.php">Sopocachi</a>
        <a submit="2" class="boton hijo btn-lg" href="enviar.php">Obrajes</a>
        <a submit="3" class="boton hijo btn-lg" href="enviar.php">MegaCenter</a>
        <a submit="4" class="boton hijo btn-lg" href="enviar.php">San Miguel</a>
        <a submit="5" class="boton hijo btn-lg" href="enviar.php">Bush</a>
        <a submit="6" class="boton hijo btn-lg" href="enviar.php">Diaz Romero</a>
        <a submit="7" class="boton hijo btn-lg" href="enviar.php">Patio</a>
        <a submit="8" class="boton hijo btn-lg" href="enviar.php">Multicine</a>
        <a submit="9" class="boton hijo btn-lg" href="enviar.php">Plaza Uyuni</a>
        <a submit="10" class="boton hijo btn-lg" href="enviar.php">Rio Seco</a>
        <a submit="11" class="boton hijo btn-lg" href="enviar.php">Cielo Mall</a>
        </div>

        <!-- Validar caracteres Scripts -->
        <script type="text/javascript">
          function validarn(e) {
            tecla = (document.all) ? e.keyCode : e.which;
            if (tecla == 8) return true;
            if (tecla == 9) return true;
            if (tecla == 11) return true;
            patron = /[A-Za-zñ!#$%&()=?¿¡*+0-9-_á-úÁ-Ú :;,.]/;

            te = String.fromCharCode(tecla);
            return patron.test(te);
          }
        </script>
      </section>
      <!-- Fin para contenido-->
    </div>
    <!-- fin interior blanco-->
  </div>

  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="plugins/fastclick/fastclick.js"></script>
  <script src="dist/js/app.min.js"></script>
  <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
  <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <script src="js/custom-file-input.js"></script>
</body>

</html>