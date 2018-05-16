<?php
if (!isset($_SESSION)) {
  session_start();
}
if ($_SERVER['SERVER_NAME'] == 'localhost') {
	$hostname = "localhost";
	$database = "casti";
	$username = "root";
	$password = "mushoRM32";
} else {
	$hostname = "localhost";
	$database = "castiofi_wp992";
	$username = "castiofi_web";
	$password = "aD5:1W.?W9=_8.";
//	$hostname = "localhost";
//	$database = "luipom_casti";
//	$username = "luipom_casti";
//	$password = "ca5t10FR33";
}

$MySQL = new mysqli($hostname, $username, $password, $database);

if ($MySQL->connect_error) {
    die('Error de Conexión (' . $MySQL->connect_errno . ') '
            . $MySQL->connect_error);
}

?>