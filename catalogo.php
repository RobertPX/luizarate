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
  <title>Catalogo</title>
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
      <section class="content">
        <?php
            //archivos modal
            include("modal/registrocatalogo.php");
            include("modal/editarcatalogo.php");
        ?>
      <form class="form-horizontal" role="form" id="datos_cotizacion">
        <div class="panel panel-info">
          <div class="panel-heading">
            <div class="form-group row">
              <label for="q" class="col-md-2 control-label">Código o nombre</label>
              <div class="col-md-5">
                <input type="text" class="form-control" id="q" placeholder="Código o nombre del producto" onkeyup='load(1);'>
              </div>
              <div class="col-md-3">
                <button type="button" class="btn btn-default" onclick='load(1);'>
                  <span class="glyphicon glyphicon-search" ></span> Buscar</button>
                <span id="loader"></span>
              </div>
              

      <div class="btn-group pull-left">
        <button type='button' class="btn btn-primary" data-toggle="modal" data-target="#nuevoProducto"><span class="glyphicon glyphicon-plus" ></span> Nuevo Producto</button>
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
		</section>
		<!-- Fin para contenido-->
	</div>
  <!-- fin interior blanco-->
</div>
<script type="text/javascript" src="js/productos.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="plugins/fastclick/fastclick.js"></script>
<script src="dist/js/app.min.js"></script>
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="js/custom-file-input.js"></script>
<script>
$( "#guardar_producto" ).submit(function( event ) {
  $('#guardar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
   $.ajax({
      type: "POST",
      url: "ajax/nuevocatalogo.php",
      data: parametros,
       beforeSend: function(objeto){
        $("#resultados_ajax_productos").html("Mensaje: Cargando...");
        },
      success: function(datos){
      $("#resultados_ajax_productos").html(datos);
      $('#guardar_datos').attr("disabled", false);
      load(1);
      }
  });
  event.preventDefault();
})

$( "#editar_producto" ).submit(function( event ) {
  $('#actualizar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
   $.ajax({
      type: "POST",
      url: "ajax/editarcatalogo.php",
      data: parametros,
       beforeSend: function(objeto){
        $("#resultados_ajax2").html("Mensaje: Cargando...");
        },
      success: function(datos){
      $("#resultados_ajax2").html(datos);
      $('#actualizar_datos').attr("disabled", false);
      load(1);
      }
  });
  event.preventDefault();
})

  function obtener_datos(id){
      var codarticulo = $("#codarticulo"+id).val();
      var descripcioncorta = $("#descripcioncorta"+id).val();
      var descripcionadicional = $("#descripcionadicional"+id).val();
      var costo = $("#costo"+id).val();
      var precio1 = $("#precio1"+id).val();
      var precio2 = $("#precio2"+id).val();
      var precio3 = $("#precio3"+id).val();
      var unidad = $("#unidad"+id).val();
      $("#mod_id").val(id);
      $("#mod_codarticulo").val(codarticulo);
      $("#mod_descripcioncorta").val(descripcioncorta);
      $("#mod_descripcionadicional").val(descripcionadicional);
      $("#mod_costo").val(costo);
      $("#mod_precio1").val(precio1);
      $("#mod_precio2").val(precio2);
      $("#mod_precio3").val(precio3);
      $("#mod_unidad").val(unidad);
    }
</script>
</body>
</html>
