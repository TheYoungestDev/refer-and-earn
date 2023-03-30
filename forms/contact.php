<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

  // Validate input
  if (empty($name) || empty($email) || empty($message)) {
    $result = array('result' => 'error', 'message' => 'Please fill in all fields.');
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $result = array('result' => 'error', 'message' => 'Please enter a valid email address.');
  } else {
    // Send the email
    $contact = new PHPMailer();
    $contact->isSMTP();
    $contact->Host = 'fastrasuite.com';
    $contact->SMTPAuth = true;
    $contact->Username = 'info@fastrasuite.com';
    $contact->Password = 'Alwaysthere@4321';
    $contact->SMTPSecure = 'ssl';
    $contact->Port = 465;

    $contact->setFrom($email, $name);
    $contact->addAddress('receiving_email_address', 'Recipient Name');
    $contact->Subject = $_POST['subject'];
    $contact->Body = "Name: $name\nEmail: $email\nMessage: $message";

    if ($contact->send()) {
      $result = array('result' => 'success', 'message' => 'Your message was sent successfully.');
    } else {
      $result = array('result' => 'error', 'message' => 'There was a problem sending your message. Please try again later.');
    }
  }

  header('Content-Type: application/json');
  echo json_encode($result);
}

?>
