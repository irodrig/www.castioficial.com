<?php
if (!isset($_SESSION)) {
  session_start();
}
$_SESSION['Raiz'] = isset($_SESSION['Raiz']) ? $_SESSION['Raiz'] : '';
if (!isset($_SESSION['idUsuario'])) {
	header("Location: ".$_SESSION['Raiz']."acceso.php");
}
if (isset($_POST['logout'])) {
	$Raiz = $_SESSION['Raiz'];
	session_destroy();
	header("Location: ".$Raiz."acceso.php");
}
if ($_SESSION['Time']+1800 < time())  {
	unset($_SESSION['UserCode']);
	header("Location: ".$_SESSION['Raiz']."acceso.php");
} else {
	$_SESSION['Time'] = time();
}

if ($_SERVER['SERVER_NAME'] == 'localhost') {
	$hostname = "localhost";
	$database = "casti";
	$username = "root";
	$password = "mushoRM32";
} else {
	$hostname = "localhost";
	$database = "castiofi_wp992";
	$username = "castiofi_web";
	$password = "aD5:1W.?W9=_8.";
//	$hostname = "localhost";
//	$database = "luipom_casti";
//	$username = "luipom_casti";
//	$password = "ca5t10FR33";
}

$empSQL = new mysqli($hostname, $username, $password, $database);
if ($empSQL->connect_error) {
		die('Error de Conexión (' . $empSQL->connect_errno . ') '
						. $empSQL->connect_error);
}
if (isset($_SESSION['empresa'])) {
	$MySQL = new mysqli($hostname, $_SESSION['UserNameBD'], $_SESSION['PasswordBD'], $_SESSION['BaseDatos']);
	if ($MySQL->connect_error) {
			die('Error de Conexión (' . $MySQL->connect_errno . ') '
							. $MySQL->connect_error);
	}
	$MainMySQL = new mysqli($hostname, $username, $password, $database);
	if ($MainMySQL->connect_error) {
			die('Error de Conexión (' . $MainMySQL->connect_errno . ') '
							. $MainMySQL->connect_error);
	}
}


if (is_file("includes/funciones.php")) {
	include_once("includes/funciones.php");
}
else if (is_file("../includes/funciones.php")) {
	include_once("../includes/funciones.php");
}
else {
	include_once("../../includes/funciones.php");
}

?>