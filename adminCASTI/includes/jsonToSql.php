<?php
//error_reporting(0);
$hora = date('Y-m-d H:i:s');						

function ActualizaSecciones($MySQL, $hora) {
	$JSON = $_POST['LineasSecciones'];
	$Lineas=json_decode($JSON, true);
	for ($i=0;$i<count($Lineas['SECCIONES']);$i++) {
		if ($Lineas['SECCIONES'][$i]['Borrar'] == 'N') {
			if ($Lineas['SECCIONES'][$i]['id'] == "New") {
				if ($Lineas['SECCIONES'][$i]['Seccion'] != '') {
					$qry = "INSERT INTO GE_EmpresasSecciones SET ";
					$qry.= " Descripcion = '".$Lineas['SECCIONES'][$i]['Descripcion']."'";
					$qry.= ", Seccion = '".$Lineas['SECCIONES'][$i]['Seccion']."'";
					$qry.= ", Keywords = '".$Lineas['SECCIONES'][$i]['Keywords']."'";
					$qry.= ", TipoArchivo = '".$Lineas['SECCIONES'][$i]['TipoArchivo']."'";
					$qry.= ", CodEmpresa = '".$_SESSION['CodEmpresa']."'";
					$qry.= ", idActualizo = '".$_SESSION['idUsuario']."'";
					$qry.= ", FActualizo = '".$hora."'";
					$qry.= ", idEmpresaSeccion= '".$Lineas['SECCIONES'][$i]['idEmpresaSeccion']."'";
				}
			} else {
				$qry = "UPDATE GE_EmpresasSecciones SET ";
				$qry.= " Descripcion = '".$Lineas['SECCIONES'][$i]['Descripcion']."'";
				$qry.= ", Seccion = '".$Lineas['SECCIONES'][$i]['Seccion']."'";
				$qry.= ", Keywords = '".$Lineas['SECCIONES'][$i]['Keywords']."'";
				$qry.= ", TipoArchivo = '".$Lineas['SECCIONES'][$i]['TipoArchivo']."'";
				$qry.= ", CodEmpresa = '".$_SESSION['CodEmpresa']."'";
				$qry.= ", idActualizo = '".$_SESSION['idUsuario']."'";
				$qry.= ", FActualizo = '".$hora."'";
				$qry.= " WHERE idEmpresaSeccion = '".$Lineas['SECCIONES'][$i]['idEmpresaSeccion']."'";
			}
		} else {
			if ($Lineas['SECCIONES'][$i]['id'] != "New") {
				$fileName = "../ANEXOS/".$Lineas['SECCIONES'][$i]['Tabla']."/".$Lineas['SECCIONES'][$i]['idAnexo'].".".$Lineas['SECCIONES'][$i]['TipoArchivo'];
				unlink($fileName);

				$qry = "DELETE FROM GE_EmpresasSecciones ";
				$qry.= " WHERE idEmpresaSeccion = '".$Lineas['SECCIONES'][$i]['idEmpresaSeccion']."'";
			}
		}
		if (isset($qry)) {$MySQL->query(utf8_decode($qry));}
	};
	echo $qry;
}


function ActualizaSlides($MySQL, $hora) {
	$JSON = $_POST['LineasSlides'];
	$Lineas=json_decode($JSON, true);
	for ($i=0;$i<count($Lineas['SLIDES']);$i++) {
		if ($Lineas['SLIDES'][$i]['Borrar'] == 'N') {
			if ($Lineas['SLIDES'][$i]['id'] == "New") {
				if ($Lineas['SLIDES'][$i]['NombreImagen'] != '') {
					$qry = "INSERT INTO GE_EmpresasSlides SET ";
					$qry.= " NombreImagen = '".$Lineas['SLIDES'][$i]['NombreImagen']."'";
					$qry.= ", OrdenWeb = '".$Lineas['SLIDES'][$i]['OrdenWeb']."'";
					$qry.= ", TextoSlide = '".$Lineas['SLIDES'][$i]['TextoSlide']."'";
					$qry.= ", TipoArchivo = '".$Lineas['SLIDES'][$i]['TipoArchivo']."'";
					$qry.= ", CodEmpresa = '".$_SESSION['CodEmpresa']."'";
					$qry.= ", idActualizo = '".$_SESSION['idUsuario']."'";
					$qry.= ", FActualizo = '".$hora."'";
					$qry.= ", idEmpresaSlide= '".$Lineas['SLIDES'][$i]['idEmpresaSlide']."'";
				}
			} else {
				$qry = "UPDATE GE_EmpresasSlides SET ";
				$qry.= " NombreImagen = '".$Lineas['SLIDES'][$i]['NombreImagen']."'";
				$qry.= ", OrdenWeb = '".$Lineas['SLIDES'][$i]['OrdenWeb']."'";
				$qry.= ", TextoSlide = '".$Lineas['SLIDES'][$i]['TextoSlide']."'";
				$qry.= ", TipoArchivo = '".$Lineas['SLIDES'][$i]['TipoArchivo']."'";
				$qry.= ", CodEmpresa = '".$_SESSION['CodEmpresa']."'";
				$qry.= ", idActualizo = '".$_SESSION['idUsuario']."'";
				$qry.= ", FActualizo = '".$hora."'";
				$qry.= " WHERE idEmpresaSlide = '".$Lineas['SLIDES'][$i]['idEmpresaSlide']."'";
			}
		} else {
			if ($Lineas['SLIDES'][$i]['id'] != "New") {
				$fileName = "../ANEXOS/".$Lineas['SLIDES'][$i]['Tabla']."/".$Lineas['SLIDES'][$i]['idAnexo'].".".$Lineas['SLIDES'][$i]['TipoArchivo'];
				unlink($fileName);

				$qry = "DELETE FROM GE_EmpresasSlides ";
				$qry.= " WHERE idEmpresaSlide = '".$Lineas['SLIDES'][$i]['idEmpresaSlide']."'";
			}
		}
		if (isset($qry)) {$MySQL->query(utf8_decode($qry));}
	};
	echo $qry;
}

function ActualizaSlidesObra($MySQL, $hora) {
	$JSON = $_POST['LineasSlides'];
	$Lineas=json_decode($JSON, true);
	for ($i=0;$i<count($Lineas['SLIDES']);$i++) {
		if ($Lineas['SLIDES'][$i]['Borrar'] == 'N') {
			if ($Lineas['SLIDES'][$i]['id'] == "New") {
				if ($Lineas['SLIDES'][$i]['NombreImagen'] != '') {
					$qry = "INSERT INTO PR_ObrasImagenes SET ";
					$qry.= " NombreImagen = '".$Lineas['SLIDES'][$i]['NombreImagen']."'";
					$qry.= ", Orden = '".$Lineas['SLIDES'][$i]['Orden']."'";
					$qry.= ", Descripcion = '".$Lineas['SLIDES'][$i]['Descripcion']."'";
					$qry.= ", TipoArchivo = '".$Lineas['SLIDES'][$i]['TipoArchivo']."'";
					$qry.= ", idObra = '".$Lineas['SLIDES'][$i]['idObra']."'";
					$qry.= ", SlideInicio = ".$Lineas['SLIDES'][$i]['SlideInicio']."";
					$qry.= ", Activo = ".$Lineas['SLIDES'][$i]['Activo']."";
					$qry.= ", idActualizo = '".$_SESSION['idUsuario']."'";
					$qry.= ", FActualizo = '".$hora."'";
					$qry.= ", idObraImagen= '".$Lineas['SLIDES'][$i]['idObraImagen']."'";
				}
			} else {
				$qry = "UPDATE PR_ObrasImagenes SET ";
				$qry.= " NombreImagen = '".$Lineas['SLIDES'][$i]['NombreImagen']."'";
				$qry.= ", Orden = '".$Lineas['SLIDES'][$i]['Orden']."'";
				$qry.= ", Descripcion = '".$Lineas['SLIDES'][$i]['Descripcion']."'";
				$qry.= ", TipoArchivo = '".$Lineas['SLIDES'][$i]['TipoArchivo']."'";
				$qry.= ", idObra = '".$Lineas['SLIDES'][$i]['idObra']."'";
				$qry.= ", SlideInicio = ".$Lineas['SLIDES'][$i]['SlideInicio']."";
				$qry.= ", Activo = ".$Lineas['SLIDES'][$i]['Activo']."";
				$qry.= ", idActualizo = '".$_SESSION['idUsuario']."'";
				$qry.= ", FActualizo = '".$hora."'";
				$qry.= " WHERE idObraImagen = '".$Lineas['SLIDES'][$i]['idObraImagen']."'";
			}
		} else {
			if ($Lineas['SLIDES'][$i]['id'] != "New") {
				$fileName = "../ANEXOS/".$Lineas['SLIDES'][$i]['Tabla']."/".$Lineas['SLIDES'][$i]['idAnexo'].".".$Lineas['SLIDES'][$i]['TipoArchivo'];
				unlink($fileName);

				$qry = "DELETE FROM PR_ObrasImagenes ";
				$qry.= " WHERE idObraImagen = '".$Lineas['SLIDES'][$i]['idObraImagen']."'";
			}
		}
		if (isset($qry)) {$MySQL->query(utf8_decode($qry));}
	};
	echo $qry;
}







function ActualizaMantenimientosSubTipos($MainMySQL, $hora) {
	
	$JSON = $_POST['LineasSubTipos'];
	$Lineas=json_decode($JSON, true);
	for ($i=0;$i<count($Lineas['SUBTIPOS']);$i++) {

		if ($Lineas['SUBTIPOS'][$i]['Borrar'] == 'N') {
			if ($Lineas['SUBTIPOS'][$i]['id'] == "New") {
				if ($Lineas['SUBTIPOS'][$i]['MantenimientoSubTipo'] != '') {
					$qry = "INSERT INTO sgt_empresas.VE_MantenimientosSubTipos SET ";
					$qry.= " MantenimientoSubTipo = '".$Lineas['SUBTIPOS'][$i]['MantenimientoSubTipo']."'";
					$qry.= ", idMantenimientoTipo = '".$Lineas['SUBTIPOS'][$i]['idMantenimientoTipo']."'";
					$qry.= ", idMantenimientoSubTipo = '".$Lineas['SUBTIPOS'][$i]['idMantenimientoSubTipo']."'";
					$qry.= ", FActualizo = '".$hora."'";
					$qry.= ", idActualizo = '".$_SESSION['idUsuario']."'";
				}
			} else {
				$qry = "UPDATE sgt_empresas.VE_MantenimientosSubTipos SET ";
				$qry.= " MantenimientoSubTipo = '".$Lineas['SUBTIPOS'][$i]['MantenimientoSubTipo']."'";
				$qry.= ", FActualizo = '".$hora."'";
				$qry.= ", idActualizo = '".$_SESSION['idUsuario']."'";
				$qry.= " WHERE idMantenimientoSubTipo = '".$Lineas['SUBTIPOS'][$i]['id']."'";
			}
		} else {
			if ($Lineas['SUBTIPOS'][$i]['id'] != "New") {
				$qry = "DELETE FROM sgt_empresas.VE_MantenimientosSubTipos ";
				$qry.= " WHERE idMantenimientoSubTipo = '".$Lineas['SUBTIPOS'][$i]['id']."'";
			}
		}
		if (isset($qry)) {$MainMySQL->query(utf8_decode($qry));}
	echo $qry;
	};
}



?>
<html>
<head>
<meta charset="utf-8">
</head>
</html>