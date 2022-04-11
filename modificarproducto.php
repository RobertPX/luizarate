<?php
session_start();
  include 'lib/conexion.php';

  ini_set('error_reporting',0);

  if(!isset($_SESSION['nomuser'])){
    header("Location: login.php");
  }

  $codigo=strval($_GET['codigo']);

  if(isset($_POST['MODIFICAR'])) {

      $codarticulo = mysql_real_escape_string($_POST['codarticulo']);
      $descripcioncorta = mysql_real_escape_string($_POST['descripcioncorta']);
      $descripcionadicional = mysql_real_escape_string($_POST['descripcionadicional']);
      $costo = mysql_real_escape_string($_POST['costo']);
      $precio1 = mysql_real_escape_string($_POST['precio1']);
      $precio2 = mysql_real_escape_string($_POST['precio2']);
      $precio3 = mysql_real_escape_string($_POST['precio3']);
      $unidad = mysql_real_escape_string($_POST['unidad']);
            mysql_query("UPDATE catalogo SET codarticulo='$codarticulo',descripcioncorta='$descripcioncorta', descripcionadicional='$descripcionadicional',costo='$costo',precio1='$precio1', precio2='$precio2', precio3='$precio3', unidad='$unidad' WHERE codcatalogo='$codigo'");
            header("Refresh: 1; url = catalogo.php");
  }
?>

<!DOCTYPE html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Modificar Producto</title>
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
  $active_productos="active";

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
  <form action="" method="post">
    <?php
    $cod=mysql_fetch_array(mysql_query("SELECT codarticulo FROM catalogo WHERE codcatalogo='$codigo'"));
    $nom=mysql_fetch_array(mysql_query("SELECT descripcioncorta FROM catalogo WHERE codcatalogo='$codigo'"));
    $desnom=mysql_fetch_array(mysql_query("SELECT descripcionadicional FROM catalogo WHERE codcatalogo='$codigo'"));
    $cos=mysql_fetch_array(mysql_query("SELECT costo FROM catalogo WHERE codcatalogo='$codigo'"));
    $pre1=mysql_fetch_array(mysql_query("SELECT precio1 FROM catalogo WHERE codcatalogo='$codigo'"));
    $pre2=mysql_fetch_array(mysql_query("SELECT precio2 FROM catalogo WHERE codcatalogo='$codigo'"));
    $pre3=mysql_fetch_array(mysql_query("SELECT precio3 FROM catalogo WHERE codcatalogo='$codigo'"));

    ?>
      <div class="form-group has-feedback">
        <input type="text" name="codarticulo" class="form-control" placeholder="Codigo" value="<?php echo $cod['codarticulo']; ?>" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="descripcioncorta" class="form-control" placeholder="Nombre Producto" value="<?php echo $nom['descripcioncorta']; ?>" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="descripcionadicional" class="form-control" placeholder="Descripcion Producto" value="<?php echo $desnom['descripcionadicional']; ?>">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="costo" class="form-control" placeholder="Costo" value="<?php echo $cos['costo']; ?>" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="precio1" class="form-control" placeholder="Precio 1" value="<?php echo $pre1['precio1']; ?>" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="precio2" class="form-control" placeholder="Precio 2" value="<?php echo $pre2['precio2']; ?>" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="precio3" class="form-control" placeholder="Precio 3" value="<?php echo $pre3['precio3']; ?>" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="col-md-7">
        <select class="form-control input-sm" id="unidad" name="unidad">
          <?php
            $unidad=mysql_query("select * from unidadmedida");
            while ($rw=mysql_fetch_array($unidad)){
              $id_unidad=$rw["unidadmedida"];
              $unidadmedida=$rw["unidadmedida"];
              if ($unidad==$unidadmedida){
                $selected="selected";
              } else {
                $selected="";
              }
              ?>
              <option value="<?php echo $id_unidad?>" <?php echo $selected;?>><?php echo $unidadmedida?></option>
              <?php
            }
          ?>
        </select>
      </div>
      <div class="row">
        <div class="col-xs-10">
          
        </div>
        <div class="col-xs-12">
          <button type="submit" name="MODIFICAR" class="btn btn-primary btn-block btn-flat">MODIFICAR</button>
          <a  href="catalogo.php" class="btn btn-default"><span></span> Cancelar </a>
        </div>
      </div>
    </form>


      </div>
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
