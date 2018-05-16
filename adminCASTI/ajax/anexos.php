<?php
//Valida Acceso
	require_once('../connections/kriva.php'); 

//Carga valores del registro cuando esta EDITANDO	
	if (isset($_POST['Id'])) {
		$qryAnexos = "SELECT * FROM GE_Anexos WHERE idEntidad = '".$_POST['Id']."' AND Tabla = '".$_POST['Tabla']."'";
		$rstAnexos = $MySQL->query($qryAnexos);
		$numAnexos = $rstAnexos->num_rows;
	} else {
		$numAnexos = 0;
	}
	$idAnexo = uniqid($_SESSION['InicioSesion']);		
?>

<script>
<?php
	$docFile = explode('.', basename($_SERVER['SCRIPT_NAME']));
?>
var	NombreDetalle = "<?php echo $docFile[0] ?>";
var NuevasFilasAnexos=1;
var idUltimaAnexo = "<?php echo $idAnexo; ?>";
$(document).ready(function(e) {
	NuevaFilaAnexos = $("#Anexo<?php echo $idAnexo; ?>").html();
	BotonBorrarAnexos = '<img src="../images/deleteGrid.png" class="borrarDetalle botonMini" />';
	
	$(".BorrarLineAnexos").each(function(index, domEle) {
		$(this).html(BotonBorrarAnexos);
	});
});

$(".tableGrid").delegate(".FieldGrid","change",function(){
	Linea = $(this).parent().parent().attr('idAnexo');
	NuevaFila = $(this).parent().parent().attr('NuevaFila');
	
	ValidaAnexos(Linea,  NuevaFila);
});

function ValidaAnexos(Linea, NuevaFila) {
	Valido = DatosRequeridos(Linea);
	idAnexo = uniqid("<?php echo $_SESSION['InicioSesion'] ?>");
	idLinea = $("#Anexo"+Linea).attr('idLinea');

	if (Valido && idLinea=="New" && NuevaFila==NuevasFilasAnexos) {
		NuevasFilasAnexos ++;
		$("#Anexo"+idUltimaAnexo+" .CeldaBotonBorrar").html(BotonBorrarAnexos);

		$("#UltFilaAnexos").before('<tr class="rowGrid" NuevaFila="'+NuevasFilasAnexos+'" idLinea="New" name="Anexos" id="Anexo'+idAnexo+'">'+NuevaFilaAnexos+'</tr>');
		$("#Anexo"+idAnexo).attr('idAnexo',idAnexo);
		$("#Anexo"+idAnexo+" #idAnexo").val(idAnexo);
		
		$("#Anexo"+idAnexo+" .FieldGrid").each(function(index, domEle) {
			if ($(this).hasClass("Cantidad")) {$(this).val(Number(0).toFixed(2))}
			if ($(this).hasClass("Precio")) {$(this).val(Number(0).toFixed(2))}
		});

		idUltimaAnexo = idAnexo;
	}
}



$(".botonUpload").click(function(){
//	var idLinea = $(this).parent().attr('idLinea');
	var idAnexo = $(this).parent().parent().attr('idAnexo');
	if ($("#Anexo"+idAnexo+" #Descripcion").val() != null && $("#Anexo"+idAnexo+" #Descripcion").val() != "") {

		$("#ContenedorPrincipal").after('<div id="dialogUploadFile"></div>');
		$("#dialogUploadFile").load("../ajax/uploadFile.php",  {idAnexo: idAnexo, Tabla: "<?php echo $_POST['Tabla'] ?>"});
		$("#dialogUploadFile").attr("title","SUBIR ANEXO");
		$("#dialogUploadFile").dialog({
			position: {
				my: "bottom",
				at: "top",
				of: "#Anexo"+idAnexo
			},
			width:"400px",
			modal:true,
			close: function() {
        $(this).remove();
				$("#CodVehiculo").focus();
      }
		});

	}

});



</script>
<div class="FormDataGrid">
  <table class="tableGrid C7_6" id="DetalleAnexos">
    <thead>
      <th width="80%" class="SeparadorBusquedaCol">DESCRIPCION</th>
      <th width="10%" class="SeparadorBusquedaCol">TIPO ARCHIVO</th>
      <th width="8%"></th>
      <th width="2%"></th>
    </thead>
    <tbody>
      <?php
				$auxCodAlmacen = "";
        if (isset($rstAnexos)) {
          while ( $rowAnexos = $rstAnexos->fetch_array()) {
?>
      <tr class="rowGrid" idLinea="<?PHP echo $rowAnexos['idAnexo'] ?>" name="AnexosCompras" idAnexo="<?PHP echo $rowAnexos['idAnexo'] ?>" id="Anexo<?PHP echo $rowAnexos['idAnexo'] ?>">
        <form id="Anexos<?PHP echo $rowAnexos['idAnexo'] ?>" name="Anexos<?PHP echo $rowAnexos['idAnexo'] ?>" method="post" class="lineGrid">
          <input type="hidden" name="idAnexo" class="FieldGrid" id="idAnexo" value="<?PHP echo $rowAnexos['idAnexo'] ?>">
          <input type="hidden" name="Tabla" class="FieldGrid" id="Tabla" value="<?PHP echo $rowAnexos['Tabla'] ?>">
          <input type="hidden" name="idEntidad" class="FieldGrid" id="idEntidad" value="<?PHP echo $rowAnexos['idEntidad'] ?>">
          <td class="SeparadorBusquedaCol">
	          <input type="text" class="FieldGrid" name="Descripcion" id="Descripcion" value="<?PHP echo $rowAnexos['Descripcion'] ?>">
          </td>
          <td class="SeparadorBusquedaCol">
	          <input type="text" class="FieldGrid" name="TipoArchivo" id="TipoArchivo" value="<?PHP echo $rowAnexos['TipoArchivo'] ?>">
          </td>
          <td align="center">
          	<?php
						$nameFile = "../images/".$_POST['Tabla']."/".$rowAnexos['idAnexo'].".".$rowAnexos['TipoArchivo'];
						$linkFile = "../images/".$_POST['Tabla']."/".$rowAnexos['idAnexo'].".".$rowAnexos['TipoArchivo'];
						$displayLink = (is_file($nameFile) ? "BLOCK" : "NONE");
						$displayUpload = (is_file($nameFile) ? "NONE" : "BLOCK");
						?>
						<a id="linkFile" href="<?php echo $linkFile; ?>" target="_blank" class="botonMini" style="display:<?php echo $displayLink ?>">VER</a>
						<a id="uploadFile" href="#" class="botonUpload botonMini" style="display:<?php echo $displayUpload ?>">SUBIR</a>
					</td>
          <td class="BorrarLineaAnexos">
						<img src="../images/deleteGrid.png" class="borrarDetalle botonMini" />
          </td>
        </form>
      </tr>
      <?php
          }
        }
?>
      <tr class="rowGrid" NuevaFila="1" idLinea="New" name="AnexosCompras" idAnexo="<?php echo $idAnexo; ?>" id="Anexo<?php echo $idAnexo; ?>">
        <form id="AnexosNew" name="AnexosNew" method="post" class="lineGrid">
          <input type="hidden" name="idAnexos" id="idAnexos" value="New">
          <input type="hidden" name="idAnexo" class="FieldGrid" id="idAnexo" value="<?php echo $idAnexo; ?>">
          <input type="hidden" name="Tabla" class="FieldGrid" id="Tabla" value="<?PHP echo $_POST['Tabla'] ?>">
          <input type="hidden" name="idEntidad" class="FieldGrid" id="idEntidad" value="<?PHP echo $_POST['Id'] ?>">
          <td class="SeparadorBusquedaCol">
	          <input class="FieldGrid New" type="text" name="Descripcion" id="Descripcion">
          </td>
          <td class="SeparadorBusquedaCol" >
          	<input class="FieldGrid New" type="text" name="TipoArchivo" id="TipoArchivo">
          </td>
          <td align="center">
						<a id="linkFile" href="#" target="_blank" class="botonMini" style="display:none">VER</a>
						<a id="uploadFile" href="#" class="botonUpload botonMini">SUBIR</a>
          </td>
          <td class="CeldaBotonBorrar"></td>
        </form>
      </tr>
      <tr id="UltFilaAnexos"></tr>
    </tbody>
  </table>
</div>



