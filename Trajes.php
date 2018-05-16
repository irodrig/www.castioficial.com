<?php
	require_once('connections/kriva.php'); 
	include('includes/inicializar.php'); 
	
	$qryArt = "SELECT * FROM WE_Productos WHERE Activo ORDER BY Orden";
	$rstArt = $MySQL->query($qryArt);
	$numArt = $rstArt->num_rows;
?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Trajes CASTI Oficial</title>
<meta name="keywords" content="Casti Oficial, Casti, Paula Casti, Moda, trajes, prendas, diseño, somoscasti"/>
<meta name="description" content="C A S T I se mueve entre la elegancia de la moda confeccionando prendas que están hechas para la mujer ambicisiosa, detallista y comprometida con sus ideales y la excentricidad de una mente creadora que convoca una revolucion conceptual y de conciencia movida por el instinto fuera de los parámetros marcados por la sociedad"/>
<?php
	include("includes/metas.php");
?>

<script type="text/javascript" src="libs/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function() {
});
</script>
</head>

<body>
<?php
	include_once("includes/analyticstracking.php");
	include("includes/Header.php");
?>

<div class="Seccion">
	<div class="ContenidoSeccion">
  
    	<?php 
				$pos=0;
				while ($rowArt = $rstArt->fetch_array()) { 
					$pos++;
			?>
  	<div class="Traje FLeft <?php echo ($pos % 2  ? 'TrajeIzq' : 'TrajeDer') ?>">
      <?php
				$NombreArchivo = array();
				$TipoArchivo = array();
				$srcImage = array();
				$PathImages = "images/";
				$directorio = "images/articulos/".$rowArt['idProducto'];

				if (is_dir($directorio)) {
					$archivos = scandir($directorio);
					$archivo = isset($archivos[2]) ? $archivos[2] : '';
				}
				$src = $directorio."/".$archivo;


				if (file_exists("images/articulos/".$rowArt['idProducto'])) {
					$directorio = opendir("images/articulos/".$rowArt['idProducto']); //ruta actual
					while ($archivo = readdir($directorio))
						{ if (!is_dir($archivo)) {array_push($NombreArchivo,$archivo);} }
				}
				
				sort($NombreArchivo);
				for ($i=0;$i<=count($NombreArchivo)-1;$i++) {
					$tmp = explode(".", $NombreArchivo[$i]);
					$TipoArchivo[$i] = strtolower(end($tmp));
			
					$srcImage[$i] = $PathImages."articulos/".$rowArt['idProducto']."/".$NombreArchivo[$i]."?".time();
				}

			?>
      	<div>
					<a href="Traje.php?idModelo=<?php echo $rowArt['idProducto'] ?>">
						<?php 
              for ($i=0;$i<=count($NombreArchivo)-1 && $i<1;$i++) {
                echo '<img src="'.$srcImage[$i]."?".time().'">';
              }
            ?>
	          <div class="NombreModelo">
						<?php echo utf8_encode($rowArt['Modelo']) ?>
            <?php if ($rowArt['Agotado']) { ?>
            <div class="Agotado">AGOTADO</div>
            <?php } ?>
            </div>
          </a>
        </div>
      </div>
      <?php } ?>
	</div>
</div>

<?php
	include("includes/Footer.php");
?>
</body>
</html>
