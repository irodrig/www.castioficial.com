<?php
	require_once('connections/kriva.php'); 
	include('includes/inicializar.php'); 
	
	$qryPost = "SELECT * FROM WE_Noticias WHERE idNoticia = '".$_GET['id']."'";
	$rstPost = $MySQL->query($qryPost);
	$numPost = $rstPost->num_rows;

	$qryUltPost = "SELECT * FROM WE_Noticias WHERE Activo ORDER BY Fecha DESC LIMIT 10";
	$rstUltPost = $MySQL->query($qryUltPost);
	$numUltPost = $rstUltPost->num_rows;
	
	$qryCateg = "SELECT Categoria FROM WE_Noticias WHERE Activo GROUP BY Categoria";
	$rstCateg = $MySQL->query($qryCateg);
	$numCateg = $rstCateg->num_rows;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>CASTI Oficial</title>
<meta name="keywords" content=""/>
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

<div class="Seccion">
	<div class="ContenidoSeccion">
  	<div class="Seccion3_4 FLeft box">
    	<?php while ($rowPost = $rstPost->fetch_array()) { ?>
      	<div class="Post">
          <h2 class="TitularPost"><?php echo utf8_encode($rowPost['Titular']) ?></h2>
          <div class="AvancePost"><?php echo utf8_encode($rowPost['Noticia']) ?></div>
			<?php 
//				if (is_file("images/noticias/".$rowPost['idNoticia'].".".$rowPost['TipoArchivo'])) {
//					echo '<img src="images/noticias/'.$rowPost['idNoticia'].'.'.$rowPost['TipoArchivo'].'">';
//      	}
			?>
        </div>
      <?php } ?>
    </div>
  	<div class="Seccion1_4 FRight">
    	<div class="headerSection">ULTIMOS POSTS</div>
      <?php while ($rowUltPost = $rstUltPost->fetch_array()) { ?>
      	<div class="lstPost">
        	<div class="Bold"><?php echo substr($rowUltPost['Fecha'],8,2).' - '.substr($rowUltPost['Fecha'],5,2).' - '.substr($rowUltPost['Fecha'],0,4) ?></div>
					<?php echo utf8_encode($rowUltPost['Titular']) ?>
        </div>
      <?php } ?>
    	<div class="headerSection">CATEGORIAS</div>
      <?php while ($rowCateg = $rstCateg->fetch_array()) { ?>
      	<div class="lstPost">
					<?php echo utf8_encode($rowCateg['Categoria']) ?>
        </div>
      <?php }?>
    </div>
	</div>
</div>

<?php
	include("includes/Footer.php");
?>
</body>
</html>
