<?php
include '../config/db_config.php';
include '../utils/session.php';
checkRole('Admin');

$stmt = $pdo->query("SELECT * FROM feedbacks");
$feedbacks = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $feedbackID = $_POST['feedbackID'];
    $status = $_POST['status'];

    $stmt = $pdo->prepare("UPDATE feedbacks SET Status = ? WHERE ID = ?");
    $stmt->execute([$status, $feedbackID]);
    echo "Feedback status updated!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Feedbacks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../public/images/log2_2.png">
</head>
<body>
<div class="container mt-5">
    <h2>Feedbacks</h2>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Sender ID</th>
            <th>Subject</th>
            <th>Message</th>
            <th>Time</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($feedbacks as $feedback): ?>
            <tr>
                <td><?php echo $feedback['ID']; ?></td>
                <td><?php echo $feedback['SenderID']; ?></td>
                <td><?php echo htmlspecialchars($feedback['Subject']); ?></td>
                <td><?php echo htmlspecialchars($feedback['Message']); ?></td>
                <td><?php echo $feedback['Times']; ?></td>
                <td><?php echo htmlspecialchars($feedback['Status']); ?></td>
                <td>
                    <form method="post" class="d-inline">
                        <input type="hidden" name="feedbackID" value="<?php echo $feedback['ID']; ?>">
                        <select name="status" class="form-select mb-2">
                            <option value="pending" <?php if ($feedback['Status'] == 'pending') echo 'selected'; ?>>Pending</option>
                            <option value="approved" <?php if ($feedback['Status'] == 'approved') echo 'selected'; ?>>Approved</option>
                            <option value="rejected" <?php if ($feedback['Status'] == 'rejected') echo 'selected'; ?>>Rejected</option>
                        </select>
                        <button type="submit" class="btn btn-success btn-sm">Update</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div class="row">
        <div class="col-md-12">

                <a href="dashboard.php" class="btn btn-primary">Back to Dashboard</a></a>
        </div>

    </div>
</div>
</body>
</html>
