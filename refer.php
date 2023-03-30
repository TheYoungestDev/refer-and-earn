<?php
$servername = "localhost:3306";
$username = "fastrasu_referandearn";
$password = "Alwaysthere@4321";
$dbname = "fastrasu_referandearn";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Escape user inputs for security
$firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
$lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
$company = mysqli_real_escape_string($conn, $_POST['company']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$country = mysqli_real_escape_string($conn, $_POST['country']);
$describe = mysqli_real_escape_string($conn, $_POST['describe']);
$official = mysqli_real_escape_string($conn, $_POST['official']);
$sold = mysqli_real_escape_string($conn, $_POST['sold']);
$terms = mysqli_real_escape_string($conn, $_POST['terms']);

// Attempt insert query execution

$sql = "INSERT INTO referandearn (firstname, lastname, company, email, country, `describe`, official, sold, terms) VALUES ('$firstname', '$lastname', '$company', '$email', '$country', '$describe', '$official', '$sold', '$terms')";

// If the form is submitted successfully to database, then do this below




//   // Send email with form data
use PHPMailer\PHPMailer\PHPMailer; // Phpmail package already on server
use PHPMailer\PHPMailer\Exception; // Phpmail package already on server

require 'PHPMailer/src/PHPMailer.php'; // Phpmail package already on server
require 'PHPMailer/src/SMTP.php'; // Phpmail package already on server

$mail = new PHPMailer();

$mail->IsSMTP(); // telling the class to use SMTP
$mail->SMTPAuth = true; // enable SMTP authentication
$mail->Host = "localhost"; // sets the SMTP server or use the server hostname
$mail->Port = 25; // set the SMTP port for the GMAIL server
$mail->Username = "info@fastrasuite.com"; // SMTP account username
$mail->Password = "Alwaysthere@4321"; // SMTP account password

$mail->SetFrom('info@fastrasuite.com');
$mail->AddReplyTo("info@fastrasuite.com");
$mail->Subject = "New Referral Form Submitted";
$mail->MsgHTML("<html>

        <body><em>Below is the details of the new record! </em><br><br><br>
        <strong>First Name:</strong> $firstname,<br><br>
        <strong>Last Name:</strong> $lastname,<br><br>
        <strong>Email:</strong> $email,<br><br>
        <strong>Company name:</strong> $company,<br><br>
        <strong>Country:</strong> $country,<br><br>
        <strong>What best describes you?:</strong> $describe`,<br><br>
        <strong>Are you a public official?:</strong> $official,<br><br>
        <strong>Have you sold or used an enterprise SaaS product before?:</strong> $sold,<br><br>
        <strong>Do you agree with the terms and conditions?:</strong> $terms</body>

    </html>");

$mail->AddAddress("info@fastrasuite.com");
//$mail->AddAttachment(""); // attachment

//If the form is submitted successfully
if (!$mail->Send()){

} elseif (mysqli_query($conn, $sql)){

}
echo "<script>window.location.href = 'https://fastrasuite.com/referandearn/registration-success.php';</script>";


// Close connection

?>



