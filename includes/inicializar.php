<?php
$Mes = array("ENE","FEB","MAR","ABR","MAY","JUN","JUL","AGO","SEP","OCT","NOV","DIC");
$NombreMes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

$qryEmpresa = "SELECT * FROM GE_Empresas WHERE CodEmpresa='CASTI'";
$rstEmpresa = $MySQL->query($qryEmpresa);
$rowEmpresa = $rstEmpresa->fetch_array();

$qrySecciones = "SELECT * FROM WE_Secciones WHERE Activo AND idGrupoSeccion ORDER BY idGrupoSeccion, Seccion";
$rstSecciones = $MySQL->query($qrySecciones);
$rowSecciones = $rstSecciones->fetch_array();

//$qryBlog = "SELECT * FROM WE_Noticias WHERE Activo ORDER BY Fecha DESC LIMIT 1";
//$rstBlog = $MySQL->query($qryBlog);
//$rowBlog = $rstBlog->fetch_array();

function ObtenerValor($MySQL, $tabla, $indice, $campo, $id)
{
	$Campos = explode(',',$campo);
	if (isset($id)) {
		$qry = sprintf("SELECT %s FROM %s WHERE %s = '%s'", $campo, $tabla, $indice, $id);
		$rst = $MySQL->query($qry);
		$row = $rst->fetch_array();
		$Valor = "";
		for ($i=0 ; $i<count($Campos); $i++) {
			$Valor.= ($i>0 ? " " : "").$row[trim($Campos[$i])]; 
		}
		
		return htmlspecialchars(utf8_encode($Valor)); 
		$rst->free();
	} else {
		return "";
	}
}

function Dia($fecha) {
	return substr($fecha,8,2);
}
function Mes($fecha) {
	return substr($fecha,5,2);
}
function Ano($fecha) {
	return substr($fecha,0,4);
}

function getSubString($string, $limit, $break=' ', $pad='&hellip;') {
// return with no change if string is shorter than $limit 
	if (strlen($string) <= $limit)
	return $string;
// is $break present between $limit and the end of the string? 
	if (false !== ($breakpoint = strpos($string, $break, $limit))) {
		if ($breakpoint < (strlen($string) - 1)) {
			$string = substr($string, 0, $breakpoint) . $pad;
		}
	}
	return $string;
}	

?>