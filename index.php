<html>
<head>
<title>PHP Email Spoofer</title>
<link rel="stylesheet" type="text/css" href="custom.css" />
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<meta name="description" content="E mail Spoofer">
</head>
<body bgcolor="cyan" text="black" background="bg.jpg">
<div class="container">
<form action="#" method="post" enctype="multipart/form-data">
<fieldset>
<font size="5" color="Blue"><a href="https://kaan.tech/spoof" target="_blank">
<center>EMAIL SPOOFER</center>
</font></a>
<?php
if(isset($_POST['submit']))
{
$to = $_POST['to'];
$fromemail = $_POST['from'];
$fromname = $_POST['name'];
$subject = $_POST['subject'];
$replyto = $_POST['replyto'];
$msg = $_POST['msg'];
$from = "From: ";
$lt = "<";
$gt = ">";
$sp = " ";
$headers = "From: ".$fromname.$sp.$lt.$fromemail.$gt. "\r\n" ."CC:".$_POST['cc']. "\r\n" ."Content-Type: text/html; charset=iso-8859-1\n";
$headers .= "MIME-Version: $fromname\r\n";
$headers .= "Reply-To: ".$replyto. "\r\n";

$file_tmp_name = $_FILES['file']['tmp_name'];
    $file_name = $_FILES['file']['name'];
    $file_size = $_FILES['file']['size'];
    $file_type = $_FILES['file']['type'];
    $file_error = $_FILES['file']['error'];
       if($file_error > 0)
    { 
mail($to,$subject,$msg,$headers);
    }
else{
    //read from the uploaded file & base64_encode content for the mail
    $handle = fopen($file_tmp_name, "r");
    $content = fread($handle, $file_size);
    fclose($handle);
    $encoded_content = chunk_split(base64_encode($content));

        $boundary = md5("sanwebe");
        //header
        $headers = "MIME-Version: 1.0\r\n"; 
        $headers .= "From:".$from."\r\n"; 
        //$headers .= "Reply-To: ".$to."" . "\r\n";
        $headers .= "Content-Type: multipart/mixed; boundary = $boundary\r\n\r\n"; 
        
        //plain text 
        $body = "--$boundary\r\n";
        $body .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $body .= "Content-Transfer-Encoding: base64\r\n\r\n"; 
        $body .= chunk_split(base64_encode($msg)); 
        
        //attachment
        $body .= "--$boundary\r\n";
        $body .="Content-Type: $file_type; name=".$file_name."\r\n";
        $body .="Content-Disposition: attachment; filename=".$file_name."\r\n";
        $body .="Content-Transfer-Encoding: base64\r\n";
        $body .="X-Attachment-Id: ".rand(1000,99999)."\r\n\r\n"; 
        $body .= $encoded_content;
        mail($to,$subject,$body,$headers);
        echo "<script type='text/javascript'>alert('Your message is successfully sent');</script>";
}
}
?>
<br>
<label for="fromName"><b><font color="red"><sup></sup></font>Name:</b></label>
<input type="text" placeholder="From Name" name="name" id="name"><br>
<label for="fromemailAddress"><b><font color="red"><sup>*</sup></font>From:</b></label>
<input type="email" placeholder="Enter a E-mail Address from which you want to send the email" name="from" id="fromemailAddress" required><br>

<label for="cc"><b>CC:</b></label>
<input type="text" placeholder="Enter CC" name="cc" id="cc">
<label for="replyto"><b>Reply-To Email:</b></label>
<input type="text" placeholder="When the person you prank presses reply it will have them reply to this email" name="replyto" id="replyto">
<label for="toemailAddress"><b><font color="red"><sup>*</sup></font>To:</b></label>
<input type="email" placeholder="Enter a E-mail Address you want to send mail" name="to" id="toemailAddress" required><br>
<label for="subject"><b>Subject</b></label>
<input type="text" placeholder="Enter the subject" name="subject" id="subject">
<label for="message"><b><font color="red"><sup>*</sup></font>Message:</b></label>
<textarea placeholder="Enter your message" name="msg" id="Message" required></textarea><br>
<label for="file"><b>Attachment:</b></label>
<input type="file" name="file" id="file"><br>
<p align="center">
<input id="button" type="submit" name="submit" value="Send" class="pulse-button">
</fieldset>
</form>
  <div id="foot"><center>Â© Copyright 2018 |All rights reserved.</center></div>
</div>
</body>
</html>
