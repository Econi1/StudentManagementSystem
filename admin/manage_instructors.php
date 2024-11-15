<?php
include ('../config/db_config.php');
include ('../utils/session.php');
CheckRole('Admin');
$stmt = $pdo->query("SELECT * FROM intructors");
$instructors = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Instructors</title>
     <link rel="stylesheet" href="css/style.css">
     <link rel="icon" type="image/x-icon" href="../public/images/log2_2.png">
</head>
<body>
    <header>
        <nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="add_instructor.php">Add Instructor</a>
        <a href="assign_instructor.php">Assign Instructor</a>
        </nav>
    </header>
    
    <h2>Manage Instructors</h2>
    
    <table>
        <tr>
            <th>
                Instructor ID
            </th>
            <th>
                Name
            </th>
            <th>
                Telephone
            </th>
            <th>
                Email
            </th>
            <th>
                Photo
            </th>
            <th>
                Action
            </th>
        </tr>
       <?php foreach($instructors as $instructor): ?>
        <tr>
            <td><?php echo $instructor['InstructorID']; ?></td>
            <td>
                <?php echo htmlspecialchars($instructor['Fname'].' '. $instructor['Lname']);?>
            </td>
            <td>
                <?php echo htmlspecialchars($instructor['Telephone']);?>
            </td>
            <td>
                <?php echo htmlspecialchars($instructor['Email']);?>
            </td>
            <td>
                

            </td>
            <td>
            <a href="edit_instructor.php?InstructorID=<?php echo $instructor['InstructorID'];?>">Edit Instructors</a>
            <a href="delete_instructor.php?InstructorID=<?php echo $instructor['InstructorID']; ?>" onclick="return confrim('Are you sure!')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>