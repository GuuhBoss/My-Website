<?php 

	require "bibliotecas/PHPMailer/Exception.php";
	require "bibliotecas/PHPMailer/OAuth.php";
	require "bibliotecas/PHPMailer/PHPMailer.php";
	require "bibliotecas/PHPMailer/POP3.php";
	require "bibliotecas/PHPMailer/SMTP.php";

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	class Mensagem{

		private $nome = null;
		private $email = null;
		private $assunto = null;
		private $mensagem = null;

		public function __set($atributo, $valor) {
			$this->$atributo = $valor;
		}
		public function __get($atributo) {
			return $this->$atributo;
		}

		// public function mensagemValida(){
		// 	if (empty($this->$email) or empty($this->mensagem)) {
		// 		return true;
		// 	} else {
		// 		return false;
		// 	}
		// }
	}

	$mensagem = new Mensagem();
	$mensagem->__set('nome', $_POST['nome']);
	$mensagem->__set('email', $_POST['email']);
	$mensagem->__set('assunto', $_POST['assunto']);
	$mensagem->__set('mensagem', $_POST['mensagem']);

	print_r($mensagem);

	echo '<br>';
	
	// if (!$mensagem-> mensagemValida()) {
	// 	echo "Mensagem válida <br>";
	// 	header( "Location: ../contact.html?envio=bem_sucedido");

	// } else {
	// 	echo "Mensagem inválida <br>";
	// 	header( "location: ../contact.html?envio=mal_sucedido");
	// }

	

	$mail = new PHPMailer(true);

	try {
	    //Server settings
	    $mail->SMTPDebug = false;                      // Enable verbose debug output
	    $mail->isSMTP();                                            // Send using SMTP
	    $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
	    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
	    $mail->Username   = 'email.bot97@gmail.com';                // SMTP username
	    $mail->Password   = 'bot10@email';                          // SMTP password
	    $mail->SMTPSecure = 'tls';         							// Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
	    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

	    //Recipients
	    $mail->setFrom( 'email.bot97@gmail.com', $mensagem->__get('nome'));
	    $mail->addAddress( 'gustavosjob@gmail.com' , 'Me');     // Add a recipient
	    /*$mail->addAddress('ellen@example.com');               // Name is optional
	    $mail->addReplyTo('info@example.com', 'Information');
	    $mail->addCC('cc@example.com');
	    $mail->addBCC('bcc@example.com');)

	    // Attachments
	    $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	    $mail->addAttachment('/tmp/image.jpg', 'new.jpg'); ~   // Optional name */

	    // Content
	    $mail->isHTML(true);                                  // Set email format to HTML
	    $mail->Subject = $mensagem->__get('assunto');
	    $mail->Body    = 'Meu email: '. $mensagem->__get('email') .  nl2br("\n \n \n") . $mensagem->__get('mensagem');
	    $mail->AltBody = 'Conteudo';

		print_r($mensagem->__get('nome'));

	    $mail->send();
	    echo '<h1>Mensagem foi enviada com sucesso!</h1>';
		header( "Location: ../contact.html?envio=bem_sucedido");
	} catch (Exception $e) {
	    echo "Não foi possível enviar o email. Erro do Envio: {$mail->ErrorInfo}";
		header( "location: ../contact.html?envio=mal_sucedido");
	}

	

?>