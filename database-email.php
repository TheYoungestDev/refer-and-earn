<?php

// Database connection parameters
$servername = "localhost:3306";
$username = "fastrasu_referandearn";
$password = "Alwaysthere@4321";
$dbname = "fastrasu_referandearn";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// SQL query to extract data
$sql = "SELECT * FROM referandearn";

// Execute the query
$result = $conn->query($sql);

// Check if any rows were returned
if ($result->num_rows > 0) {

  // Build the email message
  $message = "Here is the data you requested:<br>";
  while($row = $result->fetch_assoc()) {
    $message .= "ID: " . $row["firstname"]. " - Name: " . $row["lastname"]. " - Email: " . $row["email"]. "<br>";
  }

  // Set up the email parameters
  $to = "info@fastrasuite.com";
  $subject = "Database report";
  $headers = "From: info@fastrasuite.com\r\n";
  $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

  // Send the email
  if (mail($to, $subject, $message, $headers)) {
    echo "Email sent successfully";
  } else {
    echo "Email could not be sent";
  }

} else {
  echo "No data found";
}

// Close the database connection
$conn->close();

?>
