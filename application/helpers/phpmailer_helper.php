<?php
/**
 * Created by PhpStorm.
 * User: teenq
 * Date: 11/03/2017
 * Time: 9:19 CH
 */
function phpmailer($title, $content, $nTo, $mTo,$diachicc='')
{
    include('phpmailer/class.smtp.php');
    include "phpmailer/class.phpmailer.php";
    $nFrom = 'F4Sport Online Shop';
    $mFrom = 'chungta.bb@gmail.com';  //dia chi email cua ban
    $mPass = 'acc06c17s13c35ok';       //mat khau email cua ban
    $mail = new PHPMailer();
    $body = $content;
    $mail->IsSMTP();
    $mail->CharSet = "utf-8";
    $mail->SMTPDebug = 0;                     // enables SMTP debug information (for testing)
    $mail->SMTPAuth = true;                    // enable SMTP authentication
    $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465;
    $mail->Username = $mFrom;  // GMAIL username
    $mail->Password = $mPass;               // GMAIL password
    $mail->SetFrom($mFrom, $nFrom);
    //chuyen chuoi thanh mang
    $ccmail = explode(',', $diachicc);
    $ccmail = array_filter($ccmail);
    if (!empty($ccmail)) {
        foreach ($ccmail as $k => $v) {
            $mail->AddCC($v);
        }
    }
    $mail->Subject = $title;
    $mail->MsgHTML($body);
    $address = $mTo;
    $mail->AddAddress($address, $nTo);
    $mail->AddReplyTo('chungta.bb@gmail.com', 'F4Sport Online Shop');
    if (!$mail->Send()) {
        return false;
    } else {
        return true;
    }
}