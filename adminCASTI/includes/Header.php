<div id="SeccionEncabezado">
	<div id="ContenedorEncabezado">
  	<div style="width:300px; float:left;"><a href="<?php echo $_SESSION['Raiz'] ?>index.php"><img id="Logo" src="<?php echo $_SESSION['Raiz'] ?>/images/kriva-mini.png" height="50" /></a></div>
    <div id="Descripcion">
    GESTION  WEBS KRIVA
    </div>
    <div id="LoginId">
      <p><?php echo utf8_encode($_SESSION['Empresa']) ?></p>
      <form id="Logout" style="float:right;" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
      	<input name="logout" type="hidden" value="" /><input type="image" src="<?php echo $_SESSION['Raiz'] ?>/images/LogOut.png" />
      </form>
      <div style="float:right">
        <p>
        	<span><?php echo $_SESSION['Usuario'] ?></span>
        </p>
        <p style="font-size:9px">Ult Acci&oacute;n <?php echo date('d-m-Y H:i:s', $_SESSION['Time']) ?></p>
			</div>
    </div>
	</div>
</div>

<?php
	$qryNivel1 = "SELECT * FROM GE_Menu AS Menu, GE_UsuariosPermisos AS UsuPer WHERE Menu.idMenu = UsuPer.idMenu AND Nivel = 1 AND Activo = 1 ";
	$qryNivel1.= " AND (UsuPer.idUsuario='".$_SESSION['idUsuario']."' OR UsuPer.idUsuarioTipo='".$_SESSION['idUsuarioTipo']."') AND UsuPer.Acceso='S' ORDER BY Orden";
	$rstNivel1 = $MySQL->query($qryNivel1);
?>
<div id="SeccionMenu">
  <ul id="main-menu" class="sm sm-blue">
<?php
		while ($rowNivel1 = $rstNivel1->fetch_array()) {
?>
<?php echo htmlentities($rowNivel1['Descripcion'], ENT_COMPAT, 'iso-8859-1'); ?>
      <li><a href="#"><?php echo htmlentities($rowNivel1['Descripcion'], ENT_COMPAT, 'iso-8859-1'); ?></a>
        <ul>
<?php
//					$qryNivel2 = "SELECT * FROM GE_Menu WHERE Nivel = 2 AND idPadre = ".$rowNivel1['IdMenu']." ORDER BY Orden";
					$qryNivel2 = "SELECT * FROM GE_Menu AS Menu, GE_UsuariosPermisos AS UsuPer";
					$qryNivel2.= " WHERE Menu.idMenu=UsuPer.idMenu AND Menu.Nivel = 2 AND Menu.Activo = 1";
					$qryNivel2.= " AND (UsuPer.idUsuario='".$_SESSION['idUsuario']."' OR UsuPer.idUsuarioTipo='".$_SESSION['idUsuarioTipo']."') AND UsuPer.Acceso='S'";
					$qryNivel2.= " AND idPadre = ".$rowNivel1['IdMenu']." ORDER BY Orden";
					$rstNivel2 = $MySQL->query($qryNivel2);
					while ($rowNivel2 = $rstNivel2->fetch_array()) {
?>
            <li><a href="<?php echo ($rowNivel2['URL'] ? $_SESSION['Raiz'].$rowNivel2['URL'] : '#') ?>"><?php echo htmlentities($rowNivel2['Descripcion'], ENT_COMPAT, 'iso-8859-1'); ?></a>
<?php
//							$qryNivel3 = "SELECT * FROM GE_Menu WHERE Nivel = 3 AND idPadre = ".$rowNivel2['IdMenu']." ORDER BY Orden";
							$qryNivel3 = "SELECT * FROM GE_Menu AS Menu, GE_UsuariosPermisos AS UsuPer";
							$qryNivel3.= " WHERE Menu.idMenu=UsuPer.idMenu AND Nivel = 3 AND Menu.Activo = 1";
							$qryNivel3.= " AND (UsuPer.idUsuario='".$_SESSION['idUsuario']."' OR UsuPer.idUsuarioTipo='".$_SESSION['idUsuarioTipo']."') AND UsuPer.Acceso='S'";
							$qryNivel3.= " AND idPadre = ".$rowNivel2['IdMenu']." ORDER BY Orden";
							$rstNivel3 = $MySQL->query($qryNivel3);
							$Nivel3 = 1;
							while ($rowNivel3 = $rstNivel3->fetch_array()) {
								if ($Nivel3==1) {
									$Nivel3 = 0;
?>
								<ul>
<?php
								}
?>
	                <li><a href="<?php echo ($rowNivel3['URL'] ? $_SESSION['Raiz'].$rowNivel3['URL'] : '#') ?>"><?php echo htmlentities($rowNivel3['Descripcion'], ENT_COMPAT, 'iso-8859-1'); ?></a></li>
<?php
							}
							if ($Nivel3==0) {
?>
								</ul>
<?php
							}
?>
            </li>
<?php
					}
?>
        </ul>

      </li>
<?php
		}
?>
    </li>
  </ul>
</div>
