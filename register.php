<?php
	require_once('connections/kriva.php'); 
	include('includes/inicializar.php');
	
	if (isset($_GET['usr'])) {$usr=unserialize($_GET["usr"]);}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>CASTI Oficial</title>
<meta name="keywords" content=""/>
<?php
	include("includes/metas.php");
?>

<script type="text/javascript" src="includes/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function() {
});
</script>
</head>

<body>
<?php
	include_once("includes/analyticstracking.php");
	include("includes/Header.php");
?>

<div class="Seccion">
	<div class="ContenidoSeccion"  id="SeccionLoginRegister">
  	
  	<header>
    	<div class="accion"><a href="login.php">Usuarios Registrados</a></div>
    	<div class="accion">Registrarte</div>
		</header >      
	 	<form id="LoginBox" action="sql/loginBd.php" method="post">
      <input type="hidden" name="usrId" id=name="usrId" value="<?php echo isset($usr['usrId']) ? $usr['usrId'] : uniqid(time(),true) ?>">
    	<div>Registrate en <strong>CASTI Oficical</strong> y disfruta de un servicio personalizado</div>
    	<label for="usrName">NOMBRE</label>
      <input type="text" name="usrName" id=name="usrName" required value="<?php echo isset($usr['usrName']) ? $usr['usrName'] : '' ?>">
    	<label for="usrLName">APELLIDOS</label>
      <input type="text" name="usrLName" id=name="usrLName" value="<?php echo isset($usr['usrLName']) ? $usr['usrLName'] : '' ?>">
    	<label for="usrEmail">CORREO ELECTRÓNICO</label>
      <input type="text" name="usrEmail" id=name="usrEmail" required value="<?php echo isset($usr['usrEmail']) ? $usr['usrEmail'] : '' ?>">
    	<label for="usrPwd1">CONTRASEÑA</label>
      <input type="password" name="usrPwd1" id=name="usrPwd1"  required value="<?php echo isset($usr['usrPwd1']) ? $usr['usrPwd1'] : '' ?>">
    	<label for="usrPwd2">CONFIRMA TU CONTRASEÑA</label>
      <input type="password" name="usrPwd2" id=name="usrPwd2"  required value="<?php echo isset($usr['usrPwd2']) ? $usr['usrPwd2'] : '' ?>">
    	<label for="usrPwd2">Al crear tu cuenta, aceptas nuestros <a href="#">Términos y condiciones</a>.</label>
			<input type="checkbox" name="usrTermCond" id=name="usrTermCond" required>
      <button>REGISTRARSE</button>
			<?php if (isset($_GET['pwd']) && $_GET['pwd']=='0') { ?>
      <div id="loginError">La contraseña no coincide</div> 
      <?php } ?>
			<?php if (isset($_GET['email']) && $_GET['email']=='0') { ?>
      <div id="loginError">La cuenta de correo ya está registrada</div> 
      <?php } ?>
    </form>
  </div>
</div>


<?php
	include("includes/Footer.php");
?>
</body>
</html>
