<?php
	require_once('connections/kriva.php'); 
	include('includes/inicializar.php'); 
	
	$qryBlog = "SELECT * FROM WE_Colaboraciones WHERE Activo ORDER BY Fecha DESC LIMIT 3";
	$rstBlog = $MySQL->query($qryBlog);
	$numBlog = $rstBlog->num_rows;

	$qryUltPost = "SELECT * FROM WE_Colaboraciones WHERE Activo ORDER BY Fecha DESC LIMIT 10";
	$rstUltPost = $MySQL->query($qryUltPost);
	$numUltPost = $rstUltPost->num_rows;
	
	$qryCateg = "SELECT idColaborador FROM WE_Colaboraciones WHERE Activo GROUP BY idColaborador";
	$rstCateg = $MySQL->query($qryCateg);
	$numCateg = $rstCateg->num_rows;
	
?>
<!doctype html>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Colaboraciones - CASTI Oficial</title>
<meta name="keywords" content="colaboraciones, post moda, casti oficial, blog moda"/>
<meta name="description" content=""/>

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

<div class="Seccion">
	<div class="ContenidoSeccion">
  	<div class="Seccion3_4 FLeft box">
    	<?php while ($rowBlog = $rstBlog->fetch_array()) { ?>
      <?php
        $textoNoticia = $rowBlog['Avance'] == '' ? getSubString($rowBlog['Noticia'],230,'.') : "<p>".$rowBlog['Avance']."</p>";
			?>
      	<div class="ResumenPost">
          <h2 class="TitularPost">
          	<a href="postColaboracion.php?id=<?php echo $rowBlog['idColaboracion'] ?>"><?php echo utf8_encode($rowBlog['Titular']) ?></a>
          </h2>
          <div class="AvancePost"><?php echo utf8_encode($textoNoticia) ?></div>

           <a href="postColaboracion.php?id=<?php echo $rowBlog['idColaboracion'] ?>">SABER MAS</a>
        </div>
      <?php } ?>
    </div>
  	<div id="postsInfluencers" class="Seccion1_4 FRight">
    	<div class="headerSection">NUEVOS POSTS</div>
      <?php while ($rowUltPost = $rstUltPost->fetch_array()) { ?>
      	<div class="lstPost">
        	<a href="postColaboracion.php?id=<?php echo $rowUltPost['idColaboracion'] ?>">
						<?php echo utf8_encode($rowUltPost['Titular']) ?>
          </a>
        	<div>
						<?php echo substr($rowUltPost['Fecha'],8,2).'-'.substr($rowUltPost['Fecha'],5,2).'-'.substr($rowUltPost['Fecha'],0,4) ?>
						<span class="Bold">
							<?php echo ObtenerValor($MySQL,"WE_Colaboradores","idColaborador", "Nombre, Apellido",$rowUltPost['idColaborador']) ?>
            </span>
          </div>
        </div>
      <?php } ?>
    	<div class="headerSection">INFLUENCERS</div>
      <?php while ($rowCateg = $rstCateg->fetch_array()) { ?>
      	<div class="lstColaboradores">
					<?php 
            if (is_file("images/Colaboradores/".$rowCateg['idColaborador'].".JPG")) {
              echo '<img class="BloggerImg" src="images/Colaboradores/'.$rowCateg['idColaborador'].'.JPG">';
            }
          ?>
					<?php echo ObtenerValor($MySQL,"WE_Colaboradores","idColaborador", "Nombre, Apellido",$rowCateg['idColaborador']) ?>
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
