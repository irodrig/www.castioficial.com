<?php 
	require_once('../connections/kriva.php'); 

	if (isset($_POST['accion'])) {
		switch ($_POST['accion']) {
		case 'E':
			$qry = "UPDATE WE_Colaboradores SET ";
			$qry.= " Nombre = '".$_POST['Nombre']."'";
			$qry.= ", Apellido = '".$_POST['Apellido']."'";
			$qry.= ", Telefono = '".$_POST['Telefono']."'";
			$qry.= ", Email = '".$_POST['Email']."'";
			$qry.= ", Fecha = '".$_POST['Fecha']."'";
			$qry.= " WHERE idColaborador = '".$_POST['idColaborador']."'";
						
			$qry = utf8_decode($qry);
			break;
		case 'A':
//			$pwd = better_crypt(Encriptar($_POST['pwd1'],7));
			
			$qry = "INSERT INTO WE_Colaboradores SET ";
			$qry.= " idColaborador = '".$_POST['idColaborador']."'";
			$qry.= ", Nombre = '".$_POST['Nombre']."'";
			$qry.= ", Apellido = '".$_POST['Apellido']."'";
			$qry.= ", Telefono = '".$_POST['Telefono']."'";
			$qry.= ", Email = '".$_POST['Email']."'";
			$qry.= ", Fecha = '".$_POST['Fecha']."'";
//			$qry.= ", Activo = '".$_POST['Activo']."'";

			$qry = utf8_decode($qry);
			break;
		case 'B':
			$qry = "DELETE FROM WE_Colaboradores WHERE idColaborador = '".$_POST['idColaborador']."'";
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
