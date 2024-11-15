<?php
include '../utils/session.php';
include '../config/db_config.php';
CheckRole('Admin');

// Handle deletion if requested
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $stmt = $pdo->prepare("DELETE FROM notice WHERE ID = ?");
    $stmt->execute([$delete_id]);
    header("Location: manage_notices.php?notice_deleted=success");
    exit;
}

// Fetch all notices
$stmt = $pdo->prepare("SELECT * FROM notice ORDER BY ID DESC");
$stmt->execute();
$notices = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Notices</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../public/images/log2_2.png">
    <style>
        /* General page styling */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f6f9;
    color: #333;
    margin: 0;
    padding: 0;
}

/* Container */
.container {
    max-width: 800px;
    margin: 50px auto;
    padding: 20px;
    background: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

/* Page title */
h2 {
    color: #333;
    font-size: 24px;
    font-weight: 600;
    text-align: center;
    margin-bottom: 20px;
}

/* Add button styling */
.btn-primary {
    background-color: #4CAF50;
    border: none;
    color: #fff;
    font-size: 14px;
    font-weight: 600;
    padding: 10px 15px;
    border-radius: 4px;
    transition: background-color 0.3s ease;
}

.btn-primary:hover {
    background-color: #45a049;
}

/* Table styling */
.table-responsive {
    border-radius: 6px;
    overflow: hidden;
    background-color: #fff;
}

table.table {
    width: 100%;
    border-collapse: collapse;
}

.table thead {
    background-color: #333;
    color: #fff;
}

.table thead th {
    padding: 12px;
    text-align: left;
    font-size: 16px;
}

.table tbody tr {
    transition: background-color 0.2s ease;
}

.table tbody tr:hover {
    background-color: #f1f1f1;
}

.table tbody td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
    font-size: 14px;
}

/* Delete button styling */
.btn-danger {
    background-color: #e74c3c;
    color: #fff;
    border: none;
    padding: 6px 12px;
    border-radius: 4px;
    font-size: 14px;
    font-weight: 600;
    transition: background-color 0.3s ease;
}

.btn-danger:hover {
    background-color: #c0392b;
}

/* Alert message styling */
.alert {
    font-size: 14px;
    color: #4CAF50;
    background-color: #e9f5e9;
    border: 1px solid #4CAF50;
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 4px;
}

    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Manage Notices</h2>

        <?php if (isset($_GET['notice_deleted'])): ?>
            <div class="alert alert-success">Notice deleted successfully.</div>
        <?php endif; ?>

        <div class="d-flex justify-content-end mb-3">
            <a href="add_notice.php" class="btn btn-primary">Add New Notice</a>
        </div>
        <div class="d-flex justify-content-start mb-3">
            <a href="dashboard.php" class="btn btn-primary">Back To Dashboard</a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Message</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($notices)): ?>
                        <tr>
                            <td colspan="3" class="text-center">No notices found.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($notices as $notice): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($notice['ID']); ?></td>
                                <td><?php echo htmlspecialchars($notice['Message']); ?></td>
                                <td>
                                    <a href="manage_notices.php?delete_id=<?php echo $notice['ID']; ?>" 
                                       onclick="return confirm('Are you sure you want to delete this notice?');" 
                                       class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <div class="col-md-12">

                    </div>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
