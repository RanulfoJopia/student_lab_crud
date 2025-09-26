<?php 
include 'db_connect.php';

// --- Sorting logic ---
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'id_asc'; // default sort
$orderBy = "id ASC"; // default

switch ($sort) {
    case 'name_asc': $orderBy = "name ASC"; break;
    case 'name_desc': $orderBy = "name DESC"; break;
    case 'email_asc': $orderBy = "email ASC"; break;
    case 'email_desc': $orderBy = "email DESC"; break;
}

$result = $conn->query("SELECT * FROM students ORDER BY $orderBy");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Student Management</a>
            <a href="insert.php" class="btn btn-light btn-sm">+ Add Student</a>
        </div>
    </nav>

    <div class="container my-5">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Student List</h4>
                <a href="insert.php" class="btn btn-light btn-sm">+ Add New Student</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">#</th>

                            <!-- Sortable Name header -->
                            <th scope="col">
                                Name
                                <a href="?sort=<?php echo ($sort=='name_asc')?'name_desc':'name_asc'; ?>" 
                                   class="text-decoration-none text-dark ms-1">
                                    <?php echo ($sort=='name_asc')?'⬆️':'⬇️'; ?>
                                </a>
                            </th>

                            <!-- Sortable Email header -->
                            <th scope="col">
                                Email
                                <a href="?sort=<?php echo ($sort=='email_asc')?'email_desc':'email_asc'; ?>" 
                                   class="text-decoration-none text-dark ms-1">
                                    <?php echo ($sort=='email_asc')?'⬆️':'⬇️'; ?>
                                </a>
                            </th>

                            <th scope="col">Course</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>{$row['id']}</td>
                                        <td>".htmlspecialchars($row['name'])."</td>
                                        <td>".htmlspecialchars($row['email'])."</td>
                                        <td>".htmlspecialchars($row['course'])."</td>
                                        <td class='text-center'>
                                            <a href='update.php?id={$row['id']}' class='btn btn-warning btn-sm me-1'>✏️ Edit</a>
                                            <a href='delete.php?id={$row['id']}' class='btn btn-danger btn-sm'
                                               onclick=\"return confirm('Are you sure you want to delete this student?');\">🗑️ Delete</a>
                                        </td>
                                    </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5' class='text-center text-muted py-4'>No students found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <footer class="text-center py-3 text-muted small">
        &copy; <?php echo date('Y'); ?> Student Management
    </footer>
</body>
</html>
