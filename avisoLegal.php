<?php
	require_once('connections/kriva.php'); 

	include('includes/inicializar.php'); 

?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Aviso Legal de Grupo Asistencial Coruña</title>
<?php
	include("includes/metas.php");
?>

<script type="text/javascript" src="includes/jquery.js"></script>

</head>

<body>
<?php
	include_once("includes/analyticstracking.php");
	include("includes/Header.php");
?>

<div class="Seccion">
  <div class="ContenidoSeccion">
	  <h1 id="TituloPagina">AVISO LEGAL</h1>
    <p>Aviso  Legal del dominio <?php echo $rowEmpresa['Web'] ?> correspondiente a <?php echo $rowEmpresa['RazonSocial'] ?>, con Nº de NIF <?php echo $rowEmpresa['NIF'] ?>, con domicilio  en <?php echo utf8_encode($rowEmpresa['Direccion'].' '.$rowEmpresa['Numero'].'. '.$rowEmpresa['CodPostal']) ?> - A CORUÑA,  en adelante <?php echo $rowEmpresa['CodEmpresa'] ?></p>
    <p>&nbsp;</p>
    <p><strong>Condiciones generales de utilización de la  web</strong></p>
		<p><?php echo $rowEmpresa['CodEmpresa'] ?> le  informa de que el acceso y utilización de la página web <?php echo $rowEmpresa['Web'] ?> y todas las URLs, subdominios y directorios  incluidos bajo la misma, así como los servicios o contenidos que a través de  este sitio se puedan obtener, están sujetos a los términos recogidos y  detallados en este Aviso Legal, sin perjuicio de que el acceso a alguno de  dichos servicios o contenidos pueda precisar de la aceptación de unas  condiciones generales, particulares o adicionales.</p>
		<p>Por consiguiente, si las consideraciones detalladas en este Aviso Legal no son  de su conformidad, rogamos que no haga uso de esta web, ya que cualquier  utilización que haga de ella o de los servicios y contenidos en ella incluidos,  implicará la aceptación de los términos legales recogidos en el texto de este  Aviso Legal.</p>
		<p> Debido a la propia naturaleza de Internet, dada la posibilidad de que se pueda  acceder a esta página desde cualquier parte del mundo, los contenidos, así como  los servicios que en general ofrece <?php echo $rowEmpresa['CodEmpresa'] ?>  están dirigidos a clientes que se mueven en cualquier país. No obstante lo  anterior, al solicitar la contratación de cualquier tipo de servicios y  contenidos ofrecidos, <?php echo $rowEmpresa['CodEmpresa'] ?> se reserva  el derecho a rechazar la prestación de servicios o el envío de contenidos, en  aquellos casos que estime oportuno.</p>
		<p><?php echo $rowEmpresa['CodEmpresa'] ?> se reserva el derecho a realizar  cambios en la web sin previo aviso, con el objeto de actualizar, corregir,  modificar, añadir, cancelar o eliminar los contenidos o el diseño de la web.  Los servicios y contenidos de la web son susceptibles de actualizarse  periódicamente y debido a que la actualización de la información no es  inmediata, le sugerimos que compruebe siempre la vigencia y exactitud de la  información, servicios y contenidos recogidos aquí.</p>
		<p> Las condiciones y términos de utilización que se recogen en el presente Aviso  Legal pueden cambiar, por lo que le proponemos que revise estos términos cuando  visite de nuevo la web o solicite un nuevo servicio. Asimismo, el presente  Aviso Legal se entenderá sin perjuicio de cualesquiera otras Condiciones  Generales, y particulares, que regulen el acceso a bienes y servicios concretos  dentro de la web.</p>
		<p>&nbsp;</p>
		<p><strong>Derechos de propiedad intelectual y de  propiedad industrial</strong></p>
		<p>		  Tanto  el diseño de este sitio web, sus códigos fuente, logotipos, imágenes, melodías,  marcas y demás signos distintivos que aparecen, pertenecen a sus respectivos  autores y están protegidos por los correspondientes derechos de propiedad  intelectual e industrial.</p>
		<p> Su utilización, reproducción, distribución, comunicación pública,  transformación o cualquier otra acción semejante, está totalmente prohibida  salvo autorización expresa por escrito de su creador o propietario de los  derechos.</p>
		<p> En todo caso, <?php echo $rowEmpresa['CodEmpresa'] ?> declara su respeto a  los derechos de propiedad intelectual e industrial de terceros; por ello, si considera  que este sitio pudiera estar violando sus derechos, rogamos se ponga en  contacto con <?php echo $rowEmpresa['CodEmpresa'] ?> cumplimentando el  formulario que encontrará haciendo&nbsp;<a href="contacto.phpl">click aquí</a>.</p>
		<p>&nbsp;</p>
		<p> <strong>Links o hiperenlaces</strong></p>
		<p>		  Desde  esta web, <?php echo $rowEmpresa['CodEmpresa'] ?> le proporciona o puede  proporcionarle el acceso a otras páginas web que considera pueden ser de su  interés. El objeto de dichos enlaces es meramente el facilitar la búsqueda de  los recursos que le puedan interesar en Internet. No obstante, dichas páginas no  pertenecen a <?php echo $rowEmpresa['CodEmpresa'] ?>, ni hace una revisión  de sus contenidos, por ello, no se hace responsable de los mismos, del  funcionamiento de la página enlazada o de los posibles daños que puedan  derivarse del acceso o uso de la misma. Asimismo, <?php echo $rowEmpresa['CodEmpresa'] ?>,  se muestra plenamente respetuosa con los derechos de propiedad intelectual o  industrial que correspondan o puedan corresponder a terceras personas, sobre  las páginas web a las que se refieran los citados enlaces. Por tal motivo, si  considera que el establecimiento de los citados enlaces pudiera estar violando  sus derechos, rogamos se ponga en contacto con <?php echo $rowEmpresa['CodEmpresa'] ?>  cumplimentando el formulario que encontrará haciendo&nbsp;<a href="contacto.php">click aquí</a>.</p>
		<p> Con carácter general se autoriza el enlace de páginas web o de direcciones de  correo electrónico a la web, excepción hecha de aquellos supuestos en los que,  expresamente <?php echo $rowEmpresa['CodEmpresa'] ?> manifieste lo  contrario. Adicionalmente, y en todo caso para entender aplicable esta  autorización general, dichos enlaces deberán respetar, necesariamente, la  siguiente condición: el establecimiento del enlace no supondrá, por sí mismo,  ningún tipo de acuerdo, contrato, patrocinio ni recomendación por parte de <?php echo $rowEmpresa['CodEmpresa'] ?> de la página que realiza el enlace.</p>
		<p> No obstante lo anterior, en cualquier momento <?php echo $rowEmpresa['CodEmpresa'] ?>  podrá retirar la autorización mencionada en el párrafo anterior, sin necesidad  de alegar causa alguna. En tal caso, la página que haya realizado el enlace  deberá proceder a su inmediata supresión, tan pronto como reciba la  notificación de la revocación de la autorización por parte de <?php echo $rowEmpresa['CodEmpresa'] ?>.</p>
		<p>&nbsp;</p>
		<p><strong>Responsabilidades del usuario</strong></p>
		<p>		  El  usuario se compromete a utilizar los servicios de la web de acuerdo con los  términos expresados en el presente Aviso Legal, siendo responsable de su uso correcto.</p>
		<p> El usuario que actúe contra la imagen, buen nombre o reputación de <?php echo $rowEmpresa['CodEmpresa'] ?>, así como quien utilice ilícita o  fraudulentamente los diseños, logos o contenidos de la web y/o atente en  cualquier forma contra los derechos de propiedad intelectual e industrial de la  web o de los contenidos y servicios de la misma, será responsable frente a <?php echo $rowEmpresa['CodEmpresa'] ?> de su actuación.</p>
		<p>&nbsp;</p>
		<p> <strong>Responsabilidades de <?php echo $rowEmpresa['CodEmpresa'] ?></strong></p>
		<p><strong>Utilización incorrecta:</strong></p>
		<p>		  <?php echo $rowEmpresa['CodEmpresa'] ?> ha  creado la web para la promoción de sus productos y/o servicios, pero no puede  controlar la utilización del mismo de forma distinta a la prevista en el  presente Aviso Legal; por lo tanto, el acceso y uso correcto de la información  contenida en la web son responsabilidad de quien realiza estas acciones, no  siendo responsable <?php echo $rowEmpresa['CodEmpresa'] ?> por el uso  incorrecto, ilícito o negligente que del mismo pudiere hacer el usuario.</p>
		<p> <strong>Contenidos:</strong></p>
		<p><?php echo $rowEmpresa['CodEmpresa'] ?>  facilita todos los contenidos de su web, bajo determinadas condiciones de buena  fe, y se esforzará en la medida de lo posible para que los mismos estén  actualizados y vigentes; no obstante, <?php echo $rowEmpresa['CodEmpresa'] ?>  no puede asumir responsabilidad alguna respecto al uso o acceso que realicen  los usuarios fuera del ámbito al que se dirige la web, cuya responsabilidad  final recaerá sobre el usuario. Asimismo <?php echo $rowEmpresa['CodEmpresa'] ?>  no puede controlar los contenidos que no hayan sido elaborados por ella o por  terceros cumpliendo su encargo por lo que, no responderá en ningún caso de los  daños, contenidos e indisponibilidades técnicas que pudieran causarse por parte  de dichos terceros.</p>
		<p> <strong>Publicidad:</strong></p>
		<p><?php echo $rowEmpresa['CodEmpresa'] ?>  incluirá en la web publicidad propia o de terceros para ofrecerle productos o  servicios que entienda que pueden ser de su interés. Sin embargo, <?php echo $rowEmpresa['CodEmpresa'] ?> no puede controlar la apariencia de  dicha publicidad, ni la calidad y adecuación de los productos o servicios a que  esta se refiera, por lo que <?php echo $rowEmpresa['CodEmpresa'] ?> no  responderá de ningún daño que se pudiera generar al usuario por dichas causas.</p>
		<p> <strong>Virus:</strong></p>
		<p><?php echo $rowEmpresa['CodEmpresa'] ?> se  compromete a aplicar en la medida de lo posible, las medidas oportunas a su  alcance para intentar garantizar al usuario la ausencia de virus, gusanos,  troyanos, spam, etc… en su web. No obstante, estas medidas no son 100%  infalibles y, por ello, <?php echo $rowEmpresa['CodEmpresa'] ?> no puede  asegurar totalmente la ausencia de dichos elementos indeseables. En  consecuencia, <?php echo $rowEmpresa['CodEmpresa'] ?> no será responsable  de los daños que los mismos pudieran producir al usuario.</p>
		<p> <strong>Fallos tecnológicos:</strong></p>
		<p><?php echo $rowEmpresa['CodEmpresa'] ?> pone los medios necesarios a su alcance para la continuidad de esta web y  realizará sus mejores esfuerzos para que el mismo no sufra interrupciones, pero  no puede garantizar la ausencia de fallos tecnológicos, ni la permanente  disponibilidad de la web y de los servicios contenidos en él, en consecuencia  no se asume responsabilidad alguna por los daños y perjuicios que puedan  generarse por la falta de disponibilidad y por los fallos en el acceso  ocasionados por desconexiones, averías, sobrecargas o caídas de la red no  imputables a <?php echo $rowEmpresa['CodEmpresa'] ?>.</p>
		<p>&nbsp;</p>
		<p> <strong>Ley aplicable y jurisdicción</strong></p>
		<p>		  La  Ley aplicable en caso de disputa o conflicto de interpretación de los términos  que conforman este Aviso Legal, así como cualquier cuestión relacionada con los  servicios de la presente web, será la española.</p>
		<p> Para la resolución de cualquier conflicto que pueda surgir con ocasión de la  visita a la web o del uso de los servicios que en él se puedan ofertar, <?php echo $rowEmpresa['CodEmpresa'] ?> y el usuario acuerdan someterse a los  jueces y tribunales de lo mercantil de A  CORUÑA.</p>
		<p>&nbsp;</p>
		<p><strong>Copyright</strong></p>
		<p><strong>Los contenidos de <?php echo $rowEmpresa['Web'] ?> no pueden ser reproducidos ni  parcial ni totalmente, ni registrados o transmitidos por un sistema de recuperación  de información, en ninguna forma ni por ningún medio, sin permiso previo por  escrito de <?php echo $rowEmpresa['CodEmpresa'] ?>.</strong>&nbsp;Los derechos de propiedad intelectual del portal  <?php echo $rowEmpresa['Web'] ?> y de los distintos  elementos en él contenidos son titularidad de <?php echo $rowEmpresa['CodEmpresa'] ?> se reserva la facultad de efectuar, en cualquier momento y sin necesidad de  previo aviso, modificaciones y actualizaciones sobre la información contenida  en el portal o en su configuración o presentación. <?php echo $rowEmpresa['CodEmpresa'] ?> no garantiza la inexistencia de errores en el acceso al  portal o en su contenido ni que éste se encuentre totalmente actualizado. La  utilización no autorizada de la información contenida en este portal, así como  los perjuicios y quebrantos ocasionados en los derechos de propiedad  intelectual e industrial de <?php echo $rowEmpresa['CodEmpresa'] ?> dará  lugar al ejercicio de las acciones que legalmente correspondan a dicha Empresa  y, en su caso, a las responsabilidades que de dicho ejercicio se deriven. Tanto  el acceso al portal, como el uso que pueda hacerse de la información contenida  en el mismo son de la exclusiva responsabilidad de quien lo realiza. <?php echo $rowEmpresa['CodEmpresa'] ?> no responderá de ninguna  consecuencia, daño o perjuicio que pudieran derivarse de dicho acceso o uso de  información, con excepción de todas aquellas actuaciones que resulten de la  aplicación de las disposiciones legales a las que deba someterse en el estricto  ejercicio de sus competencias. <?php echo $rowEmpresa['CodEmpresa'] ?> no  asume responsabilidad alguna derivada de la conexión o de los contenidos de los  enlaces a terceros que pueda contener el portal. Reconoce que los derechos de  propiedad intelectual e industrial de las páginas enlazadas, pertenecen a sus  respectivos autores y propietarios y a petición de cualquiera de ellos, el  enlace o enlaces serán retirados de inmediato.</p>
  </div>
</div>




<?php
	include("includes/Footer.php");
?>
</body>
</html>
