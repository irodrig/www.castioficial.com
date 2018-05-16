<?php
//Valida Acceso
	require_once('../connections/kriva.php'); 

//Carga valores del registro cuando esta EDITANDO	
	if (isset($_POST['CodEmpresa'])) {
		$qrySlides = "SELECT * FROM GE_EmpresasSlides WHERE CodEmpresa = '".$_POST['CodEmpresa']."' ORDER BY OrdenWeb";
		$rstSlides = $MySQL->query($qrySlides);
		$numSlides = $rstSlides->num_rows;
	} else {
		$numSlides = 0;
	}
	$idSlide = uniqid($_SESSION['InicioSesion']);		
?>

<script>
<?php
	$docFile = explode('.', basename($_SERVER['SCRIPT_NAME']));
?>
var	NombreDetalle = "<?php echo $docFile[0] ?>";
var NuevasFilasSlides=1;
var idUltimaSlide = "<?php echo $idSlide; ?>";
$(document).ready(function(e) {
	NuevaFilaSlides = $("#Slide<?php echo $idSlide; ?>").html();
	BotonBorrarSlides = '<img src="../images/deleteGrid.png" class="borrarDetalle botonMini" />';
	BotonDescripcion = '<a id="htmlDescripcion" href="#" idHtmlField="Descripcion" class="botonMini htmlEditor">DESCRIPCION</a>';
	BotonImagen = '<a id="uploadFile" href="#" class="botonUpload botonMini">SUBIR</a>';

	
	$(".BorrarLineSlides").each(function(index, domEle) {
		$(this).html(BotonBorrarSlides);
	});
});

$(".tableGrid").delegate(".FieldGrid","change",function(){
	Linea = $(this).parent().parent().attr('idSlide');
	NuevaFila = $(this).parent().parent().attr('NuevaFila');
	
	ValidaSlides(Linea,  NuevaFila);
});

function ValidaSlides(Linea, NuevaFila) {
	Valido = DatosRequeridos(Linea);
	idSlide = uniqid("<?php echo $_SESSION['InicioSesion'] ?>");
	idLinea = $("#Slide"+Linea).attr('idLinea');

	if (Valido && idLinea=="New" && NuevaFila==NuevasFilasSlides) {
		NuevasFilasSlides ++;
		$("#Slide"+idUltimaSlide+" .CeldaBotonBorrar").html(BotonBorrarSlides);
		$("#Slide"+idUltimaSlide+" .CeldaImagen").html(BotonImagen);

		$("#UltFilaSlides").before('<tr class="rowGrid" NuevaFila="'+NuevasFilasSlides+'" idLinea="New" name="Slides" id="Slide'+idSlide+'">'+NuevaFilaSlides+'</tr>');
		$("#Slide"+idSlide).attr('idSlide',idSlide);
		$("#Slide"+idSlide+" #idSlide").val(idSlide);
		
		$("#Slide"+idSlide+" .FieldGrid").each(function(index, domEle) {
			if ($(this).hasClass("Cantidad")) {$(this).val(Number(0).toFixed(2))}
			if ($(this).hasClass("Precio")) {$(this).val(Number(0).toFixed(2))}
		});

		idUltimaSlide = idSlide;
	}
}



$("#DetalleSlides").delegate(".botonUpload","click",function(){
//	var idLinea = $(this).parent().attr('idLinea');
	var idSlide = $(this).parent().parent().attr('idSlide');
	if ($("#Slide"+idSlide+" #NombreImagen").val() != null && $("#Slide"+idSlide+" #NombreImagen").val() != "") {
		$("#ContenedorPrincipal").after('<div id="dialogUploadFile"></div>');
		dataToSend = {
			id: idSlide
			, TipoArchivo: $("#Slide"+idSlide+" #TipoArchivo").val()
			, Directorio: "empresa/slides"
			, CodEmpresa: "<?php echo $_POST['CodEmpresa'] ?>"
			, AnchoImg: 900
			, AltoImg: 400
		};
		$("#dialogUploadFile").load("../ajax/uploadFile.php",  dataToSend);
		$("#dialogUploadFile").attr("title","SUBIR IMAGEN");
		$("#dialogUploadFile").dialog({
			position: {
				my: "bottom",
				at: "top",
				of: "#Slide"+idSlide
			},
			width:"1000px",
			modal:true,
			close: function() {
        $(this).remove();
				$("#Slide").focus();
      }
		});

	}

});



</script>
<div class="FormDataGrid">
  <table class="tableGrid C7_6" id="DetalleSlides">
    <thead>
      <th>IMAGEN</th>
      <th width="10%" class="SeparadorBusquedaCol">ORDEN</th>
      <th width="30%" class="SeparadorBusquedaCol">NOMBRE</th>
      <th width="60%" class="SeparadorBusquedaCol">TEXTO</th>
      <th></th>
    </thead>
    <tbody>
      <?php
        if (isset($rstSlides)) {
          while ( $rowSlides = $rstSlides->fetch_array()) {
?>
      <tr class="rowGrid" idLinea="<?PHP echo $rowSlides['idEmpresaSlide'] ?>" name="Slides" idSlide="<?PHP echo $rowSlides['idEmpresaSlide'] ?>" id="Slide<?PHP echo $rowSlides['idEmpresaSlide'] ?>">
        <form id="Slides<?PHP echo $rowSlides['idEmpresaSlide'] ?>" name="Slides<?PHP echo $rowSlides['idEmpresaSlide'] ?>" method="post" class="lineGrid">
          <input type="hidden" name="idEmpresaSlide" class="FieldGrid" id="idEmpresaSlide" value="<?PHP echo $rowSlides['idEmpresaSlide'] ?>">
          <input type="hidden" name="CodEmpresa" class="FieldGrid" id="CodEmpresa" value="<?PHP echo $rowSlides['CodEmpresa'] ?>">
          <td align="center" class="SeparadorBusquedaCol">
          	<?php						
						$nameFile = "../../images/empresa/slides/".$rowSlides['idEmpresaSlide'].".".$rowSlides['TipoArchivo'];
						$linkFile = "/".$_SESSION['Web']."/images/empresa/slides/".$rowSlides['idEmpresaSlide'].".".$rowSlides['TipoArchivo'];
						$displayLink = (is_file($nameFile) ? "BLOCK" : "NONE");
						$displayUpload = (is_file($nameFile) ? "NONE" : "BLOCK");
						?>
						<a id="uploadFile" href="#" class="botonUpload botonMini Left">SUBIR</a>
					</td>
          <td class="SeparadorBusquedaCol">
	          <input type="text" class="FieldGrid" name="OrdenWeb" id="OrdenWeb" value="<?PHP echo $rowSlides['OrdenWeb'] ?>">
          </td>
          <td class="SeparadorBusquedaCol">
	          <input type="text" class="FieldGrid" name="NombreImagen" id="NombreImagen" value="<?PHP echo utf8_encode($rowSlides['NombreImagen']) ?>">
          </td>
          <td class="SeparadorBusquedaCol">
	          <input type="hidden" name="TipoArchivo" class="FieldGrid" id="TipoArchivo" value="<?PHP echo $rowSlides['TipoArchivo'] ?>">
	          <input type="text" class="FieldGrid" name="TextoSlide" id="TextoSlide" value="<?PHP echo utf8_encode($rowSlides['TextoSlide']) ?>">
          </td>
          <td class="BorrarLineaSlides">
						<img src="../images/deleteGrid.png" class="borrarDetalle botonMini" />
          </td>
        </form>
      </tr>
      <?php
          }
        }
?>
      <tr class="rowGrid" NuevaFila="1" idLinea="New" name="Slides" idSlide="<?php echo $idSlide; ?>" id="Slide<?php echo $idSlide; ?>">
        <form id="SlidesNew" name="SlidesNew" method="post" class="lineGrid">
          <input type="hidden" name="idSlides" id="idSlides" value="New">
          <input type="hidden" name="idEmpresaSlide" class="FieldGrid" id="idEmpresaSlide" value="<?php echo $idSlide; ?>">
          <input type="hidden" name="CodEmpresa" class="FieldGrid" id="CodEmpresa" value="<?PHP echo $_POST['CodEmpresa'] ?>">
          <td class="CeldaImagen SeparadorBusquedaCol" align="center">
          </td>
          <td class="SeparadorBusquedaCol">
	          <input class="FieldGrid New" type="text" name="OrdenWeb" id="OrdenWeb">
          </td>
          <td class="SeparadorBusquedaCol">
	          <input class="FieldGrid New" type="text" name="NombreImagen" id="NombreImagen">
          </td>
          <td class="SeparadorBusquedaCol">
	          <input type="hidden" name="TipoArchivo" class="FieldGrid New" id="TipoArchivo" value="">
	          <input class="FieldGrid New" type="text" name="TextoSlide" id="TextoSlide">
          </td>
          <td class="CeldaBotonBorrar"></td>
        </form>
      </tr>
      <tr id="UltFilaSlides"></tr>
    </tbody>
  </table>
</div>



