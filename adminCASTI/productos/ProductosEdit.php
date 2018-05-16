<?php
//Valida Acceso
	require_once('../connections/kriva.php'); 

//	error_reporting(0);
//Carga valores del registro cuando esta EDITANDO	
	if (isset($_POST['id'])) {
		$qry = "SELECT * FROM WE_Productos WHERE idProducto = '".$_POST['id']."'";
		$rst = $MySQL->query($qry);
		$row = $rst->fetch_array();
		$id =  $_POST['id'];
		$Nuevo = 0;
	} else {
		$id =  uniqid($_SESSION['InicioSesion']);
		$row=array();
		$row['idArticulo'] = $id;
		$row['Activo'] = 1;
		$Nuevo = 1;
	}
	$cRow = new Registro($row);

	$NombreArchivo = array();
	$TipoArchivo = array();
	$srcImage = array();

////////////////////////////////////////
// Busca el src de la imagen
	$PathImages = $_SESSION['Web']."/images/";

	if (file_exists($_SESSION['WebRoot']."/images/articulos/".$id)) {
		$directorio = opendir($_SESSION['WebRoot']."/images/articulos/".$id); //ruta actual
		while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
		{
			if (!is_dir($archivo))//verificamos si es o no un directorio
			{
				array_push($NombreArchivo,$archivo);
			}
		}
	}
	
	sort($NombreArchivo);
	
	$CantidadImg = count($NombreArchivo);
	
	for ($i=0;$i<=count($NombreArchivo)-1;$i++) {
		$tmp = explode(".", $NombreArchivo[$i]);
		$TipoArchivo[$i] = strtolower(end($tmp));

		$srcImage[$i] = $PathImages."articulos/".$id."/".$NombreArchivo[$i]."?".time();
	}
	$srcNewImage = $PathImages."ImagenNoDisponible.png";

?>
<script>

$(document).ready(function(e) {
	idEdicion = '<?php echo $id ?>';
	inicializarEdicion(idEdicion, DocumentoActual);


	attrProductos = {
		idElemento: "#cmbProductoRelacionado",
		Etiqueta: "Relacionado",
		Tabla: "WE_Productos",
		Origen: "idProducto, Referencia, Modelo",
		Destino: "idProductoRelacionado, ReferenciaRelacionado, ModeloRelacionado",
		Clase: "F3_6",
		Padre: "idProducto != '<?php echo $id ?>'"
	}
	ComboBusqueda(attrProductos);


	tinymce.init({
		plugins: ['textpattern table code image advlist'],
		toolbar1: "undo redo | removeformat | bold italic underline | alignleft aligncenter alignright alignjustify | indent outdent bullist numlist",
		toolbar_items_size: 'small',
		menubar: false,
		statusbar: false,
		language: 'es',
		selector: "textarea.tinymce",
	});

	$("#ArticulosWeb").click();
});

$(document).undelegate(".imgUpload","click");
$(document).delegate(".imgUpload","click",function(e) {
	idObj = $(this).parents('div').attr('id');
	var idArticulo = $("#id").val();
	if (idObj =='imgNewArticulo') {
		CantidadImg = Number($("#CantidadImg").val());		
		html = '<div id="imgArticulo' + CantidadImg + '" class="C1_6 Left ACenter">';
		html+= '<img id="imagen" class="imgUpload" src="<?php echo $srcNewImage; ?>">';
		html+= '<input type="hidden" class="DataField" name="TipoArchivo' + CantidadImg + '" id="TipoArchivo" value ="">';
		html+= '<input type="hidden" class="DataField F3_6" type="text" name="NombreArchivo' + CantidadImg + '" id="NombreArchivo" value="Vacio">';
		html+= '</div>';

		$("#imgNewArticulo").before(html);

		idObj = 'imgArticulo' + CantidadImg;
		existeImagen = '';

		$("#CantidadImg").val(CantidadImg+1);
	} else {
		existeImagen = '1';
	}


	$("#ContenedorPrincipal").after('<div id="dialogUploadFile"></div>');
	dataToSend = {
//		id: id
		id: idObj
		, existeImagen: existeImagen
		, obj: "#" + idObj
		, Directorio: "articulos/" + idArticulo
		, AnchoImg: 500
	};
	$("#dialogUploadFile").load("../ajax/ventanaSubeArchivo.php",  dataToSend).attr("title","SUBIR IMAGEN").dialog({
		position: {my: "bottom",at: "top",of: "#editBox"},
		width:"900",
		modal:true,
		close: function() {$(this).remove();$("#Articulo").focus();}
	});
});

$("#EditForm").delegate(".FieldGrid","change",function(){
	Linea = $(this).parent().parent().attr('idRegistro');
	NuevaFila = $(this).parent().parent().attr('NuevaFila');
	
//	ActualizaImporteLinea(Linea);
//	TotalesFactura();
	Tabla = $(this).parents('table');
	ValidaLineas(Linea,  NuevaFila, Tabla);
});

$(".Iva").change(function(e) {
	Base = Number($("#Base").val());
	Iva = Number($("#Iva").val());
	Precio = Number($("#Precio").val());
  if ($(this).attr('id') == 'Precio') {
		Base = Precio / (100 + Iva) * 100;
		$("#Base").val(Base.toFixed(2));
	} else {
		Precio = Base * (100 + Iva) / 100;
		$("#Precio").val(Precio.toFixed(2));
	}
});


function GuardaLineas() {
	var editor0 = tinymce.editors[0];
	var $ed_body0 = $(editor0.getBody());
	$("#DescripcionHTML").val($ed_body0.html());
};

</script>
  </head>
  <div id="Mensaje"></div>
	<form id="EditForm" name="EditForm" method="post" class="FormData" enctype="multipart/form-data">
		<?php $cRow->BotonActivo('ARTICULO');	?>
    <div class="C6 Clear">
	    <div class="C3_6 Left">
        <div class="FormDataField">
          <label class="DataName">Orden WEB</label>
          <input class="DataField F3_6 Required" type="number" name="Orden" id="Orden" value="<?php $cRow->Imprimir('Orden'); ?>">
        </div>
        <div class="FormDataField">
          <label class="DataName">Referencia</label>
          <input class="DataField F3_6 Upper Required" type="text" name="Referencia" id="Referencia" value="<?php $cRow->Imprimir('Referencia'); ?>">
        </div>
        <div class="FormDataField">
          <label class="DataName">Modelo</label>
          <input class="DataField F3_6 Upper" type="text" name="Modelo" id="Modelo" value="<?php $cRow->Imprimir('Modelo'); ?>">
        </div>
        <div class="FormTextareaField">
          <label class="DataName">Etiquetas</label>
          <textarea class="TextareaField F3_6 Upper" type="text" name="Etiquetas" id="Etiquetas" rows="2"><?php $cRow->Imprimir('Etiquetas'); ?></textarea>
        </div>
        <div class="FormDataField">
          <label class="DataName">url ECommerce</label>
          <input class="DataField F3_6" type="text" name="urlEcommerce" id="urlEcommerce" value="<?php $cRow->Imprimir('urlEcommerce'); ?>">
        </div>
		    <div class="FormDataField" id="cmbProductoRelacionado" valor="<?php echo (isset($_POST['id']) ? $row['idProductoRelacionado']:"") ?>"></div>
			</div>

	    <div class="Right">
        <div class="FormDataField">
          <label class="DataName">Base Imponible</label>
          <input class="DataField F12_6 Precio Iva" type="text" name="Base" id="Base" value="<?php $cRow->Imprimir('Base'); ?>">
        </div>
        <div class="FormDataField">
          <label class="DataName">Iva</label>
          <input class="DataField F12_6 Precio Iva" type="text" name="Iva" id="Iva" value="<?php $cRow->Imprimir('Iva'); ?>">
        </div>
        <div class="FormDataField">
          <label class="DataName">Precio</label>
          <input class="DataField F12_6 Precio Iva" type="text" name="Precio" id="Precio" value="<?php $cRow->Imprimir('Precio'); ?>">
        </div>
				<br/><br/>
  
			</div>  

			<input type="hidden" name="CantidadImg" id="CantidadImg" value="<?php  echo $CantidadImg; ?>">
			<input type="hidden" name="NombreArticulo" id="NombreArticulo" value="<?php  $cRow->Imprimir('Articulo'); ?>">
			<input type="hidden" name="accion" id="accion" value="<?php echo (isset($_POST['id']) ? 'E' : 'A'); ?>">
      <input type="hidden" name="id" id="id" value ="<?php echo $id; ?>">
    </div>

    <div class="">

    <?php if (!in_array('WEB', $_SESSION['Restricciones'])) { ?>

      <div id="DetalleWeb" class="C6 Clear C6_6">
        <div class="botonTab100" id="ArticulosWeb">WEB</div>
        <div id="boxArticulosWeb">
          <div class="c35_6 Left Borde1">
          	<div class="Clear">
              <div class="c15_6 Left">
                <div class="FormDataField">
                  <label class="DataName">Novedad</label>
                  <input class="DataField" type="checkbox" name="Novedad" id="Novedad" <?php $cRow->Checked('Novedad'); ?>>
                </div>
                <div class="FormDataField">
                  <label class="DataName">Proximamente</label>
                  <input class="DataField" type="checkbox" name="Proximamente" id="Proximamente" <?php $cRow->Checked('Proximamente'); ?>>
                </div>
              </div>
              <div class="c15_6 Left">
                <div class="FormDataField">
                  <label class="DataName">Agotado</label>
                  <input class="DataField" type="checkbox" name="Agotado" id="Agotado" <?php $cRow->Checked('Agotado'); ?>>
                </div>
                <div class="FormDataField">
                  <label class="DataName">Inicio</label>
                  <input class="DataField" type="checkbox" name="slideInicio" id="slideInicio" <?php $cRow->Checked('slideInicio'); ?>>
                </div>
              </div>
            </div>
          	<h3>DESCRIPCION</h3>
            <div class="FormTextareaField">
              <label class="DataName">Descripcion:</label>
              <textarea rows="12" class="TextareaField F6 tinymce" name="DescripcionHTML" id="DescripcionHTML"><?php $cRow->Imprimir('Descripcion'); ?></textarea>
            </div>
          </div>
          <?php if (!$Nuevo) { ?>
          <div class="c2_6 Right Borde1">
          	<h3>IMAGENES</h3>
            <?php for ($i=0;$i<=count($NombreArchivo)-1;$i++) { ?>
              <div id="imgArticulo<?php echo $i ?>" class="C1_6 Left ACenter" style="height:150px">
                <img id="imagen" class="imgUpload" src="<?php echo $srcImage[$i]; ?>">
                <input type="hidden" class="DataField" name="TipoArchivo<?php echo $i ?>" id="TipoArchivo" value ="<?php echo $TipoArchivo[$i]; ?>"> 
                <input type="hidden" class="DataField" name="NombreArchivo<?php echo $i ?>" id="NombreArchivo" value="<?php echo $NombreArchivo[$i]; ?>">
              </div>
            <?php } ?>
            <div id="imgNewArticulo" class="C1_6 Left ACenter">
              <img id="imagen" class="imgUpload" src="<?php echo $srcNewImage; ?>">
              <input type="hidden" class="DataField" name="TipoArchivo" id="TipoArchivo" value ="">
              <input type="hidden" class="DataField" name="NombreArchivo" id="NombreArchivo" value="Vacio">
            </div>
          </div>
          <?php } ?>
        </div>
			</div>

     <?php } ?>

    </div>

    <div id="MsgErrorDatos" class="MsgError">
    	<img id="CloseMsgError" src="../images/exit-icon20.png">
      <div id="Error"></div>
    </div>
  </form>

    <div class="BotonesFicha">
    <?php if (!in_array('B', $_SESSION['Restricciones'])) { ?>
    <button id="BotonBorrar" class="BotonAccion Right" type= "button">BORRAR</button>
    <?php	} ?>
    <?php if (!in_array('E', $_SESSION['Restricciones'])) { ?>
      <button id="BotonGuardar" class="BotonAccion Right" type="button">GUARDAR</button>
    <?php	} ?>
  </div>


<script>
function ValidarFormulario() {
	var Valido = 1;
	$("#MsgErrorDatos").hide();
	
	$("#EditForm .Required").each(function(index, domEle) {
			if ($(domEle).val() == "") {
				if (!$(domEle).hasClass("FieldGrid")) { 		// Elementos formulario principal
					$(domEle).addClass("InvalidData");
					Valido = 0;
				} else {																		// Elementos formularios lineas (excepto ultima)
					if ($(this).parents('table').attr('UltimaFila') != $(this).parents('tr').attr('idRegistro')) {
						$(domEle).addClass("InvalidDataGrid");
						Valido = 0;
					}
				}
			} else {
				$(domEle).removeClass("InvalidData");
				$(domEle).removeClass("InvalidDataGrid");
			}
	});
	
	if (!Valido) {
		$("#Error").html("Falta informaci&oacute;n necesaria para completar el registro. Rellena todos los campos obligatorios");
		$("#MsgErrorDatos").slideDown(500);
	}

	return Valido;
}

</script>