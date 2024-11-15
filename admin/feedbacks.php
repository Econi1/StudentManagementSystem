<?php
include '../config/db_config.php';
include '../utils/session.php';
$stmt = $pdo->query("SELECT SenderID,Subject,Message,Times from feedbacks");
$stmt->execute();
$feedbacks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>feedbacks</title>
    
</head>
<body>
    <table>
        <tr>
            <th>
                Sender Id
            </th>
            <th>
                Subject
            </th>
            <th>
                Message
            </th>
            <th>
                Time
            </th>
            <th>
                Action
            </th>
        </tr>
        <?php foreach($feedbacks as $feedback): ?>
            <tr>
                <td>
                    <?php echo htmlspecialchars($feedback['SenderID']);?>
                </td>
                <td>
                    <?php echo htmlspecialchars($feedback['Subject']);?>
                </td>
                <td>
                    <?php echo htmlspecialchars($feedback['Message']);?>
                </td>
                <td>
                    <?php echo htmlspecialchars($feedback['Times']);?>
                </td>
            </tr>
            
            <?php endforeach;?>
    </table>
    
</body>
</html>