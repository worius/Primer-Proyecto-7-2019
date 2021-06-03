<?php
require("class.phpmailer.php");
require("class.smtp.php");
$request_body = file_get_contents('php://input');
$datos = json_decode($request_body, true);

$destinatario = "burguercity@gmail.com";
// Datos de la cuenta de correo utilizada para enviar v�a SMTP
$smtpHost = "mail.tudominio.com";  // Dominio alternativo brindado en el email de alta 
$smtpUsuario = "correo@tudominio.com";  // Mi cuenta de correo
$smtpClave = "123456789";  // Mi contraseña


var_dump($datos);

$nombre = $datos["nombre"];
$email = $datos["email"];
$telefono = $datos["telefono"];
$mensaje = $datos["mensaje"];


// Datos de la cuenta de correo utilizada para enviar vìa SMTP
$smtpHost = "mail.hnader.com.ar";  // Dominio alternativo brindado en el email de alta 
$smtpUsuario = "desarrollo@hnader.com.ar";  // Mi cuenta de correo
$smtpClave = "AyaDes2284";  // Mi contraseña




$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Port = 587; 
$mail->IsHTML(true); 
$mail->CharSet = "utf-8";

// VALORES A MODIFICAR //
$mail->Host = $smtpHost; 
$mail->Username = $smtpUsuario; 
$mail->Password = $smtpClave;


$mail->From = $email; // Email desde donde envìo el correo.
$mail->FromName = $nombre;
$mail->AddAddress($destinatario); // Esta es la direcciòn a donde enviamos los datos del formulario

$mail->Subject = "Formulario desde el Sitio Web"; // Este es el titulo del email.
$mensajeHtml = nl2br($mensaje);
$mail->Body = "
<html> 

<body> 

<h1>Recibiste un nuevo mensaje desde el formulario de contacto</h1>

<p>Informacion enviada por el usuario de la web:</p>

<p>nombre: {$nombre}</p>

<p>email: {$email}</p>

<p>telefono: {$telefono}</p>

<p>mensaje: {$mensaje}</p>

</body> 

</html>

<br />"; // Texto del email en formato HTML
$mail->AltBody = "{$mensaje} \n\n "; // Texto sin formato HTML
// FIN - VALORES A MODIFICAR //

$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

$estadoEnvio = $mail->Send(); 
if($estadoEnvio){
    echo "El correo fue enviado correctamente.";
} else {
    echo "Ocurrió un error inesperado.";
}


?>