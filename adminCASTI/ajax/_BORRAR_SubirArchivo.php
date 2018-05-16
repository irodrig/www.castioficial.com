<?php 
	error_reporting(0);

	$id = $_POST['id'];
	$directorio = $_POST['Directorio'];

	$nombre_archivo = $_FILES['File']['name'];
	$tipo_archivo =  $_FILES['File']['type'];
  $ext = end(explode(".", $nombre_archivo));
	
	$newFile = $directorio.$id.".".$ext;
	if ($_SERVER['SERVER_NAME'] != 'localhost') {
		$newFile = "../../images/".$_POST['Directorio']."/".$id.".".$ext;
		$newFileMini = "../../images/".$_POST['Directorio']."/m".$id.".".$ext;
	} else {
		$newFile = "../../../PRS/images/".$_POST['Directorio']."/".$id.".".$ext;
		$newFileMini = "../../../PRS/images/".$_POST['Directorio']."/m".$id.".".$ext;
	}

	move_uploaded_file($_FILES['File']['tmp_name'], $newFile);
	copy($newFile,$newFileMini);
 
	$Imagen = getimagesize($newFile);
	$ImagenAncho = $Imagen[0];
	$ImagenAlto = $Imagen[1];
	$ImagenTipo = $Imagen['mime'];
	
	switch ($ImagenTipo){
		case "image/jpg":
		case "image/jpeg":
			$NuevaImagen = imagecreatefromjpeg( $newFile );
			$NuevaImagenMini = imagecreatefromjpeg( $newFileMini );
			break;
		case "image/png":
			$NuevaImagen = imagecreatefrompng( $newFile );
			$NuevaImagenMini = imagecreatefrompng( $newFileMini );
			break;
		case "image/gif":
			$NuevaImagen = imagecreatefromgif( $newFile );
			$NuevaImagenMini = imagecreatefromgif( $newFileMini );
			break;
	}

	$ImagenProporcion = $ImagenAncho / $ImagenAlto;
	$NuevaProporcion = 1200 / 400;
	if ($ImagenProporcion > $NuevaProporcion){
		$NuevoAncho = 1200;
		$NuevoAlto = 1200 / $ImagenProporcion;
	} else if ( $ImagenProporcion < $NuevaProporcion ){
		$NuevoAncho = 400 * $ImagenProporcion;
		$NuevoAlto = 400;
	} else {
		$NuevoAncho = 1200;
		$NuevoAlto = 400;
	}

//	$lienzo = imagecreatetruecolor($NuevoAncho, $NuevoAlto);
//	$lienzo = $NuevaImagen;
//	$lienzoMini = $NuevaImagen;
	imagecopyresampled($lienzo, $NuevaImagen, 0, 0, 0, 0, $NuevoAncho, $NuevoAlto, $ImagenAncho, $ImagenAlto);
	imagecopyresampled($lienzoMini, $NuevaImagenMini, 0, 0, 0, 0, 120, 80, $ImagenAncho, $ImagenAlto);

	switch ($ImagenTipo){
		case "image/jpg":
		case "image/jpeg":
			imagejpeg($lienzo, $newFile, 80);
			imagejpeg($lienzoMini, $newFileMini, 80);
			break;
		case "image/png":
			imagepng($lienzo, $newFile, 0);
			imagepng($lienzoMini, $newFileMini, 0);
			break;
		case "image/gif":
			imagegif($lienzo, $newFile);
			imagegif($lienzoMini, $newFileMini);
			break;
	}

	$Imagen = getimagesize($newFile);

	$resultado = array();
	$resultado['Tipo'] = $ext;
	$resultado['ImagenAncho'] = $Imagen[0];
	$resultado['ImagenAlto'] = $Imagen[1];
	echo json_encode($resultado);
?>