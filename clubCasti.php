<?php
	require_once('connections/kriva.php'); 
	include('includes/inicializar.php'); 
	
//	$qryBlog = "SELECT * FROM WE_Noticias WHERE Activo ORDER BY Fecha DESC LIMIT 2";
//	$rstBlog = $MySQL->query($qryBlog);
//	$numBlog = $rstBlog->num_rows;
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

<div class="Seccion" id="SeccionVentajas">
	<div class="ContenidoSeccion">
  	<header id="Slogan">CLUB CASTI</header>
    <div>
    	<p>¡Bienvenido mecenas! Este apartado es solo para ti.</p>
			<p>Gracias a tu participación en nuestra campaña de Crowdfounding <strong>#Viste2Vidas</strong> hemos podido hacer nuestra marca real y queremos agradecértelo con estas ventajas en exclusiva. <strong>¡Gracias!</strong></p>
    </div>
    <div id="VentajasClubCasti">
      <div class="Seccion2_4 FLeft">
        <div class="Ventaja">
          <img src="images/icons/discount.png">
          <h2>DESCUENTO 25%</h2>
          en cada prenda</div>
      </div>
      <div class="Seccion2_4 FLeft">
        <div class="Ventaja">
          <img src="images/icons/envios.png">
          <h2>ENVÍOS Y DEVOLUCIONES</h2>
          gratuitas sin importe mínimo</div>
      </div>
      <div class="Seccion2_4 FLeft">
        <div class="Ventaja">
          <img src="images/icons/new.png">
          <h2>EXCLUSIVIDAD</h2>
          Recibe información de las  nuevas colecciones y los descuentos en exclusiva</div>
      </div>
      <div class="Seccion2_4 FLeft">
        <div class="Ventaja">
          <img src="images/icons/invitation.png">
          <h2>POR SER TÚ</h2>
          Invitación en primicia a  todos nuestros eventos</div>
      </div>
    </div>
  </div>
</div>

<?php
	include("includes/Footer.php");
?>
</body>
</html>
