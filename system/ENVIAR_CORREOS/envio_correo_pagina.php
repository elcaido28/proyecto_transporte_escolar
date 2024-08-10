<?php
require 'PHPMailer.php';
require 'SMTP.php';
require 'Exception.php';
require 'OAuth.php';


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
$mail->setFrom('info@13deagosto.com', 'Pagina Web');
$mail->addAddress('info@13deagosto.com', 'Coop. 13Agosto De '.$nombre); // $correo_cli  .$nombre
$mail->addAddress('coop13deagosto@hotmail.com', 'Coop. 13Agosto De '.$nombre); // $correo_cli  .$nombre
$mail->Subject = 'Consulta de Cliente';
$mail->Body = "<div style='padding:5px;'> <br> Nombre de Cliente : ".$nombre."<br><br>Correo: ".$email."  <br><br>  Asunto: ".$asunto." <br> <br>   Mensaje: ".$mensaje." <br> </div>";
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
