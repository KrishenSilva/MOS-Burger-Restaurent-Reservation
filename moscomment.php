<?php
// Database connection
$host = "localhost"; // or "localhost"
$user = "root"; // MySQL username
$pass = "1234"; // MySQL password (leave empty if not set)
$dbname = "mosburgers"; // Your database name

$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user data from the form
$email = $_POST['email'];
$comm =  $_POST['comment'];

// Prepare SQL query
$sql = "INSERT INTO comment (email, comment ) VALUES ('$email', '$comm')";
$stmt = $conn->prepare($sql);


if ($conn->query($sql) === TRUE) {
    echo "Registration successful!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
