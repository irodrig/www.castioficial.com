<?php
require_once('connections/acceso.php'); 

$acceso = false;
if(isset($_POST['Validar'])){ 
	$rstEmpresa = $empSQL->query("SELECT * FROM GE_Empresas WHERE CodEmpresa = '".$_POST['CodEmpresa']."'" );
	$rowEmpresa = $rstEmpresa->fetch_array();
	$_SESSION['Logo'] = $rowEmpresa['Logo'];
	$_SESSION['ColorMenu'] = $rowEmpresa['ColorMenu'];
	$_SESSION['ColorSubMenu'] = $rowEmpresa['ColorSubMenu'];
	$_SESSION['Color1'] = $rowEmpresa['Color1'];
	$_SESSION['Color2'] = $rowEmpresa['Color2'];
	$_SESSION['CodEmpresa'] = $rowEmpresa['CodEmpresa'];
	$_SESSION['Empresa'] = $rowEmpresa['RazonSocial'];
	$_SESSION['NIF'] = $rowEmpresa['NIF'];
	$_SESSION['Raiz'] = $rowEmpresa['Raiz'];
//	if (strpos($rowEmpresa['Web'],'localhost') == false) {
//		$_SESSION['Web'] = (strpos($rowEmpresa['Web'],'http://') == false ? 'http://' : '').$rowEmpresa['Web'];
//	} else {
		$_SESSION['Web'] = "/".$_SERVER['SERVER_NAME'].$rowEmpresa['Web'];
	$_SESSION['WebRoot'] = $rowEmpresa['WebRoot'];
//	}

	$_SESSION['UserNameBD'] = $rowEmpresa['UserName'];
	$_SESSION['PasswordBD'] = $rowEmpresa['Password'];
	$_SESSION['BaseDatos'] = $rowEmpresa['BaseDatos'];
	 
	$MySQL = new mysqli($hostname, $_SESSION['UserNameBD'], $_SESSION['PasswordBD'], $rowEmpresa['BaseDatos']);
//	$MySQL = new mysqli($hostname, $usr, $pwd, "sgt_ads");
	if ($MySQL->connect_error) {
			die('Error de Conexión (' . $MySQL->connect_errno . ') '
							. $MySQL->connect_error);
	}
	$errors = array(); 
	if($_POST['idUsuario'] == ''){ 
			echo '<div class="error">Ingresa tu nombre para acceder</div>';
	}else if($_POST['Password'] == ''){ 
			echo '<div class="error">Ingresa tu contrase&ntilde;a para acceder</div>'; 
	}else {
		$qryUsuarios = "SELECT * FROM GE_Usuarios WHERE idUsuario='".$_POST['idUsuario']."' AND Activo = 1";

		$rstUsuarios = $MySQL->query($qryUsuarios);
		if ($rowUsuarios = $rstUsuarios->fetch_array()) {
			$password_hash = $rowUsuarios['Password'];
			if (crypt(Encriptar($_POST['Password'],7), $password_hash) == $password_hash) {
				$_SESSION['idUsuario'] = $_POST['idUsuario'];
				$_SESSION['idUsuarioTipo'] = $rowUsuarios['idUsuarioTipo'];
				$_SESSION['Usuario'] = $rowUsuarios['Usuario'];			
				$_SESSION['Paginado'] = $rowUsuarios['Paginado'];			
				$_SESSION['Time'] = time();
				$_SESSION['InicioSesion'] = time();
				$_SESSION['empresa'] = $rowEmpresa['BaseDatos'];
				$_SESSION['Web'] = $rowEmpresa['Web'];

				$sql = "INSERT INTO GE_Conexiones SET ";
				$sql.= "Usuario ='".$_SESSION['idUsuario']."'";
				$sql.= ", Empresa ='".$_SESSION['CodEmpresa']."'";
				$sql.= ", Fecha ='".date('Y-m-d')."'";
				$sql.= ", Hora ='".date('H:i:s')."'";
				$sql.= ", IpRemota ='".$_SERVER['REMOTE_ADDR']."'";
				
				$rst = $empSQL->query($sql);
$acceso = true;
				header("Location: " . "index.php" );
			} else {
				echo '<span class="error">Contrase&ntilde;a inválida</span>'; 
			}
		} else {
			echo '<span class="error">Usuario y/o Contrase&ntilde;a inválidos</span>'; 
		}
	} 
}
$rstEmpresas = $empSQL->query("SELECT * FROM GE_Empresas ORDER BY RazonSocial");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="libs/jquery.js"></script>

<title><?php echo (isset($_SESSION['empresa']) ? $_SESSION['empresa'] : 'ACCESO') ?>Gestion Webs de KRIVA</title>

<link href="styles/acceso.css" rel="stylesheet" type="text/css" />
<script>
$(document).ready(function(e) {
<?php if ($acceso) { ?>
	window.location.href = "index.php";
<?php } ?>
<?php
	if ($_SERVER['PHP_SELF'] == "acceso.php") {
?>
		window.location.reload();
<?php
	}
?>
<?php
	if (isset($_POST['Validar'])) {
?>
		$("#Password").focus();
<?php
	}
?>
});
</script>

</head>




<body>
  <div id="Title">
    <p>GESTION WEB</p>
    <img src="images/kriva-mini.png"/>
  </div>
	<div id="LoginBox">
    <form id="Fields" action="acceso.php" method="post">
  	  <h1>Acceso</h1>
	  	<div class="CampoAcceso">
        <select name="CodEmpresa" class="Field">
<?php
          while ($rowEmpresa = $rstEmpresas->fetch_array()) {
?>			
            <option value="<?php echo $rowEmpresa['CodEmpresa']?>" <?php echo $rowEmpresa['CodEmpresa'] == isset($_POST['CodEmpresa']) ? $_POST['CodEmpresa'] : '' ? 'selected' : '' ?>><?php echo utf8_encode($rowEmpresa['RazonSocial'])?></option>
<?php
          }
?>
        </select>
        <p>Empresa:</p>
      </div>
	  	<div class="CampoAcceso">
        <input name="idUsuario" type="text" class="Field" value="<?php echo (isset($_POST['idUsuario']) ? $_POST['idUsuario'] : '') ?>"/>
        <p>Usuario:</p>
      </div>
    	<div class="CampoAcceso">
        <input id="Password" name="Password" type="password" class="Field"/>
        <p>Contrase&ntilde;a:</p>
      </div>
    	<div class="CampoAcceso">
	      <input id="LoginButton" name='boton' type='submit' value='Acceso' />
      </div>
      <input name="Validar" type="hidden" />
		</form>
    <div id="Aviso">
  	  <h1>Aviso</h1>
    	<p>Te encuentras en la página de acceso al Area Administrativa de <br />
    	  <strong>Gesti&oacute;n Webs de KRIVA</strong></p>
      <p>Puedes enviar cualquier consulta o incidencia por el siguiente correo electrónico <a href="mailto:kriva@kriva.es">Soporte</a></p>
    </div>
  </div>
</body>
</html>
