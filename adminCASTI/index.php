<?php
	require_once('connections/kriva.php'); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="images/sgt.ico"/>
<title>Webs Kriva - Area Administrativa</title>
<link href="styles/reset.css" rel="stylesheet"/>
<link href="styles/cssGeneral.php" rel="stylesheet"/>

<!-- jQuery -->
<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>-->
<script type="text/javascript" src="libs/jquery.js"></script>

<?php
	include("includes/smartMenu.php");
?>

<script>
$(document).ready(function(e) {
	$(".RowGrid:odd").addClass("RowOdd");
	$(".RowGrid:even").addClass("RowPair");
});
</script>
</head>

<body>
<?php
	include("includes/Header.php");
?>
<div id="SeccionContenido">

  <div id="ContenedorInicio" style="margin-top:90px">
  <!--    <p><strong>SISTEMA GESTION  TRANSPORTE</strong></p>
-->    <img src="images/<?php echo $_SESSION['Logo'] ?>" height="100" alt=""/>
    <p><small>Tu sesi&oacute;n est&aacute; iniciada desde <?php echo date('d-m-Y H:i:s', $_SESSION['InicioSesion']) ?></small></p>
  </div>
  
</div>
<?php
	include("includes/Footer.php");
?>
</body>
</html>

