<?php
	require_once('connections/kriva.php'); 
	include('includes/inicializar.php'); 
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
	<div class="ContenidoSeccion" id="SeccionLoginRegister">
  	
  	<header>
    	<div class="accion">Usuarios Registrados</div>
    	<div class="accion"><a href="register.php">Registrarte</a></div>
		</header >      
	 	<form id="LoginBox" action="sql/loginBd.php" method="post">
    	<div>Si tienes una cuenta con nosotros, accede usando tu dirreción de correo electrónico</div>
    	<label for="loginUsr">DIRECCION DE CORREO</label>
      <input type="email" name="loginUsr" id=name="loginUsr" required>
    	<label for="loginPwd">CONTRASEÑA</label>
      <input type="password" name="loginPwd" id=name="loginPwd"  required>
      <button>ACCEDER</button>
			<?php if (isset($_GET['check']) && $_GET['check']=='false') { ?>
      <div id="loginError">La dirección de correo electrónico o la contraseña no son correctos</div> 
      <?php } ?>
    </form>
  </div>
</div>


<?php
	include("includes/Footer.php");
?>
</body>
</html>
