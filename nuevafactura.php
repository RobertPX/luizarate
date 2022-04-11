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
  $tipomov= $_SESSION['tipos'];
?>

<!DOCTYPE html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Nueva Factura</title>
  <!-- CSS-->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" type="text/css" href="css/component.css" />
  <link rel="stylesheet" href="plugins/smoothness/jquery-ui.css">
  <!-- icono de la pagina -->
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
  if ($tipomov=='proveedor') {
    $active_compra="active";
  }else{
    $active_venta="active";
  }
  

  include 'lib/barra.php';
?>
<!-- Fin Menu izquierdo-->

  	<!-- Inicio interior blanco-->
    <div class="content-wrapper">

    <!-- Inicio para contenido-->
    <section class="content">

      
  <div class="panel panel-info">
    <div class="panel-heading">
      <h4><i class='glyphicon glyphicon-edit'></i> Nueva Factura</h4>
    </div>
    <div class="panel-body">
    <?php
      include("modal/buscarproductos.php");
      include("modal/registrocatalogo.php");
      include("modal/registroclientes.php");
      include("modal/autocliente.php");
      ?>
      <form class="form-horizontal" role="form" id="datosfactura">
        <div class="form-group row">
          <!-- llenado de los datos para la factura-->
          <label for="nit" class="col-md-1 control-label">NIT</label>
            <div class="col-md-2">
              <input type="text" class="form-control input-sm" id="nit" placeholder="NIT" required>
              <input id="codaux" type='hidden'> 
            </div>

          <label for="nomaux" class="col-md-1 control-label"><?php echo "$tipomov"; ?></label>
            <div class="col-md-2">
              <input type="text" class="form-control input-sm" id="nomaux" placeholder="<?php echo "$tipomov"; ?>" readonly>
            </div>
          
          <label for="telefono" class="col-md-1 control-label">Telefono</label>
              <div class="col-md-2">
                <input type="text" class="form-control input-sm" id="telefono" placeholder="Telefono" readonly>
              </div>

          <label for="celular" class="col-md-1 control-label">Celular</label>
              <div class="col-md-2">
                <input type="text" class="form-control input-sm" id="celular" placeholder="Celular" readonly>
              </div>
         </div>
            <div class="form-group row">
              
              <label for="tel2" class="col-md-1 control-label">Fecha</label>
              <div class="col-md-2">
                <input type="text" class="form-control input-sm" id="fecha" value="<?php echo date("d/m/Y");?>" readonly>
              </div>
              <label for="email" class="col-md-1 control-label">Pago</label>
              <div class="col-md-3">
                <select class='form-control input-sm' id="condiciones">
                  <option value="1">Efectivo</option>
                  <option value="2">Cheque</option>
                  <option value="3">Transferencia bancaria</option>
                  <option value="4">Crédito</option>
                </select>
              </div>

              <label for="empresa" class="col-md-1 control-label">Vendedor</label>
              <div class="col-md-3">
                <select class="form-control input-sm" id="id_vendedor">
                  <?php

                    $cod = $_SESSION['nomuser'];
                    $sql_vendedor=mysql_query("select * from usuario where nomuser = '$cod'");
                    while ($rw=mysql_fetch_array($sql_vendedor)){
                      $id_vendedor=$rw["coduser"];
                      $nombre_vendedor=$rw["nomlargo"];
                      if ($id_vendedor==$_SESSION['codaux']){
                        $selected="selected";
                      } else {
                        $selected="";
                      }
                      ?>
                      <option value="<?php echo $id_vendedor?>" <?php echo $selected;?>><?php echo $nombre_vendedor?></option>
                      <?php
                    }
                  ?>
                </select>
              </div>

            </div>
        
        <!-- botones -->
        <div class="col-md-12">
          <div class="pull-right">
            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#nuevoProducto">
             <span class="glyphicon glyphicon-plus"></span> Nuevo producto
            </button>
            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#nuevoCliente">
             <span class="glyphicon glyphicon-user"></span> Nuevo cliente
            </button>
            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">
             <span class="glyphicon glyphicon-search"></span> Agregar productos
            </button>
            <button type="submit" class="btn btn-default">
              <span class="glyphicon glyphicon-print"></span> Imprimir
            </button>
          </div>  
        </div>
        
      </form> 
      
      
    <div id="resultados" class='col-md-12' style="margin-top:10px"></div><!-- Carga los datos ajax -->      
    </div>
  </div>    
      <div class="row-fluid">
      <div class="col-md-12">
      
  <?php

  ?>

      
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

<script type="text/javascript" src="js/VentanaCentrada.js"></script>
<script type="text/javascript" src="js/nuevafactura.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="plugins/fastclick/fastclick.js"></script>
<script src="dist/js/app.min.js"></script>
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="js/custom-file-input.js"></script>
<script src="plugins/jQueryUI/jquery-ui.js"></script>
    
<script> //script para el auto completado al seleccionar el nit
    $(function() {
            $("#nit").autocomplete({
              source: "./ajax/autocliente.php",
              minLength: 2,
              select: function(event, ui) {
                event.preventDefault();
                $('#codaux').val(ui.item.codaux);
                $('#nomaux').val(ui.item.nomaux);
                $('#telefono').val(ui.item.telefono);
                $('#celular').val(ui.item.celular);
                $('#nit').val(ui.item.nit);
              }
            });
    });
          
    $("#nit" ).on( "keydown", function( event ) {
            if (event.keyCode== $.ui.keyCode.LEFT || event.keyCode== $.ui.keyCode.RIGHT || event.keyCode== $.ui.keyCode.UP || event.keyCode== $.ui.keyCode.DOWN || event.keyCode== $.ui.keyCode.DELETE || event.keyCode== $.ui.keyCode.BACKSPACE )
            {
              $("#codaux" ).val("");
              $("#nomaux" ).val("");
              $("#telefono" ).val("");
              $("#celular" ).val("");
                      
            }
            if (event.keyCode==$.ui.keyCode.DELETE){
              $("#nomaux" ).val("");
              $("#codaux" ).val("");
              $("#telefono" ).val("");
              $("#celular" ).val("");
              $("#nit" ).val("");
            }
      }
      ); 
  </script>
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

    $( "#guardar_cliente" ).submit(function( event ) {
  $('#guardar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
   $.ajax({
      type: "POST",
      url: "ajax/nuevocliente.php",
      data: parametros,
       beforeSend: function(objeto){
        $("#resultados_ajax").html("Mensaje: Cargando...");
        },
      success: function(datos){
      $("#resultados_ajax").html(datos);
      $('#guardar_datos').attr("disabled", false);
      load(1);
      }
  });
  event.preventDefault();
})
</script>
</body>
</html>
