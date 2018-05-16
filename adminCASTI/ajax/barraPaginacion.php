<div class="Paginacion">
  <div class="BarraPaginacion">
    <a href="?<?php echo $_GET['QryStr']; ?>&Pagina=1"><img src="../images/Pag_first.png"/></a>
    <a href="?<?php echo $_GET['QryStr']; ?>&Pagina=<?php echo ($_GET['Pagina']==1 ? 1 : $_GET['Pagina']-1) ?>"><img src="../images/Pag_previous.png"/></a> 
    Página <?php echo $_GET['Pagina'];?> de <?php echo $_GET['UltPag']; ?> 
    <a href="?<?php echo $_GET['QryStr']; ?>&Pagina=<?php echo ($_GET['Pagina']==$_GET['UltPag'] ? $_GET['UltPag'] : $_GET['Pagina'] +1) ?>"><img src="../images/Pag_next.png"/></a> 
    <a href="?<?php echo $_GET['QryStr']; ?>&Pagina=<?php echo $_GET['UltPag'] ?>"><img src="../images/Pag_last.png"/></a> 
  </div>
</div>
