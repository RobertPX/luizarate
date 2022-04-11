<?php
session_start();
include 'lib/conexion.php';

if (isset($_SESSION['nomuser'])) {
	header('Location: index.php');
}

$mensaje = '';
//inicia verificacion de cuenta 
if (isset($_POST['login'])) {
	$nomuser = mysql_real_escape_string($_POST['nomuser']);
	$nomuser = strip_tags($_POST['nomuser']);
	$nomuser = trim($_POST['nomuser']);

	$password = mysql_real_escape_string(md5($_POST['password']));
	$password = strip_tags(md5($_POST['password']));
	$password = trim(md5($_POST['password']));

	$tipo = 0;
	$comprobartipo = mysql_num_rows(mysql_query("SELECT cargo FROM usuario WHERE nomuser = '$nomuser' AND cargo = '$tipo'"));

	$query = mysql_query("SELECT * FROM usuario WHERE nomuser = '$nomuser' AND password = '$password'");
	$contar = mysql_num_rows($query);

	if ($contar == 1) {

		while ($row = mysql_fetch_array($query)) {

			//determina si es administrador el que ingresado para mostrar opciones de administrador
			if ($nomuser = $row['nomuser'] && $password = $row['password']) {
				if ($comprobartipo == 1) {
					$_SESSION['nomuser'] = $row['nomuser'];
					$_SESSION['tipo'] = $row['cargo'];
					$_SESSION['id'] = $row['coduser'];

					header('Location: index.php');
				} else {
					$_SESSION['nomuser'] = $row['nomuser'];
					$_SESSION['id'] = $row['coduser'];
					header('Location: index.php');
				}
			}
		}
	} else {
		$mensaje = 'Los datos ingresados no son correctos';
	}
}
//finaliza verificacion de cuenta
?>
<!DOCTYPE html>
<html>

<head>
	<title>Login</title>
	<meta charset="utf-8">
	<!-- CSS -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

	<link rel="stylesheet" href="dist/css/AdminLTE.min.css">

	<link rel="stylesheet" href="plugins/iCheck/square/blue.css">
	<link rel=icon href='img/logo-icon.png' sizes="32x32" type="image/png">

</head>
<style>
body {
  height: 400px;
  background-image: url("img/madera.png");
  background-size: cover;
  background-repeat:no-repeat;
  background-position: center center;
}
</style>
<body >
	<div class="login-box">
		<div class="login-logo">
			<a style="color:black"><b style="text-shadow: 2px 2px 5px red">BIENVENIDO A LA VACA</b></a>
			<div align="center"><img src = "img/vaca.png"></div>
		</div>

		<!-- Creacion de caja -->
		<div class="login-box-body">

			<form method="post" action="" autocomplete="off" role="form" class="form-signin">
				<!-- Contenido de la caja -->
				<div class="form-group has-feedback">
					<input type="text" class="form-control" placeholder="Usuario" name="nomuser" autofocus="" pattern="[A-Za-z_-0-9]{1,20}" required>
					<span class="glyphicon glyphicon-user form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<input type="password" class="form-control" placeholder="Contraseña" name="password" pattern="[A-Za-z_-0-9]{1,20}" required>
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<button type="submit" name="login" class="btn btn-primary btn-block btn-flat">Iniciar Sesión</button>
					</div>
				</div>
			</form>
			<?php
			echo $mensaje;
			?>

		</div>
	</div>

	<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="plugins/iCheck/icheck.min.js"></script>
	<script>
		$(function() {
			$('input').iCheck({
				checkboxClass: 'icheckbox_square-blue',
				radioClass: 'iradio_square-blue',
				increaseArea: '20%'
			});
		});
	</script>
</body>

</html>