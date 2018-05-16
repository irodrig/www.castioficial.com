<script type="text/javascript" src="libs/jquery.js"></script>
<script>
$(document).ready(function(e) {
	$("#imgMenu").click(function(e) {
    $("#Menu").toggle();
  }); 
});
</script>

  <div class="Seccion" id="SeccionMenu" >
  	<div class="ContenidoSeccion" id="headerMenu">
    	<div class="Seccion25 FLeft">
	    	<a href="index.php"><img id="Logo" src="images/LogoCASTI.png" alt="CASTI Oficial"></a>
      </div>
    	<div class="Seccion50 FLeft ACenter">
      	<img id="imgMenu" src="images/menu.png">
        <ul id="Menu">
          <li><a href="Trajes.php">TRAJES</a></li>
          <li><a href="Colaboraciones.php">COLABORACIONES</a></li>
          <li><a href="somosCasti.php?idSeccion=SOMOSCASTI">SOMOS CASTI</a></li>
        </ul>
      </div>
    	<div class="Seccion25 FLeft">
        <div id="btnLogin">
        <?php if (isset($_SESSION['usrName'])) { ?>
          <?php echo ucwords(strtolower($_SESSION['usrName'])); ?>
        <?php } else { ?>
          <a href="login.php">Login</a><span id="separadorLogin"> | </span><a href="register.php">Registrarse</a>
        <?php } ?>
        </div>
        <div id="boxRRSS">
          <a href="<?php echo $rowEmpresa['Twitter'] ?>"><img class="btnRRSS" src="images/rrss/Twitter.png"></a>
          <a href="<?php echo $rowEmpresa['Facebook'] ?>"><img class="btnRRSS" src="images/rrss/Facebook.png"></a>
          <a href="<?php echo $rowEmpresa['Instagram'] ?>"><img class="btnRRSS" src="images/rrss/Instagram.png"></a>
        </div>
      </div>
    </div>
  </div>
  