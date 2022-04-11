<?php
session_start();
include 'lib/conexion.php';
  include 'ajax/pagination.php';

ini_set('error_reporting',0);

if(!isset($_SESSION['nomuser'])){
  header("Location: login.php");
}

if(isset($_POST['NUMERO'])) {

      $pagina = mysql_real_escape_string($_POST['va']);
            mysql_query("UPDATE config SET pagina='$pagina' WHERE codcof='1'");
  }
?>

<!DOCTYPE html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Clientes</title>
  <!-- CSS-->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" type="text/css" href="css/component.css" />
  <link rel=icon href='img/logo-icon.png' sizes="32x32" type="image/png">
  <script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>

    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.jscroll.js"></script>
    <style type="text/css">
      .scroll{
        width: 100%;
      }
      .scroll .jscroll-loading{
        width:10%;
        margin: -500px auto;
      }
    </style>

    <script>
    function abrir(url){
      open(url,'','top=400,width=400,height=400')
    }  
    </script>
</head>

<!-- color-->
<body class="hold-transition skin-red sidebar-mini">
<div class="wrapper">

<!-- Inicio Menus -->
<?php
  $active_clientes="active";

  include 'lib/barra.php';
?>
<!-- Fin Menus-->

    <!-- Inicio interior blanco-->
  <div class="content-wrapper">

    <!-- Inicio para contenido-->

    <section class="content">
      <section class="content">
        <div class="panel-body">
          <?php
            //archivos modal
            include("modal/registroclientes.php");
            include("modal/editarclientes.php");
          ?>
          <form class="form-horizontal" role="form" id="datos_cotizacion">
            <div class="panel panel-info">
              <div class="panel-heading">
                <div class="form-group row">
                  <label for="q" class="col-md-2 control-label">Cliente</label>
                  <div class="col-md-5">
                    <input type="text" class="form-control" id="q" placeholder="Nombre del cliente o NIT" onkeyup='load(1);'>
                  </div>
                  <div class="col-md-3">
                    <button type="button" class="btn btn-default" onclick='load(1);'>
                    <span class="glyphicon glyphicon-search" ></span> Buscar</button>
                    <span id="loader"></span>
                  </div>

                  <div class="panel-heading">
                    <div class="btn-group pull-left">
                      <button type='button' class="btn btn-primary" data-toggle="modal" data-target="#nuevoCliente"><span class="glyphicon glyphicon-plus" ></span> Nuevo Cliente</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
          <form action="" method="post">
            <?php
              $nom=mysql_fetch_array(mysql_query("SELECT pagina FROM config WHERE codcof='1'"));
            ?>
            <p><input type="number" id="va" name="va" value="<?php echo $nom['pagina']; ?>" min="1" max="250"> <!-- Numero de resultados -->
            <button type="submit" name="NUMERO" class="btn btn-default">GO</button></p>
          </form>
        <div id="resultados"></div><!-- Carga los datos ajax -->
        <div class='outer_div'></div><!-- Carga los datos ajax -->
        </div>
          

      </section>
    </section>
    <!-- Fin para contenido-->
  </div>
  <!-- fin interior blanco-->
</div>

<script type="text/javascript" src="js/clientes.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="plugins/fastclick/fastclick.js"></script>
<script src="dist/js/app.min.js"></script>
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="js/custom-file-input.js"></script>
</body>
</html>
