<?php
$name = $_POST['name'];
$lName = $_POST['lname'];
$email = $_POST['email'];
$password = $_POST['password'];

if (empty($name) || empty($lName) || empty($email) || empty($password)) {
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

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$serverName = 'localhost';
$username = 'root';
$dbPassword = '';
$dbName = 'registration';

try {
    $conn = new PDO("mysql:host=$serverName;dbname=$dbName", $username, $dbPassword);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare('INSERT INTO users (name, lname, email, password) VALUES (:name, :lname, :email, :password)');

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':lname', $lName);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashedPassword);

    $stmt->execute();

    echo 'New record created successfully';
} 
catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}

$conn = null;

