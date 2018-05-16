<?php
	require_once('../connections/kriva.php'); 
	
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
	$("#dialogUploadFile").dialog({
		position: {
			my: "center",
			at: "center",
			of: "#editBox"
		},
	});
	
});

$("#File").change(function(e) {
	var file = $("#File")[0].files[0];
	$("#NombreArchivo").val(file.name);
});

$("#UF").click(function() {
	var file = $("#File")[0].files[0];
	var fileName = file.name;

	fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
	var id = $("#Seccion<?php echo $_POST['id'] ?> #idEmpresaSeccion").val();
	
//	UploadImagen('formUploadFile', id, "<?php echo $_POST['Directorio'] ?>");
    var dataToSend = new FormData($("#formUploadFile")[0]);		
		$.ajax({
			url: '../ajax/SubirArchivo.php',
			data: dataToSend,
			dataType: 'JSON',
			type: 'POST',
			cache: false,
			contentType: false,
      processData: false,
			beforeSend: function(){
				$("#ImagenSubida").attr("src","../images/SubiendoImagen.gif").attr("width","128");
			}
		}).done(function(resp) {
//			alert (resp);
//			$("#Seccion<?php echo $_POST['id'] ?> #Descripcion").focus();
			$("#Seccion<?php echo $_POST['id'] ?> #TipoArchivo").val(resp.Tipo);
			$("#Slide<?php echo $_POST['id'] ?> #TipoArchivo").val(resp.Tipo);
			$("#TipoArchivo").val(resp.Tipo);
			$("#AltoImagen").val(resp.ImagenAlto);
			$("#AnchoImagen").val(resp.ImagenAncho);

			d = new Date();
			$("#ImagenSubida").attr("src","/<?php echo $_SESSION['Web']."/images/".$_POST['Directorio']."/".$_POST['id'] ?>" + "." + fileExtension + '?'+d.getTime()).attr("width",resp.ImagenAncho);
			<?php if (isset($_POST['idImagen'])) { ?>
				$("#<?php echo $_POST['idImagen'] ?>").attr("src","/<?php echo $_SESSION['Web']."/images/".$_POST['Directorio']."/".$_POST['id'] ?>" + "." + fileExtension + '?'+d.getTime());
			<?php } ?>
		});
})

$("#VolverImagen").click(function() {
	$("#dialogUploadFile").remove();
});


</script>

<form enctype="multipart/form-data" id="formUploadFile" class="msgWindow C6">
  <div class="FormDataField" style="text-align:center">
	<input id="id" name="id" type="hidden" value="<?php echo $_POST['id'] ?>"/>
<!--	<p>La imagen a subir se transformará al siguiente tamaño: <?php echo $AnchoImg ?> de ancho por <?php echo $AltoImg ?> de alto</p>
	<p>Seleccione un archivo de imagen para subir (jpg / png / gif) de una proporcion similar</p> -->
	<p>La imagen a subir se transformará tomando un ancho de <?php echo $AnchoImg ?>px y adaptandose el alto a su proporción original</p>
	<p>Seleccione un archivo de imagen para subir (jpg / png / gif)</p>
  </div>

  <div class="FormDataField">
    <label class="DataName" style="width:auto">Archivo:</label>
    <div class="custom-input-file botonMini">
      <input id="File" name="File" type="file" size="1" class="input-file" />
      EXAMINAR ...
	  </div>
    <input disabled class="DataField F25_6" type="text" id="NombreArchivo">
 	  <div id="UF" class="botonMini Right">Subir IMAGEN</div>
	</div>

  <div id="UF_img" style="border:2px solid #444;text-align:center;margin-top:10px">
  <?php 
		if ($_POST['TipoArchivo'] == '' || $_POST['TipoArchivo'] == NULL) {
			$ImagenAncho = '';
			$ImagenAlto = '';
	?>
	  <img id="ImagenSubida" src="../images/ImagenNoDisponible.png" width="300px" >
  <?php 
		} else { 
			$imagenFile = "../../images/".$_POST['Directorio']."/".$_POST['id'].".".$_POST['TipoArchivo'];
			if (is_file($imagenFile)) {
				$Imagen = getimagesize($imagenFile);
				$ImagenAncho = $Imagen[0];
				$ImagenAlto = $Imagen[1];
			} else {
				$ImagenAncho = '';
				$ImagenAlto = '';
			}
	?>
	  <img id="ImagenSubida" src="/<?php echo $_SESSION['Web']."/images/".$_POST['Directorio']."/".$_POST['id'].".".$_POST['TipoArchivo']."?v=".time() ?>" width="<?php echo $AnchoImg ?>px" >
  <?php
  	}
	?>
  </div>
  <div class="FormDataField">
  	<label class="DataName" style="width:auto">Ancho Imagen:</label>
    <input readonly id="AnchoImagen" class="DataField F12_6" value="<?php echo $ImagenAncho ?>">
  	<label class="DataName" style="width:auto">Alto Imagen:</label>
    <input readonly id="AltoImagen" class="DataField F12_6" value="<?php echo $ImagenAlto ?>">
  </div>
<!--  <input id="Directorio" name="Directorio" type="hidden" value="/<?php echo $_SESSION['Web']."/images/".$_POST['Directorio']."/" ?>"/> -->
  <input id="Directorio" name="Directorio" type="hidden" value="<?php echo $_POST['Directorio'] ?>"/>
  <input id="AnchoImg" name="AnchoImg" type="hidden" value="<?php echo $AnchoImg ?>"/>
  <input id="AltoImg" name="AltoImg" type="hidden" value="<?php echo $AltoImg ?>"/>
  <br>
  <br>
  <div class="BarraBotones">
	  <div id="VolverImagen" class="BotonAccion Right">VOLVER</div>
  </div>
</form>
