<?php 
	function EjecutaMySQL($qry, $MainMySQL) {
		$qry = utf8_decode($qry);
		$MainMySQL->query($qry);
		if ($MainMySQL->errno) {
			$errno .= $MainMySQL->errno." ";
			$errDesc .= $MainMySQL->error."</br>";
			$errQry .= $qry."</br>";
		}
	}

	require_once('../connections/kriva.php'); 

	include("../includes/jsonToSql.php");

	$hora = date('Y-m-d H:i:s');

	if (isset($_POST['accion'])) {
		switch ($_POST['accion']) {
		case 'E':
			if ($_SESSION['CodEmpresa'] == $_POST['CodigoEmpresa']) {
				$_SESSION['Color1'] = $_POST['Color1'];
				$_SESSION['Color2'] = $_POST['Color2'];
			}
			$qry = "UPDATE GE_Empresas SET ";
			$qry.= " RazonSocial = '".$_POST['RazonSocial']."'";
			$qry.= ", Direccion = '".$_POST['Direccion']."'";
			$qry.= ", Numero = '".$_POST['Numero']."'";
			$qry.= ", Piso = '".$_POST['Piso']."'";
			$qry.= ", Municipio = '".$_POST['Municipio']."'";
			$qry.= ", idProvincia = '".$_POST['idProvincia']."'";
			$qry.= ", Provincia = '".$_POST['Provincia']."'";
			$qry.= ", CodPostal = '".$_POST['CodPostal']."'";
			$qry.= ", NIF = '".$_POST['NIF']."'";
			$qry.= ", Telefono1 = '".$_POST['Telefono1']."'";
			$qry.= ", Telefono2 = '".$_POST['Telefono2']."'";
			$qry.= ", Fax = '".$_POST['Fax']."'";
//			$qry.= ", Web = '".$_POST['Web']."'";
			$qry.= ", urlVideo = '".$_POST['urlVideo']."'";
			$qry.= ", Email = '".$_POST['Email']."'";
			$qry.= ", Facebook = '".$_POST['Facebook']."'";
			$qry.= ", Instagram = '".$_POST['Instagram']."'";
			$qry.= ", Twitter = '".$_POST['Twitter']."'";
//			$qry.= ", BaseDatos = '".$_POST['BaseDatos']."'";
			$qry.= ", Color1 = '".$_POST['Color1']."'";
			$qry.= ", Color2 = '".$_POST['Color2']."'";
			$qry.= " WHERE CodEmpresa = '".$_POST['CodigoEmpresa']."'";

			EjecutaMySQL($qry, $MainMySQL);
			ActualizaSecciones($MySQL, $hora);
			ActualizaSlides($MySQL, $hora);

			break;
		case 'A':
			$qry = "INSERT INTO GE_Empresas SET ";
			$qry.= " RazonSocial = '".$_POST['RazonSocial']."'";
			$qry.= ", Direccion = '".$_POST['Direccion']."'";
			$qry.= ", Numero = '".$_POST['Numero']."'";
			$qry.= ", Piso = '".$_POST['Piso']."'";
			$qry.= ", Municipio = '".$_POST['Municipio']."'";
			$qry.= ", idProvincia = '".$_POST['idProvincia']."'";
			$qry.= ", Provincia = '".$_POST['Provincia']."'";
			$qry.= ", CodPostal = '".$_POST['CodPostal']."'";
			$qry.= ", NIF = '".$_POST['NIF']."'";
			$qry.= ", Telefono1 = '".$_POST['Telefono1']."'";
			$qry.= ", Telefono2 = '".$_POST['Telefono2']."'";
			$qry.= ", Fax = '".$_POST['Fax']."'";
//			$qry.= ", Web = '".$_POST['Web']."'";
			$qry.= ", urlVideo = '".$_POST['urlVideo']."'";
			$qry.= ", Email = '".$_POST['Email']."'";
			$qry.= ", Facebook = '".$_POST['Facebook']."'";
			$qry.= ", Instagram = '".$_POST['Instagram']."'";
			$qry.= ", Twitter = '".$_POST['Twitter']."'";
//			$qry.= ", BaseDatos = '".$_POST['BaseDatos']."'";
			$qry.= ", CodEmpresa = '".$_POST['CodEmpresa']."'";

			EjecutaMySQL($qry, $MainMySQL);
			ActualizaSecciones($MySQL, $hora);
			ActualizaSlides($MySQL, $hora);

			break;
		case 'B':
			$qry = "DELETE FROM GE_Empresas ";
			$qry.= " WHERE CodEmpresa = '".$_POST['CodigoEmpresa']."'";

			EjecutaMySQL($qry, $MainMySQL);

			break;
		} 
	}
	
	$error = ($errno!="" ? "<br/>ERROR: ".$errDesc."<br/>" : "");
	$Salida = "<SALIDA><ERRORNUM>".$errno."</ERRORNUM><ERRORDESC>".$error."</ERRORDESC><QUERY>".$errQry."</QUERY></SALIDA>";
	echo $Salida;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
</html>
