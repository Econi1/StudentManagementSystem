<?php
include ('../config/db_config.php');
include ('../utils/session.php');
CheckRole('Admin');
$stmt = $pdo->query("SELECT * FROM courses");
$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Courses</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="../public/images/log2_2.png">
</head>
<body>
    <header>
        <nav>
            <a href="dashboard.php">Dashboard</a>
        <a href="add_course.php">Add New Course</a>
        </nav>
    </header>
    <h2>Manage Courses</h2>
   
    <table>
        <tr>
            
            <th>
                Course Name
            </th>
            <th>
                Course Code
            </th>
            <th>
                Credits
            </th>
            <th>
                Actions
            </th>
        </tr>
        <?php
        foreach($courses as $course):?>
        <tr>
            
            <td><?php echo htmlspecialchars($course['CourseName']);?></td>
            <td><?php echo htmlspecialchars($course['CourseCode']);?></td>
            <td><?php echo $course['credits'] ?></td>
            <td>
                <a href="edit_course.php?CourseID=<?php echo $course['CourseID'];?> ">Edit Course</a>
                <a href="delet_course.php?CourseID=<?php echo $course['CourseID'];?>" onclick="return confirm('Are you sure!')">Delete</a>
            </td>
            
        </tr>
        <?php endforeach; ?>
    </table>
    
</body>
</html>