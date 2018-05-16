<?php
	require_once('connections/kriva.php'); 
	include('includes/inicializar.php'); 
	
	$qryPost = "SELECT * FROM WE_Colaboraciones WHERE idColaboracion = '".$_GET['id']."'";
	$rstPost = $MySQL->query($qryPost);
	$numPost = $rstPost->num_rows;
	$rowPost = $rstPost->fetch_array();

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
<title><?php echo utf8_encode($rowPost['Titular']) ?> - CASTI Oficial</title>
<meta name="keywords" content="<?php echo utf8_encode($rowPost['Keywords']) ?>"/>
<meta name="description" content="<?php echo utf8_encode($rowPost['Avance']) ?>"/>

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
    	<?php // while ($rowPost = $rstPost->fetch_array()) { ?>
      	<div class="Post">
          <div class="TitularPost"><?php echo utf8_encode($rowPost['Titular']) ?></div>
        	<div class="headerPost">
						<?php 
              if (is_file("images/Colaboradores/".$rowPost['idColaborador'].".JPG")) {
                echo '<img class="BloggerImg" src="images/Colaboradores/'.$rowPost['idColaborador'].'.JPG">';
              }
            ?>
            <div class="BloggerPost">
            	<p class="datePost">
	              <?php echo Dia($rowPost['Fecha']) ?> <?php echo $NombreMes[Mes($rowPost['Fecha'])-1] ?>, <?php echo Ano($rowPost['Fecha']) ?>
              </p>
							<p class="nameBloggerPost">
	              <?php echo ObtenerValor($MySQL,"WE_Colaboradores","idColaborador", "Nombre, Apellido",$rowPost['idColaborador']) ?>
              </p>
            </div>
            <div class="socialPost">
              <a href="<?php echo $rowEmpresa['Facebook'] ?>"><img class="btnRRSS" src="images/rrss/Facebook.png"></a>
              <a href="<?php echo $rowEmpresa['Twitter'] ?>"><img class="btnRRSS" src="images/rrss/Twitter.png"></a>
            </div>
          </div>
          <div class="AvancePost"><?php echo utf8_encode($rowPost['Noticia']) ?></div>
			<?php 
//				if (is_file("images/Colaboraciones/".$rowPost['idColaboracion'].".".$rowPost['TipoArchivo'])) {
//					echo '<img src="images/Colaboraciones/'.$rowPost['idColaboracion'].'.'.$rowPost['TipoArchivo'].'">';
//      	}
			?>
        </div>
      <?php // } ?>
    </div>
  	<div id="postsInfluencers"  class="Seccion1_4 FRight">
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
