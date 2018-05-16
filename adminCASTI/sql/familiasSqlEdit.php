<?php 
	require_once('../connections/kriva.php'); 

	if (isset($_POST['accion'])) {
		switch ($_POST['accion']) {
		case 'E':
			$qry = "UPDATE AL_Familias SET ";
			$qry.= " Familia = '".$_POST['Familia']."'";
			$qry.= ", idCategoria = '".$_POST['idCategoria']."'";
			$qry.= ", OrdenWeb = '".$_POST['OrdenWeb']."'";
			$qry.= ", Descripcion = '".$_POST['DescripcionHTML']."'";
			$qry.= ", Keywords = '".$_POST['Keywords']."'";
			$qry.= ", TipoArchivo = '".$_POST['TipoArchivo']."'";
			$qry.= ", Activo = '".$_POST['Activo']."'";
			$qry.= ", idActualizo = '".$_SESSION['idUsuario']."'";
			$qry.= ", FActualizo = '".date('Y-m-d H:i:s')."'";
			$qry.= " WHERE idFamilia = '".$_POST['idFamilia']."'";
						
			$qry = utf8_decode($qry);
			break;
		case 'A':
			$qry = "INSERT INTO AL_Familias SET ";
			$qry.= " Familia = '".$_POST['Familia']."'";
			$qry.= ", idCategoria = '".$_POST['idCategoria']."'";
			$qry.= ", OrdenWeb = '".$_POST['OrdenWeb']."'";
			$qry.= ", Descripcion = '".$_POST['DescripcionHTML']."'";
			$qry.= ", Keywords = '".$_POST['Keywords']."'";
			$qry.= ", TipoArchivo = '".$_POST['TipoArchivo']."'";
			$qry.= ", Activo = '".$_POST['Activo']."'";
			$qry.= ", idActualizo = '".$_SESSION['idUsuario']."'";
			$qry.= ", FActualizo = '".date('Y-m-d H:i:s')."'";
			$qry.= ", idFamilia = '".$_POST['idFamilia']."'";

			$qry = utf8_decode($qry);
			break;
		case 'B':
			$qry = "DELETE FROM AL_Familias ";
			$qry.= " WHERE idFamilia = '".$_POST['idFamilia']."'";
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
