<?php
include ('../config/db_config.php');
include ('../utils/session.php');
CheckRole('Admin');
generateCSRFToken();
if($_SERVER['REQUEST_METHOD']==='POST'){
    if(VerifyCSRFToken($_POST['csrf_token'])){
        $stmt = $pdo->prepare("INSERT INTO COURSES (CourseName,CourseCode,creditS) values
        (?,?,?)");
        $stmt->execute([$_POST['course'],$_POST['code'],$_POST['credit']]);
        header("Location: manage_courses.php");
        exit;
    }else{
        echo "Invalid CSRF Token";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course</title>
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

.form-control,
.form-select {
    height: 45px;
    padding: 10px;
    font-size: 1rem;
    border-radius: 5px;
    border: 1px solid #ced4da;
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.form-control:focus,
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
            <h2 class="text-center mb-4">Add Course</h2>
            <form action="add_course.php" method="post">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'];?>">
                
                <div class="mb-3">
                    <label for="course" class="form-label">Select Course</label>
                    <select name="course" id="course" class="form-select" required>
                        <option value="" disabled selected>Select Course</option>
                        <?php include ('partials/select_course.php'); ?>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="code" class="form-label">Course Code</label>
                    <input type="text" name="code" id="code" class="form-control" placeholder="D/C/01" required>
                </div>

                <div class="mb-3">
                    <label for="credit" class="form-label">Credit</label>
                    <input type="text" name="credit" id="credit" class="form-control" placeholder="Credit" required>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary w-100">Add Course</button>
                </div>
                <div class="text-center mt-4">
                    <a href="manage_courses.php" class="btn btn-primary w-100">Back to Manage Courses</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
