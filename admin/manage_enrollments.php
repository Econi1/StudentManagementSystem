<?php
include ('../config/db_config.php');
include ('../utils/session.php');
CheckRole('Admin');

$stmt = $pdo->query("SELECT e.EnrolmentID,s.StudentID,s.fname AS StudentFirstName,s.lname AS StudentLastName,c.coursename,e.EnrolmentDate 
FROM enrolment e JOIN Students s ON e.studentid=s.studentid JOIN courses c on e.courseid=c.courseid");
$enrollments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Enrollments</title>
    <link rel="icon" type="image/x-icon" href="../public/images/log2_2.png">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <nav>
        <a href="Dashboard.php">Dashboard</a>
        <a href="add_enrollment.php">Add New Enrollment</a>
        </nav>
    </header>
   
    <h2>Manage Enrollments</h2>
    <table>
        <tr>
            <th>
                Student ID
            </th>
            <th>
                Student Name
            </th>
            <th>
                Course Name
            </th>
            <th>
                Enrollment Date
            </th>
            <th>
                Action
            </th>
        </tr>
        <?php foreach($enrollments AS $enrollment): ?>
            <tr>
                <td>
                    <?php echo htmlspecialchars($enrollment['StudentID']);?>
                </td>
                <td> <?php echo htmlspecialchars($enrollment['StudentFirstName'].' '. $enrollment['StudentLastName']); ?>
                   
                </td>
                <td>
                    <?php echo htmlspecialchars($enrollment['coursename']); ?>
                </td>
                <td>
                    <?php echo $enrollment['EnrolmentDate']; ?>
                </td>
                <td>
                    <a href="edit_enrollment.php?EnrolmentID=<?php echo $enrollment['EnrolmentID'];?>">Edit</a>
                    <a href="delete_enrollment.php?EnrolmentID=<?php echo $enrollment['EnrolmentID'];?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
    </table>
    
</body>
</html> 