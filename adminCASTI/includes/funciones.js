function inicializarListado(tabla, claseVentanaEdicion, QryStr, Pagina, UltPag) {
	if ($('#tableData').length){
		celdas = $("#tableData thead").find('tr')[0].cells.length;
		for (i= 1; i <= celdas; i++) {
			width = $("#tableData tbody tr:first-child td:nth-child("+i+")").css("width");
			$("#tableData thead tr td:nth-child("+i+")").css("width",width);
		}
		
		$.ajax({
			url: Raiz + "ajax/barraPaginacion.php",
			type: "GET",
			data: {QryStr: QryStr, Pagina: Pagina, UltPag: UltPag},
			success: function(resp){
				$(".Resultados").before(resp);
				$(".Resultados").after(resp);
			}
		});
	}

	$(".RowData:odd").addClass("RowOdd");
	$(".RowData:even").addClass("RowPair");
	
	$(".Cantidad, .Precio, .PrecioLitro, .Porc4Dec").each(function(index, domEle) {
		Num = $(this).val();
		if ($(this).hasClass("Cantidad")) {$(this).val(Number(Num).toFixed(0))}
		if ($(this).hasClass("Precio")) {$(this).val(Number(Num).toFixed(2))}
		if ($(this).hasClass("PrecioLitro")) {$(this).val(Number(Num).toFixed(3))}
		if ($(this).hasClass("Porc4Dec")) {$(this).val(Number(Num).toFixed(4))}
	});

	$("#FiltroBusqueda").hide();
	$("#FiltroBusqueda option:selected" ).each(function() {
		if ($( this ).text() != "") {
			$("#FiltroBusqueda").show();
			return (false);
		}
	});
	$("#FiltroBusqueda :input" ).each(function() {
		if (($( this ).attr('type') == "date" || $( this ).attr('type') == "text") && $(this).attr('value') != "") {
			$("#FiltroBusqueda").show();
			return (false);
		}
	});

	$(document).delegate(':checkbox[readonly="readonly"]',"click",function() {
		return false;
	});

	$(document).delegate('#BotonActivo',"click",function() {
		if ($(this).hasClass('Green')) {
			$(this).addClass('Red');
			$(this).removeClass('Green');
			$(this).html('INACTIVO');
			$("#Activo").prop('checked','');
		} else {
			$(this).addClass('Green');
			$(this).removeClass('Red');
			$(this).html('ACTIVO');
			$("#Activo").prop('checked','checked');
		};
	});


  $("#Busqueda").click(function() {
		$("#FiltroBusqueda").slideDown(300);
	});
	$("#CerrarBusqueda").click(function() {
		$("#FiltroBusqueda :input:text").each(function(index, domEle) {
			$(domEle).attr('value', "");
			$("#FiltroBusqueda").submit();
		});
	});

	$('a[name=AddRow]').click(function(e) { 
		if (!Editando) {
			AbreVentanaEdicion(tabla, 0, claseVentanaEdicion);
		} else {
			MsgBox ("Se está editando un registro actualmente.\n\nCIERRA LA VENTANA DE EDICION PARA AÑADIR UNO NUEVO");
		}
	}); 


	$(document).delegate(".RowData","click", function() {
		if (!Editando) {
			var trId = $(this).attr("id");
			if ($("#box" + trId).html() == null) {
				if (Editando==1) {
					$(".Close").click();
				}
				AbreVentanaEdicion(tabla, trId, claseVentanaEdicion);
			} 
		} else {
			Editando = 0;
		}
	});
	

	
	$(document).delegate(".btnRegPosicion","click",function() {
		if ($(this).attr('id') == 'btnRegAnterior') {
			idNew = $("#" + idEdicion).prev().attr('id');
		} else {
			idNew = $("#" + idEdicion).next().attr('id');
		}
		if (typeof idNew == 'undefined') {
			MsgBox("Se alcanzó el inicio/final de la página");
		} else {
			AbreVentanaEdicion(tabla, idNew, claseVentanaEdicion);
		}
	});
	
	$(".RowData").hover(
		function () {
			$(this).addClass("RowHover");
		},
		function () {
			$(this).removeClass("RowHover");
		}
	);


	$("#ImprimirResultados").click(function(e) {
		d = new Date();
		idImpresion = uniqid(d.valueOf());
		NombreReporte = "Resultados";

		$("#ContenedorPrincipal").after('<div id="Informe"><img src="../images/cargando.gif"></div>');
		$("#Informe").dialog({
			title: NombreReporte
			, position: {
				my: "top center",
				at: "top center",
				of: ".resultados"
			}
			, width:"auto"
			, modal:true
			, close: function() {
				$(this).remove();
			}
		});

		data = {
			idImpresion : idImpresion
			, NombreReporte : NombreReporte
			, contenido : $(".resultados").html()
		};
		
    $.ajax({
        url: Raiz + "/informes/pdf/pdfListado.php",
				type: "POST",
				data: data,
				success: function(){
					
				}
    }).done (function(e) {
				var iframe = $('<iframe>');
				iframe.attr('src',Raiz + "/informes/pdf/"+NombreReporte+idImpresion+".pdf");
//				iframe.attr('src',"../../informes/Vehiculos/PartesKilometros.pdf");
				iframe.height("800px");
				iframe.width("1200px");
		
				$("#Informe").html("");
				$("#Informe").append(iframe);
				$("#Informe").dialog({
					position: {
						my: "top",
						at: "top",
						of: ".resultados"
					}
					, close : function() {
						$(this).remove();
						data = {NombreArchivo: "../informes/pdf/"+NombreReporte+idImpresion+".pdf"}
						$.ajax({
							url: Raiz + "/includes/borrarArchivo.php",
							type: "POST",
							data: data
						})
					}
				});
		});
  });

	$("#Imprimir").click(function(e) {
		
		d = new Date();
		idImpresion = uniqid(d.valueOf());
		NombreReporte = TituloPagina;

		$("#ContenedorPrincipal").after('<div id="Informe"><img src="../../images/cargando.gif"></div>');
		$("#Informe").dialog({
			title: NombreReporte
			, position: {
				my: "top",
				at: "top",
				of: "#datosListado"
			}
			, width:"auto"
			, modal:true
			, close: function() {
				$(this).remove();
			}
		});

		data = {
			idImpresion : idImpresion
			, F1Reporte : $("#bDesde").val()
			, F2Reporte : $("#bHasta").val()
			, NombreReporte : NombreReporte
			, FiltroReporte :$("#bFiltro").val()
			, contenido : $("#datosListado").html()
		};
		
    $.ajax({
        url: Raiz + "/informes/pdf/pdfListado.php",
				type: "POST",
				data: data,
				success: function(){
					
				}
    }).done (function(e) {
				var iframe = $('<iframe>');
				iframe.attr('src',Raiz + "/informes/pdf/"+NombreReporte+idImpresion+".pdf");
//				iframe.attr('src',"../../informes/Vehiculos/PartesKilometros.pdf");
				iframe.height("800px");
				iframe.width("1200px");
		
				$("#Informe").html("");
				$("#Informe").append(iframe);
				$("#Informe").dialog({
					position: {
						my: "top",
						at: "top",
						of: "#datosListado"
					}
					, close : function() {
						$(this).remove();
						data = {NombreArchivo: "../informes/pdf/"+NombreReporte+idImpresion+".pdf"}
						$.ajax({
							url: Raiz + "/includes/borrarArchivo.php",
							type: "POST",
							data: data
						})
					}
				});
		});
		
  });


	$(document).delegate("#BotonBorrar","click",function(){
		$("#Mensaje").html("Se borrara el Registro. CONTINUAR");
		$("#Mensaje").attr("title","CONFIRMACION");
		$("#Mensaje").dialog({
			position: {
				my: "top",
				at: "top",
				of: "#EditForm"
			},
			resizable:false,
			modal:true,
			buttons:{
				"BORRAR": function() {
					$("#accion").val("B");
					$("#BotonGuardar").click();
				}
			}
		});
	});
	
	$(document).delegate("#BotonGuardar","click",function() {
		if ($("#accion").val() == "E") {
			MsgBox("CONTINUAR EDITANDO DESPUÉS DE GUARDAR?<br/><br/>La ventana de edición se mantendrá abierta","CONTINUAR EDITANDO","CONFIRM").done(function(resp) 
			{
				if (resp) {
					Guardar(tabla, false);
				} else {
					Guardar(tabla, true);
				}
			});
		} else {
			Guardar(tabla, true);
		}
	});

	$(document).delegate(".borrarDetalle","click",function(){
		if (confirm("Se borrara la linea.\n\nCONTINUAR")) {
			var id = $(this).parent().parent().attr('id');
			$("#"+id).hide();

			Grid = $(this).parent().parent().attr('name');
			switch(Grid) {
				case "ArticulosFacturas":
					TotalesFactura();
					break;
				case "ArticulosCompras":
					TotalesCompra();
					break;
			}
		}
	});
	
	$(document).delegate(".LongText","dblclick",function(){
		parent = $(this).parent().parent().attr('id');
		id = $(this).attr('id');
		name = $(this).attr('name');
		Val = $(this).val();
	
		$("#ContenedorPrincipal").after('<div id="Longtext"><textarea rows="10" class="F35_6 TextareaField" id="Text">'+Val+'</textarea></div>');
		$("#Longtext").dialog({
			title: name
			, position: {
				my: "center",
				at: "center",
				of: document
			}
			, width:"420px"
			, modal:true
			, buttons:{
				"OK": function() {
					$("#"+parent+" #"+id).val($("#Text").val());
					$(this).remove();
				}
			}
		});
	});

	$(document).delegate(".htmlEditor","click",function(){
		parent = $(this).parent().parent().attr('id');
		id = $(this).attr('idHtmlField');
		Val = $("#"+parent+" #"+id).val();

		$("#ContenedorPrincipal").after('<div id="Longtext"><textarea rows="20" class="TextareaField tinymce" id="TextHTML">'+Val+'</textarea></div>');

		$("#Longtext").dialog({
			title: id
			, position: {
				my: "center",
				at: "center",
				of: document
			}
			, width:"900"
			, height:"420"
			, modal:false
			, close: function() {
				$("#Longtext").remove();
				tinymce.editors[0].remove();
			}
			, buttons:{
				"OK": function() {
					$("#Longtext").remove();

					editor0 = tinymce.editors[0];
					$ed_body0 = $(editor0.getBody());

					$("#"+parent+" #"+id).val($ed_body0.html());

					editor0.remove();
				}
			}
		});
		
		settings = {
			selector: "textarea.tinymce",
			statusbar: false,
			menubar: false
		};
		tinymce.init(settings);

	});


};


function Guardar(tabla, cerrar, DoneFn){
	if (ValidarFormulario() || $("#accion").val() == "B") {

		$("#ContenedorPrincipal").after('<div id="Guardando" style="padding-top:20px; text-align:center"><p>Guardandose las modificaciones, Por favor espera un momento ....</p><br/><img src="../images/cargando.gif" style=""></div>');
		$("#Guardando").dialog({
			title: "GUARDANDO"
			, position: {my: "center",at: "center",of: "#editBox"}
			, width:"auto"
			, modal:true
		});

//Reemplaza las ocurrencias del simbolo € con &euro; >>> INCOMPATIBILIDAD € - utf-8
		$(".DataField, .TextareaField").each(function(index, element) {
			if ($(this).val() != null) {
				$(this).val($(this).val().replace(/\u20ac/g, "&euro;"));
			}
		});

		DoneFn = (typeof DoneFn == "undefined" ? NoHacerNada : DoneFn);

		if(typeof GuardaLineas !== 'undefined' && $.isFunction(GuardaLineas)) {
			GuardaLineas();
		}

		var url = "../sql/" + tabla + "SqlEdit.php"; 

		$.ajax({
			type: 'POST',
			url: url,
			data: $("#EditForm").serialize(), 
			error: function (xhr, ajaxOptions, thrownError) {
					alert(xhr.status + "\n" + thrownError);
			},
			success: function(data)
			{
//$("#MsgErrorDatos").html(data).show();
//cerrar = false;

				$("#Guardando").remove();
				if ($(data).find("ERRORNUM").text() != "") {
					$("#MsgErrorDatos").html("ERROR " + $(data).find("ERRORNUM").text() + data);
					$("#MsgErrorDatos").show();
				} else {
					if (cerrar) {
						$('.Close').click();
						document.location.reload(true);
					}
					$("#BotonGuardar").blur();
//						$("#MsgErrorDatos").html(data).show();
				}
			}
		}).done(function() {DoneFn()});
		
		return false; // Evitar ejecutar el submit del formulario.
		}

}

function NoHacerNada() {}

function AbreVentanaEdicion(tabla, trId, claseVentanaEdicion, mov) {
//	if (trId == 0) {
//		FilaEdicion = "#trHeader";
//	} else {
//		FilaEdicion  = "#" + trId;
//	}

// Verifica que la conexion sea váilda
	$.ajax({
		url: Raiz + "ajax/validarConexion.php",
		dataType:"JSON",
	}).done(function(resp) {
		if(resp.Acceso == "0"){
			window.location.href=Raiz+"acceso.php";
		}
	});

	mov = typeof mov == "undefined" ? 0 : mov;

	$("#editBox").remove();
	$("#ContenedorPrincipal").after('<div id="editBox" class="' + claseVentanaEdicion + '"></div>');
	$("#editBox").html('<img src="../images/cargando.gif">');
	$("#editBox").attr("title","FICHA EDICION");

//	BOTONES PARA MOVIMIENTO ENTRE REGISTRO -- FALTA PARAMETRO QUE DIGA CUANDO MOSTRAR
//	var dialog = $("#editBox").dialog(); 
//	var titlebar = dialog.parents('.ui-dialog').find('.ui-dialog-titlebar'); 
//	$('<img id="btnRegAnterior" src="../images/Anterior.png" width="20" class="btnRegPosicion">') 
//	.appendTo(titlebar) 
//	.click(function() { 
//		$("#btnRegAnterior").click(); 
//	}); 
//	$('<img id="btnRegSiguiente" src="../images/Siguiente.png" width="20" class="btnRegPosicion">') 
//	.appendTo(titlebar) 
//	.click(function() { 
//		$("#btnRegSiguiente").click(); 
//	}); 
	$("#editBox").dialog({
		width:"auto",
		height:"auto",
		resizable:false,
//		modal:true,
		position: {
			my: "center",
			at: "center",
			of: ".Resultados"
		},
		close: function() {	tinymce.remove(); }
	});

	if (trId == 0) {
		data = ''; 
	} else {
		data = {
			id:trId,
			mov:mov
		};
	}

	$.ajax({
		url: tabla + 'Edit.php',
		data: data,
//		data: (trId == 0 ? '' : 'id='+trId),
		type: 'POST',
		success: function(resp){
			$("#editBox").html(resp); 
		}
	}).done(function(){
		$("#editBox").dialog({
			position: {
				my: "center",
				at: "center",
				of: ".Resultados"
			}
		});
	});
	
}

function inicializarEdicion(idEdicion, tabla) {
//	Inhabilita el envío de los formularios con el ENTER
//	$(function(){$('input[type=text]').keypress(function(e){return e.which!=13})})

	 $('input').keypress(enter2tab);


	$(".Cantidad, .Precio, .PrecioLitro, .Porc4Dec").each(function(index, domEle) {
		Num = $(this).val();
		if ($(this).hasClass("Cantidad")) {$(this).val(Number(Num).toFixed(0))}
		if ($(this).hasClass("Precio")) {$(this).val(Number(Num).toFixed(2))}
		if ($(this).hasClass("PrecioLitro")) {$(this).val(Number(Num).toFixed(3))}
		if ($(this).hasClass("Porc4Dec")) {$(this).val(Number(Num).toFixed(4))}
	});

//	$(".Cantidad, .Precio, .PrecioLitro").focusout(function(e) {
	$(document).delegate(".Cantidad, .Precio, .PrecioLitro, .Porc4Dec","focusout",function(e) {
		Decimales = 0;
		if ($(this).hasClass("Cantidad")) {Decimales = 0}
		if ($(this).hasClass("Precio")) {Decimales = 2}
		if ($(this).hasClass("PrecioLitro")) {Decimales = 3}
		if ($(this).hasClass("Porc4Dec")) {Decimales = 4}
		Num = $(this).val();
		if (Num == "") {
			$(this).val(Number(0).toFixed(Decimales));
			$(this).removeClass('InvalidData');
		} else if (isNaN(Num)) {
			$(this).addClass('InvalidData');
			$(this).focus();
		} else {
			$(this).val(Number(Num).toFixed(Decimales));
			$(this).removeClass('InvalidData');
		}
	});

	
	$("#CloseMsgError").click(function(e) {
    $("#MsgErrorDatos").slideUp(500);
  });

	$(".Upper").change(function(e) {
		$(this).val($(this).val().toUpperCase());
  });
	
	$(".RowGrid").hover(
		function () {
			$(this).addClass("RowGridHover");
		},
		function () {
			$(this).removeClass("RowGridHover");
		}
	);
	
	$(document).keyup(function(event){
//	$(document).bind("keyup",function(event){
		if ($('#FormParteKm').length == 0 && event.which==27) {
			$(".Close").click();
		}
	})

	$('.Close').click(function (e) { 
		e.preventDefault(); 
		Editando = 0;
		$("#boxEdit").remove();
	});    

//	$("input[type=text]").focus(function(){	   
	$(document).delegate("input[type=text]","focus", function(){
		this.select();
	});
};

function DatosRequeridos(Fila){
	Valido = 1
	$("#"+Fila+" .Required").each(function(index, element) {
		if (($(element).val() == "" || $(element).val() == null) && $("#"+Fila).attr('idLinea') != 'New') {
			$(element).addClass("InvalidDataGrid");
			Valido = 0;
		} else {
			$(element).removeClass("InvalidDataGrid");
		}
	});
	return (Valido);
}

function Numeros(DecimalesCantidad, DecimalesPrecio) {
	$(".Cantidad, .Precio").each(function(index, domEle) {
		Num = $(this).val();
		if ($(this).hasClass("Cantidad")) {$(this).val(Number(Num).toFixed(DecimalesCantidad))}
		if ($(this).hasClass("Precio")) {$(this).val(Number(Num).toFixed(DecimalesPrecio))}
		if ($(this).hasClass("Numero")) {$(this).val(Number(Num).toFixed(0))}
	});
};

function ComboBusqueda(datosCombo)  {
	idElemento = datosCombo.idElemento.split(":");
	Elemento = idElemento[0];
	ElementoCombo = Elemento;
	
	datosCombo.Padre = (typeof datosCombo.Padre == "undefined" ? "" : datosCombo.Padre);
	datosCombo.Restricciones = (typeof datosCombo.Restricciones == "undefined" ? "N" : datosCombo.Restricciones);

//Crea atributos en el elemento HTML para poder acceder a ellos desde otras funciones
//	$(Elemento).attr('Campo',Campo.trim());
	$(Elemento).attr('Etiqueta',datosCombo.Etiqueta.trim());
	$(Elemento).attr('Tabla',datosCombo.Tabla.trim());
	$(Elemento).attr('Clase',datosCombo.Clase.trim());
	$(Elemento).attr('Origen',datosCombo.Origen.trim());
	$(Elemento).attr('Destino',datosCombo.Destino.trim());
	$(Elemento).attr('Padre',datosCombo.Padre.trim()); 
	Orden = (datosCombo.Orden == "undefined" ? '' : datosCombo.Orden);
	FilaEnBlanco = (datosCombo.FilaEnBlanco == "undefined" ? 1 : datosCombo.FilaEnBlanco);
	
	$(Elemento).html('<label class="DataName">' + datosCombo.Etiqueta.trim() + ':</label>' + '<img src="'+Raiz+'images/cargando.gif" class="Left"/>');
	
	datos = {
		Etiqueta: datosCombo.Etiqueta
		, Tabla: datosCombo.Tabla
		, Origen: datosCombo.Origen
		, Destino: datosCombo.Destino
		, Clase: datosCombo.Clase
		, Padre: datosCombo.Padre
		, ValorInicial:$(Elemento).attr('valor')
		, ReadOnly: (idElemento[1] == "R" ? "S" : "N")
		, Required: (idElemento[2] == "R" ? "S" : "N")
		, Restricciones: (datosCombo.Restricciones == "N" ? "N" : "S")
		, Orden: Orden
		, FilaEnBlanco: FilaEnBlanco
		, SoloActivos: (datosCombo.SoloActivos == 1 ? 1 : 0)
	};

	if (typeof datosCombo.DoneFn == "undefined" || datosCombo.DoneFn == "") {
		$(Elemento).load(Raiz+"ajax/creaComboBusqueda.php", datos);
	}	else {
//		$.ajax({
//			url: Raiz+"ajax/creaComboBusqueda.php",
//			data: datos,
//			type: "POST",
//			error: function(xJ, error, errT) {
//				alert (xJ.responseText);
//			},
//		}).done(function(resp){
//			alert(resp);
//			$(ElementoCombo).html(resp);
//			datosCombo.DoneFn;
//		});
		$(Elemento).load(Raiz+"ajax/creaComboBusqueda.php", datos, function() {datosCombo.DoneFn()});
	}
}

function inicializaComboBusqueda(idElemento, Etiqueta, Tabla, Origen, Destino, Clase, Padre, DoneFunction, Orden, FilaEnBlanco) {
	idElemento = idElemento.split(":");
	Elemento = idElemento[0];
	
//Crea atributos en el elemento HTML para poder acceder a ellos desde otras funciones
//	$(Elemento).attr('Campo',Campo.trim());
	$(Elemento).attr('Etiqueta',Etiqueta.trim());
	$(Elemento).attr('Tabla',Tabla.trim());
	$(Elemento).attr('Clase',Clase.trim());
	$(Elemento).attr('Origen',Origen.trim());
	$(Elemento).attr('Destino',Destino.trim());
	$(Elemento).attr('Padre',Padre.trim()); 
	Orden = (Orden == "undefined" ? '' : Orden);
	FilaEnBlanco = (FilaEnBlanco == "undefined" ? 1 : FilaEnBlanco);
	
	$(Elemento).html('<label class="DataName">' + Etiqueta.trim() + ':</label>' + '<img src="'+Raiz+'images/cargando.gif" class="Left"/>');
	
	datos = {
		Etiqueta: Etiqueta
		, Tabla: Tabla
		, Clase:Clase
		, Origen:Origen
		, Destino:Destino
		, Padre:Padre
		, ValorInicial:$(Elemento).attr('valor')
		, ReadOnly: (idElemento[1] == "R" ? "S" : "N")
		, Required: (idElemento[2] == "R" ? "S" : "N")
		, Orden:Orden
		, FilaEnBlanco:FilaEnBlanco
	};
	
	if (typeof DoneFunction == "undefined") {
		$(Elemento).load(Raiz+"ajax/creaComboBusqueda.php", datos);
	}	else {
		$(Elemento).load(Raiz+"ajax/creaComboBusqueda.php", datos, function() {DoneFunction()});
	}
}

// ******************************************************************************************
// FUNCION PARA SELECCIONAR UN RANGO DE CARACTERES EN UN INPUT
$.fn.selectRange = function(start, end) {
	if(!end) end = start;
	return this.each(function() {
			if (this.setSelectionRange) {
					this.focus();
					this.setSelectionRange(start, end);
			} else if (this.createTextRange) {
					var range = this.createTextRange();
					range.collapse(true);
					range.moveEnd('character', end);
					range.moveStart('character', start);
					range.select();
			}
	});
};
// FUNCION PARA SELECCIONAR UN RANGO DE CARACTERES EN UN INPUT
// ******************************************************************************************
// SUBE ARCHIVO ANEXO PARA ARTICULOS, CLIENTES O PROVEEDORES
function UploadFile(form, id) {
    var dataToSend = new FormData($("#"+form)[0]);		
		$.ajax({
			url: '../ajax/SubirArchivo.php',
			data: dataToSend,
			type: 'POST',
			cache: false,
			contentType: false,
      processData: false,
			beforeSend: function(){
				message = $("<span class='before'>Subiendo el archivo, por favor espera...</span>");
			},
			success: function(resp){
				$("#Anexo"+id+" #TipoArchivo").val(resp);
				message = $("<span class='success'>El archivo se ha subido correctamente.</span>");
			}
		});

	$("UploadFile").dialog("remove");
}

function isPDF(extension) {
	switch(extension.toLowerCase())
	{
		case 'pdf':
		case 'jpg':
			return true;
		break;
		default:
			return false;
		break;
	}
}

// SUBE ARCHIVO ANEXO PARA ARTICULOS, CLIENTES O PROVEEDORES
// ******************************************************************************************




function addDate(dateObject, numDays) {
	dateObject.setDate(dateObject.getDate() + numDays); 
	return dateObject.toLocaleDateString(); 
}
function addDateJSON(dateObject, numDays) {
	dateObject.setDate(dateObject.getDate() + numDays); 
	return dateObject.toJSON(); 
}

function DateDiff( date1, date2 ) {
  var one_day=1000*60*60*24;

  var date1_ms = date1.getTime();
  var date2_ms = date2.getTime();

  var difference_ms = date2_ms - date1_ms;
    
  return Math.round(difference_ms/one_day); 
}

Number.prototype.formatMoney = function(c, d, t){
var n = this, 
    c = isNaN(c = Math.abs(c)) ? 2 : c, 
    d = d == undefined ? "." : d, 
    t = t == undefined ? "," : t, 
    s = n < 0 ? "-" : "", 
    i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", 
    j = (j = i.length) > 3 ? j % 3 : 0;
   return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
 };
 
 function uniqid(prefix, more_entropy) {
  //  discuss at: http://phpjs.org/functions/uniqid/
  // original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  //  revised by: Kankrelune (http://www.webfaktory.info/)
  //        note: Uses an internal counter (in php_js global) to avoid collision
  //        test: skip
  //   example 1: uniqid();
  //   returns 1: 'a30285b160c14'
  //   example 2: uniqid('foo');
  //   returns 2: 'fooa30285b1cd361'
  //   example 3: uniqid('bar', true);
  //   returns 3: 'bara20285b23dfd1.31879087'

  if (typeof prefix === 'undefined') {
    prefix = '';
  }

  var retId;
  var formatSeed = function(seed, reqWidth) {
    seed = parseInt(seed, 10)
      .toString(16); // to hex str
    if (reqWidth < seed.length) { // so long we split
      return seed.slice(seed.length - reqWidth);
    }
    if (reqWidth > seed.length) { // so short we pad
      return Array(1 + (reqWidth - seed.length))
        .join('0') + seed;
    }
    return seed;
  };

  // BEGIN REDUNDANT
  if (!this.php_js) {
    this.php_js = {};
  }
  // END REDUNDANT
  if (!this.php_js.uniqidSeed) { // init seed with big random int
    this.php_js.uniqidSeed = Math.floor(Math.random() * 0x75bcd15);
  }
  this.php_js.uniqidSeed++;

  retId = prefix; // start with prefix, add current milliseconds hex string
  retId += formatSeed(parseInt(new Date()
    .getTime() / 1000, 10), 8);
  retId += formatSeed(this.php_js.uniqidSeed, 5); // add seed hex string
  if (more_entropy) {
    // for more entropy we add a float lower to 10
    retId += (Math.random() * 10)
      .toFixed(8)
      .toString();
  }

  return retId;
}

function GridToJSON(Grid,Nombre) {
	var Lineas='{"'+Nombre+'":[';
	$("#"+Grid+" .rowGrid").each(function(index, element) {
		id = $(this).attr("id");
		idLinea = $(this).attr("idLinea");
		Borrar = ($(this).css("display") == "none" ? "S" : "N");
		Lineas+=(index ? ',' : '') + '{"id": "'+idLinea+'"';
		Lineas+=', "Borrar": "'+Borrar+'"';
			$("#"+id+" .FieldGrid").each(function(index, element) {
				Lineas+=',"'+element.name+'": "'+element.value+'"';
			});
			$("#"+id+" .ChkGrid").each(function(index, element) {
				Lineas+=',"'+element.name+'": "'+(element.checked?1:0)+'"';
			});
		Lineas+='}';
	});
	Lineas+=']}';

	return (Lineas);
}

function MsgBox(Msg,Titulo,Tipo) {
	var defer = $.Deferred();
	
	$("#MsgBox").remove();
	$("#SeccionContenido").after('<div id="MsgBox"></div>');
	$("#MsgBox").html(Msg);
	$("#MsgBox").attr("title",(Titulo ? Titulo : "ALERTA"));
	$("#MsgBox").dialog({
		resizable:false,
		closeOnEscape: false,
		modal:true,
		position: {
			my: "top center",
			at: "top center",
			of: "#editBox"
		}
	});
	Tipo = (Tipo ? Tipo : "OK");
	switch (Tipo) {
	case "CONFIRM":
		$("#MsgBox").dialog("option", "buttons",
			[
				{
					text: "SI",
					click: function() {
						defer.resolve(true);
						$(this).dialog("close");
					}
				},
				{
					text: "NO",
					click: function() {
						defer.resolve(false);
						$(this).dialog("close");
					}
				}
			]
		);
		break;
		default:
		$("#MsgBox").dialog("option", "buttons",
			[{
				text: "OK",
				click: function() {
					$(this).dialog("close")
				}
			}]
		);
	}
	
	return defer.promise();
}

function VentanaBusqueda(datos) {
//	$(document).unbind("keyup");

	$("#Busqueda").remove();
	$("#SeccionContenido").after('<div id="Busqueda"></div>');
	$("#Busqueda").html('<img src="../images/cargando.gif">');
	$("#Busqueda").attr("title","BUSQUEDA");
	$("#Busqueda").dialog({
		width:400,
		height:300,
		resizable:false,
		modal:true,
		position: {
			my: "center",
			at: "center",
			of: "#editBox"
		}
	});
	switch (datos.Tabla) {
	case "AL_Articulos":
		$("#Busqueda").load("../ajax/B_Articulos.php",datos);
		break;
	};
}


function enter2tab(e) {
 if (e.keyCode == 13) {
	pos = $("input, select, textarea").index($(this));
	listInputs = $("input, select, textarea");
	$(listInputs[pos+1]).focus();
 }
}
