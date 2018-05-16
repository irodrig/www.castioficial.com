<?php 
	require_once('../connections/kriva.php'); 

	include("../includes/jsonToSql.php");

	$hora = date('Y-m-d H:i:s');

	if (isset($_POST['accion'])) {
		switch ($_POST['accion']) {
		case 'E':
			$qry = "UPDATE PR_Obras SET ";
			$qry.= " Orden = '".$_POST['Orden']."'";
			$qry.= ", idTipoObra = '".$_POST['idTipoObra']."'";
			$qry.= ", Domicilio = '".$_POST['Domicilio']."'";
			$qry.= ", Poblacion = '".$_POST['Poblacion']."'";
			$qry.= ", idProvincia = '".$_POST['idProvincia']."'";
			$qry.= ", Propietario = '".$_POST['Propietario']."'";
			$qry.= ", idObraImagen = '".$_POST['idObraImagen']."'";
			$qry.= ", Fecha = '".$_POST['Fecha']."'";
			$qry.= ", Activo = '".$_POST['Activo']."'";
			$qry.= ", idActualizo = '".$_SESSION['idUsuario']."'";
			$qry.= ", FActualizo = '".date('Y-m-d H:i:s')."'";
			$qry.= " WHERE idObra = '".$_POST['idObra']."'";
						
			$qry = utf8_decode($qry);
			$MySQL->query($qry);

			ActualizaSlidesObra($MySQL, $hora);
			break;
		case 'A':
			$qry = "INSERT INTO PR_Obras SET ";
			$qry.= " Orden = '".$_POST['Orden']."'";
			$qry.= ", idTipoObra = '".$_POST['idTipoObra']."'";
			$qry.= ", Domicilio = '".$_POST['Domicilio']."'";
			$qry.= ", Poblacion = '".$_POST['Poblacion']."'";
			$qry.= ", idProvincia = '".$_POST['idProvincia']."'";
			$qry.= ", Propietario = '".$_POST['Propietario']."'";
			$qry.= ", idObraImagen = '".$_POST['idObraImagen']."'";
			$qry.= ", Fecha = '".$_POST['Fecha']."'";
			$qry.= ", Activo = '".$_POST['Activo']."'";
			$qry.= ", idActualizo = '".$_SESSION['idUsuario']."'";
			$qry.= ", FActualizo = '".date('Y-m-d H:i:s')."'";
			$qry.= ", idObra = '".$_POST['idObra']."'";

			$qry = utf8_decode($qry);
			$MySQL->query($qry);

			ActualizaSlidesObra($MySQL, $hora);
			break;
		case 'B':
			$qry = "DELETE FROM PR_Obras ";
			$qry.= " WHERE idObra = '".$_POST['idObra']."'";
			$MySQL->query($qry);

			$qry = "DELETE FROM PR_ObrasImagenes ";
			$qry.= " WHERE idObra = '".$_POST['idObra']."'";
			$MySQL->query($qry);

			break;
		} 

//		$MySQL->query($qry);
	}
	
	echo $qry;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
</html>
