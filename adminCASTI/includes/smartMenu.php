<!-- SmartMenus core CSS (required) -->
<link href="<?php echo $_SESSION['Raiz'] ?>/styles/sm-core-css.css" rel="stylesheet" type="text/css" />
<!-- "sm-blue" menu theme (optional, you can use your own CSS, too) -->
<link href="<?php echo $_SESSION['Raiz'] ?>/styles/css-sm-blue.php" rel="stylesheet" type="text/css" />
<!-- SmartMenus jQuery plugin -->
<script type="text/javascript" src="<?php echo $_SESSION['Raiz'] ?>/libs/jquery.smartmenus.min.js"></script>
<!-- SmartMenus jQuery init -->
<script type="text/javascript">
	$(function() {
		$('#main-menu').smartmenus({
			showOnClick: true,
			hideOnClick: false,			
			subMenusSubOffsetX: 1,
			subMenusSubOffsetY: -8
		});
	});
	
	$(document).ready(function(e) {
		$('#main-menu').bind('select.smapi', function(e, menu) {
			url = menu.toString();
			if (url.substr(-1,1) != "#" && Editando) {
				if (!confirm("Se está editando un registro actualmente\nSe perderán los cambios\n\nCONTINUAR")) {
					return false;
				}
			}
		});
	});	
	
</script>

