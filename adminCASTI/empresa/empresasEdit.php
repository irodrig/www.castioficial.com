<?php
//Valida Acceso
	require_once('../connections/kriva.php'); 

//Carga valores del registro cuando esta EDITANDO	
	if (isset($_POST['id'])) {
		$qry = "SELECT * FROM GE_Empresas WHERE CodEmpresa = '".$_POST['id']."'";
		$rst = $MainMySQL->query($qry);
		$row = $rst->fetch_array();
		$CodEmpresa =  $_POST['id'];
	} else {
		$CodEmpresa =  "";
	}

?>
<html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<script type="text/javascript" src="../libs/tinymce/tinymce.min.js"></script>
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

		attrProvincias = {
			idElemento: "#cmbProvincia", 
			Etiqueta: "Provincia",
			Tabla: "GE_Provincias",
			Origen: "idProvincia, Provincia",
			Destino: "idProvincia, Provincia",
			Clase: "F25_6", 
			Padre: "CodPais = 'ES'",
		}
		ComboBusqueda(attrProvincias);

		$(".Tab").each(function(index, element) {
      $(this).hide();
    });

		datos = {
			CodEmpresa: '<?php echo ($CodEmpresa) ?>',
		};
//		$("#boxSecciones").html('<img src="../images/cargando.gif"/>');
//		$("#boxSecciones").load("SeccionesEmpresa.php", datos);
//
//		$("#boxSlides").html('<img src="../images/cargando.gif"/>');
//		$("#boxSlides").load("SlidesEmpresa.php", datos);
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
		$("#LineasSecciones").val(GridToJSON("DetalleSecciones","SECCIONES"));
	});

  </script>
  </head>
  
	<h2 class="HeaderBusqueda">FICHA EMPRESA<a href="#" class="Close"></a></h2>
  <div id="Mensaje"></div>
	<form id="EditForm" name="EditForm" method="post" class="FormData C7_6" enctype="multipart/form-data" >
  	<input id="LineasSlides" name="LineasSlides" type="hidden" value="">
  	<input id="LineasSecciones" name="LineasSecciones" type="hidden" value="">
    <input type="hidden" name="CodigoEmpresa" id="CodEmpresa" value="<?php echo (isset($_POST['id']) ? $row['CodEmpresa'] : ''); ?>">
    <div class="C6 C6_6">
      <div class="C6 C3_6 Left">
        <div class="FormDataField">
          <label class="DataName">C&oacute;digo:</label>
          <input <?php echo ($_POST['id'] ? "readonly" : "")?> class="DataField F25_6 Required" type="text" name="CodEmpresa" id="CodEmpresa" value="<?php echo (isset($_POST['id']) ? $row['CodEmpresa'] : ''); ?>">
        </div>
        <div class="FormDataField">
          <label class="DataName">Razon Social:</label>
          <input class="DataField F25_6 Required" type="text" name="RazonSocial" id="RazonSocial" value="<?php echo (isset($_POST['id']) ? utf8_encode($row['RazonSocial']) : ''); ?>">
        </div>
        <div class="FormDataField">
          <label class="DataName">Direccion:</label>
          <input class="DataField F25_6" type="text" name="Direccion" id="Direccion" value="<?php echo (isset($_POST['id']) ? utf8_encode($row['Direccion']) : ''); ?>">
        </div>
        <div class="FormDataField">
          <label class="DataName">Numero:</label>
          <input class="DataField F2_6" type="text" name="Numero" id="Numero" value="<?php echo (isset($_POST['id']) ? utf8_encode($row['Numero']) : ''); ?>">
        </div>
        <div class="FormDataField">
          <label class="DataName">Piso:</label>
          <input class="DataField F2_6" type="text" name="Piso" id="Piso" value="<?php echo (isset($_POST['id']) ? $row['Piso'] : ''); ?>">
        </div>
        <div class="FormDataField">
          <label class="DataName">Codigo Postal:</label>
          <input class="DataField F12_6" type="text" name="CodPostal" id="CodPostal" value="<?php echo (isset($_POST['id']) ? $row['CodPostal'] : ''); ?>">
        </div>
        <div class="FormDataField">
          <label class="DataName">Municipio:</label>
          <input class="DataField F25_6 Required" type="text" name="Municipio" id="Municipio" value="<?php echo (isset($_POST['id']) ? utf8_encode($row['Municipio']) : ''); ?>">
        </div>
        <div class="FormDataField" id="cmbProvincia" valor="<?php echo (isset($_POST['id']) ? $row['idProvincia']:"") ?>"></div>
        <div class="FormDataField">
          <label class="DataName">NIF:</label>
          <input class="DataField F15_6 Required" type="text" name="NIF" id="NIF" value="<?php echo (isset($_POST['id']) ? utf8_encode($row['NIF']) : ''); ?>">
        </div>
      </div>
      <div class="C6 C25_6 Right">
        <div class="FormDataField">
          <label class="DataName">Telefono:</label>
          <input class="DataField F25_6" type="text" name="Telefono1" id="Telefono1" value="<?php echo (isset($_POST['id']) ? utf8_encode($row['Telefono1']) : ''); ?>">
        </div>
        <div class="FormDataField">
          <label class="DataName">Movil:</label>
          <input class="DataField F25_6" type="text" name="Telefono2" id="Telefono2" value="<?php echo (isset($_POST['id']) ? utf8_encode($row['Telefono2']) : ''); ?>">
        </div>
        <div class="FormDataField">
          <label class="DataName">Fax:</label>
          <input class="DataField F25_6" type="text" name="Fax" id="Fax" value="<?php echo (isset($_POST['id']) ? utf8_encode($row['Fax']) : ''); ?>">
        </div>
<!--
        <div class="FormDataField">
          <label class="DataName">Web:</label>
          <input readonly class="DataField F25_6" type="text" name="Web" id="Web" value="<?php echo (isset($_POST['id']) ? utf8_encode($row['Web']) : ''); ?>">
        </div>
-->
        <div class="FormDataField">
          <label class="DataName">Video:</label>
          <input class="DataField F25_6" type="text" name="urlVideo" id="urlVideo" value="<?php echo (isset($_POST['id']) ? utf8_encode($row['urlVideo']) : ''); ?>">
        </div>
        <div class="FormDataField">
          <label class="DataName">E-mail:</label>
          <input class="DataField F25_6" type="text" name="Email" id="Email" value="<?php echo (isset($_POST['id']) ? utf8_encode($row['Email']) : ''); ?>">
        </div>
        <div class="FormDataField">
          <label class="DataName">Facebook:</label>
          <input class="DataField F25_6" type="text" name="Facebook" id="Facebook" value="<?php echo (isset($_POST['id']) ? utf8_encode($row['Facebook']) : ''); ?>">
        </div>
        <div class="FormDataField">
          <label class="DataName">Instagram:</label>
          <input class="DataField F25_6" type="text" name="Instagram" id="Instagram" value="<?php echo (isset($_POST['id']) ? utf8_encode($row['Instagram']) : ''); ?>">
        </div>
        <div class="FormDataField">
          <label class="DataName">Twitter:</label>
          <input class="DataField F25_6" type="text" name="Twitter" id="Twitter" value="<?php echo (isset($_POST['id']) ? utf8_encode($row['Twitter']) : ''); ?>">
        </div>
<!--
        <div class="FormDataField">
          <label class="DataName">Base de Datos:</label>
          <input <?php echo ($_POST['id'] ? "readonly" : "")?> class="DataField F25_6 Required" type="text" name="BaseDatos" id="BaseDatos" value="<?php echo (isset($_POST['id']) ? $row['BaseDatos'] : ''); ?>">
        </div>
-->
        <div class="FormDataField">
          <label class="DataName">Color 1:</label>
          <input class="DataField Required" type="color" name="Color1" id="Color1" value="<?php echo (isset($_POST['id']) ? $row['Color1'] : ''); ?>">
        </div>
        <div class="FormDataField">
          <label class="DataName">Color 2:</label>
          <input class="DataField Required" type="color" name="Color2" id="Color2" value="<?php echo (isset($_POST['id']) ? $row['Color2'] : ''); ?>">
        </div>
      </div>
		</div>
    <br style="clear:both"/>
    <input type="hidden" name="accion" id="accion" value="<?php echo (isset($_POST['id']) ? 'E' : 'A'); ?>">
    
<!--
		<div class="C6">
      <div id="DetalleSlides">
        <div class="botonTab100" id="Slides">SLIDES INICIO</div>
        <div id="boxSlides" class="Tab"></div>
	    </div>
		</div>
		<div class="C6">
      <div id="DetalleSecciones">
        <div class="botonTab100" id="Secciones">SECCIONES</div>
        <div id="boxSecciones" class="Tab"></div>
	    </div>
		</div>
-->    
    <div id="MsgErrorDatos" class="MsgError">
    	<img id="CloseMsgError" src="../images/exit-icon20.png">
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