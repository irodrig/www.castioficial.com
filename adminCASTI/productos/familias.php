<?php
	require_once('../connections/kriva.php'); 

	$url = str_replace('/admin','',$_SERVER['PHP_SELF']);
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

	$whereCond = "WHERE idFamilia!=''";
	if (isset($_GET['bFamilia']) AND $_GET['bFamilia'] != "") {
		$whereCond .= " AND Familia LIKE '%".$_GET['bFamilia']."%'";
	} 
	if (isset($_GET['bidCategoria']) AND $_GET['bidCategoria'] != "") {
		$whereCond .= " AND idCategoria = '".$_GET['bidCategoria']."'";
	} 
	$orderQry = "Familia";
	if (!isset($_POST['qOrden'])) {
		$_POST['qOrden'] = $orderQry;
	}
	if (isset($_POST['qOrden']) AND $_POST['qOrden'] != "") {
		$orderQry = $_POST['qOrden'];
	}
	
	$qry = "SELECT * FROM AL_Familias ".$whereCond;
	$rst = $MainMySQL->query($qry);
	$numRows = $rst->num_rows;
	$qry = "SELECT * FROM AL_Familias ".$whereCond." ORDER BY ".$orderQry.$rangoSQL;
	$rst = $MainMySQL->query($qry);
	$UltimaPagina = floor($numRows / $MaxPagina)+1;
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="../images/sgt.ico"/>
<title>WebAdmin - <?php echo utf8_encode($rowPage['Descripcion']) ?></title>
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
var TituloPagina = "<?php echo $rowPage['Observaciones']>'' ? $rowPage['Observaciones'] : $rowPage['Descripcion'] ?>"
var Raiz = "<?php echo $_SESSION['Raiz'] ?>";

$(document).ready(function(e) {
	inicializarListado(DocumentoActual, 'C6_6', '<?php echo $queryString ?>', <?php echo $_GET['Pagina'] ?>, <?php echo $UltimaPagina ?>);

	attrCategorias = {
		idElemento: "#cmbBCategoria",
		Etiqueta: "CATEGORIA",
		Tabla: "AL_Categorias",
		Origen: "idCategoria, Categoria",
		Destino: "bidCategoria, bCategoria",
		Clase: "F25_6",
		SoloActivos: 1
	}
	ComboBusqueda(attrCategorias);
});


</script>

</head>

<body>

<?php
	include("../includes/Header.php");
?>

<div id="SeccionContenido">
<div id="ContenedorPrincipal">
    <h1><?php echo utf8_encode($rowPage['Observaciones']>'' ? $rowPage['Observaciones'] : $rowPage['Descripcion']) ?></h1>
    <div id="Acciones">
      <ul class="Botones">
				<?php if (!in_array('A', $_SESSION['Restricciones'])) { ?>
	        <li id="Add" class="BotonAccion"><a href="#Dialog" name="AddRow">A&Ntilde;ADIR</a></li>
        <?php	} ?>
        <li id="Busqueda" class="BotonAccion"><a href="#">BUSCAR</a></li>
        <li id="ImprimirResultados" class="BotonAccion"><a href="#">IMPRIMIR</a></li>
        <form id="fOrden" name="fOrden" action="<?php echo $_SERVER['PHP_SELF']."?".$queryString; ?>" method="post">
          <select name="qOrden">
            <option value="Familia"<?php if ("Familia"==$_POST['qOrden']) {echo "SELECTED";} ?>>FAMILIA</option>
            <option value="idCategoria, Familia"<?php if ("idCategoria, Familia"==$_POST['qOrden']) {echo "SELECTED";} ?>>CATEGORIA</option>
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
            <label>FAMILIA</label>
            <input name="bFamilia" type="text" id="bFamilia" value="<?php echo (isset($_GET['bFamilia']) ? $_GET['bFamilia'] :  NULL); ?>"/>
          </div>
				</div>
        <div class="BusquedaCol_1_3 SeparadorBusquedaCol">
          <div class="BusquedaParametro" id="cmbBCategoria" valor="<?php echo (isset($_GET['bidCategoria']) ? $_GET['bidCategoria'] :  NULL); ?>"></div>
				</div>
      </div>
    </form>
    <div class="Resultados">
      <table id="tableData">
        <thead class="fixedHeader">
          <tr id="trHeader" class="RowHeader">
            <td>FAMILIA</td>
            <td>CATEGORIA</td>
            <td>ORDEN WEB</td>
            <td>PALABRAS CLAVE</td>
            <td>ACTIVA</td>
            <td>IMAGEN</td>
          </tr>
        </thead>
        <tbody class="scrollContent">
          <?php 
            $i=0;
            while ($row = $rst->fetch_array()) {
              $i++; 
          ?>
              <tr class="RowData <?php echo ($i % 2 == 0 ? "RowOdd" : "RowPair") ?>" id="<?php echo htmlentities($row['idFamilia'], ENT_COMPAT, 'iso-8859-1'); ?>">
                <td style="width:250px"><?php echo utf8_encode($row['Familia']); ?></td>
                <td style="width:300px"><?php echo ObtenerValor($MySQL,"AL_Categorias","idCategoria","Categoria",$row['idCategoria']); ?></td>
                <td style="width:50px"><?php echo $row['OrdenWeb']; ?></td>
                <td style="width:400px"><?php echo utf8_encode($row['Keywords']); ?></td>
                <td style="width:100px"><?php echo ($row['Activo'] ? 'SI' : ''); ?></td>
                <td style="width:100px" align="center">
									<?php
                    if (is_file("../../images/familias/".$row['idFamilia'].".".$row['TipoArchivo'])) { 
                      $src = "/".$_SESSION['Web']."/images/familias/".$row['idFamilia'].".".$row['TipoArchivo']."?".time();
                    } else {
                      $src = "../images/ImagenNoDisponible.png";
                    }
                  ?>
                  
                  <img src="<?php echo $src; ?>">
                </td>
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


</div>
</body>
</html>
