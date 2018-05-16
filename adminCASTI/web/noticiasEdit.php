<?php
//Valida Acceso
	require_once('../connections/kriva.php'); 

//Carga valores del registro cuando esta EDITANDO	
	if (isset($_POST['id'])) {
		$qry = "SELECT * FROM WE_Noticias WHERE idNoticia = '".$_POST['id']."'";
		$rst = $MySQL->query($qry);
		$row = $rst->fetch_array();
		$idNoticia = $row['idNoticia'];
	} else {
		$row['Activo'] = 1;
		$idNoticia = uniqid($_SESSION['InicioSesion']);		
	}
	if ($_SERVER['SERVER_NAME'] != 'localhost') {
		$carpeta = "http://castioficial.com/CASTI/images/noticias";
	} else {
		$carpeta = "../../../PRS/CASTI/images/noticias";
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
	idNoticia = "<?php echo $idNoticia ?>";
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
					formData.append("Directorio", "noticias/"+idNoticia);
					formData.append("AnchoImg", "600");
					formData.append("AltoImg", "400");
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
//alert ('<img src="<?php echo $carpeta ?>/'+idNoticia+"/"+id+'.'+resp.Tipo+'"/>');
						editor.insertContent('<img src="http://castioficial.com/CASTI/images/noticias/'+idNoticia+"/"+id+'.'+resp.Tipo+'"/>');
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

});

$("#BotonGuardar").click(function(e) {
	var editor0 = tinymce.editors[0];
	var $ed_body0 = $(editor0.getBody());
	$("#NoticiaHTML").val($ed_body0.html());
});

$("#BotonUpload").click(function(){
	var idNoticia = $("#idNoticia").val();

	$("#ContenedorPrincipal").after('<div id="dialogUploadFile"></div>');
	dataToSend = {
		id: idNoticia
		, TipoArchivo: $("#TipoArchivo").val()
		, Directorio: "noticias"
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
  <input type="hidden" name="idNoticia" id="idNoticia" value="<?php echo $idNoticia; ?>">
 	<input name="image" type="file" id="upload" class="hidden" onchange="">
 
  <div class="C6 C1080">
    <div class="FormDataField">
      <label class="DataName">Fecha:</label>
      <input class="DataField F17_6 Required" type="date" name="Fecha" id="Fecha" value="<?php echo (isset($_POST['id']) ? $row['Fecha'] : date('Y-m-d')); ?>">
    </div>
    <div class="FormDataField">
      <label class="DataName">Titular:</label>
      <input class="DataField F6 Required" type="text" name="Titular" id="Titular" value="<?php echo (isset($_POST['id']) ? utf8_encode($row['Titular']) : ''); ?>">
    </div>
    <div class="FormDataField">
      <label class="DataName">Categoria:</label>
      <input class="DataField F2_6 Required" type="text" name="Categoria" id="Categoria" value="<?php echo (isset($_POST['id']) ? utf8_encode($row['Categoria']) : ''); ?>">
    </div>
    <div class="FormDataField">
      <label class="DataName">Avance:</label>
      <input class="DataField F6" type="text" name="Avance" id="Avance" value="<?php echo (isset($_POST['id']) ? utf8_encode($row['Avance']) : ''); ?>">
    </div>
    <div class="FormTextareaField">
      <label class="DataName">Palabras Clave:</label>
      <textarea rows="2" class="TextareaField F6 Required" name="Keywords" id="Keywords"><?php echo (isset($_POST['id']) ? utf8_encode($row['Keywords']) : ''); ?></textarea>
    </div>
    <div class="FormTextareaField">
      <label class="DataName">Noticia:</label>
      <textarea rows="30" class="TextareaField F6 tinymce" name="NoticiaHTML" id="NoticiaHTML"><?php echo (isset($_POST['id']) ? utf8_encode($row['Noticia']) : ''); ?></textarea>
    </div>
    <div class="FormDataField">
      <label class="DataName" for="Activo">Activo:</label>
      <input class="DataField F1_6 Required" type="checkbox" name="Activo" id="Activo" <?php echo ((isset($row['Activo']) && !$row['Activo']) ? '' : 'checked'); ?>>
    </div>
    <div class="FormTextareaField ACenter">
      <?php
				if ($_SERVER['SERVER_NAME'] == 'localhost') {
					$srv = "../../../PRS/CASTI";
				} else {
					$srv = "../../CASTI";
				}
				if (isset($row['TipoArchivo']) && is_file($srv."/images/noticias/".$idNoticia.".".$row['TipoArchivo'])) { 
        	$src = "/".$_SESSION['Web']."/images/noticias/".$idNoticia.".".$row['TipoArchivo']."?".time();
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