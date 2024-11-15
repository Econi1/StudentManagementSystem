<?php
include '../config/db_config.php';
include '../utils/session.php';
checkRole('Admin');

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

$id = $_GET['InstructorID'];
if (!$id) {
    echo "InstructorID not provided in the URL.";
    exit;
}

// Fetch the instructor to confirm they exist before attempting to delete
$stmt = $pdo->prepare("SELECT * FROM intructors WHERE InstructorID = ?");
$stmt->execute([$id]);
$instructor = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$instructor) {
    echo "No instructor found with ID: " . htmlspecialchars($id);
    exit;
}

// Delete the instructor
$stmt = $pdo->prepare("DELETE FROM intructors WHERE InstructorID = ?");
if ($stmt->execute([$id])) {
    header("Location: manage_instructors.php");
    exit;
} else {
    echo "Failed to delete instructor.";
    var_dump($stmt->errorInfo()); // Show error info if query failed
    exit;
}
?>
