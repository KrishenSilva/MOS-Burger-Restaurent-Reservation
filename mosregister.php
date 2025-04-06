<?php
$host = "localhost"; 
$user = "root"; 
$pass = "1234"; 
$dbname = "mosburgers"; 

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash password for security

$sql = "INSERT INTO register (username, email, passwordd) VALUES ('$username', '$email', '$password')";
$stmt = $conn->prepare($sql);

if ($conn->query($sql) === TRUE) {
    echo "Registration successful!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
