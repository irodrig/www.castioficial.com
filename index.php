<?php
	require_once('connections/kriva.php'); 
	include('includes/inicializar.php'); 
	
	$qryProd = "SELECT * FROM WE_Productos WHERE Activo AND slideInicio ORDER BY Novedad DESC, Orden";
	$rstProd = $MySQL->query($qryProd);
	$numProd = $rstProd->num_rows;
	
	$imgProductos = array();
	$idProductos = array();
	$proximamente = array();
	while ($rowProd = $rstProd->fetch_array()) {
		$id = $rowProd['idProducto'];
		$PathImages = "images/";

		$NombreArchivo = array();
		if (file_exists("images/articulos/".$id)) {
			$directorio = opendir("images/articulos/".$id); //ruta actual
			while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
			{
				if (!is_dir($archivo))//verificamos si es o no un directorio
				{
					array_push($NombreArchivo,$archivo);
				}
			}
		}
		sort($NombreArchivo);
		
		array_push($imgProductos,$NombreArchivo);
		array_push($idProductos,$id);
		array_push($proximamente,$rowProd['Proximamente']);
	}
?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CASTI Oficial</title>
<meta name="keywords" content="Casti Oficial, Casti, Paula Casti, Moda, educo, ella, somoscasti"/>
<meta name="description" content="C A S T I se mueve entre la elegancia de la moda confeccionando prendas que están hechas para la mujer ambicisiosa, detallista y comprometida con sus ideales y la excentricidad de una mente creadora que convoca una revolucion conceptual y de conciencia movida por el instinto fuera de los parámetros marcados por la sociedad"/>
<?php
	include("includes/metas.php");
?>

<script type="text/javascript" src="libs/jquery.js"></script>
<!-- include Cycle plugin -->
<script type="text/javascript" src="libs/jquery.cycle2.js"></script>
<script src="libs/jquery.cycle2.shuffle.js"></script>
<script src="libs/jquery.cycle2.shuffleVert.js"></script>
<script type="text/javascript" src="libs/jquery.cycle2.center.js"></script>
<script type="text/javascript">
$(document).ready(function() {
//	$("#SeccionMenu").addClass("FondoGrano");
//	$('.cycle-slideshow').cycle({
//		timeout:3000,
//	});
});

</script>

<style>
/*#cycle-slideshow img { display: none }
#cycle-slideshow img.first { display: block }

.cycle-slideshow{
	margin:auto;
	height:700px;
}
.cycle-slideshow img{
	max-height:600px;
	max-width:100%;
}
.movSlide{
	position:absolute;
	top:250px;
	z-index:500;
	opacity:0.3;
	cursor:pointer;
}
#prev{
	left:0px;
}
#next{
	right:0px;
}
*/</style>
</head>

<body>
<?php
	include_once("includes/analyticstracking.php");
	include("includes/Header.php");
?>

<!--
<div class="Seccion FondoGrano">
	<div class="ContenidoSeccion">
    <div id="Slogan">
      <img src="images/HT_Viste2Vidas.png" alt="Viste 2 Vidas" style="width:183px;height:37px">
    </div>
  </div>
</div>
-->
<div class="Seccion" id="SeccionModelos">

    <div id="SlideInicio" style="position:relative">
    	<div id="boxImgSlideLeft"></div>
      <div id="boxImgSlideRight"></div>
      <img id="prev" class="movSlide" src="images/Anterior.png">
      <img id="next" class="movSlide" src="images/Siguiente.png">
      <div class="cycle-slideshow"
        data-cycle-fx="scrollHorz" 
        data-cycle-slides="> div"
        data-cycle-timeout="20000"
        data-cycle-speed="300"
        data-cycle-center-horz=true
        data-cycle-center-vert=true
        data-cycle-prev="#prev"
        data-cycle-next="#next"
      >
        <?php for ($i=0; $i<count($imgProductos); $i++) { ?>
			  <div class="ContenidoSeccion">
          <div class="FLeft Slide">
            <img src="images/articulos/<?php echo $idProductos[$i]."/".$imgProductos[$i][0]; ?>" alt="" <?php echo $i==0 ? 'class"first"' : '' ?>/>
          </div>
          <?php if ($proximamente[$i]) { ?>
          	<span class="textSlide">PROXIMAMENTE</span>
          <?php } else { ?>
          <a class="linkSlide" href="Traje.php?idModelo=<?php echo $idProductos[$i] ?>">Ver mas</a>
          <?php }  ?>
          <div  class="FRight Slide">
            <img style="top:0px;bottom0px" src="images/articulos/<?php echo $idProductos[$i]."/".$imgProductos[$i][1]; ?>" alt="" <?php echo $i==0 ? 'class"first"' : '' ?>/>
          </div>
        </div>
        <?php  } ?>
  
      </div>
    </div>
</div>


<?php
	include("includes/Footer.php");
?>
</body>
</html>
