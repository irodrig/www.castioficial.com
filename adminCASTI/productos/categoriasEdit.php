<?php
//Valida Acceso
	require_once('../connections/kriva.php'); 

//Carga valores del registro cuando esta EDITANDO	
	if (isset($_POST['id'])) {
		$qry = "SELECT * FROM AL_Categorias WHERE idCategoria = '".$_POST['id']."'";
		$rst = $MySQL->query($qry);
		$row = $rst->fetch_array();
		$idCategoria = $row['idCategoria'];
	} else {
		$idCategoria = uniqid($_SESSION['InicioSesion']);		
	}

?>
<html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script type="text/javascript" src="../libs/tinymce/tinymce.min.js"></script>

  <script>
		settings = {
			selector: "textarea.tinymce",
			statusbar: false,
			menubar: false
		};
		tinymce.init(settings);

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
});

$("#BotonGuardar").click(function(e) {
	var editor0 = tinymce.editors[0];
	var $ed_body0 = $(editor0.getBody());
	$("#DescripcionHTML").val($ed_body0.html());
});

$("#BotonUpload").click(function(){
	var idCategoria = $("#idCategoria").val();

	$("#ContenedorPrincipal").after('<div id="dialogUploadFile"></div>');
	dataToSend = {
		id: idCategoria
		, TipoArchivo: $("#TipoArchivo").val()
		, Directorio: "categorias"
		, idImagen: "img"
		, AnchoImg: 500
		, AltoImg: 500
	};
	$("#dialogUploadFile").load("../ajax/uploadFile.php",  dataToSend);
	$("#dialogUploadFile").attr("title","SUBIR IMAGEN");
	$("#dialogUploadFile").dialog({
		position: {
			my: "bottom",
			at: "top",
			of: "#editBox"
		},
		width:"600",
		modal:true,
		close: function() {
			$(this).remove();
			$("#Categoria").focus();
			$("#img").attr("src",id+".jpg");
		}
	});

});

		
  </script>
  </head>
  
  <div id="Mensaje"></div>
	<form id="EditForm" name="EditForm" method="post" class="FormData" enctype="multipart/form-data" >
    <input type="hidden" name="idCategoria" id="idCategoria" value="<?php echo $idCategoria; ?>">
    <div class="C6 C6_6">
    <div class="FormDataField">
      <label class="DataName">Categoria:</label>
      <input class="DataField F6 Required" type="text" name="Categoria" id="Categoria" value="<?php echo (isset($_POST['id']) ? utf8_encode($row['Categoria']) : ''); ?>">
    </div>
    <div class="FormDataField">
      <label class="DataName">Orden Web:</label>
      <input class="DataField F1_6 Required" type="number" name="OrdenWeb" id="OrdenWeb" value="<?php echo (isset($_POST['id']) ? utf8_encode($row['OrdenWeb']) : ''); ?>">
    </div>
    <div class="FormTextareaField">
      <label class="DataName">Palabras Clave:</label>
      <textarea rows="2" class="TextareaField F6 Required" name="Keywords" id="Keywords"><?php echo (isset($_POST['id']) ? utf8_encode($row['Keywords']) : ''); ?></textarea>
    </div>
    <div class="FormTextareaField">
      <label class="DataName">Descripcion:</label>
      <textarea rows="12" class="TextareaField F6 tinymce" name="DescripcionHTML" id="DescripcionHTML"><?php echo (isset($_POST['id']) ? utf8_encode($row['Descripcion']) : ''); ?></textarea>
    </div>
    <div class="FormDataField">
      <label class="DataName" for="Activo">Activo:</label>
      <input class="DataField F1_6 Required" type="checkbox" name="Activo" id="Activo" <?php echo (!isset($_POST['id']) || (isset($row['Activo']) && !$row['Activo']) ? '' : 'checked'); ?>>
    </div>
    <div class="FormTextareaField ACenter">
    	<?php
				if (is_file("../../images/categorias/".$idCategoria.".".$row['TipoArchivo'])) { 
        	$src = "/".$_SESSION['Web']."/images/categorias/".$idCategoria.".".$row['TipoArchivo']."?".time();
				} else {
	       	$src = "../images/ImagenNoDisponible.png";
				}
			?>
      
      <img id="img" src="<?php echo $src; ?>" width="200px">
    </div>
    <input type="hidden" name="TipoArchivo" id="TipoArchivo" class="DataField" value="<?php echo (isset($_POST['id']) ? utf8_encode($row['TipoArchivo']) : ''); ?>">
    <input type="hidden" name="accion" id="accion" value="<?php echo (isset($_POST['id']) ? 'E' : 'A'); ?>">
  </div>
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