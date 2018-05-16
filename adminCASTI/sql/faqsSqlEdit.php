<?php 
	require_once('../connections/kriva.php'); 

	if (isset($_POST['accion'])) {
		switch ($_POST['accion']) {
		case 'E':
			$qry = "UPDATE WE_Faqs SET ";
			$qry.= " Fecha = '".$_POST['Fecha']."'";
			$qry.= ", Pregunta = '".$_POST['Pregunta']."'";
			$qry.= ", Respuesta = '".$_POST['RespuestaHTML']."'";
			$qry.= ", Keywords = '".$_POST['Keywords']."'";
			$qry.= ", TipoArchivo = '".$_POST['TipoArchivo']."'";
			$qry.= ", Activo = '".$_POST['Activo']."'";
			$qry.= ", idActualizo = '".$_SESSION['idUsuario']."'";
			$qry.= ", FActualizo = '".date('Y-m-d H:i:s')."'";
			$qry.= " WHERE idFaq = '".$_POST['idFaq']."'";
						
			$qry = utf8_decode($qry);
			break;
		case 'A':
			$qry = "INSERT INTO WE_Faqs SET ";
			$qry.= " Fecha = '".$_POST['Fecha']."'";
			$qry.= ", Pregunta = '".$_POST['Pregunta']."'";
			$qry.= ", Respuesta = '".$_POST['RespuestaHTML']."'";
			$qry.= ", Keywords = '".$_POST['Keywords']."'";
			$qry.= ", TipoArchivo = '".$_POST['TipoArchivo']."'";
			$qry.= ", Activo = '".$_POST['Activo']."'";
			$qry.= ", idActualizo = '".$_SESSION['idUsuario']."'";
			$qry.= ", FActualizo = '".date('Y-m-d H:i:s')."'";
			$qry.= ", idFaq = '".$_POST['idFaq']."'";

			$qry = utf8_decode($qry);
			break;
		case 'B':
			$qry = "DELETE FROM WE_Faqs ";
			$qry.= " WHERE idFaq = '".$_POST['idFaq']."'";
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
