<?php
include '../config/db_config.php'; // Include your database configuration
include '../utils/session.php';
CheckRole('Admin');

$searchResults = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $searchTerm = trim($_POST['search_term']);

    if (!empty($searchTerm)) {
        // Prepare query to search in both students and instructors tables
        $query = "SELECT 'Student' AS role, StudentID AS id, Fname AS first_name, Lname AS last_name, Email 
            FROM students 
            WHERE Fname LIKE :term OR Lname LIKE :term OR Email LIKE :term
            UNION
            SELECT 'Instructor' AS role, InstructorID AS id, Fname AS first_name, Lname AS last_name, Email 
            FROM intructors 
            WHERE Fname LIKE :term OR Lname LIKE :term OR Email LIKE :term
            ORDER BY role, first_name, last_name
        ";

        $stmt = $pdo->prepare($query);
        $stmt->execute(['term' => '%' . $searchTerm . '%']);
        $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Students & Instructors</title>
    <link rel="icon" type="image/x-icon" href="../public/images/log2_2.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container { margin-top: 30px; }
        .search-results { margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Search for Students & Instructors</h2>
        <form method="POST" action="search.php" class="input-group mb-3">
            <input type="text" name="search_term" class="form-control" placeholder="Enter name or email to search" required>
            <button class="btn btn-primary" type="submit">Search</button>
        </form>
            <div class="text-center mt-4">
            <nav class="navbar navbar-expand-lg navbar-light bg-trans">
            <a href="dashboard.php" class="navbar-brand">Dashboard</a>
            </nav>
            </div>
        <?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
            <div class="search-results">
                <?php if (!empty($searchResults)): ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Role</th>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($searchResults as $result): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($result['role']); ?></td>
                                    <td><?php echo htmlspecialchars($result['id']); ?></td>
                                    <td><?php echo htmlspecialchars($result['first_name']); ?></td>
                                    <td><?php echo htmlspecialchars($result['last_name']); ?></td>
                                    <td><?php echo htmlspecialchars($result['Email']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No results found for "<?php echo htmlspecialchars($searchTerm); ?>"</p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
