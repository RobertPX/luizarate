<?php
session_start();
include 'lib/conexion.php';

ini_set('error_reporting',0);

if(!isset($_SESSION['nomuser']))
{
  header("Location: login.php");
}

if(!isset($_SESSION['tipo']))
{
  header("Location: index.php");
}
?>

<!DOCTYPE html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Usuarios</title>
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
</head>

<!-- color-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

<!-- Inicio Menu izquierdo -->
<?php
  $active_usuarios="active";

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
    <p class="login-box-msg">Regístrate</p>

    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="nomlargo" class="form-control" placeholder="Nombre completo" value="<?php echo $_POST['nomlargo']; ?>" required>
        <span class="glyphicon glyphicon-star form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="nomuser" class="form-control" placeholder="Usuario" value="<?php echo $_POST['nomuser']; ?>" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="contrasena" class="form-control" placeholder="Contraseña" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="repcontrasena" class="form-control" placeholder="Repita la contraseña" required>
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <select name="tipo" class='form-control input-sm'>
          <option value="admi" required>
            Administrador
          </option>
          <option value="invi" required>
            Invitado
          </option>
        </select>
      </div>

      <div class="row">
        <div class="col-xs-10">
          
        </div>
        <div class="col-xs-12">
          <button type="submit" name="registrar" class="btn btn-primary btn-block btn-flat">Registrarme</button>
        </div>
      </div>
    </form>

    <!-- Verificacion de de cuentas similares y si no hay ingresa datos a la BD -->
    <?php

    if(isset($_POST['registrar'])) {

      $usuario = mysql_real_escape_string($_POST['nomuser']);
      $nombre = mysql_real_escape_string($_POST['nomlargo']);
      $tipo = mysql_real_escape_string($_POST['tipo']);
      $contrasena = mysql_real_escape_string(md5($_POST['contrasena']));
      $repcontrasena = mysql_real_escape_string(md5($_POST['repcontrasena']));

      //comprueba si hay mas usuarios con el mismo usuario
      $comprobarusuario = mysql_num_rows(mysql_query("SELECT nomuser FROM usuario WHERE nomuser = '$usuario'"));

      if($comprobarusuario >= 1) { ?>

        <br>
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          El nombre de usuario está en uso, por favor escoja otro
        </div>

      <?php } else {

        
        //compara las 2 contraseñas ingresadas
        if($contrasena != $repcontrasena) { ?>

          <br>
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Las contraseñas no coinciden
          </div>

        <?php } 
        else {

          $insertar = mysql_query("INSERT INTO usuario (nomuser,nomlargo,tipo,password) values ('$usuario','$nombre','$tipo','$contrasena')");

          if($insertar) { ?>

            <br>
            <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              Felicidades se ha registrado correctamente
            </div>

            <?php

            


          }

        }

      }

    }

    ?>

    <br>
    
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
