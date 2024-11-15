<?php
include '../config/db_config.php';
include '../utils/session.php';
checkRole('Admin');

$instructorID = $_GET['InstructorID'];

// Fetch the current instructor information
$stmt = $pdo->prepare("SELECT * FROM Intructors WHERE InstructorID = ?");
$stmt->execute([$instructorID]);
$instructor = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$instructor) {
    echo "No instructor found or query failed.";
    var_dump($stmt->errorInfo()); // Show error info if query failed
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = htmlspecialchars($_POST['first_name']);
    $lastName = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $photo = htmlspecialchars($_POST['image']);

    // Update instructor information
    $stmt = $pdo->prepare("UPDATE Intructors SET FName = ?, LName = ?, Email = ?, Telephone = ?, Image = ? WHERE InstructorID = ?");
    $stmt->execute([$firstName, $lastName, $email, $phone, $photo, $instructorID]);
    $stmt1 = $pdo->prepare("UPDATE users SET email = ? WHERE InstructorID = ?");
    $stmt1->execute([$email, $instructorID]);
    header("Location: manage_instructors.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Instructor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/styles.css">
    <link rel="icon" type="image/x-icon" href="../public/images/log2_2.png">
    <style>
        body {
    background-color: #f8f9fa;
    font-family: Arial, sans-serif;
}

.container {
    max-width: 600px;
}

.card {
    background: #ffffff;
    border-radius: 8px;
    padding: 2rem;
    border: none;
}

h2 {
    font-size: 1.75rem;
    font-weight: 700;
    color: #343a40;
}

.form-label {
    font-weight: 500;
    color: #495057;
}

.form-control {
    height: 45px;
    padding: 10px;
    font-size: 1rem;
    border-radius: 5px;
    border: 1px solid #ced4da;
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #80bdff;
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1), 0 0 6px rgba(0, 123, 255, 0.25);
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
    font-size: 1.1rem;
    font-weight: 500;
    padding: 10px;
    transition: background-color 0.3s ease;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #004085;
}

.text-center {
    text-align: center;
}

    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            <h2 class="text-center mb-4">Edit Instructor Information</h2>
            <form method="post" action="edit_instructor.php?InstructorID=<?php echo $instructorID; ?>" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="first_name" class="form-label">First Name:</label>
                    <input type="text" name="first_name" class="form-control" value="<?php echo htmlspecialchars($instructor['Fname']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Last Name:</label>
                    <input type="text" name="last_name" class="form-control" value="<?php echo htmlspecialchars($instructor['Lname']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($instructor['Email']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number:</label>
                    <input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($instructor['Telephone']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Photo:</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary w-100">Update Instructor</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
