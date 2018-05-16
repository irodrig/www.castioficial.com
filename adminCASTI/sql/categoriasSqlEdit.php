<?php 
	require_once('../connections/kriva.php'); 

	if (isset($_POST['accion'])) {
		switch ($_POST['accion']) {
		case 'E':
			$qry = "UPDATE AL_Categorias SET ";
			$qry.= " Categoria = '".$_POST['Categoria']."'";
			$qry.= ", Descripcion = '".$_POST['DescripcionHTML']."'";
			$qry.= ", OrdenWeb = '".$_POST['OrdenWeb']."'";
			$qry.= ", Keywords = '".$_POST['Keywords']."'";
			$qry.= ", TipoArchivo = '".$_POST['TipoArchivo']."'";
			$qry.= ", Activo = '".$_POST['Activo']."'";
			$qry.= ", idActualizo = '".$_SESSION['idUsuario']."'";
			$qry.= ", FActualizo = '".date('Y-m-d H:i:s')."'";
			$qry.= " WHERE idCategoria = '".$_POST['idCategoria']."'";
						
			$qry = utf8_decode($qry);
			break;
		case 'A':
			$qry = "INSERT INTO AL_Categorias SET ";
			$qry.= " Categoria = '".$_POST['Categoria']."'";
			$qry.= ", Descripcion = '".$_POST['DescripcionHTML']."'";
			$qry.= ", OrdenWeb = '".$_POST['OrdenWeb']."'";
			$qry.= ", Keywords = '".$_POST['Keywords']."'";
			$qry.= ", TipoArchivo = '".$_POST['TipoArchivo']."'";
			$qry.= ", Activo = '".$_POST['Activo']."'";
			$qry.= ", idActualizo = '".$_SESSION['idUsuario']."'";
			$qry.= ", FActualizo = '".date('Y-m-d H:i:s')."'";
			$qry.= ", idCategoria = '".$_POST['idCategoria']."'";

			$qry = utf8_decode($qry);
			break;
		case 'B':
			$qry = "DELETE FROM AL_Categorias ";
			$qry.= " WHERE idCategoria = '".$_POST['idCategoria']."'";
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
