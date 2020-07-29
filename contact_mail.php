<?php 
if(isset($_REQUEST['contactVal']) && $_REQUEST['contactVal']=='1'){
    
    $contact_name = $_REQUEST['contact_name'];
    $contact_email = $_REQUEST['contact_email'];
    $contact_message = $_REQUEST['contact_message'];

    $err = false;
    $sent= false;
    $msg = '';
    if(trim($contact_name)=="" || trim($contact_email)=="" || trim($contact_message)==""){
        $err = true;
        $errmsg = "Please enter all the required fields."; 
    }

    if (!$err) {

        include("class.phpmailer.php");
        $mail = new PHPMailer();
        $mail->IsHTML(true); /* set email format to HTML */

        $mail->From = $contact_email ;
        $mail->FromName = $contact_name;

        $msg .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html>
        <head>
        <style type="text/css">
            h1 {
                font-size: 14px;
                font-weight: bold;
            }
            p {
                margin: 0 0 16px;
            }
        </style>
        </head>
        <body>
        <p>Hi,<p>
        <p>You have received a new message.</p>
        <p><span style="width: 80px; float:left;">Name       </span>: ' . nl2br(stripslashes($contact_name)) . '</p>
        <p><span style="width: 80px; float:left;">Email      </span>: <a href="mailto:' . $contact_email. '">' .nl2br(htmlspecialchars($contact_email)). '</a></p>
        <p><span style="width: 80px; float:left;">Message   </span>: ' . nl2br(stripslashes($contact_message)). '</p>
        <p><span style="width: 100%; float:left;">&nbsp;   </span></p>
        <p><span style="width: 200px; float:left;">Thanks,<br />1000 Pitches</span></p>
        </body></html>';

        $mail->Subject = "1000 Pitches - You have a new message";

        $mail->Body = $msg;
        $mail->AddAddress('ishakamath@ucla.edu');
        
        //$mail->Send();
        if($mail->send()){
            $sendMail = 'Message has been sent';
            $sendMailErr = '';
            $sendMailFlag = 1;
        }else{
            $sendMail = 'Message could not be sent.';
            $sendMailErr = 'Mailer Error: ' . $mail->ErrorInfo;
            $sendMailFlag = 0;
        }
        echo $sendMailFlag;

    }else{
        echo $errmsg;
    }
}
?>