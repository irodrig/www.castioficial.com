<?php 
	require_once('../connections/kriva.php'); 

	if (isset($_POST['loginUsr'])) {
		$qry = "SELECT * FROM WE_Usuarios WHERE Email = '".$_POST['loginUsr']."' AND Password = '".$_POST['loginPwd']."'";
		$rst = $MySQL->query($qry);
		if ($row = $rst->fetch_array()) {
			$_SESSION['usrName'] = $row['Nombre'];
			$_SESSION['usrId'] = $row['idUsuario'];
			
			header("Location: " . "../index.php" );
		} else {
			header("Location: " . "../login.php?check=false");
		}
	}
	if (isset($_POST['usrName'])) {
		if ($_POST['usrPwd1'] != $_POST['usrPwd2']) {
			header("Location: " . "../register.php?pwd=0&usr=".serialize($_POST));
		}
		$qry = "SELECT * FROM WE_Usuarios WHERE Email = '".$_POST['usrEmail']."'";
		$rst = $MySQL->query($qry);
		if ($row = $rst->fetch_array()) {
			header("Location: " . "../register.php?email=0&usr=".serialize($_POST));
		}
		$qry = "INSERT INTO WE_Usuarios SET ";
		$qry.= " idUsuario = '".$_POST['usrId']."'";
		$qry.= ", Nombre = '".$_POST['usrName']."'";
		$qry.= ", Apellido = '".$_POST['usrLName']."'";
		$qry.= ", Email = '".$_POST['usrEmail']."'";
		$qry.= ", Password = '".$_POST['usrPwd1']."'";
		$qry.= ", Fecha = '".date('Y-m-d')."'";
		
		$qry = utf8_decode($qry);
		$MySQL->query($qry);
		
		$_SESSION['usrName'] = $_POST['usrName'];
		$_SESSION['usrId'] = $_POST['usrId'];


		require '../libs/PhpMailer/PHPMailerAutoload.php';
			

		$mail = new PHPMailer();
		$mail->isSendmail();
//		$mail->IsSMTP(); 
		$mail->Host = 'mail.castioficial.com';
		$mail->SMTPAuth = true;
		$mail->Username = "no_reply@castioficial.com";
		$mail->Password = "}S95mNT]2-62-_";
		$mail->setFrom("no_reply@castioficial.com", "no_reply@castioficial.com");
		$mail->addReplyTo("no_reply@castioficial.com", "no_reply@castioficial.com");
		$mail->addAddress("castioficial@castioficial.com", "castioficial@castioficial.com");
		$mail->Subject = "Registro de Usuario CASTI Oficial";
		
		$msgHTML = "<p>Se ha registrado un nuevo usuario en Casti Oficial con los siguientes datos</p>";
		$msgHTML.= "<br/>";
		$msgHTML.= "<p><strong>Nombre:</strong> ".$_POST['usrName'].'</p>';
		$msgHTML.= "<p><strong>Apellidos:</strong> ".$_POST['usrLName'].'</p>';
		$msgHTML.= "<p><strong>eMail:</strong> ".$_POST['usrEmail'].'</p>';
		$msgHTML.= "<br/>";
		$msgHTML.= "<p>Fecha: ".date('d/m/Y')."</p>";
		$msgHTML.= "<br/>";
		$msgHTML.= "<p>Este mensaje fue generado automaticamente desde la web castioficial.com</p>";
		
		$mail->msgHTML(utf8_decode($msgHTML));
		$mail->AltBody = utf8_decode($_POST['usrEmail']);

		if(!$mail->Send()) {
			$resultado['Error'] = 1;
			$resultado['ErrorDesc'] = $mail->ErrorInfo;
		//resultado = $mail->ErrorInfo;
		}
	
		header("Location: " . "../index.php");

	}

?>
