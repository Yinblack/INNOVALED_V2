<?php
date_default_timezone_set('America/Mexico_City');
if ($_POST) {
    if(isset($_POST['nombre'])
    && isset($_POST['correo'])
    && isset($_POST['telefono'])
    && isset($_POST['mensaje'])
    ){
              $Nombre  = $_POST['nombre'];
              $Email   = $_POST['correo'];
              $Telefono = $_POST['telefono'];
              $Mensaje = $_POST['mensaje'];
              $html = '
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
                    <tr style="background:#FBC816; height:21px;">
                      <td colspan="5" style="font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight: 500; color: #FBC816;"></td>
                    </tr>
                        <tr>
                          <td width="17"></td>
                          <td width="569" colspan="3" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">
                          Contacto Rhinoactive
                            <p style ="margin:5px 0;"><strong>Nombre:</strong> '.$Nombre.'</p>
                            <p style ="margin:5px 0;"><strong>Email:</strong> '.$Email.'</p>
                            <p style ="margin:5px 0;"><strong>Telefono:</strong> '.$Telefono.'</p>
                            <p style ="margin:5px 0;"><strong>Mensaje:</strong> '.$Mensaje.'</p>
                            </td>
                          <td width="14"></td>
                        </tr>
                    <tr style="background:#FBC816; height:21px;">
                      <td colspan="5"></td>
                    </tr>
                  </table></td>
                    </tr>
                  </table>
                  </body>
                  </html>';


require 'phpmailer/PHPMailerAutoload.php';
$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host = 'in-v3.mailjet.com';
$mail->SMTPAuth = true;
$mail->Username = '76ee47694c59244e2a9e145f1359fbe4';
$mail->Password = '8635a8949fc61b3d7ee706033e9f2e82';
$mail->SMTPSecure = 'TLS';
$mail->Port = 587;
$mail->setFrom('contacto@rhinoactive.mx','Mailer');
$mail->addAddress('daniel.m.arvizu@gmail.com', 'Daniel');
$mail->isHTML(true);
$mail->Subject = 'Contacto INNOVALED WEB';
$mail->Body=$html;
$mail->AltBody = '';
if(!$mail->send()) {
  echo 'Message could not be sent.<br>'; echo 'Mailer Error: ' . $mail->ErrorInfo;
}else{
  echo "success";
}
}else{
  echo"Spam attempt, I'm sorry, you can´t do this";
  print_r($_POST); }
}else{
  echo"There is no form";
}
?>
