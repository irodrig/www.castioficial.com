<?php
//Valida Acceso
	require_once('../connections/kriva.php'); 

//Carga valores del registro cuando esta EDITANDO	
	if (isset($_POST['id'])) {
		$qry = "SELECT * FROM WE_Colaboradores WHERE idColaborador = '".$_POST['id']."'";
		$rst = $MySQL->query($qry);
		$row = $rst->fetch_array();
		$idColaborador = $row['idColaborador'];
	} else {
		$idColaborador = uniqid($_SESSION['InicioSesion']);
	}
	if ($_SERVER['SERVER_NAME'] != 'localhost') {
		$carpeta = "../../CASTI/images/Colaboradores";
	} else {
		$carpeta = "../../../PRS/CASTI/images/Colaboradores";
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

	$("#BotonUpload").click(function(){
		var idColaborador = $("#idColaborador").val();
	
		$("#ContenedorPrincipal").after('<div id="dialogUploadFile"></div>');
		dataToSend = {
			id: idColaborador
			, TipoArchivo: $("#TipoArchivo").val()
			, Directorio: "Colaboradores"
			, idImagen: "img"
			, AnchoImg: 225
			, AltoImg: 300
		};
		$("#dialogUploadFile").load("../ajax/uploadFile.php",  dataToSend);
		$("#dialogUploadFile").attr("title","SUBIR IMAGEN");
		$("#dialogUploadFile").dialog({
			position: {
				my: "bottom",
				at: "top",
				of: "#editBox"
			},
			width:"900",
			modal:true,
			close: function() {
				$(this).remove();
				$("#Nombre").focus();
				$("#img").attr("src",id+".jpg");
			}
		});
	});
});


</script>
</head>

<div id="Mensaje"></div>
<form id="EditForm" name="EditForm" method="post" class="FormData" enctype="multipart/form-data" >
  <input type="hidden" name="idColaborador" id="idColaborador" value="<?php echo $idColaborador; ?>">
  <div class="C6 C3_6">
    <div class="FormDataField">
      <label class="DataName">Fecha:</label>
      <input class="DataField F17_6 Required" type="date" name="Fecha" id="Fecha" value="<?php echo (isset($_POST['id']) ? $row['Fecha'] : date('Y-m-d')); ?>">
    </div>
    <div class="FormDataField">
      <label class="DataName">Nombre:</label>
      <input class="DataField F3_6 Required" type="text" name="Nombre" id="Nombre" value="<?php echo (isset($_POST['id']) ? utf8_encode($row['Nombre']) : ''); ?>">
    </div>
    <div class="FormDataField">
      <label class="DataName">Apellido:</label>
      <input class="DataField F3_6 Required" type="text" name="Apellido" id="Apellido" value="<?php echo (isset($_POST['id']) ? utf8_encode($row['Apellido']) : ''); ?>">
    </div>
    <div class="FormDataField">
      <label class="DataName">Tel&eacute;fono:</label>
      <input class="DataField F3_6" type="text" name="Telefono" id="Telefono" value="<?php echo (isset($_POST['id']) ? utf8_encode($row['Telefono']) : ''); ?>">
    </div>
    <div class="FormDataField">
      <label class="DataName">Email:</label>
      <input class="DataField F3_6 Required" type="text" name="Email" id="Email" value="<?php echo (isset($_POST['id']) ? utf8_encode($row['Email']) : ''); ?>">
    </div>

    <div class="FormTextareaField ACenter">
      <?php
				$src = $carpeta."/".$idColaborador.".".$row['TipoArchivo'];
				if (is_file($src)) { 
        	$src = $src."?".time();
				} else {
	       	$src = "../images/ImagenNoDisponible.png";
				}
			?>
      <img id="img" src="<?php echo $src; ?>" width="200px">
	    <input type="hidden" name="TipoArchivo" id="TipoArchivo" class="DataField" value="<?php echo (isset($_POST['id']) ? utf8_encode($row['TipoArchivo']) : ''); ?>">
		</div>

    <input type="hidden" name="accion" id="accion" value="<?php echo (isset($_POST['id']) ? 'E' : 'A'); ?>">
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
    <input id="BotonUpload" class="BotonAccion Left" type= "button" value="SUBIR IMAGEN">
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