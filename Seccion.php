<?php
	require_once('connections/kriva.php'); 
	include('includes/inicializar.php'); 
	
	$qry = "SELECT * FROM WE_Secciones WHERE idSeccion = '".$_GET['idSeccion']."'";
	$rst = $MySQL->query($qry);
	$row = $rst->fetch_array();

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo utf8_encode($row['Seccion']) ?> - CASTI Oficial</title>
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
	include_once("includes/analyticstracking.php");
	include("includes/Header.php");
?>

<div class="Seccion" id="Seccion">
	<div class="ContenidoSeccion ACenter">
  	<div id="Slogan"><?php echo utf8_encode($row['Seccion']) ?></div>
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
