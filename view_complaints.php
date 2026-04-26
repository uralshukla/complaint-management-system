<?php
include 'db.php';
session_start();

$user_id = $_SESSION['user_id'];

$result = mysqli_query($conn, "SELECT * FROM complaints WHERE user_id = $user_id");

echo "<h2>Your Complaints</h2>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<p>{$row['title']} - Status: {$row['status']}</p>";
}
?>
