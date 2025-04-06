<?php
$servername = "localhost"; 
$username = "root"; 
$password = "1234"; 
$dbname = "mosburgers"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$bb = $_POST['dish'];
$qty = $_POST['quantity'];
$fname = $_POST['fullName'];
$ad = $_POST['address'];
$emai = $_POST['email'];
$cc = $_POST['charg'];


// SQL Query
$sql = "INSERT INTO invoice (CustomerID, CustomerName, RoomNumber, Duration, AdditionalCharges, TotalBill  ) VALUES ('$bb', '$qty', '$fname', '$ad','$cc','$emai')";

if ($conn->query($sql) === TRUE) {
    echo "Registration successful!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}









$conn->close();


?>
