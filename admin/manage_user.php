<?php
include ('../config/db_config.php');
include ('../utils/session.php');
CheckRole('Admin');
$stmt = $pdo->query("SELECT * FROM users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="../public/images/log2_2.png">
</head>
<body>
    <header>
        <nav>
            <a href="dashboard.php">Dashboard</a>
            <a href="add_user.php">Add Users</a>
        </nav>
    </header>
    <h2>Manage Users</h2>
    <table>
        <tr>
            <th>
                User ID
            </th>
            <th>
                User Name
            </th>
            <th>
                User Type
            </th>
            <th>
                Action
            </th>
        </tr>
        <?php foreach($users as $user):?>
            <tr>
                <td>
                    <?php echo $user['userID']; ?>
                </td>
                <td>
                    <?php echo htmlspecialchars($user['username']);?>
                </td>
                <td>
                    <?php echo htmlspecialchars($user['usertype']);?>
                </td>
                <td>
                    <a href="edit_user.php?userID=<?php echo $user['userID']; ?>">Edit</a>
                    <a href="delete_user.php?userID=<?php echo $user['userID']; ?>">Delete</a>
                </td>
         </tr>
         <?php endforeach; ?>;
    </table>
</body>
</html>