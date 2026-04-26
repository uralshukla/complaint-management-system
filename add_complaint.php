<?php
// add_complaint.php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<form method="POST" action="insert_complaint.php">
    <label>Title:</label><br>
    <input type="text" name="title" required><br><br>

    <label>Description:</label><br>
    <textarea name="description" required></textarea><br><br>

    <input type="submit" value="Submit Complaint">
</form>
