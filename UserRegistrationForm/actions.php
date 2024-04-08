<?php
$name = $_POST['name'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$password = $_POST['password'];

if (empty($name) || empty($lname) || empty($email) || empty($password)) {
    echo 'All fields are required!';
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo 'Invalid email format';
    exit;
}

if (strlen($password) < 8) {
    echo 'Your password must be at least 8 characters long';
    exit;
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$servername = "localhost";
$username = "root";
$db_password = "";
$dbname = "registration";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $db_password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("INSERT INTO users (name, lname, email, password) VALUES (:name, :lname, :email, :password)");

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':lname', $lname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashed_password);

    $stmt->execute();

    echo 'New record created successfully';
} 
catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}

$conn = null;

