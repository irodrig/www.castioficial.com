<?php
	require_once('connections/kriva.php'); 
	include('includes/inicializar.php'); 
	
//	$qryBlog = "SELECT * FROM WE_Noticias WHERE Activo ORDER BY Fecha DESC LIMIT 2";
//	$rstBlog = $MySQL->query($qryBlog);
//	$numBlog = $rstBlog->num_rows;

	$qry = "SELECT * FROM WE_Secciones WHERE Url = '".$_SERVER['REQUEST_URI']."'";
	$rst = $MySQL->query($qry);
	$row = $rst->fetch_array();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo utf8_encode($row['Nombre']) ?> - CASTI Oficial</title>
<meta name="keywords" content="<?php echo utf8_encode($row['Keywords']) ?>"/>
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
//	include_once("includes/analyticstracking.php");
	include("includes/Header.php");
?>

<div class="Seccion" id="SeccionPorSerTU">
	<div class="ContenidoSeccion">
  	<div id="Slogan"><?php echo utf8_encode($row['Nombre']) ?></div>

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
