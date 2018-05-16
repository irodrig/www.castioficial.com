<?php
//Valida Acceso
	require_once('../connections/kriva.php'); 

//Carga valores del registro cuando esta EDITANDO	
	if (isset($_POST['CodEmpresa'])) {
		$qrySecciones = "SELECT * FROM GE_EmpresasSecciones WHERE CodEmpresa = '".$_POST['CodEmpresa']."'";
		$rstSecciones = $MySQL->query($qrySecciones);
		$numSecciones = $rstSecciones->num_rows;
	} else {
		$numSecciones = 0;
	}
	$idSeccion = uniqid($_SESSION['InicioSesion']);		
?>

<script>
<?php
	$docFile = explode('.', basename($_SERVER['SCRIPT_NAME']));
?>
var	NombreDetalle = "<?php echo $docFile[0] ?>";
var NuevasFilasSecciones=1;
var idUltimaSeccion = "<?php echo $idSeccion; ?>";
$(document).ready(function(e) {
	NuevaFilaSecciones = $("#Seccion<?php echo $idSeccion; ?>").html();
	BotonBorrarSecciones = '<img src="../images/deleteGrid.png" class="borrarDetalle botonMini" />';
	BotonDescripcion = '<a id="htmlDescripcion" href="#" idHtmlField="Descripcion" class="botonMini htmlEditor">DESCRIPCION</a>';
	BotonImagen = '<a id="uploadFile" href="#" class="btnUploadImgSeccion botonMini">SUBIR</a>';

	
	$(".BorrarLineSecciones").each(function(index, domEle) {
		$(this).html(BotonBorrarSecciones);
	});
});

$(".tableGrid").delegate(".FieldGrid","change",function(){
	Linea = $(this).parent().parent().attr('idSeccion');
	NuevaFila = $(this).parent().parent().attr('NuevaFila');
	
	ValidaSecciones(Linea,  NuevaFila);
});

function ValidaSecciones(Linea, NuevaFila) {
	Valido = DatosRequeridos(Linea);
	idSeccion = uniqid("<?php echo $_SESSION['InicioSesion'] ?>");
	idLinea = $("#Seccion"+Linea).attr('idLinea');

	if (Valido && idLinea=="New" && NuevaFila==NuevasFilasSecciones) {
		NuevasFilasSecciones ++;
		$("#Seccion"+idUltimaSeccion+" .CeldaBotonBorrar").html(BotonBorrarSecciones);
		$("#Seccion"+idUltimaSeccion+" .CeldaDescripcion").html(BotonDescripcion);
		$("#Seccion"+idUltimaSeccion+" .CeldaImagen").html(BotonImagen);

		$("#UltFilaSecciones").before('<tr class="rowGrid" NuevaFila="'+NuevasFilasSecciones+'" idLinea="New" name="Secciones" id="Seccion'+idSeccion+'">'+NuevaFilaSecciones+'</tr>');
		$("#Seccion"+idSeccion).attr('idSeccion',idSeccion);
		$("#Seccion"+idSeccion+" #idSeccion").val(idSeccion);
		
		$("#Seccion"+idSeccion+" .FieldGrid").each(function(index, domEle) {
			if ($(this).hasClass("Cantidad")) {$(this).val(Number(0).toFixed(2))}
			if ($(this).hasClass("Precio")) {$(this).val(Number(0).toFixed(2))}
		});

		idUltimaSeccion = idSeccion;
	}
}



$(document).delegate(".btnUploadImgSeccion","click",function(){
//	var idLinea = $(this).parent().attr('idLinea');
	var idSeccion = $(this).parent().parent().attr('idSeccion');
	if ($("#Seccion"+idSeccion+" #Seccion").val() != null && $("#Seccion"+idSeccion+" #Seccion").val() != "") {
		$("#ContenedorPrincipal").after('<div id="dialogUploadFile"></div>');
		dataToSend = {
			id: idSeccion
			, TipoArchivo: $("#Seccion"+idSeccion+" #TipoArchivo").val()
			, Directorio: "empresa"
			, CodEmpresa: "<?php echo $_POST['CodEmpresa'] ?>"
		};
		$("#dialogUploadFile").load("../ajax/uploadFile.php",  dataToSend);
		$("#dialogUploadFile").attr("title","SUBIR IMAGEN");
		$("#dialogUploadFile").dialog({
			position: {
				my: "bottom",
				at: "top",
				of: "#Seccion"+idSeccion
			},
			width:"500px",
			modal:true,
			close: function() {
        $(this).remove();
				$("#Seccion").focus();
      }
		});

	}

});



</script>
<div class="FormDataGrid">
  <table class="tableGrid C7_6" id="DetalleSecciones">
    <thead>
      <th>IMAGEN</th>
      <th width="40%" class="SeparadorBusquedaCol">SECCION</th>
      <th width="60%" class="SeparadorBusquedaCol">PALABRAS CLAVE</th>
      <th></th>
      <th></th>
    </thead>
    <tbody>
      <?php
        if (isset($rstSecciones)) {
          while ( $rowSecciones = $rstSecciones->fetch_array()) {
?>
      <tr class="rowGrid" idLinea="<?PHP echo $rowSecciones['idEmpresaSeccion'] ?>" name="SeccionesCompras" idSeccion="<?PHP echo $rowSecciones['idEmpresaSeccion'] ?>" id="Seccion<?PHP echo $rowSecciones['idEmpresaSeccion'] ?>">
        <form id="Secciones<?PHP echo $rowSecciones['idEmpresaSeccion'] ?>" name="Secciones<?PHP echo $rowSecciones['idEmpresaSeccion'] ?>" method="post" class="lineGrid">
          <input type="hidden" name="idEmpresaSeccion" class="FieldGrid" id="idEmpresaSeccion" value="<?PHP echo $rowSecciones['idEmpresaSeccion'] ?>">
          <input type="hidden" name="CodEmpresa" class="FieldGrid" id="CodEmpresa" value="<?PHP echo $rowSecciones['CodEmpresa'] ?>">
          <input type="hidden" name="Descripcion" class="FieldGrid" id="Descripcion" value="<?PHP echo $rowSecciones['Descripcion'] ?>">
          <td align="center" class="SeparadorBusquedaCol">
          	<?php						
						$nameFile = "../../images/empresa/".$rowSecciones['idEmpresaSeccion'].".".$rowSecciones['TipoArchivo'];
						$linkFile = "/".$_SESSION['Web']."/images/empresa/".$rowSecciones['idEmpresaSeccion'].".".$rowSecciones['TipoArchivo'];
						$displayLink = (is_file($nameFile) ? "BLOCK" : "NONE");
						$displayUpload = (is_file($nameFile) ? "NONE" : "BLOCK");
						?>
						<a id="uploadFile" href="#" class="btnUploadImgSeccion botonMini Left">SUBIR</a>
					</td>
          <td class="SeparadorBusquedaCol">
	          <input type="text" class="FieldGrid" name="Seccion" id="Seccion" value="<?PHP echo utf8_encode($rowSecciones['Seccion']) ?>">
          </td>
          <td class="SeparadorBusquedaCol">
	          <input type="hidden" name="TipoArchivo" class="FieldGrid" id="TipoArchivo" value="<?PHP echo $rowSecciones['TipoArchivo'] ?>">
	          <input type="text" class="FieldGrid" name="Keywords" id="Keywords" value="<?PHP echo $rowSecciones['Keywords'] ?>">
          </td>
          <td align="center">
						<a id="htmlDescripcion" href="#" idHtmlField="Descripcion" class="botonMini htmlEditor">DESCRIPCION</a>
					</td>
          <td class="BorrarLineaSecciones">
						<img src="../images/deleteGrid.png" class="borrarDetalle botonMini" />
          </td>
        </form>
      </tr>
      <?php
          }
        }
?>
      <tr class="rowGrid" NuevaFila="1" idLinea="New" name="SeccionesCompras" idSeccion="<?php echo $idSeccion; ?>" id="Seccion<?php echo $idSeccion; ?>">
        <form id="SeccionesNew" name="SeccionesNew" method="post" class="lineGrid">
          <input type="hidden" name="idSecciones" id="idSecciones" value="New">
          <input type="hidden" name="idEmpresaSeccion" class="FieldGrid" id="idEmpresaSeccion" value="<?php echo $idSeccion; ?>">
          <input type="hidden" name="CodEmpresa" class="FieldGrid" id="CodEmpresa" value="<?PHP echo $_POST['CodEmpresa'] ?>">
          <input type="hidden" name="Descripcion" class="FieldGrid" id="Descripcion">
          <td class="CeldaImagen SeparadorBusquedaCol" align="center">
          </td>
          <td class="SeparadorBusquedaCol">
	          <input class="FieldGrid New" type="text" name="Seccion" id="Seccion">
          </td>
          <td class="SeparadorBusquedaCol">
	          <input type="hidden" name="TipoArchivo" class="FieldGrid New" id="TipoArchivo" value="">
	          <input class="FieldGrid New" type="text" name="Keywords" id="Keywords">
          </td>
          <td class="CeldaDescripcion" align="center">
					</td>
          <td class="CeldaBotonBorrar"></td>
        </form>
      </tr>
      <tr id="UltFilaSecciones"></tr>
    </tbody>
  </table>
</div>



