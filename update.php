<?php
include 'db_connect.php';
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM students WHERE id=$id");
$row = $result->fetch_assoc();

if (isset($_POST['update'])) {
    $name   = $_POST['name'];
    $email  = $_POST['email'];
    $course = $_POST['course'];

    $conn->query("UPDATE students SET name='$name', email='$email', course='$course' WHERE id=$id");
    header("Location: select.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Student Management</a>
            <a href="select.php" class="btn btn-light btn-sm">⬅ Back to List</a>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <!-- Card -->
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white text-center">
                        <h4 class="mb-0">💾 Edit Student</h4>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" 
                                       value="<?php echo htmlspecialchars($row['name']); ?>" 
                                       placeholder="Enter full name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" 
                                       value="<?php echo htmlspecialchars($row['email']); ?>" 
                                       placeholder="Enter email address" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Course</label>
                                <input type="text" name="course" class="form-control" 
                                       value="<?php echo htmlspecialchars($row['course']); ?>" 
                                       placeholder="Enter course" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" name="update" class="btn btn-primary">
                                    💾 Update Student
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <a href="select.php" class="btn btn-outline-secondary btn-sm">Back to Student List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-center py-3 text-muted small">
        &copy; <?php echo date('Y'); ?> Student Management
    </footer>
</body>
</html>
