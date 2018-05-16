<?php
//Valida Acceso
	require_once('../connections/kriva.php'); 

?>
<html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!--  <link href="../styles/reset.css" rel="stylesheet"/>
  <link href="../styles/general.css" rel="stylesheet"/>-->
  <script>
	$(document).ready(function(e) {
		$("#pwd1").focus();
		idEdicion = <?php echo (isset($_POST['id']) ? $_POST['id'] : "0") ?>;
	
		inicializarEdicion(idEdicion, 'usuarios');
	});

	$("#CambiarPwd").click(function(){
		if (ValidarFormulario()) {
			var url = "../sql/usuariosSqlEdit.php"; 
 			$.ajax({
				type: 'POST',
				url: url,
				data: $("#EditPwd").serialize(), 
				success: function(data)
				{
					id = $("#id").val();
					$("#FormPwd").dialog( "close" );
					$("#FormPwd").remove();
					$(".Close").click();
					$("#"+id).click();
				}
			});
			
			return false; // Evitar ejecutar el submit del formulario.
		}
	});

  </script>
  </head>
  
  <div id="Mensaje"></div>
	<form id="EditPwd" name="EditPwd" method="post" class="FormData" enctype="multipart/form-data" >
    <div class="C6 C3_6 Borde1">
      <div class="FormDataField">
        <label class="DataName">Contrase&ntilde;a:</label>
        <input class="DataField F2_6 Required" type="password" name="pwd1" id="pwd1" placeholder"Escribe la contraseña">
      </div>
      <div class="FormDataField">
        <label class="DataName">Repetir Contrase&ntilde;a:</label>
        <input class="DataField F2_6 Required" type="password" name="pwd2" id="pwd2" placeholder"Repite la contraseña">
      </div>
    </div>
    <input type="hidden" name="accion" id="accion" value="E_pwd">
    <input type="hidden" name="idUsuario" id="idUsuario" value ="<?php echo $_POST['id']; ?>">
	  </div>
	  <div id="MsgErrorPwd"></div>
    <div class="Botones">
    <input id="CambiarPwd" class="BotonAccion Right" type="button" value="CAMBIAR CONTRASE&Ntilde;A">
  </div>
  </form>
</html>
<script>
function ValidarFormulario() {
	var Valido = 1;
	$("#MsgErrorPwd").hide();
	$("#EditPwd .Required").each(function(index, domEle) {
		if ($(domEle).val() == "") {
			$(domEle).addClass("InvalidData");
			Valido = 0;
			$("#MsgErrorPwd").html("Falta informaci&oacute;n necesaria para completar el registro. Rellena todos los campos obligatorios");
		} else {
			$(domEle).removeClass("InvalidData");
		}
	});
	if ($("#pwd1").val() != $("#pwd2").val()) {
		$("#MsgErrorPwd").html("Las contraseñas son diferentes");
		$("#pwd1").addClass("InvalidData");
		$("#pwd2").addClass("InvalidData");
		Valido = 0;
	}
	if (!Valido) {
		$("#MsgErrorPwd").slideDown(500);
	}
	return Valido;
}

</script>