<?php
if (!isset($_SESSION)) {
  session_start();
}
$acceso = 1;
if (!isset($_SESSION['idUsuario'])) {
	$acceso = 0;
} elseif (isset($_POST['logout'])) {
	$acceso = 0;
} elseif ($_SESSION['Time']+1800 < time())  {
	unset($_SESSION['idUsuario']);
	$acceso = 0;
} else {
	$_SESSION['Time'] = time();
}

$resultados = array();
$resultados['Acceso'] = $acceso;

$resultadosJson = json_encode($resultados);

echo $resultadosJson;
?>