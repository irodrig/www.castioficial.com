<html>
<?php
	require_once('../connections/kriva.php'); 

	$origen = explode(',',$_POST['Origen']);
	for ($i = 0; $i<count($origen); $i++) {
		$auxOrigen = explode(":",$origen[$i]);
		$parametroOrigen[$i] = trim($auxOrigen[0]);
	}
/*
	$destino = explode(',',$_POST['Destino']);
	for ($i = 0; $i<count($destino); $i++) {
		$auxDestino = explode(":",$destino[$i]);
		$parametroDestino[$i] = trim($auxdestino[0]);
	}
*/
	$tabla = explode('.',$_POST['Tabla']);

	$qry = "SELECT * FROM ".$_POST['Tabla'];
	$qry.= " WHERE ".$parametroOrigen[0]." = '".$_POST['Valor']."'";
	
	if (count($tabla) == 1) {
		$rst = $MySQL->query($qry);
	} else {
		$rst = $MainMySQL->query($qry);
	}
//	$rst = $MySQL->query($qry);
	$resultado =  "<row><desc></desc></row>";
	if ($row = $rst->fetch_array()) {
		$resultado = "<row>";
		$resultado.=  "<".$parametroOrigen[1].">".$row[$parametroOrigen[1]]."</".$parametroOrigen[1].">";
		for ($i=2 ; $i<count($parametroOrigen); $i++) {
			$resultado.=  "<".$parametroOrigen[$i].">".htmlentities($row[$parametroOrigen[$i]],ENT_COMPAT,'iso-8859-1')."</".$parametroOrigen[$i].">";
		}
		$resultado .=	"</row>";
		$rst->free();
	}
	echo utf8_encode($resultado);
?>
</html>