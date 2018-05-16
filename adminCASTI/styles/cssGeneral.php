<?php
header('content-type:text/css');

require_once('../connections/kriva.php'); 
$color1 = $_SESSION['Color1'];
$color2 = $_SESSION['Color2'];

$grad1 = "linear-gradient(180deg, ".$color1.", #000)";
$grad2 = "linear-gradient(180deg, ".$color2.", #FFF)";
$grad0_2_0 = "linear-gradient(180deg, #FFF, ".$color2.", #FFF)";
$grad1_2_1 = "linear-gradient(180deg, ".$color1.", ".$color2.", ".$color1.")";
$grad2_1_2 = "linear-gradient(180deg, ".$color2.", ".$color1.", ".$color2.")";
?>

<STYLE>
/* MANTENER --- NO SE PORQUE NO APLICA EL PRIMERO */
body {}
/* MANTENER --- NO SE PORQUE NO APLICA EL PRIMERO */

@charset "utf-8";
@font-face {
font-family: Mercedes;
src: url('../includes/meresre.ttf');
}
.Numero, .Cantidad, .Precio, .PrecioLitro, .Importe, .PMC, .Porc4Dec{
	text-align:right;	
}

#SeccionEncabezado {
	width: 100%;
	top: 0px;

	background: <?php echo $grad2 ?>;
	color: #222;
	position: fixed;
}
#ContenedorEncabezado {
	margin: auto;
	width: 1200px;
	position: relative;
	height: 50px;
	top: 0px;
	text-align: center;
/*
	display:none;
*/
}
#ContenedorEncabezado #Descripcion {
	width: calc(100% - 300px);
}
#Logo {
	float: left;
}
#LoginId {
	width: 300px;
	position: absolute;
	text-align: right;
	font-size: 14px;
	bottom: 0px;
	float: right;
	right: 0px;
}
.NotificacionesPendientes {
	background:#F88;

	-webkit-animation-name: blinker;
	-webkit-animation-duration: 2s;
	-webkit-animation-timing-function: linear;
	-webkit-animation-iteration-count: infinite;
}

@-webkit-keyframes blinker {  
    0% { opacity: 1.0; }
    50% { opacity: 0.5; }
    100% { opacity: 1.0; }
}



body {
	font-family: "Calibri", Arial, Helvetica, sans-serif;
	margin-top: 0px;
	margin-left: 0px;
	margin-bottom: 0px;
	margin-right: 0px;
}
#SeccionMenu {
	width: 100%;
	position: fixed;
	top: 50px;
	background: <?php echo $grad1 ?>;
}

#main-menu {
	position:relative;
	width:1200px;
}
#main-menu ul {
	width:12em; /* fixed width only please - you can use the "subMenusMinWidth"/"subMenusMaxWidth" script options to override this if you like */
}

.DashBoard{
	margin: auto;
	width: 1200px;
	height:auto;
	font-size: 12px;
	border-radius: 2px;
	overflow-x: hidden;
	overflow-y: auto;
}
.DashBoard thead{
	border:1px solid #000;
	background:#DDD;
	font-weight:bold;
}
.DashBoard h2{
	color: #000;
	background: <?php echo $color2 ?>;;
	padding-bottom: 5px;
	padding-left: 5px;
	padding-right: 5px;
	padding-top: 5px;
}
#DB_Notificaciones{
	height: 100px;
	margin: 90px auto 20px auto;
}
#DB_Fondo{
	margin-bottom: 20px;
}

.DB_3_10{
	width: 30%;
	margin: 0px 2%;
	float: left;
}
.DB_4_10{
	width: 39%;
	margin: 0% 0.5%;
	float: left;
}

#SeccionContenido{
	min-height: 650px;
}
#ContenedorPrincipal {
	margin: 90px auto;
	width: 1220px;
	font-family: 'Calibri', sans-serif;
	font-size: 12px;
	border-radius: 2px;
	padding-top: 0px;
	padding-bottom: 10px;
}
#Descripcion h3 {
	margin-top: 5px;
	margin-bottom: 5px;
	font-size: 16px;
	font-family: "Calibri", Arial, sans-serif;
}
#Descripcion h4 {
	font-size: 14px;

}
#LoginId span {
	font-size: 14px;
	text-transform: uppercase;
	line-height: 26px;
}
#LoginId a {
	color: #FFFFFF;
	text-decoration: none;
	font-size: 8px;
}
#LoginId a:hover {
	color: #82B885;
	text-decoration: none;
}
#ContenedorPrincipal h1  {
	background: <?php echo $color1 ?>;
	color: #FFFFFF;
	padding: 5px;
	margin-bottom: 0px;
	border-radius: 2px 2px 0px 0px;
	text-align: center;
	font-size: 16px;
}
#ContenedorInicio {
	font-family: "Calibri", Arial, sans-serif;
	font-size: 2rem;
	width: 1000px;
	text-align: center;
	margin-bottom: 30px;
	margin-left: auto;
	margin-right: auto;
	margin-top: 0px;
}
#ContenedorInicio p{
	padding-top: 10px;
	padding-right: 10px;
	padding-left: 10px;
	padding-bottom: 10px;
}
#ContenedorInicio small{
	font-size: 1rem;
}
#SeccionPie {
	background: <?php echo $grad1 ?>;
	color: #EEEEEE;
	text-align: center;
	font-family: "Calibri", Arial, sans-serif;
	font-size: 1rem;
	padding: 8px;
	position: relative;
	height: 50px;
	top:60px;
	
}
#SeccionPie a{
	text-decoration:none;
	color: #FFF;
}
#Acciones {
	border: 1px solid #555;
	background-color: <?php echo $color2 ?>;
	color: <?php echo $color1 ?>;
	overflow: hidden;
	margin-bottom: 0px;
}
.HeaderData{
	padding: 5px;
	background-color: #CCC;
	color:<?php echo $color1 ?>;
	border-bottom: 1px solid #555;
}
#FiltroBusqueda, .Filtro{
	border: 1px solid #555;
	color: <?php echo $color1 ?>;
	overflow: hidden;
	display: block;
	width:100%;
	background-color:#FFFFFF;
}
#FiltroBusqueda #fOrden{
	border-top: 1px solid #555;
}
#FiltroBusqueda label, .Filtro label{
	height:20px;
	line-height:20px;
	width:100px;
	border-bottom: 1px solid #555;
	float:left;
	margin-right:5px;
	text-align:left;
	padding:0px;
}
#FiltroBusqueda input, #FiltroBusqueda select, #fOrden select{
	width:200px;
	float:left;
	background-color:#EEE;
	border:0px none;
}
.Filtro input, .Filtro select{
	width:180px;
	float:left;
	background-color:#EEE;
	border:0px none;
}
#fOrden{
	padding: 0px 5px;
	float:right;
}
#DatosBusqueda{
	background-color: #FFFFFF;
	width:100%;
}
.BusquedaParametro{
	overflow:hidden;
}
.HeaderBusqueda{
	color: #FFFFFF;
	background-color: <?php echo $color1 ?>;
	padding-bottom: 5px;
	padding-left: 5px;
	padding-right: 5px;
	padding-top: 5px;
	display:none;
}
.HeaderNew{
	color: #222;
	background-color: #FFB580;
	padding-bottom: 5px;
	padding-left: 5px;
	padding-right: 5px;
	padding-top: 5px;
}
.BusquedaCol_1_3{
	width: 32%;
	padding: 4px;
	float: left;
	background-color: #FFFFFF;
	font-weight: bold;
}
.SeparadorBusquedaCol, .bDer{
	border-right:1px solid #999;
}
.Resultados {
	background-color: #DDD;

	overflow-y: scroll;
	overflow-x:hidden;
	width: 100%;
	height:500px;

	clear: both;
	border: 1px solid #555;
}
.ResultadosListado {
	width: 100%;
	border: 1px solid #555;
	background-color: #DDD;
}
thead.fixedHeader tr {
/*
CAMBIO REALIZADO EL 25/04/2016 --- CHROME DEJO DE FUNCIONAR EL SCROLL DE LAS TABLAS
	display: block; 
*/
	height:30px;
}
.Resultados td, .Resultados th, .ResultadosListado td, .ResultadosListado th{
	padding: 4px;
/*
CAMBIO REALIZADO EL 25/04/2016 --- CHROME DEJO DE FUNCIONAR EL SCROLL DE LAS TABLAS
	display: block; 
*/
}
.Resultados td, .ResultadosListado td{
	border-bottom: 1px solid #DDD;
	vertical-align:middle;
}
.Resultados td img{
	max-height:50px;
	max-width:100px;
}
tbody.scrollContent {
/*
CAMBIO REALIZADO EL 25/04/2016 --- CHROME DEJO DE FUNCIONAR EL SCROLL DE LAS TABLAS
	display: block; 
*/
	height: 470px; /* HEIGHT div.tableContainer - HEIGHT thead.fixedHeader th */
	overflow-y: scroll;
	width: 100%
}
#trHeader td, .tableGrid th{
	text-align:center;
	vertical-align:middle;
}
.RowHeader{
	font-weight:bold;
	background:#DDD;
}
.RowHeader th{
	border-bottom: 1px solid #555;
}
.RowOdd{
	background-color:#F3F3F3;
}
.RowPair{
	background-color:#FFF;
}
.RowSelected{
	color:#35229F;	
	font-weight:bold;
}
.RowData {
	line-height:14px;
}
.RowHover{
	border:2px solid #FFA368;	
}
.RowHeaderG1{
	font-weight:bold;
	background: <?php echo $color2; ?>;
}
.RowSubTotG1{
	font-weight:bold;
	background: #999;
}
.Botones{
	padding: 5px 0px;
	background: <?php echo $color2 ?>;
	color:  <?php echo $color1 ?>;
	overflow: hidden;
	width: 100%;
	height:20px;
}
.BotonAccion, .BotonEdicion {
	cursor: pointer;
	float: left;
	margin: 0px 10px;
	background: <?php echo $grad1 ?>;
	padding: 5px 15px;
	color: #FFFFFF;
	font-weight: bold;
	border-radius: 4px;
	border: 1px solid <?php echo $color1 ?>;
	font-size: 10px;
	line-height: 8px;
}
.BotonAccion:hover, .BotonEdicion:hover {
	background: <?php echo $grad2_1_2 ?>;
}
.BotonAccion a, .botonMini{
	color: #FFFFFF;
	text-decoration: none;
}
.botonMini {
	float: left;
	margin: 0px 0px 0px 2px;
	background: <?php echo $color2 ?>;
	padding: 2px;
	color: #FFFFFF;
	font-weight: bold;
	border-radius: 4px;
	border: 1px solid <?php echo $color2 ?>;
	font-size: 10px;
	line-height:8px;
	top:2px;
	position:relative;
}
.botonMini:hover{
	background: <?php echo $color1 ?>;
	cursor:pointer;
}
#BotonActivo{
	cursor: pointer;
	padding: 3px 5px;
	color: #FFFFFF;
	font-weight: bold;
	border-radius: 4px;
	border: 1px solid <?php echo $color1 ?>;
	font-size: 10px;
	line-height: 8px;
	float:right;
}
.CerrarVentana {
	position:relative;
	top:-4px;
	float:right;
}
.euro {
	text-align: right;
}
.cantidad {
	text-align: right;
}
.C6 {
	margin: 5px;
}
.C1_6 {
	width:140px;
}
.C15_6 {
	width:215px;
}
.C2_6 {
	width: 290px;
}
.C22_6 {
	width: 315px;
}
.C25_6 {
	width: 365px;
}
.C3_6 {
	width:440px;
}
.C35_6 {
	width:515px;
}
.C38_6 {
	width:565px;
}
.C4_6 {
	width:590px;
}
.C45_6 {
	width:665px;
}
.C5_6 {
	width:740px;
}
.C6_6 {
	width:890px;
}
.C7_6 {
	width:950px;
}

.C1080 {
	width:1080px;
}
.C1200 {
	width:1200px;
}
.F05_6 {
	width: 15px;
}
.F07_6 {
	width: 20px;
}
.F1_6 {
	width: 30px;
}
.F11_6 {
	width: 40px;
}
.F12_6 {
	width: 55px;
}
.F13_6 {
	width: 60px;
}
.F14_6 {
	width: 75px;
}
.F15_6 {
	width: 90px;
}
.F16_6 {
	width: 105px;
}
.F17_6 {
	width: 118px;
}
.F18_6 {
	width: 130px;
}
.F19_6 {
	width: 160px;
}
.F2_6 {
	width: 180px;
}
.F22_6 {
	width: 210px;
}
.F25_6 {
	width: 255px;
}
.F3_6 {
	width: 330px;
}
.F35_6 {
	width: 390px;
}
.F4_6 {
	width: 480px;
}
.F5_6 {
	width: 630px;
}
.F6 {
	width: 780px;
}
.F61_6 {
	width: 795px;
}
.F62_6 {
	width: 810px;
}
.F63_6 {
	width: 825px;
}
.F64_6 {
	width: 840px;
}
.F65_6 {
	width: 855px;
}
.F7_6 {
	width: 930px;
}
#editBox{
	margin: 10px;
	border:2px solid <?php echo $color1 ?>;
	background-color:#606D80;
	box-shadow: 0px 0px 20px #666;
}
#HeaderRecord{
/*	text-align:center; */
	padding-left:5px;
	color:#FFF;
	background-color:<?php echo $color2 ?>;
	border-radius:4px 4px 0px 0px;
	line-height:16px;
}
.FormData {
	background-color:#EEE;
	margin:10px;
	border: 1px solid #000;
}
.FormDataField{
	width: 100%;
	overflow: hidden;
	line-height: 12px;
}
.FormTextareaField{
	width: 100%;
	overflow: hidden;
	line-height: 12px;
}
.FormDataGrid{
/*	width: 100%;*/
	overflow: hidden;
	line-height: 12px;
}
.DataName, .DataNameMini {
	text-transform:none;
	float: left;
	font-weight: bold;
	padding: 2px;
	text-align: left;
	margin-right: 2px;
}
.DataName {
	width: 98px;
	border-bottom: 1px solid #999999;
}
.DataNameMini {
	width: 60px;
}
.RowGrid{
	line-height: 20px;
}
.RowGridHover{
	background:#EFCB85;
	cursor:pointer;
}
.DataField, .TextareaField  {
	float: left;
	padding: 0px;
	border: 1px solid #DDDDDD;
	height:15px;

	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#FBFBFB', endColorstr='#FFFFFF');
	-webkit-box-shadow: 0 0 2px #DDDDDD;
	box-shadow: 0 0 2px #DDDDDD;
}
.TextareaField{
	height:auto;
	resize:none;
}
input, select, textarea{
	font-family: "Calibri", Arial, sans-serif;
	font-size:12px;
}
input:hover, select:hover, textarea:hover{
	border:1px solid <?php echo $color2 ?>;
}
input:focus, select:focus, textarea:focus{
	box-shadow:0 0 2px <?php echo $color2 ?>;
	background: #EEE;
}
.Close, .CloseMsg{
	background-image:url(../images/exit-icon.png);
	width:14px;
	height:14px;
	float:right;
	position:relative;
	top:0px;
	cursor:pointer;
}
.Paginacion{
	font-weight: normal;
	width:100%;
	overflow:hidden;
	padding: 5px 0px;
	background:#EEEEEE;
}
.BarraPaginacion{
	float: right;
	font-weight: normal;
}
#BarraPaginacion{
	float: right;
	font-weight: normal;
}
.InvalidData {
	border-color:#F00;
	color: #F00;
}
.InvalidDataGrid {
	background-color:#FFDDDD;
	color: #F00;
}
.Right{
	float:right;
}
.Left{
	float:left;
}
.Clear{
	overflow:hidden;
	clear:both;
}
.Borde1{
	border: 1px solid #000;
	padding: 5px;
	overflow:hidden;
}
.Borde0{
	padding: 5px;
	overflow:hidden;
}
.botonTab100 {
	margin: 5px 0px 0px 0px;
	font-weight:bold;
	text-align:left;
	padding: 5px 10px;
	background-color:<?php echo $color2 ?>;
}
.botonTab {
	text-align: left;
	padding: 5px;
	margin-bottom: 5px;
	width: 150px;
	float: left;
	border: 1px solid  #A5A5A5;
	background-color: <?php echo $color2 ?>;
}
.botonTab:hover, .botonTab100:hover{
	cursor: pointer;
	color: #FFF;
	background-color: #BBBBBB;
}
#EditForm h3, #NoEditForm h3, .FormData h3 {
	text-align:left;
	color:#FFF;
	background-color:#BBB;
	padding: 3px;
	margin-top:3px;
}
.tableGrid {
	width: 100%;
	border:1px groove #666;
	background-color:#FFF;
}
.tableGrid th{
	border-bottom:1px solid #666;
	background-color:#ccc;
}
.tableGrid td {
	border-bottom:1px solid #666;
	padding: 0px 4px;
}
.tableGrid td input, .tableGrid td select{
	border: 0 none;
	width:100%;
}
.tableGrid tfoot td{
	border-bottom:1px solid #666;
	background-color:#ccc;
	font-weight:bold;
	padding:4px;
}
.NoDisplay{
	display:none;
}
#MsgErrorDatos, .MsgError{
	background-color:#BB0000; 
	color:#FFF; 
	font-weight:bold;
	font-size:1.2em;
	display:none;
	padding:10px;
	overflow:hidden;
}
#CloseMsgError{
	float:right;
}
#Error{
	float:left;
	width: 90%;
}
#boxPartesKilometros {
	max-height:550px;
	overflow:auto;
}
.btnRegPosicion{
	cursor: pointer;
	margin-left: 5px;
	background: <?php echo $grad1 ?>;
	border-radius: 4px;
	border: 1px solid <?php echo $color1 ?>;
	float:left;
}

.Red {
	background-color: #FF9A9A;
}
.Yellow{
	background-color:#F8F879;
}
.Green{
	background-color:#88DD99;
}
#FiltroVentanaBusqueda{
	background-color:#DCDCDC;
	margin-bottom:10px;
	padding: 5px 0px;
	border:1px solid #2F2F2F;
	overflow:hidden;
}
.Aright{
	text-align:right;
}
.ACenter{
	text-align:center;
}
.optionDisabled {
	color: #B9B9B9;
	background-color: #FFD7D7;
}

.DashBoard{
	margin: auto;
	width: 1200px;
	height:auto;
	font-size: 12px;
	border-radius: 2px;
	overflow-x: hidden;
	overflow-y: auto;
}
.DashBoard thead{
	border:1px solid #000;
	background:#DDD;
	font-weight:bold;
}
.DashBoard h2{
	color: #000;
	background: <?php echo $color2 ?>;;
	padding-bottom: 5px;
	padding-left: 5px;
	padding-right: 5px;
	padding-top: 5px;
}
#DB_Cumples{
	height: 100px;
	margin: 90px auto 20px auto;
}
#DB_Fondo{
	margin-bottom: 20px;
}

.imgUpload{
	cursor:pointer;
	max-height:130px;
	max-width:130px;
}



</STYLE>
