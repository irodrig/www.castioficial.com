<?php
	require_once('connections/kriva.php'); 
	include('includes/inicializar.php'); 
	
	$_GET['idModelo'] = isset($_GET['idModelo']) ? $_GET['idModelo'] : '';
	$qryArt = "SELECT * FROM WE_Productos WHERE idProducto = '".$_GET['idModelo']."'";
	$rstArt = $MySQL->query($qryArt);
	$rowArt = $rstArt->fetch_array();
	$numArt = $rstArt->num_rows;
?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo utf8_encode($rowArt['Modelo']) ?> - CASTI Oficial</title>
<meta name="keywords" content="<?php echo utf8_encode($rowArt['Etiquetas']) ?>"/>
<meta name="description" content="C A S T I se mueve entre la elegancia de la moda confeccionando prendas que están hechas para la mujer ambicisiosa, detallista y comprometida con sus ideales y la excentricidad de una mente creadora que convoca una revolucion conceptual y de conciencia movida por el instinto fuera de los parámetros marcados por la sociedad"/>
<?php
	include("includes/metas.php");
?>

<script type="text/javascript" src="libs/jquery.js"></script>
<!-- include Cycle plugin -->
<script type="text/javascript" src="libs/jquery.cycle2.js"></script>
<script type="text/javascript" src="libs/jquery.cycle2.center.js"></script>
<script type="text/javascript">
$(document).ready(function() {
});
</script>


<style>
#cycle-slideshow img { display: none }
#cycle-slideshow img.first { display: block }
.movSlide{
	position:absolute;
	top:350px;
	z-index:500;
	opacity:0.3;
	cursor:pointer;
}

#prev{
	left:50px;
	width:30px;
}
#next{
	right:50px;
	width:30px;
}
</style>

</head>

<body>
<?php
	include_once("includes/analyticstracking.php");
	include("includes/Header.php");
?>

<div class="Seccion Clear">
<!--	<div class="ContenidoSeccion"> -->
    	<?php if ($rowArt) { 
				$NombreArchivo = array();
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
					$srcImage[$i] = $PathImages."articulos/".$rowArt['idProducto']."/".$NombreArchivo[$i]."?".time();
				}

			?>
		  	<div class="TrajeImagenes FLeft" >
        	<div id="movSlides">
            <img id="prev" class="movSlide" src="images/Anterior.png">
            <img id="next" class="movSlide" src="images/Siguiente.png">
          </div>
          <div class="cycle-slideshow" 
              data-cycle-fx="fadeout"
              data-cycle-speed="1000"
              data-cycle-timeout="0"
              data-cycle-center-horz=true
              data-cycle-center-vert=true
              data-cycle-prev="#prev"
              data-cycle-next="#next"
              >
						<?php 
							for ($i=0;$i<=count($NombreArchivo)-1;$i++) {
								echo '<img class="imagenTraje" src="'.$srcImage[$i]."?".time().'">';
							}
						?>
					</div>
          <?php if ($rowArt['idProductoRelacionado'] != '') { ?>
          <div id="productoRelacionado">
          	<p>LO MAS VENDIDO</p>
            <a href="Traje.php?idModelo=<?php echo $rowArt['idProductoRelacionado'] ?>">

<?php
				$NombreArchivo = array();
				$srcImageRelacionado = array();
				$PathImages = "images/";
				$directorio = "images/articulos/".$rowArt['idProductoRelacionado'];

				if (is_dir($directorio)) {
					$archivos = scandir($directorio);
					$archivo = isset($archivos[2]) ? $archivos[2] : '';
				}
				$src = $directorio."/".$archivo;


				if (file_exists("images/articulos/".$rowArt['idProductoRelacionado'])) {
					$directorio = opendir("images/articulos/".$rowArt['idProductoRelacionado']); //ruta actual
					while ($archivo = readdir($directorio))
						{ if (!is_dir($archivo)) {array_push($NombreArchivo,$archivo);} }
				}
				
				sort($NombreArchivo);
				for ($i=0;$i<=count($NombreArchivo)-1 && $i<2;$i++) {
					$srcImageRelacionado[$i] = $PathImages."articulos/".$rowArt['idProductoRelacionado']."/".$NombreArchivo[$i]."?".time();
				}
?>
						<?php 
							for ($i=0;$i<=count($NombreArchivo)-1 && $i<2;$i++) {
								echo '<img class="imagenTrajeRelacionado" src="'.$srcImageRelacionado[$i]."?".time().'">';
							}
						?>

						</a>
            
          </div>
          <?php } ?>



        </div>
        <div class="DescripcionTraje FRight">
        	<div class="Seccion50 FCenter">
            <?php if ($rowArt['Agotado']) { ?>
	            <div class="Agotado">AGOTADO</div>
            <?php } ?>
            <div id="ModeloTraje"><?php echo utf8_encode($rowArt['Modelo']).' - '.number_format($rowArt['Precio'],2,",",".").'&euro;' ?></div>
            <div class="textoDescripcionTraje"><?php echo utf8_encode($rowArt['Descripcion']) ?></div>
<!--            <div id="PrecioTraje"><?php echo number_format($rowArt['Precio'],2,",",".").'&euro;' ?></div> -->
            <?php if (!$rowArt['Agotado']) { ?>
	            <a href="<?php echo utf8_encode($rowArt['urlEcommerce']) ?>" class="botonCompra">AÑADIR AL CARRO DE COMPRAS</a>
            <?php } ?>
          </div>
        </div>
      <?php } ?>
<!--	</div>-->
</div>

<?php
	include("includes/Footer.php");
?>
</body>
</html>
