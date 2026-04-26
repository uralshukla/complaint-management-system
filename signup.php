<?php
session_start();
include 'db.php'; // Make sure db.php connects to complaint_system DB

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);

    // Check if email already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Email already registered! Please login.');</script>";
    } else {
        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert new user
        $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $hashedPassword, $role);

        if ($stmt->execute()) {
            $_SESSION['user_id'] = $conn->insert_id;
            $_SESSION['role'] = $role;
            $_SESSION['name'] = $name;

            // Redirect to dashboard based on role
            if ($role == "student") {
                header("Location: student_dashboard.php");
            } elseif ($role == "faculty") {
                header("Location: faculty_dashboard.php");
            } elseif ($role == "admin") {
                header("Location: admin_dashboard.php");
            }
            exit;
        } else {
            echo "<script>alert('Something went wrong. Please try again.');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sign Up - Complaint Management System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .signup-container {
      max-width: 500px;
      margin: 60px auto;
      padding: 30px;
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    }
    .signup-header {
      text-align: center;
      margin-bottom: 20px;
    }
    .btn-custom {
      background-color: #28a745;
      color: #fff;
    }
    .btn-custom:hover {
      background-color: #218838;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">ComplaintMS</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
        <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Signup Form -->
<div class="container">
  <div class="signup-container">
    <div class="signup-header">
      <h2>Create Account</h2>
    </div>
    <form action="process_signup.php" method="post">
      <div class="mb-3">
        <label class="form-label">Full Name</label>
        <input type="text" class="form-control" name="name" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Email address</label>
        <input type="email" class="form-control" name="email" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" class="form-control" name="password" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Select Role</label>
        <select class="form-select" name="role" required>
          <option value="">-- Select Role --</option>
          <option value="student">Student</option>
          <option value="faculty">Faculty</option>
          <option value="admin">Admin</option>
        </select>
      </div>
      <button type="submit" class="btn btn-custom w-100">Sign Up</button>
    </form>
    <p class="mt-3 text-center">
      Already have an account? <a href="login.php">Login here</a>
    </p>
  </div>
</div>

<!-- Footer -->
<div class="bg-dark text-white text-center mt-5 p-3">
  &copy; <?= date('Y'); ?> Complaint Management System
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
