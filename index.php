<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Complaint Management System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f5f7fa;
    }
    .hero {
      padding: 100px 20px;
      background: linear-gradient(to right, #007bff, #00c6ff);
      color: white;
      text-align: center;
    }
    .hero h1 {
      font-size: 3rem;
    }
    .section {
      padding: 60px 0;
    }
    footer {
      background-color: #343a40;
      color: white;
      padding: 15px 0;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#">ComplaintMS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarContent">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
        <li class="nav-item"><a class="nav-link" href="signup.php">Sign Up</a></li>
        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<div class="hero">
  <div class="container">
    <h1>Welcome to Complaint Management System</h1>
    <p class="lead">
      Our College Complaint Management System is designed to create a transparent, efficient, and student-friendly environment. 
      It allows students to raise issues related to academics, infrastructure, facilities, or administration and ensures that 
      every complaint is tracked, managed, and resolved in a systematic manner.
    </p>
    <p>
      This platform connects Students, Faculty, and Administration into one unified system where communication becomes easier, 
      response time improves, and accountability is maintained across all departments of the college.
    </p>
    <a href="login.php" class="btn btn-light btn-lg m-2">Login</a>
    <a href="signup.php" class="btn btn-outline-light btn-lg m-2">Sign Up</a>
  </div>
</div>

<!-- College Description Section -->
<div class="container section">
  <div class="row text-center">
    <div class="col-lg-10 mx-auto">
      <h2>About Our College</h2>
      <p class="mt-3">
        C.K Pithawala Engineering and Technology is dedicated to providing high-quality education 
        and fostering innovation among students. The college offers a strong academic foundation 
        supported by experienced faculty, modern laboratories, and advanced learning resources.
      </p>
      <p>
        The institution focuses on the overall development of students by encouraging participation 
        in technical events, workshops, internships, and industry collaborations. It aims to build 
        skilled professionals who are ready to face real-world challenges with confidence.
      </p>
      <p>
        To enhance campus life and maintain transparency, the college has implemented a Complaint 
        Management System that allows students to easily report issues. This ensures quick resolution, 
        better communication, and continuous improvement in campus facilities and academic services.
      </p>
    </div>
  </div>
</div>

<!-- Info Section -->
<div class="container section">
  <div class="row text-center">
    <div class="col-md-4 mb-4">
      <h3>📩 Submit Complaint</h3>
      <p>
        Students can easily submit complaints related to classroom issues, lab equipment, campus facilities, 
        or any academic concerns through a simple and user-friendly interface. Each complaint is securely stored 
        and assigned a unique ID for tracking.
      </p>
      <p>
        The system ensures that no complaint is ignored and every issue reaches the appropriate authority for action.
      </p>
    </div>
    <div class="col-md-4 mb-4">
      <h3>🛠 Faculty Actions</h3>
      <p>
        Faculty members are responsible for reviewing complaints assigned to them. They can update the status 
        (Pending, Working, Completed), provide replies, and take necessary actions to resolve student issues efficiently.
      </p>
      <p>
        This helps in maintaining discipline, improving facilities, and ensuring better communication between students and staff.
      </p>
    </div>
    <div class="col-md-4 mb-4">
      <h3>👨‍💼 Admin Panel</h3>
      <p>
        The Admin Panel provides complete control over the system. Admins can view all complaints, assign them to 
        the appropriate faculty members, monitor progress, and ensure timely resolution.
      </p>
      <p>
        It helps the college management maintain transparency, improve decision-making, and enhance overall student satisfaction.
      </p>
    </div>
  </div>
</div>

<!-- Footer -->
<footer class="text-center">
  <div class="container">
    <p>&copy; 2025 Complaint Management System. All Rights Reserved.</p>
  </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>