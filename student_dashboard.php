<?php 
session_start();
include 'db_connect.php';

// Ensure student is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.php");
    exit;
}

$student_id = $_SESSION['user_id'];

// Handle complaint submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['title'], $_POST['description'], $_POST['category'])) {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $category = $_POST['category'];

    if (!empty($title) && !empty($description) && !empty($category)) {
        $stmt = $conn->prepare("INSERT INTO complaints (user_id, title, description, category, status) VALUES (?, ?, ?, ?, 'pending')");
        $stmt->bind_param("isss", $student_id, $title, $description, $category);
        $stmt->execute();

        header("Location: student_dashboard.php");
        exit;
    }
}

// Fetch student's previous complaints
$stmt = $conn->prepare("SELECT title, status, category FROM complaints WHERE user_id = ? ORDER BY id DESC");
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Student Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <style>
    body { background: #f1f4f9; }
    .container-box {
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      padding: 25px;
      margin-top: 50px;
    }
    .completed-row {
      background-color: #e6ffe6;
    }
  </style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">ComplaintMS</a>
    <ul class="navbar-nav ms-auto">
      <li class="nav-item"><a class="nav-link">Welcome, Student</a></li>
      <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
    </ul>
  </div>
</nav>

<div class="container container-box">

  <h3 class="mb-4">Submit a Complaint</h3>

  <form method="post">
    <div class="mb-3">
      <label class="form-label">Complaint Category</label>
      <select name="category" class="form-select" required>
        <option value="">Select Category</option>
        <option value="Academic">Academic</option>
        <option value="Infrastructure">Infrastructure</option>
        <option value="Cleanliness">Cleanliness</option>
        <option value="Technical">Technical</option>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Complaint Title</label>
      <input type="text" class="form-control" name="title" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea class="form-control" name="description" rows="4" required></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Submit Complaint</button>
  </form>

  <hr class="my-5">

  <h4>Your Previous Complaints</h4>

  <table class="table table-bordered mt-3">
    <thead class="table-dark">
      <tr>
        <th>Title</th>
        <th>Category</th>
        <th>Status</th>
      </tr>
    </thead>

    <tbody>
      <?php while ($row = $result->fetch_assoc()): ?>
      <tr class="<?= $row['status']=='complete' ? 'completed-row' : '' ?>">

        <td><?= htmlspecialchars($row['title']) ?></td>
        <td><?= htmlspecialchars($row['category']) ?></td>

        <td>
          <?php if ($row['status'] == 'complete'): ?>
            <span class="badge bg-success">Resolved</span>

          <?php elseif ($row['status'] == 'working'): ?>
            <span class="badge bg-warning text-dark">Working</span>

          <?php else: ?>
            <span class="badge bg-danger">Pending</span>
          <?php endif; ?>
        </td>

      </tr>
      <?php endwhile; ?>
    </tbody>

  </table>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>