<?php
include '../config/db_config.php';
include '../utils/session.php';
checkRole('Admin');
$id = $_GET['EnrolmentID'];
if (!$id) {
    echo "EnrollmentID not provided in the URL.";
    exit;
}

// Fetch the instructor to confirm they exist before attempting to delete
$stmt = $pdo->prepare("SELECT * FROM enrolment WHERE EnrolmentID = ?");
$stmt->execute([$id]);
$enrollment = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$enrollment) {
    echo "No Enrollment found with ID: " . htmlspecialchars($id);
    exit;
}

$stmt = $pdo->prepare("DELETE FROM enrolment WHERE EnrolmentID = ?");
if ($stmt->execute([$id])) {
    header("Location: manage_enrollments.php");
    exit;
} else {
    echo "Failed to delete instructor.";
    var_dump($stmt->errorInfo()); // Show error info if query failed
    exit;
}
?>
?>