<?php 
	require_once('../connections/kriva.php'); 

	if (isset($_POST['accion'])) {
		switch ($_POST['accion']) {
		case 'E':
			$qry = "UPDATE GE_TiposObras SET ";
			$qry.= " TipoObra = '".$_POST['TipoObra']."'";
			$qry.= ", Orden = '".$_POST['Orden']."'";
			$qry.= ", TipoArchivo = '".$_POST['TipoArchivo']."'";
			$qry.= ", Activo = '".$_POST['Activo']."'";
			$qry.= ", idActualizo = '".$_SESSION['idUsuario']."'";
			$qry.= ", FActualizo = '".date('Y-m-d H:i:s')."'";
			$qry.= " WHERE idTipoObra = '".$_POST['idTipoObra']."'";
						
			$qry = utf8_decode($qry);
			break;
		case 'A':
			$qry = "INSERT INTO GE_TiposObras SET ";
			$qry.= " TipoObra = '".$_POST['TipoObra']."'";
			$qry.= ", Orden = '".$_POST['Orden']."'";
			$qry.= ", TipoArchivo = '".$_POST['TipoArchivo']."'";
			$qry.= ", Activo = '".$_POST['Activo']."'";
			$qry.= ", idActualizo = '".$_SESSION['idUsuario']."'";
			$qry.= ", FActualizo = '".date('Y-m-d H:i:s')."'";
			$qry.= ", idTipoObra = '".$_POST['idTipoObra']."'";

			$qry = utf8_decode($qry);
			break;
		case 'B':
			$qry = "DELETE FROM GE_TiposObras ";
			$qry.= " WHERE idTipoObra = '".$_POST['idTipoObra']."'";
			break;
		} 

		$MySQL->query($qry);
	}
	
	echo $qry;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
</html>
