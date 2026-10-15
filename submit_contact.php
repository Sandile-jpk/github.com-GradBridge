<?php
declare(strict_types=1);
session_start();
header('Content-Type: application/json; charset=utf-8');

function respond(int $status, array $payload): never {
    http_response_code($status);
    echo json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond(405, ['success' => false, 'message' => 'Please submit the contact form using the website.']);
}
$name = trim((string)($_POST['name'] ?? ''));
$email = trim((string)($_POST['email'] ?? ''));
$subject = trim((string)($_POST['subject'] ?? ''));
$message = trim((string)($_POST['message'] ?? ''));
if ($name === '' || mb_strlen($name) > 100 || !filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 190 || $subject === '' || mb_strlen($subject) > 150 || $message === '' || mb_strlen($message) > 5000) {
    respond(422, ['success' => false, 'message' => 'Please check all fields and enter a valid email address.']);
}
if (preg_match('/[\r\n]/', $email)) {
    respond(422, ['success' => false, 'message' => 'Please enter a valid email address.']);
}
$dataDir = __DIR__ . DIRECTORY_SEPARATOR . 'data';
if (!is_dir($dataDir) && !mkdir($dataDir, 0750, true) && !is_dir($dataDir)) {
    respond(500, ['success' => false, 'message' => 'The message could not be saved. Please try again later.']);
}
$file = $dataDir . DIRECTORY_SEPARATOR . 'messages.csv';
$fp = @fopen($file, 'ab');
if ($fp === false) {
    respond(500, ['success' => false, 'message' => 'The server could not write to data/messages.csv. Check folder permissions.']);
}
if (!flock($fp, LOCK_EX)) {
    fclose($fp);
    respond(500, ['success' => false, 'message' => 'The server could not save your message. Please try again.']);
}
$stat = fstat($fp);
if (($stat['size'] ?? 0) === 0) {
    fputcsv($fp, ['submitted_at', 'name', 'email', 'subject', 'message']);
}
$ok = fputcsv($fp, [date(DATE_ATOM), $name, $email, $subject, $message]) !== false;
fflush($fp);
flock($fp, LOCK_UN);
fclose($fp);
if (!$ok) {
    respond(500, ['success' => false, 'message' => 'The server could not save your message. Please try again.']);
}
respond(200, ['success' => true, 'message' => 'Thank you! Your message was submitted successfully.']);
?>