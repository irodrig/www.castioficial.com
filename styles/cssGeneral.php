<?php
header('content-type:text/css');
$color1 = "#262262";
$color2 = "#c8d5e3";
$color2 = "#FEF5A8";

?>

<style>
/* MANTENER --- NO SE PORQUE NO APLICA EL PRIMERO */
body {}
/* MANTENER --- NO SE PORQUE NO APLICA EL PRIMERO */

@charset "utf-8";
@import url('https://fonts.googleapis.com/css?family=Buenard|Raleway:200,700');

@font-face {
	font-family: Scriptina;
	src: url("../includes/SCRIPTIN.ttf");
}

body{
	font-family:'Buenard', serif;
	font-size:14px;
	color:<?php echo $color1 ?>;
	background-repeat:repeat;
}

.FondoGrano{
	background:url(../images/GRANO.jpg);
	background-size:135px 272px;
}


/*****************************************************************************/
/* HEADER */
#imgMenu{
	display:none;
}
#SeccionMenu{
	line-height: 50px;
}
#headerMenu{
	z-index:1000;
}
#Logo{
	float:left;
	height:50px;
	padding-left:10px;
	padding-right:50px;
}
#Menu{
	float:left;
	position:relative;
	left:50%;
}
#Menu li{
	float: left;
	padding: 0px 15px;
	text-align: center;
	cursor:pointer;
	position:relative;
	right:50%
}
#Menu li a{
	color:<?php echo $color1 ?>;
	text-decoration:none;
	display: block;
	text-transform: uppercase;
	letter-spacing: 3px;
}
#Menu li a:hover{
	color:#000;
	-webkit-transition: 1s;
	transition: 1s;
}

#btnLogin{
	position:relative;
	float:right;
	border-left:1px solid #000;
	padding-left:10px;
}
#boxRRSS{
	position:relative;
	overflow: hidden;
	float: right;
	padding-right: 10px;
	padding-top:3px;
	height: 50px;
}
#boxRRSS a{
	padding: 5px;
}
/* HEADER */
/*****************************************************************************/


/*****************************************************************************/
/* FOOTER */
#SeccionFooter{
	background-color: #EFEFEF;
	padding:10px;
}
#SeccionFooter a {
	display:block;
	padding:5px 0px;
}
#SeccionFooter #Beneficiarios img{
	height:30px;
	margin:20px 0px 0px 20px;
}
#boxRRSSFooter{
	display:none;
	color:#FFF;
	border:2px solid #FFF;
	background: #262262;
	left: 100px;
	top: 15px;
	padding: 5px 15px;
	z-index: 100;
	position: absolute;
}
#boxRRSSFooter a{
	float:left;
	margin:0px 10px;
}
#boxContacto{
	display:none;
	color:#FFF;
	border:2px solid #FFF;
	background: #262262;
	left: 400px;
	top: 15px;
	z-index: 100;
	width:330px;
	position: absolute;
}
#boxContacto a{
	margin:5px;
}
/* FOOTER */
/*****************************************************************************/

/*****************************************************************************/
/* COMUNES */
#Slogan{
	font-family:"Buenard", sans-serif;
	font-size: 1.7em;
	font-weight:bold;
	line-height: 2em;
	color:<?php echo $color1 ?>;
	letter-spacing:2px;
	margin:40px 0px 0px 0px;
	text-align:center;
}
#SeccionDescripcion{
	font-family:'Raleway', sans-serif;
	margin-top:40px;
	margin-bottom:80px;
	text-align:left;
}
.bordeSupColor{
	border-top:1px solid #009BDB;
}
/* COMUNES */
/*****************************************************************************/

/*****************************************************************************/
/* INDEX */
#boxImgSlideLeft, #boxImgSlideRight{
	height: calc(100% + 50px);
	position:absolute;
	width:calc(50% - 75px);
}
#boxImgSlideLeft{
	background: #D17301;
}
#boxImgSlideRight{
	background:#FEF5A8;
	right:0px;
}
#SeccionModelos{
	text-align:center;
	padding-bottom:50px;
}
#SeccionModelos img{
	width:calc(100% - 10px);
}
#SeccionModelos .DescripcionModelo{
	font-family:'Raleway', sans-serif;
	font-size:1.2em;
	margin:20px 0px;
}
#SlideInicio{
	margin:0px;
}
#SlideInicio img{
	width: auto;
	vertical-align:middle;
}
#SlideInicio .Slide{
	line-height:600px;
	width: calc(40% - 20px);
	padding: 10px;
	text-align:center;
}
.linkSlide{
	font-size:1.5em;
	line-height:500px;
	width:20%;
	text-align:center;
	color:#262262;
	text-decoration:underline;
}
.textSlide{
	font-size:1.3em;
	line-height:500px;
	width:20%;
	text-align:center;
	color:#262262;
	float:left;
}

#cycle-slideshow img { display: none }
#cycle-slideshow img.first { display: block }

.cycle-slideshow{
	margin:auto;
	height:700px;
}
.cycle-slideshow img{
	max-height:600px;
	max-width:100%;
}
.movSlide{
	position:absolute;
	top:250px;
	z-index:500;
	cursor:pointer;
}
#prev{
	left:0px;
}
#next{
	right:0px;
}

/* INDEX */
/*****************************************************************************/

/*****************************************************************************/
/* PAGINAS LOGIN / REGISTER */
#SeccionLoginRegister{
	font-family:'Raleway', sans-serif;
	margin-top:80px;
	margin-bottom:80px;
	width:550px;
	background-color:<?php echo $color2 ?>;
	text-align:center;
	padding-bottom:40px;
}
#SeccionLoginRegister header{
	font-family:'Buenard', sans-serif;
	font-size:1.6em;
	text-transform:capitalize;
	font-weight:bold;
	overflow:hidden;
	margin-bottom:30px;
}
#SeccionLoginRegister .accion{
	width: calc(50% - 31px);
	float:left;
	padding:15px;
	border-bottom: 1px solid <?php echo $color1 ?>;	
}
#SeccionLoginRegister .accion a{
	color:#D8D8D8;
}
#SeccionLoginRegister .accion a:hover{
	color:<?php echo $color1 ?>;;
	letter-spacing:2px;
	-webkit-transition: 1s;
	transition: 1s;
}
#SeccionLoginRegister .accion:first-child{
	border-right: 1px solid <?php echo $color1 ?>;
}
#LoginBox label, #LoginBox input, #LoginBox button{
	margin:auto;
	display:block;
	padding:8px;
	width:80%;
}
#LoginBox label{
	margin-top:25px;
}
#LoginBox input{
	margin-bottom:10px;
	background:#F0F0F0;
	border:none;
	text-align:center;
}
#LoginBox button{
	font-family:'Buenard', sans-serif;
	font-weight:bold;
	letter-spacing:3px;
	margin-top:40px;
	background-color:<?php echo $color1 ?>;
	color: #FFF;
	border:none;
	width: calc( 80% + 20px);
}

#loginError{
	margin:20px;
	background-color:#FFF;
	border:1px solid <?php echo $color1 ?>;
	padding: 5px;
	color: #F00;
	font-family: 'Buenard';
}
/* PAGINAS LOGIN / REGISTER */
/*****************************************************************************/

/*****************************************************************************/
/* PAGINA SOMOS CASTI */
#SeccionSomosCasti{
}
#SeccionSomosCasti img{
	width:100%;
}
#videoYouTube{
	width:800px;
	height:600px;
}
/* PAGINA SOMOS CASTI */
/*****************************************************************************/

/*****************************************************************************/
/* PAGINA COLABORADORES */
.BloggerPost{
	float:left;
	font-weight:bold;
	color:<?php echo $color1 ?>;
}
.BloggerPost p{
	margin:2px;
}
.BloggerImg{
	float:left;
	height:50px;
	width:50px;
	border-radius:50%;
	margin-right:20px;
}
.datePost{
	font-family:"Raleway", sans-serif;
}
.nameBloggerPost{
	font-family:"Scriptina", sans-serif;
	font-size:1.2em;
}
.socialPost{
	float:right;
}
.lstColaboradores{
	padding:10px 5px;
	line-height:50px;
	border-bottom:1px solid #000;
	font-family:"Raleway",sans-serif;
}

.ResumenPost{
	padding-bottom:50px;
	border-bottom:1px solid #000;
	text-align:center;
}
.ResumenPost img{
	width:40%;
}
.TitularPost{
	font-family:'Raleway',Arial, Helvetica, sans-serif;
	font-size: 1.2em;
	font-weight: bold;
	color: <?php echo $color1 ?>;
	text-align:center;
	margin:20px 0px;
}
.headerPost{
	overflow:hidden;
}
.AvancePost{
	text-align:left;
	font-size:1.2em;
}
.lstPost{
	padding:10px 5px;
	line-height:1.3em;
	border-bottom:1px solid #000;
	font-family:"Raleway",sans-serif;
}
#postsInfluencers{
/*	position:absolute;*/
	background-color:<?php echo $color2 ?>;
	right:0px;
	bottom:0px;
	top:0px;
}
.headerSection{
	background:<?php echo $color1 ?>;
	font-family:'Raleway',Arial, Helvetica, sans-serif;
	font-size: 1.2em;
	color: #FFF;
	text-align:center;
	padding: 4px 10px;
	margin-top: 10px;
}
/* PAGINA COLABORADORES*/
/*****************************************************************************/

/*****************************************************************************/
/* TRAJES */
.Traje img{
	margin-bottom:10px;
	width:70%;
}
.Traje {
	padding: 20px 30px;
	margin-bottom: 30px;
	overflow: hidden;
	position: relative;
	margin: 30px 0px;
	width: calc(50% - 60px);
}
.Traje .NombreModelo{
	text-align:left;
	width:70%;
}
.TrajeDer .NombreModelo{
	float:right;
}
.TrajeIzq{
	text-align:left;
	padding-bottom:100px
}
.TrajeDer{
	text-align:right;
	padding-top:100px
}
#ModeloTraje{
	font-size:1.75em;
	font-family:'Raleway',Arial, Helvetica, sans-serif;
	margin:50px 0px 20px 0px;
}
#PrecioTraje{
	font-size:1.75em;
	font-family:'Raleway',Arial, Helvetica, sans-serif;
	text-align:center;
	font-weight:bold;
	margin:20px 0px 0px 0px;
}
.TrajeImagenes {
	padding: 20px 30px;
	margin-bottom: 30px;
	overflow: hidden;
	position: relative;
	margin: 30px 0px;
	height: 885px;
	width: calc(50% - 60px);
}
.imagenTraje{
	max-width:80%;
}
#productoRelacionado{
	text-align:center;
	margin-top:20px;
	font-weight:bold;
	font-size:1.2em;
}
.imagenTrajeRelacionado{
	height:140px;
	margin:10px;
}
.DescripcionTraje{
	position: absolute;
	padding: 120px 30px 0px 30px;
	line-height: 2em;
	margin: 0px 0px;
	top: 0px;
	height: 950px;
	right: 0px;
	width: calc(50% - 60px);
	background:#FEF5A8;
}
.textoDescripcionTraje{
}
.botonCompra{
	padding: 10px;
	margin: 50px 0px 0px;
	font-size: 1.1em;
	background:#000;
	color:#fff;
	position:relative;
	display:block;
	text-align:center;
	font-family:'Raleway',Arial, Helvetica, sans-serif;
}
.Agotado{
	COLOR:#f00;
	font-size:1.2em;
	font-weight:bold;
}
/* TRAJES */
/*****************************************************************************/






@media screen and (max-width: 840px) {

/*****************************************************************************/
/* HEADER */
#imgMenu{
	display: block;
	position: absolute;
	top: 30px;
	right: 10px;
}
#SeccionMenu{
	line-height: 20px;
}
#headerMenu{
	z-index:1000;
}
#Menu{
	display:none;
	float: right;
	right: 10px;
	left: 0px;
	top: 65px;
	background: #FFF;
	position: absolute;
	z-index: 10;
}
#Menu li{
	float: none;
	text-align: right;
	right:0px;
	padding:0px;
}
#btnLogin{
	width:100%;
	position:absolute;
	border-left:none;
	padding-left:0px;
	top:80px;
}
#btnLogin a{
	width: 50%;
	display: block;
	float: left;
	text-align: center;
}
#separadorLogin{
	display:none;
}
#boxRRSS{
	display:none;
}
/* HEADER */
/*****************************************************************************/

/*****************************************************************************/
/* FOOTER */
#SeccionFooter{
	text-align:center;
}
#SeccionFooter #Beneficiarios{
	height:30px;
	margin:20px 0px;
	text-align:center;
}
#SeccionFooter #Beneficiarios img{
	margin:0px 20px;
}
/* FOOTER */
/*****************************************************************************/

/*****************************************************************************/
/* PAGINAS LOGIN / REGISTER */
#SeccionLoginRegister{
	width:calc(100% - 20px);
}
#SeccionLoginRegister header{
	font-size:1em;
}
/* PAGINAS LOGIN / REGISTER */
/*****************************************************************************/


/*****************************************************************************/
/* PAGINA SOMOS CASTI */
#videoYouTube{
	width:80%;
	height:auto;
}
/* PAGINA SOMOS CASTI */
/*****************************************************************************/

/*****************************************************************************/
/* PAGINA INDEX */
#SeccionModelos{
	padding-bottom:0px;
}
#SlideInicio .Slide{
	width: calc(100% - 20px);
}
#boxImgSlideLeft, #boxImgSlideRight{
	display:none;
}

.cycle-slideshow{
	height:600px;
}

/* PAGINA INDEX */
/*****************************************************************************/


/*****************************************************************************/
/* TRAJES */
.Traje img{
	margin-bottom:10px;
	width:100%;
}
.Traje {
	padding: 20px 0px;
	width: 100%;
}
.Traje .NombreModelo{
	text-align:center;
	width:100%;
}
.TrajeDer .NombreModelo{
	float:none;
}
.TrajeIzq, .TrajeDer{
	text-align:center;
	padding-top:0px;
	padding-bottom:0px;
}

#ModeloTraje{
	text-align:center;
	font-size:1.5em;
	margin-bottom:30px;
}
.TrajeImagenes {
	padding: 20px 15px;
	margin-bottom: 30px;
	margin: 30px 0px;
	height: auto;
	width: calc(100% - 30px);
}
.imagenTraje{
	max-width:100%;
}
.DescripcionTraje{
	position: relative;
	padding: 0px 15px 0px 15px;
	line-height: 2em;
	height: auto;
	width: calc(100% - 30px);
}
.textoDescripcionTraje{
}
.botonCompra{
	padding: 5px;
	margin: 25px 0px 0px;
	font-size: 1em;
}
/* TRAJES */
/*****************************************************************************/

}

</style>