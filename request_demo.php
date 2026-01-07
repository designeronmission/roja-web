<?php

use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 
  
require 'vendor/autoload.php';
$https = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://";
$baseurl = $https."www.roja.one/website/";
$mail = new PHPMailer;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
// getting post values
$name = $_REQUEST["name"];
$email = $_REQUEST["email"];
$company = $_REQUEST["company"];
$phone = $_REQUEST["phone"];
$message = $_REQUEST["message"];
$mail->isSMTP();                            // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                     // Enable SMTP authentication
$mail->Username = 'support@roja.one';          // SMTP username
$mail->Password = 'phfqtphcfyzaebey'; // SMTP password
$mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                          // TCP port to connect to
$mail->setFrom('support@roja.one', 'Roja');
$mail->addReplyTo('support@roja.one', 'Roja');
//$mail->addAddress('jason@gotur6tech.com');   // Add a recipient
$mail->addAddress('support@roja.one');   // Add a recipient
//$mail->addAddress('nskarthi@aparajayah.com');   // Add a recipient
//$mail->addAddress('sheikdawood@aparajayah.com');   // Add a recipient
// $mail->addCC('cc@example.com');
// $mail->addBCC('bcc@example.com');

$mail->isHTML(true);  // Set email format to HTML
$admin_Template = '<table border="0" cellpadding="10" cellspacing="0" style="width: 700px; border: 1px solid #3c388f; margin: 0 auto;">
		<tr>
			<td style="border-bottom: 2px solid #3c388f;" align="center"><img src="'.$baseurl.'images/roja.png" alt="" width="150" /></td>
		</tr>
		<tr style="background-color: #fcfcfc;">
			<td>
			<div>Hello Team,
			<p>You have received a new Request a Quote submission through roja.one. Please find the details below:</p>

			<p><b>Name:</b> '.$name.'</p>
			<p><b>E-Mail:</b> '.$email.'</p>
			<p><b>Cell Phone Number:</b> '.$phone.'</p>
			<p><b>Company Name :</b> '.$company.'</p>
			<p><b>Message:</b> '.$message.'</p>
			<p>&nbsp;</p>
			<p>Please review the request and follow up with the user at the earliest.</p>
			<p>Regards,<br>
Roja.one<br>
Website Notification System</p>
</div>
			</td>
		</tr>
		<tr>
			<td align="center" style="background-color: #363636;">
				<table border="0" cellpadding="3" cellspacing="0" style="color: #fcfcfc;">
					<tr>
						<td colspan="5" >Copyright &copy; 2026. <b>Roja</b>. All Rights Reserved</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>';
$bodyContent=$admin_Template;

$mail->Subject ='New Quote Request Received - Roja.one';
$mail->Body = $bodyContent;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} 
$mail->ClearAllRecipients();
$mail->addAddress($email);   // Add a recipient
$user_Template = '<table border="0" cellpadding="10" cellspacing="0" style="width: 700px; border: 1px solid #3c388f; margin: 0 auto;">
		<tr>
			<td style="border-bottom: 2px solid #3c388f;" align="center"><img src="'.$baseurl.'images/roja.png" alt="" width="150" /></td>
		</tr>
		<tr style="background-color: #fcfcfc;">
			<td>
			<div>Hello '.$name.',
			<p>Thank you for requesting a quote from Roja.one.</p>
			<p>We have successfully received your request and our team is reviewing the details you shared. One of our representatives will get back to you shortly with further information or a customized quote.</p>
			<p><b>Your Request Summary:</b> '.$message.'</p>
			<p>If you need to add more details or have questions in the meantime, feel free to reply to this email or contact us at support@roja.one.</p>
			<p>We appreciate your interest in working with us and look forward to connecting with you.</p>
			<p>Warm regards,<br>
			Team Roja</p></div>
			</td>
		</tr>
		<tr>
			<td align="center" style="background-color: #363636;">
				<table border="0" cellpadding="3" cellspacing="0" style="color: #fcfcfc;">
					<tr>
						<td colspan="5">Copyright &copy; 2026. <b>Roja</b>. All Rights Reserved</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>';
$bodyContent=$user_Template;

$mail->Subject ="We've Received Your Quote Request - Roja.one";
$mail->Body = $bodyContent;
if(!$mail->send()) {
	echo json_encode([
		'success' => false,
		'message' => 'Message could not be sent.'
	]);
	exit;
} else {
	echo json_encode([
		'success' => true,
		'message' => 'Message has been sent.'
	]);
	exit;
}
}