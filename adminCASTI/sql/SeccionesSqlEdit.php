<?php 
	require_once('../connections/kriva.php'); 

	if (isset($_POST['accion'])) {
		switch ($_POST['accion']) {
		case 'E':
			$qry = "UPDATE WE_Secciones SET ";
			$qry.= " Seccion = '".SQLVal($MySQL,$_POST['Seccion'])."'";
			$qry.= ", Url = '".$_POST['Url']."'";
			$qry.= ", Keywords = '".SQLVal($MySQL,$_POST['Keywords'])."'";
			$qry.= ", Descripcion = '".SQLVal($MySQL,$_POST['SeccionHTML'])."'";
			$qry.= ", idActualizo = '".$_SESSION['idUsuario']."'";
			$qry.= ", FActualizo = '".date('Y-m-d H:i:s')."'";
			$qry.= " WHERE idSeccion = '".$_POST['idSeccion']."'";
						
			$qry = utf8_decode($qry);
			break;
		case 'A':
			$qry = "INSERT INTO WE_Secciones SET ";
			$qry.= " Seccion = '".$_POST['Seccion']."'";
			$qry.= ", Url = '".$_POST['Url']."'";
			$qry.= ", Keywords = '".SQLVal($MySQL,$_POST['Keywords'])."'";
			$qry.= ", Descripcion = '".SQLVal($MySQL,$_POST['SeccionHTML'])."'";
			$qry.= ", idActualizo = '".$_SESSION['idUsuario']."'";
			$qry.= ", FActualizo = '".date('Y-m-d H:i:s')."'";
			$qry.= ", idSeccion = '".$_POST['idSeccion']."'";

			$qry = utf8_decode($qry);
			break;
		case 'B':
			$qry = "DELETE FROM WE_Secciones ";
			$qry.= " WHERE idSeccion = '".$_POST['idSeccion']."'";
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
