<?php
session_start();

// Database connection
$host = "localhost";      
$user = "root";           
$pass = "";               
$db   = "complaint_system";  // Your database name

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name     = trim($_POST['name']);
$email    = trim($_POST['email']);
$password = trim($_POST['password']);
$role     = trim($_POST['role']); 

// Hash password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Check if email exists
$check = $conn->prepare("SELECT id FROM users WHERE email = ?");
$check->bind_param("s", $email);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    $_SESSION['error'] = "Email already registered!";
    header("Location: signup.php");
    exit();
}
$check->close();

// Insert user
$stmt = $conn->prepare("INSERT INTO users (name, email, password, role, created_at) VALUES (?, ?, ?, ?, NOW())");
$stmt->bind_param("ssss", $name, $email, $hashed_password, $role);

if ($stmt->execute()) {
    $_SESSION['success'] = "Registration successful! Please login.";
    header("Location: login.php");
    exit();
} else {
    $_SESSION['error'] = "Something went wrong.";
    header("Location: signup.php");
    exit();
}

$stmt->close();
$conn->close();
?>
