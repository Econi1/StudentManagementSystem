<?php
include '../config/db_config.php';
include '../utils/session.php';
checkRole('Admin');

$courseID = $_GET['CourseID'];

// Fetch the current course information
$stmt = $pdo->prepare("SELECT * FROM Courses WHERE CourseID = ?");
$stmt->execute([$courseID]);
$course = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $courseName = $_POST['course_name'];
    $courseCode = $_POST['course_code'];
    $credits = $_POST['credits'];

    // Update course information
    $stmt = $pdo->prepare("UPDATE courses SET CourseName = ?, CourseCode = ?, credits = ? WHERE CourseID = ?");
    $stmt->execute([$courseName, $courseCode, $credits, $CourseID]);

    header("Location: manage_courses.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Course</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="../public/images/log2_2.png">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: Arial, sans-serif;
        }
        .form-container {
            max-width: 500px;
            margin: 3rem auto;
            background-color: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-container h2 {
            color: #007bff;
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .form-container .form-group label {
            font-weight: bold;
            color: #333;
        }
        .form-container .form-control {
            border-radius: 0.5rem;
            border: 1px solid #ced4da;
        }
        .form-container .form-control:focus {
            box-shadow: none;
            border-color: #007bff;
        }
        .form-container .btn-submit {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
            border-radius: 0.5rem;
            padding: 0.5rem 1rem;
            width: 100%;
        }
        .form-container .btn-submit:hover {
            background-color: #0056b3;
        }
        .form-container .btn-cancel {
            text-align: center;
            display: block;
            color: #007bff;
            margin-top: 1rem;
            font-weight: bold;
        }
        .form-container .btn-cancel:hover {
            text-decoration: underline;
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Edit Course Information</h2>
        <form method="post" action="edit_course.php?course_id=<?php echo $courseID; ?>">
            
            <div class="form-group">
                <label for="course_name">Course Name</label>
                <input type="text" class="form-control" name="course_name" id="course_name" 
                       value="<?php echo htmlspecialchars($course['CourseName']); ?>" required>
            </div>

            <div class="form-group">
                <label for="course_code">Course Code</label>
                <input type="text" class="form-control" name="course_code" id="course_code" 
                       value="<?php echo htmlspecialchars($course['CourseCode']); ?>" required>
            </div>

            <div class="form-group">
                <label for="credits">Credits</label>
                <input type="number" class="form-control" name="credits" id="credits" 
                       value="<?php echo $course['credits']; ?>" required min="1" max="5">
            </div>

            <button type="submit" class="btn btn-submit">Update Course</button>
            <a href="manage_courses.php" class="btn btn-cancel">Cancel</a>
        </form>
        
        
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
