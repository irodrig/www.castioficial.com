<?php 
	require_once('../connections/kriva.php'); 

	if (isset($_POST['accion'])) {
		switch ($_POST['accion']) {
		case 'E':
			$qry = "UPDATE WE_Noticias SET ";
			$qry.= " Fecha = '".$_POST['Fecha']."'";
			$qry.= ", Titular = '".$_POST['Titular']."'";
			$qry.= ", Categoria = '".$_POST['Categoria']."'";
			$qry.= ", Avance = '".$_POST['Avance']."'";
			$qry.= ", Noticia = '".$_POST['NoticiaHTML']."'";
			$qry.= ", Keywords = '".$_POST['Keywords']."'";
			$qry.= ", TipoArchivo = '".$_POST['TipoArchivo']."'";
			$qry.= ", Activo = '".$_POST['Activo']."'";
			$qry.= ", idActualizo = '".$_SESSION['idUsuario']."'";
			$qry.= ", FActualizo = '".date('Y-m-d H:i:s')."'";
			$qry.= " WHERE idNoticia = '".$_POST['idNoticia']."'";
						
			$qry = utf8_decode($qry);
			break;
		case 'A':
			$qry = "INSERT INTO WE_Noticias SET ";
			$qry.= " Fecha = '".$_POST['Fecha']."'";
			$qry.= ", Titular = '".$_POST['Titular']."'";
			$qry.= ", Categoria = '".$_POST['Categoria']."'";
			$qry.= ", Avance = '".$_POST['Avance']."'";
			$qry.= ", Noticia = '".$_POST['NoticiaHTML']."'";
			$qry.= ", Keywords = '".$_POST['Keywords']."'";
			$qry.= ", TipoArchivo = '".$_POST['TipoArchivo']."'";
			$qry.= ", Activo = '".$_POST['Activo']."'";
			$qry.= ", idActualizo = '".$_SESSION['idUsuario']."'";
			$qry.= ", FActualizo = '".date('Y-m-d H:i:s')."'";
			$qry.= ", idNoticia = '".$_POST['idNoticia']."'";

			$qry = utf8_decode($qry);
			break;
		case 'B':
			$qry = "DELETE FROM WE_Noticias ";
			$qry.= " WHERE idNoticia = '".$_POST['idNoticia']."'";
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
