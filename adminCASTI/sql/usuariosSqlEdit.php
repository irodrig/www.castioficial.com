<?php 
	require_once('../connections/kriva.php'); 

	if (isset($_POST['accion'])) {
		switch ($_POST['accion']) {
		case 'E':
			$qry = "UPDATE GE_Usuarios SET ";
			$qry.= " Usuario = '".$_POST['Usuario']."'";
			$qry.= ", idUsuarioTipo = '".$_POST['idUsuarioTipo']."'";
			$qry.= ", Telefono = '".$_POST['Telefono']."'";
			$qry.= ", Email = '".$_POST['Email']."'";
			$qry.= ", Activo = '".$_POST['Activo']."'";
			$qry.= " WHERE idUsuario = '".$_POST['idUsuario']."'";
						
			$qry = utf8_decode($qry);
			break;
		case 'A':
			$pwd = better_crypt(Encriptar($_POST['pwd1'],7));
			
			$qry = "INSERT INTO GE_Usuarios SET ";
			$qry.= " idUsuario = '".$_POST['idUsuario']."'";
			$qry.= ", idUsuarioTipo = '".$_POST['idUsuarioTipo']."'";
			$qry.= ", Usuario = '".$_POST['Usuario']."'";
			$qry.= ", Password = '".$pwd."'";
			$qry.= ", Telefono = '".$_POST['Telefono']."'";
			$qry.= ", Email = '".$_POST['Email']."'";
			$qry.= ", Activo = '".$_POST['Activo']."'";

			$qry = utf8_decode($qry);
			break;
		case 'B':
			$qry = "DELETE FROM GE_Usuarios WHERE idUsuario = '".$_POST['idUsuario']."'";
			break;
		case 'E_pwd':
			$pwd = better_crypt(Encriptar($_POST['pwd1'],7));

			$qry = "UPDATE GE_Usuarios SET ";
			$qry.= " Password = '".$pwd."'";
			$qry.= " WHERE idUsuario = '".$_POST['idUsuario']."'";
						
			$qry = utf8_decode($qry);
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
