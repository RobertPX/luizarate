<?php
session_start();
  include 'lib/conexion.php';

  ini_set('error_reporting',0);

  if(!isset($_SESSION['nomuser'])){
    header("Location: login.php");
  }

  $_SESSION['tipos']=1;
  $sucursal= $_SESSION['tipos'];
?>

<!DOCTYPE html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ENVIAR</title>
  <!-- CSS-->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" type="text/css" href="css/component.css" />
  <link rel="stylesheet" href="css/fondo.css">
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
<body class="hold-transition skin-red sidebar-mini">
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
            include("modal/registroabarrote.php");
            include("modal/enviarabarrote.php");
            include("modal/editarabarrote.php");
        ?>
      <form class="form-horizontal" role="form" id="datos_cotizacion">
        <div class="panel panel-info">
          <div class="panel-heading">
            <div class="form-group row">
              <label for="q" class="col-md-2 control-label">Nombre de Producto</label>
              <div class="col-md-5">
                <input type="text" class="form-control" id="q" placeholder="Nombre del producto" onkeyup='load(1);'>
              </div>
              <div class="col-md-3">
                <button type="button" class="btn btn-default" onclick='load(1);'>
                  <span class="glyphicon glyphicon-search" ></span> Buscar</button>
                <span id="loader"></span>
              </div>
              
            </div>
          </div>
        </div>
        
        
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
<script type="text/javascript" src="js/VentanaCentrada.js"></script>
<script type="text/javascript" src="js/abarrotes.js"></script>
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
      url: "ajax/nuevoabarrote.php",
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
      url: "ajax/editarabarrote.php",
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
      var codaba = $("#codaba"+id).val();
      var nombre = $("#nombre"+id).val();
      var stock = $("#stock"+id).val();
      var sucursal = <?php echo $sucursal ?>;
      $("#mod_id").val(id);
      $("#mod_codaba").val(codaba);
      $("#mod_nombre").val(nombre);
      $("#mod_stock").val(stock);
      $("#mod_sucursal").val(sucursal);
    }
</script>
</body>
</html>
