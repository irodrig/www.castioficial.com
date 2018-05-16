<?php
	require_once('../connections/kriva.php'); 
	
	$url = str_replace('/adminCASTI','',$_SERVER['PHP_SELF']);
	$raiz = str_replace('//localhost','',$_SESSION['Raiz']);
	$qryPage = "SELECT idMenu, Descripcion, Observaciones FROM GE_Menu WHERE CONCAT('/',URL) = '".$url."'"." OR CONCAT('".$raiz."',URL) = '".$url."'";
	$rstPage = $MySQL->query($qryPage);
	$rowPage = $rstPage->fetch_array();

	ValidarAcceso($MySQL, $rowPage['idMenu'], $_SESSION['idUsuario'], $_SESSION['idUsuarioTipo']);
	
	if (in_array('*', $_SESSION['Restricciones'])) {
		header("Location: ".$_SESSION['Raiz']."index.php");
	}

	$queryString = "";
	if (!empty($_SERVER['QUERY_STRING'])) {
		$Parametros = explode("&", $_SERVER['QUERY_STRING']);
		$ParametrosNuevos = array();
		foreach ($Parametros as $Parametros) {
			if (stristr($Parametros, "pagina") == false) {
				array_push($ParametrosNuevos, $Parametros);
			}
		}
		if (count($ParametrosNuevos) != 0) {
			$queryString = htmlentities(implode("&", $ParametrosNuevos));
		}
	}

	$MaxPagina = 50;
	if (isset($_GET['Pagina'])) {
		$rangoSQL = " LIMIT ".$MaxPagina*($_GET['Pagina']-1).", ".$MaxPagina;
	} else {
		$_GET['Pagina']=1;
		$rangoSQL = " LIMIT ".$MaxPagina;
	}


	$whereCond = " WHERE idUsuario!='KRIVA'";
	if ($_SESSION['idUsuarioTipo'] != 1) {
		$whereCond.= " AND idUsuario='".$_SESSION['idUsuario']."'";
	} else {
		$whereCond.= " AND idUsuario!=''";
	}
	if (isset($_GET['bUsuario']) AND $_GET['bUsuario'] != "") {
		$whereCond .= " AND Usuario LIKE '%".$_GET['bUsuario']."%'";
	} 
	if (isset($_GET['bUsuarioTipo']) AND $_GET['bUsuarioTipo'] != "") {
		$whereCond .= " AND idUsuarioTipo = '".$_GET['bUsuarioTipo']."'";
	}
	if (isset($_GET['bActivo']) AND $_GET['bActivo'] != "-1") {
		$whereCond .= " AND Activo = '".$_GET['bActivo']."'";
	}
	$orderQry = "Usuario";
	if (!isset($_POST['qOrden'])) {
		$_POST['qOrden'] = $orderQry;
	}
	if (isset($_POST['qOrden']) AND $_POST['qOrden'] != "") {
		$orderQry = $_POST['qOrden'];
	}
	
	$qry = "SELECT * FROM GE_Usuarios ".$whereCond;
	$rst = $MySQL->query($qry);
	$numRows = $rst->num_rows;
	$qry = "SELECT * FROM GE_Usuarios ".$whereCond." ORDER BY ".$orderQry.$rangoSQL;
	$rst = $MySQL->query($qry);
	$UltimaPagina = floor($numRows / $MaxPagina)+1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="../images/sgt.ico"/>
<title>SGT - <?php echo utf8_encode($rowPage['Descripcion']) ?></title>
<link href="../styles/reset.css" rel="stylesheet"/>
<link href="../styles/cssGeneral.php" rel="stylesheet"/>
<!-- jQuery -->
<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>-->
<script type="text/javascript" src="../libs/jquery.js"></script>

<?php
	include("../includes/smartMenu.php");
?>

<link rel="stylesheet" href="../libs/jquery-ui/css-jquery-ui.php">
<script src="../libs/jquery-ui/jquery-ui.js"></script>
<link rel="stylesheet" href="../libs/jquery-ui/css-jquery-ui.theme.php">

<script type="text/javascript" src="../includes/funciones.js"></script>
<script>
<?php
	$docFile = explode('.', basename($_SERVER['SCRIPT_NAME']));
?>
var Editando = 0;
var	DocumentoActual = "<?php echo $docFile[0] ?>";
var TituloPagina = "<?php echo $rowPage['Observaciones'] ?>"
var Raiz = "<?php echo $_SESSION['Raiz'] ?>";

$(document).ready(function(e) {
	inicializarListado(DocumentoActual, 'C35_6', '<?php echo $queryString ?>', <?php echo $_GET['Pagina'] ?>, <?php echo $UltimaPagina ?>);
});


</script>

</head>

<body>

<?php
	include("../includes/Header.php");
?>

<div id="SeccionContenido">
<div id="ContenedorPrincipal">
    <h1><?php echo $rowPage['Observaciones'] ?></h1>
    <div id="Acciones">
      <ul class="Botones">
				<?php if (!in_array('A', $_SESSION['Restricciones'])) { ?>
	        <li id="Add" class="BotonAccion"><a href="#Dialog" name="AddRow">A&Ntilde;ADIR</a></li>
        <?php	} ?>
        <li id="Busqueda" class="BotonAccion"><a href="#">BUSCAR</a></li>
        <li id="ImprimirResultados" class="BotonAccion"><a href="#">IMPRIMIR</a></li>
        <form id="fOrden" name="fOrden" action="<?php echo $_SERVER['PHP_SELF']."?".$queryString; ?>" method="post">
          <select name="qOrden">
            <option value="Usuario"<?php if ("Usuario"==$_POST['qOrden']) {echo "SELECTED";} ?>>USUARIO</option>
            <option value="idUsuarioTipo, Usuario"<?php if ("idUsuarioTipo, Usuario"==$_POST['qOrden']) {echo "SELECTED";} ?>>TIPO USUARIO</option>
            <option value="Activo DESC, Usuario"<?php if ("Activo DESC, Usuario"==$_POST['qOrden']) {echo "SELECTED";} ?>>ACTIVO</option>
          </select>
          <input type="image" src="../images/sort.png" alt="Submit Form" />
        </form>
      </ul>
    </div>
    <form id="FiltroBusqueda" name="FiltroBusqueda" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
      <h2 class="HeaderBusqueda">FILTRO DE BUSQUEDA<img src="../images/exit-icon.png" name="CerrarBusqueda" class="CerrarVentana" id="CerrarBusqueda"/></h2>
      <div class="Botones">
        <input class="BotonAccion" type="submit" value="APLICAR FILTRO"/>
      </div>
      <div id="DatosBusqueda">
        <div class="BusquedaCol_1_3 SeparadorBusquedaCol">
          <div class="BusquedaParametro">
            <label>USUARIO</label>
            <input name="bUsuario" type="text" id="bUsuario" value="<?php echo (isset($_GET['bUsuario']) ? $_GET['bUsuario'] :  NULL); ?>"/>
          </div>
				</div>
        <div class="BusquedaCol_1_3 SeparadorBusquedaCol">
          <div class="BusquedaParametro">
            <label for="bActivo">ACTIVO</label>
            <select name="bActivo" type="checkbox" id="bActivo">
							<option value="-1"></option>
            	<option value="1" <?php echo (isset($_GET['bActivo']) && $_GET['bActivo']==1 ? "SELECTED" : "") ?>>SI</option>
            	<option value="0" <?php echo (isset($_GET['bActivo']) && $_GET['bActivo']==0 ? "SELECTED" : "") ?>>NO</option>
            </select>
          </div>
        </div>
      </div>
    </form>
    <div class="Resultados">
      <table id="tableData">
        <thead class="fixedHeader">
          <tr id="trHeader" class="RowHeader">
            <td>USUARIO</td>
            <td>NOMBRE</td>
            <td>TIPO USUARIO</td>
            <td>TELEFONO</td>
            <td>E-MAIL</td>
            <td>ACTIVO</td>
          </tr>
        </thead>
        <tbody class="scrollContent">
          <?php 
            $i=0;
            while ($row = $rst->fetch_array()) {
              $i++; 
          ?>
              <tr class="RowData <?php echo ($i % 2 == 0 ? "RowOdd" : "RowPair") ?>" id="<?php echo htmlentities($row['idUsuario'], ENT_COMPAT, 'iso-8859-1'); ?>">
                <td style="width:150px" class="bDer"><?php echo $row['idUsuario']; ?></td>
                <td style="width:250px" class="bDer"><?php echo htmlentities($row['Usuario'],ENT_COMPAT,'iso-8859-1'); ?></td>
                <td style="width:250px" class="bDer"><?php echo ObtenerValor($MySQL, "GE_UsuarioTipos", "idUsuarioTipo", "UsuarioTipo", $row['idUsuarioTipo']); ?></td>
                <td style="width:200px" class="bDer"><?php echo $row['Telefono']; ?></td>
                <td style="width:250px" class="bDer"><?php echo htmlentities($row['Email'],ENT_COMPAT,'iso-8859-1'); ?></td>
                <td style="width:100px" class="bDer ACenter"><?php echo ($row['Activo'] ? "SI" : "NO"); ?></td>
              </tr>
          <?php 
            }
            $rst->free();
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php
	include("../includes/Footer.php");
?>

</body>
</html>
