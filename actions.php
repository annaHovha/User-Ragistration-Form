<?php

$name = $_POST['name'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$password = $_POST['password'];


if(empty($name) || empty($lname) || empty($email) || empty($password)) {
    echo "All fields are required!";
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email format";
    exit;
}


if(strlen($password) < 8) {
    echo "Your password must be at least 8 characters long";
    exit;
}

$hashed_pass = password_hash($password, PASSWORD_DEFAULT);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration";

$conn = new mysqli($servername, $username, $password, $dbname);

$stmt = $conn->prepare("INSERT INTO users (name, lname, email, password) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $lname, $email, $hashed_pass);

if ($stmt->execute() === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
