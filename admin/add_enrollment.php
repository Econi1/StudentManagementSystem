<?php
include '../config/db_config.php';
include '../utils/session.php';
checkRole('Admin');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studentID = $_POST['studentID'];
    $courseID = $_POST['courseID'];
    $enrolmentDate = date('Y-m-d');

    // Insert enrolment into the database
    $stmt = $pdo->prepare("INSERT INTO enrolment (studentID, courseID, EnrolmentDate) VALUES (?, ?, ?)");
    $stmt->execute([$studentID, $courseID, $enrolmentDate]);

    // Redirect or show success message
    header("Location: manage_enrollments.php?success=true");
    exit;
}

// Fetch students and courses for the dropdowns
$students = $pdo->query("SELECT studentID, CONCAT(Fname, ' ', Lname) AS studentName FROM students")->fetchAll(PDO::FETCH_ASSOC);
$courses = $pdo->query("SELECT courseID, CourseName FROM courses")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Enrolment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
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

.form-select {
    height: 45px;
    padding: 10px;
    font-size: 1rem;
    border-radius: 5px;
    border: 1px solid #ced4da;
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.form-select:focus {
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
            <h2 class="text-center mb-4">Enroll Student in Course</h2>
            <form action="add_enrollment.php" method="post">
                
                <!-- Student Selection -->
                <div class="mb-3">
                    <label for="studentID" class="form-label">Select Student</label>
                    <select name="studentID" id="studentID" class="form-select" required>
                        <option value="" disabled selected>Choose a student</option>
                        <?php foreach ($students as $student): ?>
                            <option value="<?php echo htmlspecialchars($student['studentID']); ?>">
                                <?php echo htmlspecialchars($student['studentName']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Course Selection -->
                <div class="mb-3">
                    <label for="courseID" class="form-label">Select Course</label>
                    <select name="courseID" id="courseID" class="form-select" required>
                        <option value="" disabled selected>Choose a course</option>
                        <?php foreach ($courses as $course): ?>
                            <option value="<?php echo htmlspecialchars($course['courseID']); ?>">
                                <?php echo htmlspecialchars($course['CourseName']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary w-100">Enroll Student</button>
                </div>
                <div class="text-center mt-4">
                    <a href="manage_enrollments.php" class="btn btn-primary w-100">Back to Manage Enrolments</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
