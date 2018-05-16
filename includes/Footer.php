<script>
$(document).delegate("#SeccionFooter #RRSS","click",function() {
	$("#boxRRSSFooter").slideToggle(500);
});
//$(document).delegate("#SeccionFooter .CONTACTO","click",function() {
//	$("#boxContacto").slideToggle(500);
//});
</script>
  <div class="Seccion"  id="SeccionFooter">
  	<div class="ContenidoSeccion" style="overflow:visible">
      <div id="boxRRSSFooter">
        <h2>SIGUENOS</h2>
        <a href="<?php echo $rowEmpresa['Twitter'] ?>" target="new"><img class="btnRRSS" src="images/rrss/twitterFooter.png"></a>
        <a href="<?php echo $rowEmpresa['Facebook'] ?>" target="new"><img class="btnRRSS" src="images/rrss/facebookFooter.png"></a>
        <a href="<?php echo $rowEmpresa['Instagram'] ?>" target="new"><img class="btnRRSS" src="images/rrss/instagramFooter.png"></a>
      </div>
<!--
      <div id="boxContacto">
        <h2 class="Seccion25 FLeft">CONTACTO</h2>
        <div class="Seccion75 FLeft">
          <a href="mailto:castioficial@castioficial.com">castioficial@castioficial.com</a>
          <a href="mailto:presscasti@castioficial.com">presscasti@castioficial.com</a>
          <a href="mailto:wholesale@castioficial.com">wholesale@castioficial.com</a>
        </div>
      </div>
-->
      <div>
    <?php 
			$idGrupoSeccion = '';
			$rowS = $rowSecciones;
			while ($rowS = $rowSecciones) {
				$url = $rowS['Url'] == '' ? "Seccion.php?idSeccion=".$rowS['idSeccion'] : $rowS['Url']."?idSeccion=".$rowS['idSeccion'];
				if ($idGrupoSeccion != $rowS['idGrupoSeccion']) {
					$idGrupoSeccion = $rowS['idGrupoSeccion'];
					$Seccion = ObtenerValor($MySQL,"GE_SeccionGrupos","idSeccionGrupo", "SeccionGrupo",$rowS['idGrupoSeccion']);
		?>
						<div class="Seccion1_4 FLeft">
							<h2><?php echo $Seccion ?></h2>
				<?php
				}
				?>
        <a id="<?php echo utf8_encode($rowS['idSeccion']) ?>" class="<?php echo $Seccion ?>" href="<?php echo $url ?>"><?php echo utf8_encode($rowS['Seccion']) ?></a>
		<?php
				$rowSecciones = $rstSecciones->fetch_array();
				if ($idGrupoSeccion != $rowSecciones['idGrupoSeccion']) {
		?>
      </div>
    <?php
				}
			}
		?>

        <div class="Seccion1_4 FRight ARight">
          <div id="Beneficiarios">
            <img src="images/Ella.png" alt="Becas ELLA"/>
            <img src="images/Educo.png" alt="Fundación Educo"/>
          </div>
        </div>
      </div>
    </div>
    <div class="ContenidoSeccion ACenter bordeSupColor">
			© 2018 CASTI® ES UNA MARCA REGISTRADA. TODOS LOS DERECHOS RESERVADOS
    </div>
  </div>
