<?php /* include("API_Request.php");
// File: contact-form-handler.php

// Enable error reporting for debugging (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Your reCAPTCHA secret key
    $recaptcha_secret = "6Ldj4T4sAAAAABT6xOhY6pNuXU9kFQbf9GZjtZB4";
    
    // Get the reCAPTCHA response token from the form
    if (isset($_POST['g-recaptcha-response'])) {
        $recaptcha_response = $_POST['g-recaptcha-response'];
    } else {
        die("reCAPTCHA token is missing.");
    }
    
    // Google reCAPTCHA verification URL
    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    
    // Prepare data for POST request
    $recaptcha_data = [
        'secret' => $recaptcha_secret,
        'response' => $recaptcha_response,
        'remoteip' => $_SERVER['REMOTE_ADDR'] // Optional: Include user's IP
    ];
    
    // Create context for POST request
    $recaptcha_options = [
        'http' => [
            'method' => 'POST',
            'header' => 'Content-type: application/x-www-form-urlencoded',
            'content' => http_build_query($recaptcha_data)
        ]
    ];
    
    // Create stream context
    $recaptcha_context = stream_context_create($recaptcha_options);
    
    // Send request to Google reCAPTCHA API
    $recaptcha_result = file_get_contents($recaptcha_url, false, $recaptcha_context);
    
    // Check if request was successful
    if ($recaptcha_result === FALSE) {
        die("Error verifying reCAPTCHA. Please try again.");
    }
    
    // Decode the JSON response
    $recaptcha_json = json_decode($recaptcha_result);
    
    // Verify the response
    if ($recaptcha_json->success && $recaptcha_json->score >= 0.5) {
        // reCAPTCHA verification passed
        // You can adjust the score threshold (0.5 is recommended)
        
        // Get form data
        $name = htmlspecialchars(trim($_POST['name']));
        $email = htmlspecialchars(trim($_POST['email']));
        $phone = htmlspecialchars(trim($_POST['phone']));
        $subject = htmlspecialchars(trim($_POST['subject']));
        $message = htmlspecialchars(trim($_POST['message']));
        
        // Validate form data (add your own validation)
        if (empty($name) || empty($email) || empty($phone) || empty($subject) || empty($message)) {
            die("All fields are required.");
        }
        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die("Invalid email format.");
        }
        $record['name'] = $name;
        $record['email'] = $email;
        $record['phone'] = $phone;
        $record['subject'] = $subject;
        $record['description'] = $message;
        
        $result = contactRequest($record);
		$msg = '';
		if($result)
			$msg = $result['message'];
		echo $msg;
        
    } else {
        // reCAPTCHA verification failed
        $error_message = "reCAPTCHA verification failed. ";
        
        if (isset($recaptcha_json->{'error-codes'})) {
            $error_message .= "Error codes: " . implode(", ", $recaptcha_json->{'error-codes'});
        } else if (isset($recaptcha_json->score)) {
            $error_message .= "Score too low: " . $recaptcha_json->score . " (minimum required: 0.5)";
        }
        
        echo json_encode([
            'success' => false,
            'message' => $error_message,
            'score' => $recaptcha_json->score ?? 'N/A'
        ]);
    }
    
} else {
    // Not a POST request
    die("Invalid request method.");
}*/

use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 
header('Content-Type: application/json; charset=utf-8');
error_reporting(0); // :fire: prevent PHP warnings breaking JSON
  
require 'vendor/autoload.php';
$https = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://";
$baseurl = $https."www.roja.one/website/";
$mail = new PHPMailer;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
// getting post values
$name = $_REQUEST["name"];
$email = $_REQUEST["email"];
$phone = $_REQUEST["phone"];
$subject = $_REQUEST["subject"];
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
			<p>You have received a new contact enquiry through roja.one. Please find the details below:</p>

			<p><b>Name:</b> '.$name.'</p>
			<p><b>E-Mail:</b> '.$email.'</p>
			<p><b>Cell Phone Number:</b> '.$phone.'</p>
			<p><b>Enquiry Category :</b> '.$subject.'</p>
			<p><b>Message:</b> '.$message.'</p>
			<p>&nbsp;</p>
			<p>Please review the enquiry and follow up with the user at the earliest.</p>
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

$mail->Subject ='New Contact Enquiry Received - Roja.one';
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
			<p>Thank you for contacting Roja.one.</p>
			<p>We have successfully received your enquiry, and our team will review it shortly. One of our representatives will get back to you as soon as possible.</p>
			<p><b>Your Message:</b> '.$message.'</p>
			<p>If you have any additional details to share, feel free to reply to this email or contact us at support@roja.one.</p>
			<p>Thank you for reaching out to us.</p>
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

$mail->Subject ="Thank You for Contacting Roja.one";
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