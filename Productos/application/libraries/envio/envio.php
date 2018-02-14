<?php
date_default_timezone_set('America/Mexico_City');
if ($_POST) {

    if(isset($_POST['Nombre']) 
      && isset($_POST['Email']) 
      && isset($_POST['Telefono']) 
      && isset($_POST['Interes']) 
      && isset($_POST['Mensaje'])
      ){
              $Nombre   = $_POST['Nombre'];
              $Correo   = $_POST['Email'];
              $Telefono = $_POST['Telefono'];
              $Interes  = $_POST['Interes'];
              $TextoMensaje  = $_POST['Mensaje'];

              $mensaje = '
                  <!DOCTYPE html>
                  <html lang="en">
                  <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                    <title></title>
                  </head>
                  <body>
                  <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td>
                      <table border="0" cellspacing="0" cellpadding="0" width="600" align="center">
                        <tr>
                          <td width="17"></td>
                          <td width="569" colspan="3" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">
                            <p style ="margin:5px 0;"><strong>Nombre:</strong> '.$Nombre.'</p>
                            <p style ="margin:5px 0;"><strong>Correo:</strong> '.$Correo.'</p>
                            <p style ="margin:5px 0;"><strong>Teléfono:</strong> '.$Telefono.'</p>
                            <p style ="margin:5px 0;"><strong>Interes:</strong> '.$Interes.'</p>
                            <p style ="margin:5px 0;"><strong>Mensaje:</strong> '.$TextoMensaje.'</p>
                            </td>
                          <td width="14"></td>
                        </tr>
                    <tr style="background:#1A0E31; height:21px;">
                      <td colspan="5"></td>
                    </tr>
                  </table></td>
                    </tr>
                  </table>
                  </body>
                  </html>';


require 'phpmailer/PHPMailerAutoload.php';
$mail = new PHPMailer;
//$mail->SMTPDebug = 3;                               // Enable verbose debug output
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'in-v3.mailjet.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = '76ee47694c59244e2a9e145f1359fbe4';                 // SMTP username
$mail->Password = '8635a8949fc61b3d7ee706033e9f2e82';                           // SMTP password
$mail->SMTPSecure = 'TLS';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('contacto@turmalinaresidencial.com', 'Mailer');
$mail->addAddress('contacto@turmalinaresidencial.com', 'Contacto');     // Add a recipient
$mail->addAddress('ventas@turmalinaresidencial.com', 'Ventas');     // Add a recipient
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'CONTACTO TURMALINA RESIDENCIAL';
$mail->Body    = $mensaje;
$mail->AltBody = '';

    if(!$mail->send()) {
        echo 'Message could not be sent.<br>';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo "ok";
    }


    }else{
      echo"HAY CAMPOS VACIOS";
      print_r($_POST);
    }
}else{
      echo"NO EXISTE FORMULARIO";
}
?>