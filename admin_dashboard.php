<?php
session_start();
include 'db_connect.php';

// Ensure admin is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Handle assign to faculty
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['assign_id'], $_POST['faculty_id'])) {
    $assign_id = intval($_POST['assign_id']);
    $faculty_id = intval($_POST['faculty_id']);
    $stmt = $conn->prepare("UPDATE complaints SET faculty_id=?, status='pending' WHERE id=?");
    $stmt->bind_param("ii", $faculty_id, $assign_id);
    $stmt->execute();
    header("Location: admin_dashboard.php");
    exit;
}

// Handle delete
if (isset($_GET['action'], $_GET['id']) && $_GET['action'] == 'delete') {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("DELETE FROM complaints WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: admin_dashboard.php");
    exit;
}

// Fetch complaints
$result = $conn->query("
    SELECT c.id, c.title, c.description, c.status, c.reply, c.faculty_id, u.name AS student_name
    FROM complaints c
    JOIN users u ON c.user_id = u.id
    ORDER BY c.id DESC
");

// Fetch all faculties
$faculty_result = $conn->query("SELECT id, name FROM users WHERE role='faculty'");
$faculties = [];
while($f = $faculty_result->fetch_assoc()){
    $faculties[$f['id']] = $f['name'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body { background: #f1f4f9; }
.container-box { background: #fff; border-radius:10px; box-shadow:0 0 10px rgba(0,0,0,0.1); padding:25px; margin-top:50px; }
textarea { resize:none; }
</style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container">
<a class="navbar-brand" href="#">Admin Dashboard</a>
<ul class="navbar-nav ms-auto">
<li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
</ul>
</div>
</nav>

<div class="container container-box">
<h3>All Complaints</h3>
<table class="table table-bordered mt-3">
<thead class="table-dark">
<tr>
<th>ID</th>
<th>Student</th>
<th>Title</th>
<th>Description</th>
<th>Status</th>
<th>Faculty</th>
<th>Reply</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php while($row = $result->fetch_assoc()): ?>
<tr>
<td><?= $row['id'] ?></td>
<td><?= htmlspecialchars($row['student_name']) ?></td>
<td><?= htmlspecialchars($row['title']) ?></td>
<td><?= htmlspecialchars($row['description']) ?></td>
<td><?= ucfirst($row['status']) ?></td>
<td>
<?php if(!$row['faculty_id']): ?>
<form method="post" style="display:flex; gap:5px;">
<input type="hidden" name="assign_id" value="<?= $row['id'] ?>">
<select name="faculty_id" class="form-select form-select-sm" required>
<option value="">Select Faculty</option>
<?php foreach($faculties as $id=>$name): ?>
<option value="<?= $id ?>"><?= htmlspecialchars($name) ?></option>
<?php endforeach; ?>
</select>
<button type="submit" class="btn btn-sm btn-warning">Assign</button>
</form>
<?php else: ?>
<?= htmlspecialchars($faculties[$row['faculty_id']]) ?>
<?php endif; ?>
</td>
<td><?= $row['reply'] ?? '--' ?></td>
<td><a href="admin_dashboard.php?action=delete&id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</a></td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>
</body>
</html>
