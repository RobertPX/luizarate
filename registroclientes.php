<?php
session_start();
  include 'lib/conexion.php';

  ini_set('error_reporting',0);

  if(!isset($_SESSION['nomuser'])){
    header("Location: login.php");
  }

  if(isset($_SESSION['tipo']))
  {
  $admi = "si";
  }

    if(isset($_POST['registrar'])) {

      $nombre = mysql_real_escape_string($_POST['nombre']);
      $apaterno = mysql_real_escape_string($_POST['apaterno']);
      $amaterno = mysql_real_escape_string($_POST['amaterno']);
      $nit = mysql_real_escape_string(($_POST['nit']));
      $razonsocial = mysql_real_escape_string(($_POST['razonsocial']));

      //comprueba si hay mas nit iguales
      $comprobarnit = mysql_num_rows(mysql_query("SELECT nit FROM clientes WHERE nit = '$nit'"));

      if($comprobarnit >= 1) { 
        $mensaje = 'no';
        
        } else {
        

        $insertar = mysql_query("INSERT INTO clientes (nombre,apaterno,amaterno,nit,razonsocial) values ('$nombre','$apaterno','$amaterno','$nit','$razonsocial')");

          if($insertar) { 
            $mensaje ='si';
            
            header("Refresh: 2; url = clientes.php");
          }

      }

    }
?>

<!DOCTYPE html>
<html class="no-js">
<head>
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
<!-- Fin Menu izquierdo-->

  	<!-- Inicio interior blanco-->
    <div class="content-wrapper">

    <!-- Inicio para contenido-->

    <section class="content">
    	<div class="register-box">
  <!-- Caja -->
  <div class="register-box-body">
          <div class="register-box-body">
    <p class="login-box-msg">Regístrar cliente</p>

    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="nombre" class="form-control" placeholder="Nombre" value="<?php echo $_POST['nombre']; ?>" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="apaterno" class="form-control" placeholder="Apellido Paterno" value="<?php echo $_POST['apaterno']; ?>">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="amaterno" class="form-control" placeholder="Apellido Materno" value="<?php echo $_POST['amaterno']; ?>">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="nit" class="form-control" placeholder="NIT" value="<?php echo $_POST['nit']; ?>" required>
        <span class="glyphicon glyphicon-star form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="razonsocial" class="form-control" placeholder="Razon Social" value="<?php echo $_POST['razonsocial']; ?>" required>
        <span class="glyphicon glyphicon-star form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-10">
          
        </div>
        <div class="col-xs-12">
          <button type="submit" name="registrar" class="btn btn-primary btn-block btn-flat">Registrar</button>
        </div>
      </div>
      <a  href="clientes.php" class="btn btn-default"><span></span> Cancelar </a>
    </form>
    
    <!-- Verificacion de de cuentas similares y si no hay ingresa datos a la BD -->

    <?php
    if($mensaje == 'no'){
      ?>

        <br>
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          El NIT está en uso
        </div>

      <?php } else {
        if($mensaje == 'si'){
        ?>

            <br>
            <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              Felicidades ha registrado correctamente
            </div>

            <?php
        }
      }
    ?>
    <br>
    
  </div>

    	<!-- Validar caracteres Scripts -->
      <script type="text/javascript">

    		function validarn(e) {
    			tecla = (document.all) ? e.keyCode : e.which;
   				if (tecla==8) return true;
   				if (tecla==9) return true;
   				if (tecla==11) return true;
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
