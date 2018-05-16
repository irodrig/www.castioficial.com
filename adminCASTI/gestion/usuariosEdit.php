<?php
//Valida Acceso
	require_once('../connections/kriva.php'); 

//Carga valores del registro cuando esta EDITANDO	
	if (isset($_POST['id'])) {
		$qry = "SELECT * FROM GE_Usuarios WHERE idUsuario = '".$_POST['id']."'";
		$rst = $MySQL->query($qry);
		$row = $rst->fetch_array();
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
		idEdicion = <?php echo (isset($_POST['id']) ? $_POST['id'] : "0") ?>;
		inicializarEdicion(idEdicion, DocumentoActual);

		attrUsuarioTipo = {
			idElemento: "#cmbUsuarioTipo",
			Etiqueta: "Tipo Usuario",
			Tabla: "GE_UsuarioTipos",
			Origen: "idUsuarioTipo, UsuarioTipo",
			Destino: "idUsuarioTipo, UsuarioTipo",
			Clase: "F25_6",
			SoloActivos: 1
		}
		ComboBusqueda(attrUsuarioTipo);
	});

<?php
	if (isset($_POST['id'])) {
?>
		$("#BotonPwd").click(function(e) {
			$("#ContenedorPrincipal").after('<div id="FormPwd"></div>');
			$("#FormPwd").load("usuariosPasswordEdit.php",  {id: "<?php echo $_POST['id'] ?>"});
			$("#FormPwd").attr("title","CAMBIO PASSWORD");
			$("#FormPwd").dialog({
				width:"auto",
				modal:true,
				position: {my:"center", at:"center", of:"#EditForm"},
				close: function() {
					$(this).remove();
				}
			});
		});
<?php
	}
?>
		
  </script>
  </head>
  
	<h2 class="HeaderBusqueda">EDITAR USUARIO<a href="#" class="Close"></a></h2>
  <div id="Mensaje"></div>
	<form id="EditForm" name="EditForm" method="post" class="FormData" enctype="multipart/form-data" >
    <div class="C6 C3_6">
    <div class="FormDataField">
      <label class="DataName">Usuario:</label>
      <input class="DataField F15_6 Required" <?php echo (isset($_POST['id']) ? 'readonly' : ''); ?> type="text" name="idUsuario" id="idUsuario" value="<?php echo (isset($_POST['id']) ? utf8_encode($row['idUsuario']) : ''); ?>">
    </div>
<?php
		if (!isset($_POST['id'])) {
?>
    <div class="FormDataField">
      <label class="DataName">Contrase&ntilde;a:</label>
      <input class="DataField F18_6 Required" type="password" name="pwd1" id="pwd1" placeholder="Escribir la contrase&ntilde;a">
    </div>
    <div class="FormDataField">
      <label class="DataName">Rep. Contrase&ntilde;a:</label>
      <input class="DataField F18_6 Required" type="password" name="pwd2" id="pwd2" placeholder="Repetir la contrase&ntilde;a">
    </div>
<?php
		}
?>    
    <div class="FormDataField" id="cmbUsuarioTipo" valor="<?php echo (isset($_POST['id']) ? $row['idUsuarioTipo']:"") ?>"></div>
    <div class="FormDataField">
      <label class="DataName">Nombre:</label>
      <input class="DataField F3_6 Required" type="text" name="Usuario" id="Usuario" value="<?php echo (isset($_POST['id']) ? utf8_encode($row['Usuario']) : ''); ?>">
    </div>
    <div class="FormDataField">
      <label class="DataName">Telefono:</label>
      <input class="DataField F15_6" type="text" name="Telefono" id="Telefono" value="<?php echo (isset($_POST['id']) ? $row['Telefono'] : ''); ?>">
    </div>
    <div class="FormDataField">
      <label class="DataName">E-mail:</label>
      <input class="DataField F3_6" type="text" name="Email" id="Email" value="<?php echo (isset($_POST['id']) ? utf8_encode($row['Email']) : ''); ?>">
    </div>
    <div class="FormDataField">
      <label class="DataName" for="Activo">Activo:</label>
      <input class="DataField F1_6 Required" type="checkbox" name="Activo" id="Activo" <?php echo (isset($row['Activo']) && $row['Activo'] ? 'checked' : ''); ?>>
    </div>
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
	    <input id="BotonPwd" class="BotonAccion Right" type= "button" value="CAMBIAR CONTRASE&Ntilde;A">
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
	if ($("#pwd1").val() != $("#pwd2").val()) {
		$("#Error").html("Las contraseñas son diferentes");
		$("#pwd1").addClass("InvalidData");
		$("#pwd2").addClass("InvalidData");
		Valido = 0;
	}
	if (!Valido) {
		$("#MsgErrorDatos").slideDown(500);
	}
	return Valido;
}

</script>