<?php
include 'config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendMail($email, $name, $subject, $body)
{
  global $sitemail, $sitename, $siteurl;
  require_once "../PHPMailer/PHPMailer.php";
  require_once '../PHPMailer/Exception.php';

  $mail = new PHPMailer;
  $mail->setFrom($sitemail);
  $mail->FromName = $sitename;
  $mail->addAddress("$email", "$name");
  $mail->isHTML(true);
  $mail->Subject = $subject;
  $mail->Body = '<!doctype html>
  <html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="mail.css">
  </head>
  <body style="background-color: #f6f6f6; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
    <span class="preheader" style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;"></span>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6f6f6; width: 100%;" width="100%" bgcolor="#f6f6f6">
      <tr>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;" valign="top">&nbsp;</td>
        <td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto;" width="580" valign="top">
          <div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;">
            <table role="presentation" class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #ffffff; border-radius: 3px; width: 100%;" width="100%">
              <tr>
                <td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;" valign="top">
                <h1 style=" color:#00A6DB;"> ' . $sitename . ' </h1>
                <hr>
                  ' . $body . '  
                </td>
              </tr>
            </table>
          </div>
        </td>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;" valign="top">&nbsp;</td>
      </tr>
    </table>
  </body>
</html>
  ';
  $send = $mail->send();
  return $send;
}

function customAlert($case, $content)
{
  switch ($case) {
    case 'success':
      $mesg =  '<script type="text/javascript">
          $(document).ready(function() {
              swal("Success", "' . $content . '", "success")    
          });
        </script>';
      break;

    case 'error':
      $mesg = '<script type="text/javascript">
              $(document).ready(function() {
                  sweetAlert("Error", "' . $content . '", "error")    
              });
          </script>';
      break;
    default:
      break;
  }
  return $mesg;
}


function userAlert($case, $content)
{
  switch ($case) {
    case 'success':
      $mesg =  "<script type='text/javascript'>
          Notiflix.Notify.success('" . $content . "');
        </script>";
      break;
    case 'error':
      $mesg =  "<script type='text/javascript'>
            Notiflix.Notify.failure('" . $content . "');
          </script>";
      break;

    default:
      break;
  }
  return $mesg;
}

function text_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function pageRedirect($sec, $route)
{
  $c = "<meta http-equiv='refresh' Content='" . $sec . "; url=" . $route . " ' />";
  return $c;
}
