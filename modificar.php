<?php
session_start();
  include 'lib/conexion.php';

  ini_set('error_reporting',0);

  if(!isset($_SESSION['nomuser'])){
    header("Location: login.php");
  }

  if(isset($_POST['MODIFICAR'])) {

      $nombre = mysql_real_escape_string($_POST['nombre']);
      $apaterno = mysql_real_escape_string($_POST['apaterno']);
      $amaterno = mysql_real_escape_string($_POST['amaterno']);
      $nit = mysql_real_escape_string(($_POST['nit']));
      $razonsocial = mysql_real_escape_string(($_POST['razonsocial']));
            mysql_query("UPDATE clientes SET codcli='{$_REQUEST['codcli']}',nombre='$nombre',apaterno='$apaterno',amaterno='$amaterno',nit='$nit',razonsocial='$razonsocial' WHERE codcli={$_REQUEST['codcli']}");
            header("Refresh: 1; url = clientes.php");
        }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Registrar Cliente</title>
  <!-- CSS-->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" type="text/css" href="css/component.css" />
  <link rel=icon href='img/logo-icon.png' sizes="32x32" type="image/png"> <!-- imagen del icono de la pagina -->
  <script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>
    <!-- Scroll -->
  	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
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
</head>
<!-- color-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

<!-- Inicio Menu izquierdo -->
<?php
  $active_clientes="active";

  include 'lib/barra.php';
?>

  <div class="content-wrapper">
	<section class="content">
    	<div class="register-box">
  <!-- Caja -->
  <div class="register-box-body">
          <div class="register-box-body">
	<form action="" class="form-horizontal" method="post" id="editar_cliente" name="editar_cliente">
    <?php
    $nom=mysql_fetch_array(mysql_query("SELECT nombre FROM clientes WHERE codcli={$_REQUEST['codcli']}"));
    $apa=mysql_fetch_array(mysql_query("SELECT apaterno FROM clientes WHERE codcli={$_REQUEST['codcli']}"));
    $ama=mysql_fetch_array(mysql_query("SELECT amaterno FROM clientes WHERE codcli={$_REQUEST['codcli']}"));
    $ni=mysql_fetch_array(mysql_query("SELECT nit FROM clientes WHERE codcli={$_REQUEST['codcli']}"));
    $razo=mysql_fetch_array(mysql_query("SELECT razonsocial FROM clientes WHERE codcli={$_REQUEST['codcli']}"));

    ?>
      
      <div class="form-group has-feedback">
        <input type="text" name="nombre" class="form-control" placeholder="Nombre" value="<?php echo $nom['nombre']; ?>" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="apaterno" class="form-control" placeholder="Apellido Paterno" value="<?php echo $apa['apaterno']; ?>">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="amaterno" class="form-control" placeholder="Apellido Materno" value="<?php echo $ama['amaterno']; ?>">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="nit" class="form-control" placeholder="NIT" value="<?php echo $ni['nit']; ?>" required>
        <span class="glyphicon glyphicon-star form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="razonsocial" class="form-control" placeholder="Razon Social" value="<?php echo $razo['razonsocial']; ?>" required>
        <span class="glyphicon glyphicon-star form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-10">
          
        </div>
        <div class="col-xs-12">
          <button type="submit" name="MODIFICAR" class="btn btn-primary btn-block btn-flat">MODIFICAR</button>
          <a  href="clientes.php" class="btn btn-default"><span></span> Cancelar </a>
        </div>
      </div>
    </form>


      </div>
  </div>
</div>
</section>
</body>
</html>