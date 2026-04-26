<?php
session_start();
include 'db_connect.php'; // Database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Check user in DB
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify hashed password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            // Redirect by role
            if ($user['role'] === 'student') {
                header("Location: student_dashboard.php");
            } elseif ($user['role'] === 'faculty') {
                header("Location: faculty_dashboard.php");
            } elseif ($user['role'] === 'admin') {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: index.php");
            }
            exit;
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No account found with that email.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - Complaint Management System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .login-container {
      max-width: 400px;
      margin: 80px auto;
      padding: 30px;
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    }
    .login-header {
      text-align: center;
      margin-bottom: 20px;
    }
    .login-header h2 {
      color: #007bff;
      margin-bottom: 5px;
    }
    .form-control:focus {
      border-color: #007bff;
      box-shadow: none;
    }
    .btn-custom {
      background-color: #007bff;
      color: #fff;
      border: none;
    }
    .btn-custom:hover {
      background-color: #0056b3;
    }
    .footer {
      background-color: #343a40;
      color: #fff;
      padding: 15px 0;
      text-align: center;
      margin-top: 40px;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">ComplaintMS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="signup.php">Sign Up</a></li>
        <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Login Form -->
<div class="container">
  <div class="login-container">
    <div class="login-header">
      <h2>Login</h2>
      <p>Please enter your credentials</p>
    </div>

    <?php if (!empty($error)): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form action="login.php" method="post">
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
      </div>
      <div class="mb-3 form-check">
         <input type="checkbox" class="form-check-input" id="remember" name="remember">
         <label class="form-check-label" for="remember">Remember me</label>
      </div>
      <button type="submit" class="btn btn-custom w-100">Login</button>
    </form>
    <p class="mt-3 text-center">
      Don't have an account? <a href="signup.php">Sign up here</a>
    </p>
  </div>
</div>

<!-- Footer -->
<div class="footer">
  &copy; <?= date('Y'); ?> Complaint Management System. All rights reserved.
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
