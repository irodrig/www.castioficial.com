<?php 
//	error_reporting(0);

	if ($_SERVER['SERVER_NAME'] != 'localhost') {
		$carpeta = "../../images/".$_POST['Directorio'];
		$carpeta = "/home/castiofi/public_html/images/".$_POST['Directorio'];
	} else {
		$carpeta = "../../../PRS/CASTI/images/".$_POST['Directorio'];
	}
	if (!file_exists($carpeta)) {
			mkdir($carpeta, 0777, true);
	}

	$id = $_POST['id'];
	$directorio = $_POST['Directorio'];
	$AnchoImg = $_POST['AnchoImg'];
	$AltoImg = $_POST['AltoImg'];


	$nombre_archivo = $_FILES['File']['name'];
	$tipo_archivo =  $_FILES['File']['type'];
  $ext = end(explode(".", $nombre_archivo));
	
//	$newFile = $directorio.$id.".".$ext;
	if ($_SERVER['SERVER_NAME'] != 'localhost') {
		$newFile = "/home/castiofi/public_html/images/".$_POST['Directorio']."/".$id.".".$ext;
		$newFileMini = "/home/castiofi/public_html/images/".$_POST['Directorio']."/m".$id.".".$ext;
		$tmpFile = "/home/castiofi/public_html/images/".$_POST['Directorio']."/tmp".$id.".".$ext;
	} else {
		$newFile = "../../../PRS/CASTI/images/".$_POST['Directorio']."/".$id.".".$ext;
		$newFileMini = "../../../PRS/CASTI/images/".$_POST['Directorio']."/m".$id.".".$ext;
		$tmpFile = "../../../PRS/CASTI/images/".$_POST['Directorio']."/tmp".$id.".".$ext;
	}

	move_uploaded_file($_FILES['File']['tmp_name'], $tmpFile);
//	copy($tmpFile,$newFileMini);
//	copy($tmpFile,$newFile);
 
	$Imagen = getimagesize($tmpFile);
	$ImagenAncho = $Imagen[0];
	$ImagenAlto = $Imagen[1];
	$ImagenTipo = $Imagen['mime'];
	
	$ImagenProporcion = $ImagenAncho / $ImagenAlto;
/////////////////////////////////////////////////////////////////////////////////////////////
// SI QUEREMOS TRANSFORMA IMAGEN ANCHO Y ALTO PREDEFINIDO
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
	$AnchoMini = 120;
	$AltoMini = 120 / $ImagenProporcion;

	$img = imagecreatetruecolor($NuevoAncho, $NuevoAlto);
	$imgMini = imagecreatetruecolor($AnchoMini, $AltoMini);

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
			imagecolortransparent($imgMini, imagecolorallocate($img, 0, 0, 0));

			break;
		case "image/gif":
			$NuevaImagen = imagecreatefromgif( $tmpFile  );
			break;
	}

	$NuevaImagenMini = $NuevaImagen;

	imagecopyresized($img, $NuevaImagen, 0, 0, 0, 0, $NuevoAncho, $NuevoAlto, $ImagenAncho, $ImagenAlto);
	imagecopyresized($imgMini, $NuevaImagenMini, 0, 0, 0, 0, 120, 80, $ImagenAncho, $ImagenAlto);

	switch ($ImagenTipo){
		case "image/jpg":
		case "image/jpeg":
			imagejpeg($img, $newFile, 80);
			imagejpeg($imgMini, $newFileMini, 80);
			break;
		case "image/png":
			imagepng($img, $newFile, 0);
			imagepng($imgMini, $newFileMini, 0);
			break;
		case "image/gif":
			imagegif($img, $newFile);
			imagegif($imgMini, $newFileMini);
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