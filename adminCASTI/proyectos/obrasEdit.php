<?php
//Valida Acceso
	require_once('../connections/kriva.php'); 

//Carga valores del registro cuando esta EDITANDO	
	if (isset($_POST['id'])) {
		$qry = "SELECT * FROM PR_Obras WHERE idObra = '".$_POST['id']."'";
		$rst = $MySQL->query($qry);
		$row = $rst->fetch_array();
		$idObra = $row['idObra'];
	} else {
		$idObra = uniqid($_SESSION['InicioSesion']);		
	}

?>
<html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <script>
<?php if (in_array('E', $_SESSION['Restricciones']) && isset($_POST['id'])) { ?>
		$( document ).ajaxComplete(function() {
			$(".DataField, .FieldGrid, .TextareaField").each(function(index, element) {
				$(this).attr('disabled','disabled');
			});
			$(".borrarDetalle").each(function(index, element) {
				$(this).remove();
			});
		});
<?php } ?>

	$(document).ready(function(e) {
		idEdicion = "<?php echo (isset($_POST['id']) ? $_POST['id'] : "0") ?>";
		inicializarEdicion(idEdicion, DocumentoActual);
	
		attrTiposObras = {
			idElemento: "#cmbTipoObra::R",
			Etiqueta: "Tipo Obra",
			Tabla: "GE_TiposObras",
			Origen: "idTipoObra, TipoObra",
			Destino: "idTipoObra, TipoObra",
			Clase: "F25_6",
			SoloActivos: 1
		}
		ComboBusqueda(attrTiposObras);
	
		attrProvincias = {
			idElemento: "#cmbProvincia",
			Etiqueta: "Provincia",
			Tabla: "GE_Provincias",
			Origen: "idProvincia, Provincia",
			Destino: "idProvincia, Provincia",
			Clase: "F25_6",
		}
		ComboBusqueda(attrProvincias);
	
		$(".Tab").each(function(index, element) {
			$(this).hide();
		});
	
		datos = {
			idObra: '<?php echo ($idObra) ?>',
		};
		$("#boxSlides").html('<img src="../images/cargando.gif"/>');
		$("#boxSlides").load("SlidesObra.php", datos);
	});

	$( ".botonTab100" ).click(function() {
		var box = "#box" + $(this).attr('id');
		if ($(box).css('display') == 'none') {
			$(box).slideDown("slow");
		} else {
			$(box).slideUp("slow");
		}
	});

	$("#BotonGuardar").click(function(e) {
		$("#LineasSlides").val(GridToJSON("DetalleSlides","SLIDES"));
	});

  </script>
  </head>
  
<div id="Mensaje"></div>
<form id="EditForm" name="EditForm" method="post" class="FormData" enctype="multipart/form-data" >
    <input type="hidden" name="idObra" id="idObra" value="<?php echo $idObra; ?>">
    <input id="LineasSlides" name="LineasSlides" type="hidden" value="">
    <div class="C6 C6_6">
    <div class="FormDataField">
      <label class="DataName">Orden:</label>
      <input class="DataField F1_6" type="number" name="Orden" id="Orden" value="<?php echo (isset($_POST['id']) ? utf8_encode($row['Orden']) : ''); ?>">
    </div>
    <div class="FormDataField" id="cmbTipoObra" valor="<?php echo (isset($_POST['id']) ? $row['idTipoObra'] : ''); ?>"></div>
    <div class="FormDataField">
      <label class="DataName">Domicilio:</label>
      <input class="DataField F6" type="text" name="Domicilio" id="Domicilio" value="<?php echo (isset($_POST['id']) ? utf8_encode($row['Domicilio']) : ''); ?>">
    </div>
    <div class="FormDataField">
      <label class="DataName">Poblacion:</label>
      <input class="DataField F6" type="text" name="Poblacion" id="Poblacion" value="<?php echo (isset($_POST['id']) ? utf8_encode($row['Poblacion']) : ''); ?>">
    </div>
    <div class="FormDataField" id="cmbProvincia" valor="<?php echo (isset($_POST['id']) ? $row['idProvincia'] : ''); ?>"></div>
    <div class="FormDataField">
      <label class="DataName">Propietario:</label>
      <input class="DataField F6 Required" type="text" name="Propietario" id="Propietario" value="<?php echo (isset($_POST['id']) ? utf8_encode($row['Propietario']) : ''); ?>">
    </div>
    <div class="FormDataField">
      <label class="DataName">Fecha:</label>
      <input class="DataField F17_6" type="date" name="Fecha" id="Fecha" value="<?php echo (isset($_POST['id']) ? $row['Fecha'] : ''); ?>">
    </div>
    <div class="FormDataField">
      <label class="DataName" for="Activo">Activo:</label>
      <input class="DataField F1_6 Required" type="checkbox" name="Activo" id="Activo" <?php echo (!isset($_POST['id']) || (isset($row['Activo']) && !$row['Activo']) ? '' : 'checked'); ?>>
    </div>
    <div class="FormTextareaField ACenter">
      <input type="hidden" name="idObraImagen" id="idObraImagen" value="<?php echo $row['idObraImagen']; ?>">
		<?php
      $src = "../images/ImagenNoDisponible.png";
      $whereCond = " WHERE idObra = '".$row['idObra']."' AND Activo";
      $qryImagenes = "SELECT * FROM PR_ObrasImagenes ".$whereCond." ORDER BY Orden, idObraImagen";
      $rstImagenes = $MySQL->query($qryImagenes);
      if ($rowImagenes = $rstImagenes->fetch_array()) {
        if (is_file("../../images/obras/".utf8_encode($rowImagenes['idObraImagen']).".jpg")) { 
          $src = "/".$_SESSION['Web']."/images/obras/".utf8_encode($rowImagenes['idObraImagen']).".jpg"."?".time();
        }
      }
    ?>
      
      <img id="img" src="<?php echo $src; ?>" width="200px">
    </div>
    <input type="hidden" name="accion" id="accion" value="<?php echo (isset($_POST['id']) ? 'E' : 'A'); ?>">
    <div class="C6">
      <div id="DetalleSlides">
        <div class="botonTab100" id="Slides">SLIDES PROYECTO</div>
        <div id="boxSlides" class="Tab"></div>
      </div>
    </div>
  </div>
    <div id="MsgErrorDatos" class="MsgError"> <img id="CloseMsgError" src="../images/exit-icon20.png">
    <div id="Error"></div>
  </div>
    <div class="Botones">
    <?php
			if (isset($_POST['id'])) {
		?>
    <?php if (!in_array('B', $_SESSION['Restricciones'])) { ?>
    <input id="BotonBorrar" class="BotonAccion Right" type= "button" value="BORRAR">
    <?php	} ?>
    <?php
			}
		?>
    <?php if (!in_array('E', $_SESSION['Restricciones'])) { ?>
    <input id="BotonGuardar" class="BotonAccion Right" type="button" value="GUARDAR">
    <?php	} ?>
  </div>
  </form>
</html>
<script>
function ValidarFormulario() {
	var Valido = 1;
	$("#MsgErrorDatos").hide();
	$("#EditForm .Required").each(function(index, domEle) {
		if ($(domEle).val() == "") {
			$(domEle).addClass("InvalidData");
			Valido = 0;
			$("#Error").html("Falta informaci&oacute;n necesaria para completar el registro. Rellena todos los campos obligatorios");
		} else {
			$(domEle).removeClass("InvalidData");
		}
	});
	if (!Valido) {
		$("#MsgErrorDatos").slideDown(500);
	}
	return Valido;
}

</script>