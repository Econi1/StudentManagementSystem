<?php
include ('../config/db_config.php');
include ('../utils/session.php');
CheckRole('Admin');
$stmt = $pdo->query("SELECT * FROM students");
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Student</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="../public/images/log2_2.png">
</head>
<body>
    <header>
        <nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="add_student.php">Add New Student</a>
        </nav>
    </header>

    <h2>Manage Student</h2>
    
    <table>
        <tr>
            <th>
                ID
            </th>
            <th>
                Name
            </th>
            <th>
                Email
            </th>
            <th>
                Telephone
            </th>
            <th>
                Gender
            </th>
            <th>
                Date of Birth
            </th>
            <th>
                Photo
            </th>
            <th>
                Action
            </th>
        </tr>
        <?php foreach($students as $student):?>
            <tr>
                <td>
                    <?php echo $student['StudentID']; ?>
                </td>
                <td>
                    <?php echo htmlspecialchars($student['Lname']. ' '. $student['Fname']);?>
                </td>
                <td>
                    <?php echo htmlspecialchars($student['Email']);?>
                </td>
                <td>
                    <?php echo $student['Telephone'];?>
                </td>
                <td>
                    <?php echo htmlspecialchars($student['Gender']);?>
                </td>
                <td>
                    <?php echo htmlspecialchars($student['DateofBirth']);?>
                </td>
                <td>
                    <?php echo htmlspecialchars($student['image']);?>
                </td>
                <td>
                    <a href="edit_student.php?StudentID=<?php echo $student['StudentID']; ?>">Update Student</a>
                </td>
            </tr>
            <?php endforeach; ?>
    </table>

</body>
</html>