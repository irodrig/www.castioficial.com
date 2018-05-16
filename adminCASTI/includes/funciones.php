<html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
<?php
$DiaSemana = array('LUNES','MARTES','MIERC0LES','JUEVES','VIERNES','SABADO','DOMINGO');


function SQLVal($MySQL, $Valor, $Type='text') {
	$Valor = $MySQL->real_escape_string(html_entity_decode($Valor));
	return ($Valor);
}


function HTMLVal($Valor) {
	$Valor = isset($Valor) ? htmlspecialchars(utf8_encode($Valor)) : '';
	return ($Valor);
}


class Registro {
	var $row = array();
	
	function Registro($row) {
		$this->row = $row;
	}
	
	function Imprimir($field,$type='STR',$decimals=0,$zero='N') {
		$Fields = explode(',',$field);
		if (isset($this->row[$Fields[0]])) {
			switch ($type) {
				case 'STR':
					$Valor = "";
					for ($i=0 ; $i<count($Fields); $i++) {
						$Valor.= ($i>0 ? " - " : "").$this->row[trim($Fields[$i])]; 
					}
					echo htmlspecialchars(utf8_encode($Valor));
					break;
				case 'NUM':
					echo Numero($this->row[$field],$decimals,$zero);
					break;
				case 'DATE':
					echo FecEsp($this->row[$field]);
					break;
				case 'CHK':
					echo ($this->row[$field]==1 ? 'SI' : 'NO');
					break;
			}
		}
	}

	function Valor($field,$type='STR',$decimals=0,$zero='N') {
		$Valor = '';
		if (isset($this->row[$field])) {
			switch ($type) {
				case 'STR':
					$Valor = "";
					$Valor= htmlspecialchars(utf8_encode($this->row[trim($field)])); 
					break;
				case 'NUM':
					$Valor = Numero($this->row[$field],$decimals,$zero);
					break;
				case 'DATE':
					$Valor = FecEsp($this->row[$field]);
					break;
				case 'CHK':
					$Valor = $this->row[$field];
					break;
			}
		}
		return ($Valor);
	}
	
	function Activo() {
		return isset($this->row['Activo']) && $this->row['Activo']==1 ? true : false;
	}
	function Checked($field) {
		echo (isset($this->row[$field]) && $this->row[$field]==1 ? 'CHECKED' : '');
	}
	function Selected($field,$value) {
		echo (isset($this->row[$field]) && $this->row[$field]==$value ? 'SELECTED' : '');
	}
	function Existe() {
		return (count($this->row));
	}
	function claseActivo() {
		echo (isset($this->row['Activo']) && $this->row['Activo']==0 ? 'fontRed' : '');
	}
	
	function BotonActivo($tabla='---') {
		$Salida = '<div id="HeaderRecord">'.$tabla;
		$Salida.= '<button id="BotonActivo" type="button" class="'.($this->Activo() ? 'Green' : 'Red').'">'.($this->Activo() ? 'ACTIVO' : 'INACTIVO').'</button>';
		$Salida.= '<input class="DataField" style="display:none" type="checkbox" name="Activo" id="Activo" '.($this->Activo()==1 ? 'CHECKED' : '').'>';
    $Salida.= '</div>';
		echo $Salida;
	}
	function LeeCampo($type='input', $id, $class, $value='', $label='', $rows='4') {
		if ($value=='') {
			$value = isset($this->row[$id]) ? $this->row[$id] : '';
		}
		$Salida = '';
		$label = $label=='' ? $id : $label;
		switch ($type) {
			case 'input':
			case 'date':
				$Salida = '<div class="FormDataField">';
				$Salida.= '<label class="DataName">'.$label.'</label>';
				if ($type == 'date') {
					$Salida.= '<input class="DataField F14_6 Fecha '.$class.'" type="text" name="'.$id.'" id="'.$id.'" value="'.FecEsp($value).'">';
				} else {
					$Salida.= '<input class="DataField '.$class.'" type="text" name="'.$id.'" id="'.$id.'" value="'.$value.'">';
				}
				$Salida.= '</div>';

				break;
			case 'select':
				$Salida = '<div class="FormDataField">';
				$Salida.= '<label class="DataName">'.$label.'</label>';
				$Salida.= '<select class="DataField '.$class.'" name="'.$id.'" id="'.$id.'">';
				$Salida.= '<option></option>';
				for ($i=0;$i<count($rows);$i++) {
					$row = explode(':',$rows[$i]);
					$selected = $row[0] == $value ? ' SELECTED' : '';
					$Salida.= '<option value="'.$row[0].'"'.$selected.'>'.$row[1].'</option>';
				}
				$Salida.= '</select>';
				$Salida.= '</div>';

				break;
			case 'textarea':
				$Salida = '<div class="FormTextareafield">';
				$Salida.= '<label class="DataName">'.$label.'</label>';
				$Salida.= '<textarea class="TextareaField '.$class.'" rows = "'.$rows.'"name="'.$id.'" id="'.$id.'">'.$value.'</textarea>';
				$Salida.= '</div>';
				
				break;
			case 'cmb':
				$Salida = '<div class="FormDataField '.$class.'" id="'.$id.'" valor="'.$value.'"></div>';
				
				break;
			case 'checkbox':
				$Salida = '<div class="FormDataField">';
				$Salida.= '<label class="DataName">'.$label.'</label>';
				$Salida.= '<input class="DataField '.$class.'" type="checkbox" name="'.$id.'" id="'.$id.'" '.($value==1 ? 'CHECKED' : '').'>';
				$Salida.= '</div>';

				break;
		}
		
		echo $Salida;
	}

	function LeeCampoGrid($type='input', $id, $class, $value) {
		$Salida = '';
		switch ($type) {
			case 'input':
				$Salida = '<td class="SeparadorBusquedaCol">';
				$Salida.= '<input type="text" class="FieldGrid '.$class.'" name="'.$id.'" id="'.$id.'" value="'.$value.'">';
				$Salida.= '</td>';

				break;
			case 'cmb':
				$Salida = '<td class="SeparadorBusquedaCol '.$id.'" id="cmb'.$id.'" valor="'.$value.'"></td>';
				break;
			case 'checkbox':
				$Salida = '<td class="SeparadorBusquedaCol">';
				$Salida.= '<input type="checkbox" class="chkGrid '.$class.'" name="'.$id.'" id="'.$id.'" '.($value==1 ? 'CHECKED' : '').'>';
				$Salida.= '</td>';

				break;
		}
		
		echo $Salida;
	}
}





if (!function_exists("GetSQLValueString")) {
	function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
	{
		if (PHP_VERSION < 6) {
			$theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
		}
	
		$theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);
	
		switch ($theType) {
			case "text":
				$theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
				break;    
			case "long":
			case "int":
				$theValue = ($theValue != "") ? intval($theValue) : "NULL";
				break;
			case "double":
				$theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
				break;
			case "date":
				$theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
				break;
			case "defined":
				$theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
				break;
		}
		return $theValue;
	}
}

function PermitirAccesoPagina($NivelesPermitidos) {
	if (isset($_SESSION['GrupoUsuario'])) {
		return in_array($_SESSION['GrupoUsuario'],$NivelesPermitidos);
	} else {
		return 0;
	}
}

//***************************************************
//Devuelve un valor de una tabla en función de un id
function ObtenerValor($MySQL, $tabla, $indice, $campo, $id)
{
//	global $hostname, $username, $password, $database;
//	$MySQL = new mysqli($hostname, $username, $password, $_SESSION['empresa']);

	$Campos = explode(',',$campo);

	if (isset($id)) {
		$qry = sprintf("SELECT %s FROM %s WHERE %s = '%s'", $campo, $tabla, $indice, $id);
		$rst = $MySQL->query($qry);
		$row = $rst->fetch_array();

		$Valor = "";
		for ($i=0 ; $i<count($Campos); $i++) {
			$Valor.= ($i>0 ? " - " : "").$row[trim($Campos[$i])]; 
		}
		
//		return utf8_encode($row[$campo]); 
		return utf8_encode($Valor); 
		$rst->free();
	} else {
		return "";
	}
}

//***************************************************
//Devuelve un numero formateado 
function Numero($Numero, $Decimales=0, $verCero='S'){
	if ($Numero == "") {
	 	return $Numero;
	} elseif ($Numero == 0 && $verCero == "N") {
			return "";
	} else {
	return number_format($Numero, $Decimales, ',', '.');
	}
} 


//***************************************************
//Convierte fecha de mysql a normal 
function cambiaf_a_normal($fecha){ 
   	@ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha); 
   	$lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1]; 
   	return $lafecha; 
} 

//***************************************************
//Convierte fecha de normal a mysql 

function cambiaf_a_mysql($fecha){ 
   	@ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha, $mifecha); 
   	$lafecha=$mifecha[3]."-".$mifecha[2]."-".$mifecha[1]; 
   	return $lafecha; 
} 

function AddMes($mes, $ano, $i) {
	$mesAux = $mes + $i;
	if ($mesAux > 12) {
		$ano = $ano + 1;
	} elseif ($mesAux <= 0) {
		$ano = $ano - 1;
	} else {
		$mesAux = $mesAux % 12;
		if ($mesAux == 0) {
			$mesAux = 12;
		} elseif ($mesAux < 10) {
			$mesAux = '0'.$mesAux;
		}
	}
	return "".$ano."-".$mesAux."";
}

function Encriptar($strOriginal, $salto) {
	$strEncriptado = "";
	for ($i = 0; $i<strlen($strOriginal); $i++) {
		$X = $strOriginal[$i];
		$strEncriptado = $strEncriptado.chr(((ord($X) - $salto) < 0 ? (ord($X) - $salto+ 255) : ord($X) - $salto));
		$salto = ord($strEncriptado[$i]);
	}
	return ($strEncriptado);
}

function Desencriptar($strEncriptado, $salto){
	$strOriginal = "";
	If ($strEncriptado != NULL) {
		for ($i = 0; $i<strlen($strEncriptado); $i++) {
			$X = $strEncriptado[$i];
			$strOriginal = $strOriginal.chr(((ord($X) + $salto) > 255 ? (ord($X) + $salto - 255) : ord($X) + $salto));
			$salto = ord($strEncriptado[$i]);
		}
	}
	return $strOriginal;
}

function NombreMes( $NumeroMes ){
	$meses = array('','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
	return $meses[$NumeroMes];
}

function better_crypt($input, $rounds = 7)
{
	$salt = "";
	$salt_chars = array_merge(range('A','Z'), range('a','z'), range(0,9));
	for($i=0; $i < 22; $i++) {
		$salt .= $salt_chars[array_rand($salt_chars)];
	}
	return crypt($input, sprintf('$2a$%02d$', $rounds) . $salt);
}


function ValidarAcceso($MySQL, $idMenu, $idUsuario, $idTipoUsuario) 
{
//	global $hostname, $username, $password, $database;
//	$MySQL = new mysqli($hostname, $username, $password, $database);

	$qry = "SELECT * FROM GE_UsuariosPermisos WHERE idMenu = '".$idMenu."' ";
	$qry.= " AND idUsuario = '".$idUsuario."'";
	$rst = $MySQL->query($qry);
	if ($row = $rst->fetch_array()) {
		$Restricciones = ($row['Acceso'] == 'S' ? $row['Restricciones'] : '*');
	} else {
		$qry = "SELECT * FROM GE_UsuariosPermisos WHERE idMenu = '".$idMenu."' ";
		$qry.= " AND idUsuarioTipo = '".$idTipoUsuario."'";
		$rst = $MySQL->query($qry);
		if ($row = $rst->fetch_array()) {
			$Restricciones = ($row['Acceso'] == 'S' ? $row['Restricciones'] : '*');
		} else {
			$Restricciones = "*";
		}
	}
	
	$_SESSION['Restricciones'] = explode(',',$Restricciones);
}

function LimpiarVariablesInformes() {
	unset ($_SESSION['strQry']);
	unset ($_SESSION['NombreReporte']);
	unset ($_SESSION['FiltroReporte']);
	unset ($_SESSION['F1Reporte']);
	unset ($_SESSION['F2Reporte']);
	unset ($_SESSION['datMes']);
	unset ($_SESSION['datAno']);
}

function DateDiff($F1,$F2,$unidad) {

	switch ($unidad) {
		case 'D':
			$t = 3600*24;
			break;
		case 'H':
			$t = 3600;
			break;
		case 'M':
			$t = 60;
			break;
		case 'S':
			$t = 1;
			break;
	}

	$result = (strtotime($F1)-strtotime($F2))/$t;

	return abs($result);
}

?>

</html>