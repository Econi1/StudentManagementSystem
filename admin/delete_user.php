<?php
include '../config/db_config.php';
include '../utils/session.php';
checkRole('Admin');

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

$id = $_GET['userID'];
if (!$id) {
    echo "UserID not provided in the URL.";
    exit;
}

// Fetch the user to confirm it exists before attempting to delete
$stmt = $pdo->prepare("SELECT * FROM users WHERE userID = ?");
$stmt->execute([$id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "No user found with ID: " . htmlspecialchars($id);
    exit;
}

// Delete the user
$stmt = $pdo->prepare("DELETE FROM users WHERE userID = ?");
if ($stmt->execute([$id])) {
    header("Location: manage_user.php");
    exit;
} else {
    echo "Failed to delete user.";
    var_dump($stmt->errorInfo()); // Show error info if query failed
    exit;
}
?>
