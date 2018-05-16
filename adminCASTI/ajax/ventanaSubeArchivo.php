<?php
	require_once('../connections/kriva.php'); 

	$PathImages = $_SESSION['Web']."/images";
	$Miniatura = isset($_POST['Miniatura']) && $_POST['Miniatura'] == '1' ? true : false;

	$AnchoImg = isset($_POST['AnchoImg']) && $_POST['AnchoImg']>0 ? $_POST['AnchoImg'] : 600;
	$AltoImg = isset($_POST['AltoImg']) && $_POST['AltoImg']>0 ? $_POST['AltoImg'] : 400;

?>
<style>
.custom-input-file {
    overflow: hidden;
    position: relative;
    cursor: pointer;
}
.custom-input-file .input-file {
    margin: 0;
    padding: 0;
    outline: 0;
    font-size: 10000px;
    border: 10000px solid transparent;
    opacity: 0;
    filter: alpha(opacity=0);
    position: absolute;
    right: -1000px;
    top: -1000px;
    cursor: pointer;
}
.botonFile{
	float: left;
	margin: 0px 0px 0px 2px;
	background: #333;
	padding: 2px;
	color: #FFFFFF;
	font-weight: bold;
	border-radius: 4px;
	border: 1px solid #111;
	font-size: 10px;
	line-height:8px;
	top:2px;
}
</style>
<script>
$(document).ready(function(e) {
	existeImagen = "<?php echo $_POST['existeImagen'] ?>";
	objArchivo = $("<?php echo $_POST['obj'] ?>");

//	$("#ImagenSubida").attr('src',$("<?php echo $_POST['obj'] ?>").attr('src'));
	$("#ImagenSubida").attr('src',$(objArchivo).find('#imagen').attr('src'));
	$("#TipoArchivo").val($(objArchivo).find('#TipoArchivo').val());

	$("#dialogUploadFile").dialog({
		position: {my: "center",at: "center",of: "#editBox"},
	});
});

$("#File").change(function(e) {
	var file = $("#File")[0].files[0];
	$("#NombreArchivoSubir").val(file.name);
});

$("#UF").click(function() {
	var file = $("#File")[0].files[0];
	var fileName = file.name;

	fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
	var id = $("#Seccion<?php echo $_POST['id'] ?> #idEmpresaSeccion").val();
	
	var dataToSend = new FormData($("#formUploadFile")[0]);
	<?php if ($Miniatura) { ?> 
		dataToSend.append('Miniatura','1');
	<?php } ?>
			
	$.ajax({
		url: '<?php echo $_SESSION['Web'] ?>/ajax/SubeArchivoWeb.php',
		crossDomain : true,
		data: dataToSend,
		dataType: 'JSON',
		type: 'POST',
		cache: false,
		contentType: false,
		processData: false,
		beforeSend: function(){
			$("#ImagenSubida").attr("src","<?php echo $PathImages ?>/SubiendoImagen.gif").attr("width","128");
		},
		error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.status + "\n" + thrownError);
		},
	}).done(function(resp) {
		existeImagen="1";
		$("#MsgErrorUF").html(resp);
		$("#TipoArchivo").val(resp.Tipo);
		$("#AltoImagen").val(resp.ImagenAlto);
		$("#AnchoImagen").val(resp.ImagenAncho);
	
		d = new Date();
		$("#ImagenSubida").attr("src","<?php echo $_SESSION['Web']."/images/".$_POST['Directorio']."/".$_POST['id'] ?>" + "." + resp.Tipo + '?'+d.getTime()).attr("width",<?php echo $AnchoImg ?>);
//		$("#ImagenSubida").attr("src","<?php echo $_SESSION['Web']."/images/".$_POST['Directorio']."/".$_POST['id'] ?>" + "." + resp.Tipo + '?'+d.getTime()).attr("width",resp.ImagenAncho);
		$(objArchivo).find("#imagen").attr('src',$("#ImagenSubida").attr('src'));
		$(objArchivo).find("#NombreArchivo").val('<?php echo $_POST['id'] ?>' + '.' + resp.Tipo);
		$(objArchivo).find("#TipoArchivo").val(resp.Tipo);
	});
})

$("#BorrarImagen").click(function() {
	$("#dialogUploadFile").remove();

	var data = {
		idFile: $(objArchivo).find("#NombreArchivo").val(),
		Directorio: '<?php echo $_POST['Directorio'] ?>',
	};
			
	$.ajax({
		url: '<?php echo $_SESSION['Web'] ?>/ajax/BorraArchivoWeb.php',
		crossDomain : true,
		data: data,
		dataType: 'JSON',
		type: 'POST',
		cache: false,
		error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.status + "\n" + thrownError);
		},
	}).done(function(resp) {
//		alert (resp.dir);
		$(objArchivo).remove();
	});
});

$("#VolverImagen").click(function() {
	if (existeImagen == '') { 
		$(objArchivo).remove();
	}
	$("#dialogUploadFile").remove();
	
});


</script>
<form enctype="multipart/form-data" id="formUploadFile" class="msgWindow C6">
  <div class="FormDataField" style="text-align:center">
	<input id="id" name="id" type="hidden" value="<?php echo $_POST['id'] ?>"/>
	<p>La imagen a subir se transformará tomando un ancho de <?php echo $AnchoImg ?>px y adaptará el alto de acuerdo a su proporción original</p>
	<p>Seleccione un archivo de imagen para subir (jpg / png / gif)</p>
  </div>

	<div id="MsgErrorUF"></div>
  <div class="FormDataField">
    <label class="DataName" style="width:auto">Archivo:</label>
    <div class="custom-input-file botonMini">
      <input id="File" name="File" type="file" size="1" class="input-file" />
      EXAMINAR ...
	  </div>
    <input disabled class="DataField F25_6" type="text" id="NombreArchivoSubir">
 	  <div id="UF" class="botonMini Right">Subir IMAGEN</div>
	</div>

  <div id="UF_img" style="border:2px solid #444;text-align:center;margin-top:10px">
		<?php 
        $srcImage = $PathImages."ImagenNoDisponible.png";
    ?>
	  <img id="ImagenSubida" src="" width="<?php echo $AnchoImg ?>px" >
  </div>

<!--
  <div class="FormDataField">
  	<label class="DataName" style="width:auto">Ancho Imagen:</label>
    <input readonly id="AnchoImagen" class="DataField F12_6" value="<?php echo $ImagenAncho ?>">
  	<label class="DataName" style="width:auto">Alto Imagen:</label>
    <input readonly id="AltoImagen" class="DataField F12_6" value="<?php echo $ImagenAlto ?>">
  </div>
-->

  <input id="Directorio" name="Directorio" type="hidden" value="<?php echo $_POST['Directorio'] ?>"/>
  <input id="AnchoImg" name="AnchoImg" type="hidden" value="<?php echo $AnchoImg ?>"/>
  <input id="AltoImg" name="AltoImg" type="hidden" value="<?php echo $AltoImg ?>"/>
  <input id="TipoArchivo" name="TipoArchivo" type="hidden"/>
  <br>
  <br>
  <div class="BarraBotones">
	  <div id="VolverImagen" class="BotonAccion Right">VOLVER</div>
		<?php if (isset($_POST['existeImagen']) && $_POST['existeImagen']) { ?>
	  <div id="BorrarImagen" class="BotonAccion Left">BORRAR ARCHIVO</div>
    <?php } ?>
  </div>
</form>
