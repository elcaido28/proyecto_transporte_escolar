<?php
require 'ENVIAR_CORREOS/PHPMailer.php';
require 'ENVIAR_CORREOS/SMTP.php';
require 'ENVIAR_CORREOS/Exception.php';
require 'ENVIAR_CORREOS/OAuth.php';


$mail = new PHPMailer\PHPMailer\PHPMailer();

$mail->isSMTP();
/*
Enable SMTP debugging
0 = off (for production use)
1 = client messages
2 = client and server messages
*/
$mail->SMTPDebug = 0;
$mail->Host = 'mail.13deagosto.com ';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = "info@13deagosto.com";
$mail->Password = "13deagostoInfo";
$mail->setFrom('info@13deagosto.com', 'Coop. 13Agosto');
$mail->addAddress($correo, ''); // $correo_cli  .$nombre
$mail->Subject = 'Asignar Clave';
$mail->Body = "<div style='padding:5px;'> <br> usuario : ".$cedula."<br><br>Contraseña: ".$clave."  <br> <br>   INGRESAR: <a href='https://13deagosto.com/system/login_cliente.php'>Inicio Sesión - Coop. 13 de Agosto</a> <br> </div>";
//$mail->addAttachment('/levox2.png', 'My uploaded file'); <img src='/levox2.png' width='150' height='110'>
$mail->CharSet = 'UTF-8'; // Con esto ya funcionan los acentos
$mail->IsHTML(true);

if (!$mail->send())
{
	// echo "Error al enviar el E-Mail: ".$mail->ErrorInfo;
}
else
{
	// header("Location:../contact.php");

}
?>
