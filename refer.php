<?php
$servername = "localhost";
$username = "abdul";
$password = "abdullahi";
$dbname = "abdul";

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


// Define email parameters
$to = $email;
$subject = 'New form submission';
$message = 'Your referral has been submitted.';
$headers = 'From: info@fastrasuite.com' . "\r\n" .
    'Reply-To: info@fastrasuite.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

// Attempt to send email

if (mysqli_query($conn, $sql))
 {

  // Refresh the current tab
  echo "<script>window.location.href = '/your-form-has-been-recorded.html';</script>";
// Define email parameters
$to = $email;
$subject = 'New form submission';

$message = "A new referral has been submitted with the following information:\n\n"
. "First Name: $firstname\n"
. "Last Name: $lastname\n"
. "Company: $company\n"
. "Email: $email\n"
. "Country: $country\n"
. "Description: $describe\n"
. "Official: $official\n"
. "Sold: $sold\n"
. "Terms: $terms\n";

$headers = 'From: info@fastrasuite.com' . "\r\n" .
    'Reply-To: info@fastrasuite.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

// Attempt to send email
if (mail($to, $subject, $message, $headers)) {
    echo 'Email sent successfully.
    Form submitted!';
} else {
    echo 'Failed to send email.';
}


}
mysqli_close($conn);


// Close connection

?>



<!-- 
if(mysqli_query($conn, $sql)) {
  echo "Form submitted successfully.";

  // Define email parameters
  $to = 'info@fastrasuite.com'; // Replace with the actual email address of the company
  $subject = 'New form submission';
  $message = "A new referral has been submitted with the following information:\n\n"
            . "First Name: $firstname\n"
            . "Last Name: $lastname\n"
            . "Company: $company\n"
            . "Email: $email\n"
            . "Country: $country\n"
            . "Description: $describe\n"
            . "Official: $official\n"
            . "Sold: $sold\n"
            . "Terms: $terms\n";
  $headers = 'From: info@fastrasuite.com' . "\r\n" .
      'Reply-To: info@fastrasuite.com' . "\r\n" .
      'X-Mailer: PHP/' . phpversion();

  // Attempt to send email
  if (mail($to, $subject, $message, $headers)) {
      echo ' Email sent successfully.';
  } else {
      echo ' Failed to send email.';
  }
} else {
  echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);
?> -->
