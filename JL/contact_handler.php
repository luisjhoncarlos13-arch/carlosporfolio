<?php
/**
 * Contact Form Submission Handler (contact_handler.php)
 * Receives POST data from index.php contact form and calls portfolio_data.php
 * 
 * Returns JSON response for modern asynchronous feedback or redirects gracefully.
 */

header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/portfolio_data.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed.']);
    exit;
}

$name    = $_POST['name'] ?? '';
$email   = $_POST['email'] ?? '';
$subject = $_POST['subject'] ?? '';
$message = $_POST['message'] ?? '';

// Call data layer function (which handles the SQL prepared statement)
$result = saveContactMessage($name, $email, $subject, $message);

echo json_encode($result);
exit;
