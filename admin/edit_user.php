<?php
include '../config/db_config.php';
include '../utils/session.php';
CheckRole('Admin');

$id = $_GET['userID'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE userID = ?");
$stmt->execute([$id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $usertype = $_POST['usertype'];
    $plainpassword = $_POST['password'];
    $hashedpassword = password_hash($plainpassword,PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("UPDATE users SET username = ?, passwordhash = ?, usertype = ? WHERE userID = ?");
    $stmt->execute([$username, $password, $usertype, $id]);

    header("Location: manage_user.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* General body styling */
body {
    background-color: #f8f9fa;
    font-family: Arial, sans-serif;
}

.container {
    max-width: 500px;
    margin-top: 50px;
}

/* Card styling */
.card {
    border-radius: 8px;
    padding: 20px;
    background-color: #ffffff;
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
}

/* Heading styling */
h2 {
    color: #343a40;
    font-weight: bold;
}

/* Form label styling */
.form-label {
    font-weight: 600;
    color: #495057;
}

/* Form input styling */
.form-control, .form-select {
    border-radius: 5px;
    box-shadow: none;
    border: 1px solid #ced4da;
    transition: border-color 0.3s;
}

.form-control:focus, .form-select:focus {
    border-color: #80bdff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

/* Button styling */
.btn-primary {
    padding: 10px 20px;
    font-weight: bold;
    font-size: 16px;
    border-radius: 5px;
}

.btn-secondary {
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 5px;
    color: #fff;
    background-color: #6c757d;
    border: none;
}

.btn-secondary:hover {
    background-color: #5a6268;
}

    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-body">
                <h2 class="text-center mb-4">Edit User</h2>
                <form method="post" action="">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Enter new password" required>
                    </div>

                    <div class="mb-3">
                        <label for="usertype" class="form-label">User Type</label>
                        <select name="usertype" id="usertype" class="form-select" required>
                            <option value="Admin" <?php echo ($user['usertype'] === 'Admin') ? 'selected' : ''; ?>>Admin</option>
                            <option value="Instructor" <?php echo ($user['usertype'] === 'Instructor') ? 'selected' : ''; ?>>Instructor</option>
                            <option value="Student" <?php echo ($user['usertype'] === 'Student') ? 'selected' : ''; ?>>Student</option>
                        </select>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Update User</button>
                        <a href="manage_user.php" class="btn btn-secondary ms-2">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
