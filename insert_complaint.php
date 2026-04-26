<?php
session_start();
include("db_connect.php"); // Connect to DB

if (!isset($_SESSION['user_id'])) {
    die("User not logged in.");
}

$user_id = $_SESSION['user_id'];
$title = $_POST['title'];
$description = $_POST['description'];

$sql = "INSERT INTO complaints (user_id, title, description) 
        VALUES ('$user_id', '$title', '$description')";

if (mysqli_query($conn, $sql)) {
    echo "Complaint submitted successfully.";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
    