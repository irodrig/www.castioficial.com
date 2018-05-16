<?php 
	header("Access-Control-Allow-Origin: *");

//	error_reporting(0);

//	if ($_SERVER['SERVER_NAME'] != 'localhost') {
//		$_SESSION['WebRoot'] = '/var/www/vhosts/27/193950/webspace/httpdocs/sanmede.com';
//	} else {
//		$_SESSION['WebRoot'] = 'E:/wamp/www/TIENDAS/Sanmede';
//	}
	$Miniatura = isset($_POST['Miniatura']) && $_POST['Miniatura'] == '1' ? true : false;

	$_SESSION['WebRoot'] = '..';
	$carpeta = $_SESSION['WebRoot']."/images/".$_POST['Directorio'];

	if (!file_exists($carpeta)) {
			mkdir($carpeta, 0777, true);
	}

	$id = $_POST['id'];
	$directorio = $_POST['Directorio'];
	$AnchoImg = $_POST['AnchoImg'];
	$AltoImg = $_POST['AltoImg'];

	$nombre_archivo = $_FILES['File']['name'];
	$tipo_archivo =  $_FILES['File']['type'];
	
	$tmp = explode(".", $nombre_archivo);
  $ext = strtolower(end($tmp));

	$tmpFile = $_SESSION['WebRoot']."/images/".$_POST['Directorio']."/tmp".$id.".".$ext;
	$newFile = $_SESSION['WebRoot']."/images/".$_POST['Directorio']."/".$id.".".$ext;
	if ($Miniatura) {
		$newFileMini = $_SESSION['WebRoot']."/images/".$_POST['Directorio']."/m".$id.".".$ext;
	}

	move_uploaded_file($_FILES['File']['tmp_name'], $tmpFile);
//////////////////////////////////////////////////
// COPIAR ARCHIVOS SIN MODIFICAR EL TAMAÑO
//	copy($tmpFile,$newFileMini);
//	copy($tmpFile,$newFile);
//////////////////////////////////////////////////
 
	$Imagen = getimagesize($tmpFile);
	$ImagenAncho = $Imagen[0];
	$ImagenAlto = $Imagen[1];
	$ImagenTipo = $Imagen['mime'];
	
	$ImagenProporcion = $ImagenAncho / $ImagenAlto;
/////////////////////////////////////////////////////////////////////////////////////////////
// SI QUEREMOS TRANSFORMAR IMAGEN ANCHO Y ALTO PREDEFINIDO
/////////////////////////////////////////////////////////////////////////////////////////////
//	$NuevaProporcion = $AnchoImg / $AltoImg;
//	if ($ImagenProporcion > $NuevaProporcion){
//		$NuevoAncho = $AnchoImg;
//		$NuevoAlto = $AnchoImg / $NuevaProporcion;
//		$AnchoMini = 120;
//		$AltoMini = 120 / $ImagenProporcion;
//	} else if ( $ImagenProporcion < $NuevaProporcion ){
//		$NuevoAncho = $AltoImg * $NuevaProporcion;
//		$NuevoAlto = $AltoImg;
//		$AnchoMini = 80 * $ImagenProporcion;
//		$AltoMini = 80;
//	} else {
//		$NuevoAncho = $AnchoImg;
//		$NuevoAlto = $AltoImg;
//		$AnchoMini = 120;
//		$AltoMini = 80;
//	}
/////////////////////////////////////////////////////////////////////////////////////////////
// SI QUEREMOS TRANSFORMAR IMAGEN ANCHO PREDEFINIDO ALTO ADAPTADO
/////////////////////////////////////////////////////////////////////////////////////////////
	$NuevoAncho = $AnchoImg;
	$NuevoAlto = $AnchoImg / $ImagenProporcion;
	$img = imagecreatetruecolor($NuevoAncho, $NuevoAlto);
	
	if ($Miniatura) {
		$AnchoMini = 120;
		$AltoMini = 120 / $ImagenProporcion;
		$imgMini = imagecreatetruecolor($AnchoMini, $AltoMini);
	}


	switch ($ImagenTipo){
		case "image/jpg":
		case "image/jpeg":
			$NuevaImagen = imagecreatefromjpeg( $tmpFile );
			break;
		case "image/png":
			$NuevaImagen = imagecreatefrompng( $tmpFile  );

			imagealphablending($img, false);
			imagesavealpha($img, true);
			imagecolortransparent($img, imagecolorallocate($img, 0,0,0));
			if ($Miniatura) {
				imagecolortransparent($imgMini, imagecolorallocate($img, 0, 0, 0));
			}
			break;
		case "image/gif":
			$NuevaImagen = imagecreatefromgif( $tmpFile  );
			break;
	}

	imagecopyresized($img, $NuevaImagen, 0, 0, 0, 0, $NuevoAncho, $NuevoAlto, $ImagenAncho, $ImagenAlto);

	if ($Miniatura) {
		$NuevaImagenMini = $NuevaImagen;
		imagecopyresized($imgMini, $NuevaImagenMini, 0, 0, 0, 0, $AnchoMini, $AltoMini, $ImagenAncho, $ImagenAlto);
	}
	
	switch ($ImagenTipo){
		case "image/jpg":
		case "image/jpeg":
//			imagejpeg($img, $newFile, 80);
			imagejpeg($NuevaImagen, $newFile, 80);
			if ($Miniatura) {imagejpeg($imgMini, $newFileMini, 80);}
			break;
		case "image/png":
//			imagepng($img, $newFile, 0);
			imagepng($NuevaImagen, $newFile, 0);
			if ($Miniatura) {imagepng($imgMini, $newFileMini, 0);}
			break;
		case "image/gif":
//			imagegif($img, $newFile);
			imagegif($NuevaImagen, $newFile);
			if ($Miniatura) {imagegif($imgMini, $newFileMini);}
			break;
	}

	unlink($tmpFile);

	$Imagen = getimagesize($newFile);

	$resultado = array();
	$resultado['Tipo'] = $ext;
	$resultado['ImagenAncho'] = $Imagen[0];
	$resultado['ImagenAlto'] = $Imagen[1];
	echo json_encode($resultado);
?>