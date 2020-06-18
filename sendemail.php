<?php
/**
 * @version 1.0
 */

require("class.phpmailer.php");
require("class.smtp.php");

header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");

$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// Aquí se deberían validar los datos ingresados por el usuario
if(!isset($name) || !isset($email) ||!isset($message) ||!isset($subject) ){
	echo 'El formulario tiene un error, por favor corrijalo y vuelva a enviarlo';
	die();
}

// Datos de la cuenta de correo utilizada para enviar vía SMTP
$smtpHost = "mail.menchacafelt.com"; // Dominio alternativo brindado en el email de alta
$smtpUsuario = "info@menchacafelt.com"; // Mi cuenta de correo
$smtpClave = "menchaca2018!!"; // Mi contraseña

// Email donde se enviaran los datos cargados en el formulario de contacto
$emailDestino = "info@menchacafelt.com";

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Port = 465;
$mail->SMTPSecure = 'ssl';
$mail->IsHTML(true);
$mail->CharSet = "utf-8";

// VALORES A MODIFICAR //
$mail->Host = $smtpHost;
$mail->Username = $smtpUsuario;
$mail->Password = $smtpClave;

$mail->From = $email; // Email desde donde envío el correo.
$mail->FromName = $name;
$mail->AddAddress($emailDestino); // Esta es la dirección a donde enviamos los datos del formulario

$mail->Subject = "Contacto desde el sitio web - " . $subject;
$mail->Body = nl2br($message);
$mail->AltBody = $message;
// FIN - VALORES A MODIFICAR //

$estadoEnvio = $mail->Send();
if($estadoEnvio){
    echo "El mensaje de contacto se envio con exito!";
} else {
		echo "Ocurrió un error inesperado.";
		die();
}

?>
