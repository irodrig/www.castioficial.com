<?php
	require_once('../connections/kriva.php'); 

	$_POST['SoloActivos'] = (isset($_POST['SoloActivos']) ? $_POST['SoloActivos'] : 0);

	$origen = explode(',',$_POST['Origen']);
	for ($i = 0; $i<count($origen); $i++) {
		$auxOrigen = explode(":",$origen[$i]);
		$parametroOrigen[$i] = trim($auxOrigen[0]);
		$mostrarParametroOrigen[$i] = (isset($auxOrigen[1]) ? trim($auxOrigen[1]) : "");
	}
	$destino = explode(',',$_POST['Destino']);
	for ($i = 0; $i<count($destino); $i++) {
		$auxDestino = explode(":",$destino[$i]);
		$parametroDestino[$i] = trim($auxDestino[0]);
	}

	$clase = ($_POST['Clase'] == "" ? "F2_6" : $_POST['Clase']);
	$clase.= ($_POST['Etiqueta'] == "" ? " FieldGrid" : "");
	$whereCond = ($_POST['Padre'] == "" ? "" : " WHERE ".$_POST['Padre']);

	$tabla = explode('.',$_POST['Tabla']);

	if (isset($_POST['Orden']) && $_POST['Orden'] != "") {
		$qry = "SELECT * FROM ".$_POST['Tabla'].$whereCond." ORDER BY ".$_POST['Orden'];
	} else {
		$qry = "SELECT * FROM ".$_POST['Tabla'].$whereCond." ORDER BY ".$parametroOrigen[1];
	}
	if (count($tabla) == 1) {
		$rst = $MySQL->query($qry);
	} else {
		$rst = $MainMySQL->query($qry);
	}

	$qryReg = "SELECT * FROM ".$_POST['Tabla'].($whereCond == "" ? " WHERE " : $whereCond." AND ")." ".$parametroOrigen[0]." = '".$_POST['ValorInicial']."'";
	if (count($tabla) == 1) {
		$rstReg = $MySQL->query($qryReg);
	} else {
		$rstReg = $MainMySQL->query($qryReg);
	}
//	$rstReg = $MySQL->query($qryReg);
	if ($rowReg = $rstReg->fetch_array()) {
		if (isset($rowReg['Activo']) && $rowReg['Activo']) {
			$regActivo = 1;
		} else {
			$regActivo = 0;
		}
	} else {
		$regActivo = 0;
	}
	
?>
<script>

$(document).delegate("#<?php echo $parametroDestino[0] ?>", "change", function(e) {
	nombreCampo = "<?php echo $parametroDestino[0] ?>";
	$.ajax({
		url: Raiz + '/ajax/obtenerValoresTabla.php',
		data: {Tabla: "<?php echo $_POST['Tabla'] ?>", Origen: "<?php echo $_POST['Origen'] ?>", Valor: $(this).val()},
//		dataType: "xml",
		type: 'POST',
		error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status);
        alert(thrownError);
		},
		success: function(resp){
			if ($(resp).find("<?php echo trim($parametroOrigen[1]) ?>").text() == "") {
				$("#<?php echo $parametroDestino[0] ?>").addClass("InvalidData");
			} else {
				$("#<?php echo $parametroDestino[0] ?>").removeClass("InvalidData");
			}
			<?php
			for ($i = 1; $i<count($parametroDestino); $i++) {
			?>
				if ($("#<?php echo trim($parametroDestino[$i]) ?>").is("input") || $("#<?php echo trim($parametroDestino[$i]) ?>").is("select")) {
// Actualiza el valor, en el caso de un checkbox marca/desmarca en función del valor
					if (	$("#<?php echo trim($parametroDestino[$i]) ?>").get(0).type  == "checkbox") {
						if ($(resp).find("<?php echo trim($parametroOrigen[$i]) ?>").text() == '1') {
							$("#<?php echo trim($parametroDestino[$i]) ?>").attr('checked','checked');
						} else {
							$("#<?php echo trim($parametroDestino[$i]) ?>").removeAttr('checked','checked');
						}
					} else {
						$("#<?php echo trim($parametroDestino[$i]) ?>").val($(resp).find("<?php echo trim($parametroOrigen[$i]) ?>").text());
					}
				}	
				
				$("#<?php echo trim($parametroDestino[$i]) ?>").change();
			<?php
			}
			?>
		}
	}).fail(function() {
    alert( "SE PRODUJO UN ERROR EN LA CARGA DE <?php echo $_POST['Etiqueta']; ?>" );
  });
})

</script>
<!--<html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
 <body>
--><?php
if ($_POST['Etiqueta'] != "") {
?>
	<label class="DataName" for="<?php echo $parametroDestino[0] ?>"><?php echo $_POST['Etiqueta']; ?>:</label>
<?php 
} 
if ($_POST['ReadOnly'] == "S" || (isset($_POST['Editable']) && $_POST['Editable'] == "N" && in_array('E', $_SESSION['Restricciones']))) {
?>
    <input type="hidden" name="<?php echo $parametroDestino[0] ?>" class="DataField <?php echo $clase ?> <?php echo ($_POST['Required'] =="S" ? "Required" : "") ?>" id="<?php echo $parametroDestino[0] ?>" value="<?php echo $_POST['ValorInicial'] ?>">
    <input type="text" readonly name="<?php echo $parametroDestino[1] ?>" class="DataField <?php echo $clase ?> <?php echo ($_POST['Required'] =="S" ? "Required" : "") ?>" id="<?php echo $parametroDestino[1] ?>" value="<?php echo ObtenerValor((count($tabla)>1 ? $MainMySQL : $MySQL), $_POST['Tabla'],$parametroOrigen[0],$parametroOrigen[1],$_POST['ValorInicial']) ?>">
<?php
} else {
?>
    <select name="<?php echo $parametroDestino[0] ?>" class="DataField <?php echo $clase ?> <?php echo ($_POST['Required'] =="S" ? "Required" : "") ?>" id="<?php echo $parametroDestino[0] ?>">
<?php
	 if (!isset($_POST['FilaEnBlanco']) || $_POST['FilaEnBlanco'] == 1) { 
?>
      <option value=""></option>
<?php
		}
?>      
    <?php
      while ($row = $rst->fetch_array()) {
        $Descripcion = trim($row[$parametroOrigen[1]]);
				for ($i = 2; $i<count($origen); $i++) {
					$Descripcion.= ($mostrarParametroOrigen[$i] != "N" ? " --- ".$row[$parametroOrigen[$i]] : "");
				}
		
				$regInicial = ($row[$parametroOrigen[0]] == $_POST['ValorInicial'] ? 1 : 0);
				$selected = ($regInicial ? 'selected' : '');
				$activo = ($_POST['SoloActivos'] && !$regActivo && $regInicial ? 'class="optionDisabled"' : '');
				
				if (!($_POST['SoloActivos'] && !$row['Activo']) || $regInicial) {
    ?>
      <option <?php echo $activo ?> value="<?php echo $row[$parametroOrigen[0]] ?>" <?php echo $selected; ?>><?php echo utf8_encode($Descripcion) ?></option>
    <?php
				}
      }
    ?>
    </select>
    <input type="hidden" name="<?php echo $parametroDestino[1] ?>" class="DataField <?php echo $clase ?>" id="<?php echo $parametroDestino[1] ?>" value="<?php echo ObtenerValor((count($tabla)>1 ? $MainMySQL : $MySQL), $_POST['Tabla'],$parametroOrigen[0],$parametroOrigen[1],$_POST['ValorInicial']) ?>">
<?php
}
?>

<!--</body>
</html>

-->