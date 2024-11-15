<?php
include '../config/db_config.php';
include '../utils/session.php';
checkRole('Admin');

$studentID = $_GET['StudentID'];

// Fetch the current student information
$stmt = $pdo->prepare("SELECT * FROM Students WHERE StudentID = ?");
$stmt->execute([$studentID]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = htmlspecialchars($_POST['first_name']);
    $lastName = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $address = htmlspecialchars($_POST['address']);
    $dob = htmlspecialchars($_POST['dob']);
    $gender = htmlspecialchars($_POST['gender']);

    // Update student information
    $stmt = $pdo->prepare("UPDATE Students SET Fname = ?, Lname = ?, Email = ?, Telephone = ?, Address = ?, DateofBirth = ?, Gender = ? WHERE StudentID = ?");
    $stmt->execute([$firstName, $lastName, $email, $phone, $address, $dob, $gender, $studentID]);
    $stmt1 = $pdo->prepare("UPDATE users SET email = ? WHERE StudentID = ?");
    $stmt1->execute([$email, $studentID]);

    header("Location: manage_students.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/styles.css">
    <link rel="icon" type="image/x-icon" href="../public/images/log2_2.png">
    <style>
        body {
            background-image: url("../public/images/shape.png");
            font-family: Arial, sans-serif;
        }
        .form-container {
            max-width: 600px;
            margin: 3rem auto;
            background-color: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-container h2 {
            color: #007bff;
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .form-container .form-group label {
            font-weight: bold;
            color: #333;
        }
        .form-container .form-control,
        .form-container .form-select {
            border-radius: 0.5rem;
            border: 1px solid #ced4da;
        }
        .form-container .form-control:focus,
        .form-container .form-select:focus {
            box-shadow: none;
            border-color: #007bff;
        }
        .form-container .btn-submit {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
            border-radius: 0.5rem;
            padding: 0.5rem 1rem;
            width: 100%;
        }
        .form-container .btn-submit:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Edit Student Information</h2>
        <form method="post" action="edit_student.php?StudentID=<?php echo $studentID; ?>">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" name="first_name" id="first_name"
                       value="<?php echo htmlspecialchars($student['Fname']); ?>" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" name="last_name" id="last_name"
                       value="<?php echo htmlspecialchars($student['Lname']); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email"
                       value="<?php echo htmlspecialchars($student['Email']); ?>" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" class="form-control" name="phone" id="phone"
                       value="<?php echo htmlspecialchars($student['Telephone']); ?>" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" name="address" id="address"
                       value="<?php echo htmlspecialchars($student['Address']); ?>" required>
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth</label>
                <input type="date" class="form-control" name="dob" id="dob"
                       value="<?php echo $student['DateofBirth']; ?>" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <select class="form-select" name="gender" id="gender" required>
                    <option value="Male" <?php if ($student['Gender'] == 'Male') echo 'selected'; ?>>Male</option>
                    <option value="Female" <?php if ($student['Gender'] == 'Female') echo 'selected'; ?>>Female</option>
                    <option value="Other" <?php if ($student['Gender'] == 'Other') echo 'selected'; ?>>Other</option>
                </select>
            </div>
            <button type="submit" class="btn btn-submit">Update Student</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
