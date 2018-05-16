<?php
//Valida Acceso
	require_once('../connections/kriva.php'); 

//Carga valores del registro cuando esta EDITANDO	
	if (isset($_POST['id'])) {
		$qry = "SELECT * FROM WE_Secciones WHERE idSeccion = '".$_POST['id']."'";
		$rst = $MySQL->query($qry);
		$row = $rst->fetch_array();
		$idSeccion = $row['idSeccion'];
	} else {
		$row['Activo'] = 1;
		$idSeccion = "";		
	}
	if ($_SERVER['SERVER_NAME'] != 'localhost') {
//		$carpeta = "../../CASTI/images/secciones";
		$carpeta = "http://castioficial.com/CASTI/images/secciones";
	} else {
		$carpeta = "../../../PRS/CASTI/images/secciones";
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
	idSeccion = "<?php echo $idSeccion ?>";
	inicializarEdicion(idEdicion, DocumentoActual);
	
	tinymce.init({
		plugins: ['textcolor colorpicker textpattern table code image fullscreen preview advlist link'],
		toolbar1: "undo redo | imageupload link | removeformat | fontsizeselect | bold italic underline | alignleft aligncenter alignright alignjustify | indent outdent bullist numlist | forecolor backcolor | table | code fullscreen preview",
		toolbar_items_size: 'small',
		menubar: false,
		statusbar: false,
		language: 'es',
		selector: "textarea.tinymce",
		setup: function(editor) {
				var inp = $('<input id="tinymce-uploader" type="file" name="pic" accept="image/*" style="display:none">');
				$(editor.getElement()).parent().append(inp);

				inp.on("change",function(){
					var input = inp.get(0);
					var file = input.files[0];
					var fr = new FileReader();
					fr.onload = function() {

					var formData = new FormData();

					id = uniqid("<?php echo $_SESSION['InicioSesion'] ?>");
					formData.append("id", id);
					formData.append("Directorio", "secciones/"+idSeccion);
					formData.append("AnchoImg", "1000");
					formData.append("AltoImg", "600");
					formData.append("File", file);

					$.ajax({
						url: '../ajax/SubirArchivo.php',
						data: formData,
						dataType: 'JSON',
						type: 'POST',
						cache: false,
						contentType: false,
						processData: false,
						error: function (xhr, ajaxOptions, thrownError) {MsgBox("NO SE PUDO SUBIR LA IMAGEN" + xhr.status + "\n" + thrownError); },
					}).done(function(resp) {
						editor.insertContent('<img src="<?php echo $carpeta ?>/'+idSeccion+"/"+id+'.'+resp.Tipo+'"/>');
						inp.val('');
					});
						
					}
					fr.readAsDataURL(file);
				});

				editor.addButton( 'imageupload', {
					tooltip: "Subir Imagen e Insertar",
					image: "../images/picture.png",
					onclick: function(e) {inp.trigger('click');}
				});
			}
	});

	attrSeccionGrupos = {
		idElemento: "#cmbSeccionGrupo:R", 
		Etiqueta: "Grupo",
		Tabla: "GE_SeccionGrupos",
		Origen: "idSeccionGrupo, SeccionGrupo",
		Destino: "idGrupoSeccion, SeccionGrupo",
		Clase: "F25_6", 
	}
	ComboBusqueda(attrSeccionGrupos);


});

$("#BotonGuardar").click(function(e) {
	var editor0 = tinymce.editors[0];
	var $ed_body0 = $(editor0.getBody());
	$("#SeccionHTML").val($ed_body0.html());
});

$("#BotonUpload").click(function(){
	var idSeccion = $("#idSeccion").val();

	$("#ContenedorPrincipal").after('<div id="dialogUploadFile"></div>');
	dataToSend = {
		id: idSeccion
		, TipoArchivo: $("#TipoArchivo").val()
		, Directorio: "secciones"
		, idImagen: "img"
		, AnchoImg: 600
		, AltoImg: 800
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
			$("#Titular").focus();
			$("#img").attr("src",id+".jpg");
		}
	});
});

</script>
<style>
.hidden{display:none;}
</style>
</head>

<div id="Mensaje"></div>
<form id="EditForm" name="EditForm" method="post" class="FormData" enctype="multipart/form-data" >
  <input type="hidden" name="idSeccion" id="idSeccion" value="<?php echo $idSeccion; ?>">
 	<input name="image" type="file" id="upload" class="hidden" onchange="">
 
  <div class="C6 C1080">
    <div class="FormDataField">
      <label class="DataName">ID:</label>
      <input readonly class="DataField F17_6 Required" type="text" name="idSeccion" id="idSeccion" value="<?php echo $idSeccion; ?>">
    </div>
      <div class="FormDataField" id="cmbSeccionGrupo" valor="<?php echo (isset($_POST['id']) ? $row['idGrupoSeccion']:"") ?>"></div>
    <div class="FormDataField">
      <label class="DataName">Secci&oacute;n:</label>
      <input class="DataField F6 Required" type="text" name="Seccion" id="Seccion" value="<?php echo (isset($_POST['id']) ? utf8_encode($row['Seccion']) : ''); ?>">
    </div>
    <div class="FormDataField">
      <label class="DataName">Url:</label>
      <input readonly class="DataField F2_6" type="text" name="Url" id="Url" value="<?php echo (isset($_POST['id']) ? utf8_encode($row['Url']) : ''); ?>">
    </div>
    <div class="FormTextareaField">
      <label class="DataName">Palabras Clave:</label>
      <textarea rows="2" class="TextareaField F6" name="Keywords" id="Keywords"><?php echo (isset($_POST['id']) ? utf8_encode($row['Keywords']) : ''); ?></textarea>
    </div>
    <div class="FormDataField">
      <label class="DataName" for="Activo">Activo:</label>
      <input class="DataField F1_6 Required" type="checkbox" name="Activo" id="Activo" <?php echo ((isset($row['Activo']) && !$row['Activo']) ? '' : 'checked'); ?>>
    </div>
    <div class="FormTextareaField">
      <label class="DataName">Descripcion:</label>
      <textarea rows="30" class="TextareaField F6 tinymce" name="SeccionHTML" id="SeccionHTML"><?php echo (isset($_POST['id']) ? utf8_encode($row['Descripcion']) : ''); ?></textarea>
    </div>
    <div class="FormTextareaField ACenter">
      <?php
				if ($_SERVER['SERVER_NAME'] == 'localhost') {
					$srv = "../../../PRS/CASTI";
				} else {
					$srv = "../../CASTI";
				}
				if (isset($row['TipoArchivo']) && is_file($srv."/images/secciones/".$idSeccion.".".$row['TipoArchivo'])) { 
        	$src = "/".$_SESSION['Web']."/images/secciones/".$idSeccion.".".$row['TipoArchivo']."?".time();
				} else {
	       	$src = "../images/ImagenNoDisponible.png";
				}
			?>
<!--
      <img id="img" src="<?php echo $src; ?>" width="200px"> 
-->
</div>
    <input type="hidden" name="TipoArchivo" id="TipoArchivo" class="DataField" value="<?php echo (isset($_POST['id']) ? utf8_encode($row['TipoArchivo']) : ''); ?>">
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
<!--    <input id="BotonUpload" class="BotonAccion Left" type= "button" value="SUBIR IMAGEN">-->
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