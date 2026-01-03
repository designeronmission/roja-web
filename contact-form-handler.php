<?php
// contact-form-handler.php
header('Content-Type: application/json');

// Allow CORS if needed
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Set a higher timeout for reCAPTCHA verification
ini_set('default_socket_timeout', 30);

// Check if request is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

// Your reCAPTCHA secret key
$recaptcha_secret = '6Ldj4T4sAAAAABT6xOhY6pNuXU9kFQbf9GZjtZB4';

// Get POST data
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$subject = isset($_POST['subject']) ? trim($_POST['subject']) : '';
$message = isset($_POST['message']) ? trim($_POST['message']) : '';
$recaptcha_response = isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : '';

// Debug: Log received data
error_log("Received form data: name=$name, email=$email, subject=$subject");

// Basic validation
if (empty($name) || empty($email) || empty($phone) || empty($subject) || empty($message)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Invalid email address']);
    exit;
}

// Validate reCAPTCHA
if (empty($recaptcha_response)) {
    echo json_encode(['success' => false, 'message' => 'reCAPTCHA verification failed']);
    exit;
}

// Verify reCAPTCHA with Google
$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
$recaptcha_data = [
    'secret' => $recaptcha_secret,
    'response' => $recaptcha_response,
    'remoteip' => $_SERVER['REMOTE_ADDR']
];

// Use cURL (more reliable)
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $recaptcha_url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($recaptcha_data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);

$recaptcha_result = curl_exec($ch);
$curl_error = curl_error($ch);
curl_close($ch);

if ($curl_error) {
    error_log("cURL Error: " . $curl_error);
    echo json_encode(['success' => false, 'message' => 'Network error during verification']);
    exit;
}

$recaptcha_json = json_decode($recaptcha_result);

// Debug: Log reCAPTCHA response
error_log("reCAPTCHA Response: " . print_r($recaptcha_json, true));

if (!$recaptcha_json || !isset($recaptcha_json->success)) {
    echo json_encode(['success' => false, 'message' => 'Invalid reCAPTCHA response']);
    exit;
}

if (!$recaptcha_json->success) {
    $error_codes = isset($recaptcha_json->{'error-codes'}) ? implode(', ', $recaptcha_json->{'error-codes'}) : 'Unknown error';
    echo json_encode(['success' => false, 'message' => 'reCAPTCHA verification failed: ' . $error_codes]);
    exit;
}

// Check score threshold (0.5 is recommended)
$score_threshold = 0.5;
if (isset($recaptcha_json->score) && $recaptcha_json->score < $score_threshold) {
    echo json_encode([
        'success' => false, 
        'message' => 'Security check failed. Please try again.',
        'score' => $recaptcha_json->score
    ]);
    exit;
}

// If we get here, form is valid and reCAPTCHA passed
// Process the form data (save to database, send email, etc.)

// Example: Send email notification
$to = 'your-email@example.com'; // Replace with your email
$email_subject = "New Contact Form Submission: " . htmlspecialchars($subject);
$email_body = "You have received a new message from your website contact form.\n\n";
$email_body .= "Name: " . htmlspecialchars($name) . "\n";
$email_body .= "Email: " . htmlspecialchars($email) . "\n";
$email_body .= "Phone: " . htmlspecialchars($phone) . "\n";
$email_body .= "Subject: " . htmlspecialchars($subject) . "\n\n";
$email_body .= "Message:\n" . htmlspecialchars($message) . "\n\n";
$email_body .= "reCAPTCHA Score: " . (isset($recaptcha_json->score) ? $recaptcha_json->score : 'N/A') . "\n";
$email_body .= "IP Address: " . $_SERVER['REMOTE_ADDR'] . "\n";
$email_body .= "Timestamp: " . date('Y-m-d H:i:s') . "\n";

$headers = "From: " . htmlspecialchars($email) . "\r\n";
$headers .= "Reply-To: " . htmlspecialchars($email) . "\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

// Try to send email
$mail_sent = mail($to, $email_subject, $email_body, $headers);

if ($mail_sent) {
    // Also save to database or log file if needed
    $log_entry = date('Y-m-d H:i:s') . " - Form submitted by: $email ($name)\n";
    file_put_contents('contact_log.txt', $log_entry, FILE_APPEND);
    
    echo json_encode([
        'success' => true,
        'message' => 'Thank you! Your message has been sent successfully.',
        'score' => isset($recaptcha_json->score) ? $recaptcha_json->score : null
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Message saved but email could not be sent. We will contact you soon.',
        'score' => isset($recaptcha_json->score) ? $recaptcha_json->score : null
    ]);
}

exit;
?>