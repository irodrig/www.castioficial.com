<?php 
	header("Access-Control-Allow-Origin: *");

//	error_reporting(0);

	$_SESSION['WebRoot'] = '..';
	$carpeta = $_SESSION['WebRoot']."/images/".$_POST['Directorio'];

	unlink($carpeta."/".$_POST['idFile']);

	$resultado = array();
	$resultado['dir'] = $carpeta."/".$_POST['idFile'];
	echo json_encode($resultado);
?>