<?php
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
        
        // Process the form data (example: send email)
        $to = "your-email@example.com"; // Replace with your email
        $email_subject = "New Contact Form Submission: " . $subject;
        $email_body = "You have received a new message from your website contact form.\n\n";
        $email_body .= "Name: " . $name . "\n";
        $email_body .= "Email: " . $email . "\n";
        $email_body .= "Phone: " . $phone . "\n";
        $email_body .= "Subject: " . $subject . "\n\n";
        $email_body .= "Message:\n" . $message . "\n\n";
        $email_body .= "reCAPTCHA Score: " . $recaptcha_json->score . "\n";
        $email_body .= "IP Address: " . $_SERVER['REMOTE_ADDR'] . "\n";
        
        $headers = "From: " . $email . "\r\n";
        $headers .= "Reply-To: " . $email . "\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();
        
        // Send email
        if (mail($to, $email_subject, $email_body, $headers)) {
            // Success response
            echo json_encode([
                'success' => true,
                'message' => 'Thank you! Your message has been sent successfully.'
            ]);
        } else {
            // Email failed
            echo json_encode([
                'success' => false,
                'message' => 'Failed to send email. Please try again.'
            ]);
        }
        
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
}
?>