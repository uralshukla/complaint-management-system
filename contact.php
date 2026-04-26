<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact Us - Complaint Management System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .contact-box {
      max-width: 700px;
      margin: 60px auto;
      background: #fff;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .contact-box h2 {
      color: #17a2b8;
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
        <li class="nav-item"><a class="nav-link" href="signup.php">Sign Up</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Contact Section -->
<div class="container">
  <div class="contact-box">
    <h2>Contact Us</h2>
    <p>If you have any queries, reach us at:</p>
    <ul class="list-unstyled">
      <li><strong>Email:</strong> Complaintmanagement@gmail.com </li>
      <li><strong>Phone:</strong> +91 11111 22222</li>
      <li><strong>Address:</strong> C.K Pithawalla College of Engineering & Technology, Dumas Rd, Surat, India</li>
    </ul>
    
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
