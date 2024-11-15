<?php
include '../config/db_config.php' ;
include '../utils/session.php';
CheckRole('Admin');
$intructors = $pdo->query("SELECT * FROM intructors")->fetchAll(PDO::FETCH_ASSOC);
$courses = $pdo->query("SELECT * FROM courses")->fetchAll(PDO::FETCH_ASSOC);
if($_SERVER['REQUEST_METHOD']=== 'POST'){
    $course_id = $_POST['courseID'];
    $intructor_id = $_POST['instructorid'];
    $stmt = $pdo->prepare("INSERT INTO assignment (courseID,instructorID) values (?,?)");
    $stmt->execute([$course_id,$intructor_id]);
    header("Location: manage_instructors.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Instructor</title>
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
            <h2 class="text-center mb-4">Assign Instructor to Course</h2>
            <form action="assign_instructor.php" method="post">
                
                <div class="mb-3">
                    <label for="courseID" class="form-label">Select Course</label>
                    <select name="courseID" id="courseID" class="form-select" required>
                        <option value="" disabled selected>Choose a course</option>
                        <?php foreach($courses as $course): ?>
                            <option value="<?php echo $course['CourseID']; ?>">
                                <?php echo htmlspecialchars($course['CourseName']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="instructorid" class="form-label">Select Instructor</label>
                    <select name="instructorid" id="instructorid" class="form-select" required>
                        <option value="" disabled selected>Choose an instructor</option>
                        <?php foreach($intructors as $intructor): ?>
                            <option value="<?php echo $intructor['InstructorID']; ?>">
                                <?php echo htmlspecialchars($intructor['Fname'] . ' ' . $intructor['Lname']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary w-100">Assign Instructor</button>
                </div>
                <div class="text-center mt-4">
                    <a href="manage_instructors.php" class="btn btn-primary w-100">Back to Manage Instructors</a>
                </div>
            </form>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
