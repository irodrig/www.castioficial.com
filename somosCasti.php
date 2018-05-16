<?php
	require_once('connections/kriva.php'); 
	include('includes/inicializar.php'); 
	
//	$qryBlog = "SELECT * FROM WE_Noticias WHERE Activo ORDER BY Fecha DESC LIMIT 2";
//	$rstBlog = $MySQL->query($qryBlog);
//	$numBlog = $rstBlog->num_rows;

	$qry = "SELECT * FROM WE_Secciones WHERE idSeccion = '".$_GET['idSeccion']."'";
	$rst = $MySQL->query($qry);
	$row = $rst->fetch_array();

?>
<!doctype html>
<html>
<head>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo utf8_encode($row['Seccion']) ?> - CASTI Oficial</title>
<meta name="keywords" content="<?php echo utf8_encode($row['Keywords']) ?>"/>
<meta name="description" content="C A S T I se mueve entre la elegancia de la moda confeccionando prendas que están hechas para la mujer ambicisiosa, detallista y comprometida con sus ideales y la excentricidad de una mente creadora que convoca una revolucion conceptual y de conciencia movida por el instinto fuera de los parámetros marcados por la sociedad"/>

<?php
	include("includes/metas.php");
?>

<script type="text/javascript" src="includes/jquery.js"></script>
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

<div class="Seccion" id="SeccionSomosCasti">
	<div class="ContenidoSeccion ACenter">
  	<div id="Slogan"><?php echo utf8_encode($row['Seccion']) ?></div>
    <?php if ($rowEmpresa['urlVideo'] != '') { ?>
    <iframe id="videoYouTube" src="https://www.youtube.com/embed/<?php echo $rowEmpresa['urlVideo'] ?>?rel=0&autoplay=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
		<?php } ?>  
		<div id="SeccionDescripcion">
    <?php echo utf8_encode($row['Descripcion']) ?>
    </div>

  </div>
</div>

<?php
	include("includes/Footer.php");
?>
</body>
</html>
