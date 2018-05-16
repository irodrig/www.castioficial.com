<?php 
	require_once('../connections/kriva.php'); 
//	require_once('../includes/jsonToSql.php'); 
	
	error_reporting(0);

	$resp = array();

	if (isset($_POST['accion'])) {
		switch ($_POST['accion']) {
		case 'E':
			$qry = "UPDATE WE_Productos SET ";
			$qry.= " Referencia = '".SQLVal($MySQL,$_POST['Referencia'])."'";
			$qry.= ", Orden = '".$_POST['Orden']."'";
			$qry.= ", Modelo = '".SQLVal($MySQL,$_POST['Modelo'])."'";
			$qry.= ", Descripcion = '".SQLVal($MySQL,$_POST['DescripcionHTML'])."'";
			$qry.= ", Etiquetas = '".$_POST['Etiquetas']."'";
			$qry.= ", Novedad = '".$_POST['Novedad']."'";
			$qry.= ", slideInicio = '".$_POST['slideInicio']."'";
			$qry.= ", Proximamente = '".$_POST['Proximamente']."'";
			$qry.= ", Agotado = '".$_POST['Agotado']."'";
			$qry.= ", urlEcommerce = '".SQLVal($MySQL,$_POST['urlEcommerce'])."'";
			$qry.= ", idProductoRelacionado = '".$_POST['idProductoRelacionado']."'";
			$qry.= ", Base = '".$_POST['Base']."'";
			$qry.= ", Iva = '".$_POST['Iva']."'";
			$qry.= ", Precio = '".$_POST['Precio']."'";
			$qry.= ", Activo = '".$_POST['Activo']."'";
			$qry.= ", idActualizo = '".$_SESSION['idUsuario']."'";
			$qry.= ", FActualizo = '".date("Y-m-d H:i:s")."'";
			$qry.= " WHERE idProducto = '".$_POST['id']."'";

			$qry = utf8_decode($qry);
			$MySQL->query($qry);

			if (!in_array('WEB', $_SESSION['Restricciones'])) {
				$PathImages = $_SESSION['WebRoot']."/images/articulos/".$_POST['id']."/";
				
				for ($i=0; $i<$_POST['CantidadImg']; $i++) {
	//echo $_POST['CantidadImg'].'---'.$i.'-----'.$_POST['NombreArchivo'.$i]."\n";
					if ($_POST['NombreArchivo'.$i] != 'Vacio') {
						$srcImage = $PathImages."imgArticulo".$i.".".$_POST['TipoArchivo'.$i];
						if (file_exists($srcImage)) {
							rename ($srcImage,$PathImages.SQLVal($MySQL,$_POST['Referencia'].'_'.$i).".".$_POST['TipoArchivo'.$i]);
						}
						if (file_exists($PathImages.$_POST['NombreArchivo'.$i])) {
							rename ($PathImages.$_POST['NombreArchivo'.$i],$PathImages.SQLVal($MySQL,$_POST['Referencia'].'_'.$i).".".$_POST['TipoArchivo'.$i]);
						}
					} else {
						if (file_exists($PathImages.SQLVal($MySQL,$_POST['NombreArticulo'].'_'.$i.".".$_POST['TipoArchivo'.$i]))) {
							unlink($PathImages.SQLVal($MySQL,$_POST['NombreArticulo'].'_'.$i.".".$_POST['TipoArchivo'.$i]));
						}
					}
				}
			}
			break;
		case 'A':
			$qry = "INSERT INTO WE_Productos SET ";
			$qry.= " Referencia = '".SQLVal($MySQL,$_POST['Referencia'])."'";
			$qry.= ", Orden = '".$_POST['Orden']."'";
			$qry.= ", Modelo = '".SQLVal($MySQL,$_POST['Modelo'])."'";
			$qry.= ", Descripcion = '".SQLVal($MySQL,$_POST['DescripcionHTML'])."'";
			$qry.= ", Etiquetas = '".$_POST['Etiquetas']."'";
			$qry.= ", Novedad = '".$_POST['Novedad']."'";
			$qry.= ", slideInicio = '".$_POST['slideInicio']."'";
			$qry.= ", Proximamente = '".$_POST['Proximamente']."'";
			$qry.= ", Agotado = '".$_POST['Agotado']."'";
			$qry.= ", urlEcommerce = '".SQLVal($MySQL,$_POST['urlEcommerce'])."'";
			$qry.= ", idProductoRelacionado = '".$_POST['idProductoRelacionado']."'";
			$qry.= ", Base = '".$_POST['Base']."'";
			$qry.= ", Iva = '".$_POST['Iva']."'";
			$qry.= ", Precio = '".$_POST['Precio']."'";
			$qry.= ", Activo = '".$_POST['Activo']."'";
			$qry.= ", idActualizo = '".$_SESSION['idUsuario']."'";
			$qry.= ", FActualizo = '".date("Y-m-d H:i:s")."'";
			$qry.= ", idProducto = '".$_POST['id']."'";

			$qry = utf8_decode($qry);
			$MySQL->query($qry);
			$_POST['id'] = $MySQL->insert_id;
			break;
		case 'B':
			$qry = "DELETE FROM WE_Productos";
			$qry.= " WHERE idProducto = '".$_POST['id']."'";
			$MySQL->query($qry);

			break;
		} 

	}

	if ($MySQL->errno) {
		$resp['ERROR'] = $MySQL->errno;
		$resp['ERROR_DESC'] = $MySQL->error;
		$resp['qry'] = $qry;
	} else {
		$resp['ERROR'] = 0;
	}

	echo json_encode($resp);
?>
