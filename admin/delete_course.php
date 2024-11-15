<?php
include('../config/db_config.php');
include('../utils/session.php');
CheckRole('Admin');
$courseid = $_GET['course_id'];
$stmt = $pdo->prepare("DELETE FROM courses where courseid = ?");
$stmt->execute([$courseid]);
header("Location: manage_course.php");
exit;
?>