<?php
include ('../config/db_config.php');
include ('../utils/session.php');
CheckRole('Admin');
generateCSRFToken();
if($_SERVER['REQUEST_METHOD']==='POST'){
    if(VerifyCSRFToken($_POST['csrf_token'])){
        $stmt = $pdo->prepare("INSERT INTO STUDENTS (studentID,fname,lname,dateofbirth,gender,address,telephone,email,maritalstatus,Residentialtype,image) values
        (?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->execute([$_POST['studentid'],$_POST['firstname'],$_POST['lastname'],$_POST['dob'],$_POST['gender'],$_POST['address'],$_POST['telephone'],$_POST['email'],$_POST['maritalstatus'],$_POST['resident'],$_POST['image']]);
      
        $stmt = $pdo->prepare("INSERT INTO users (username,passwordhash,usertype,StudentID,email) values
        (?,?,?,?)");
         $plainpassword = $_POST['studentid'];
         $hashedpassword = password_hash($plainpassword,PASSWORD_BCRYPT);
         $usertype = 'Student';
        $stmt->execute([$_POST['studentid'],$hashedpassword,$usertype,$_POST['studentid'],$_POST['email']]);
        header("Location: manage_students.php");
        exit;
    }else{
        echo "Invalid CSRF Token";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <link rel="icon" type="image/x-icon" href="../public/images/log2_2.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            background-color: #f0f2f5;
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
        <h2>Add Student</h2>
        <form action="add_student.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

            <div class="form-group">
                <label for="studentid">Student ID</label>
                <input type="text" class="form-control" name="studentid" id="studentid" placeholder="MTBI/21/C/B/001" required>
            </div>
            
            <div class="form-group">
                <label for="firstname">First Name</label>
                <input type="text" class="form-control" name="firstname" id="firstname" placeholder="First Name" required>
            </div>

            <div class="form-group">
                <label for="lastname">Last Name</label>
                <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name" required>
            </div>

            <div class="form-group">
                <label for="dob">Date of Birth</label>
                <input type="date" class="form-control" name="dob" id="dob" required>
            </div>

            <div class="form-group">
                <label for="gender">Gender</label>
                <select class="form-select" name="gender" id="gender" required>
                    <option value="" disabled selected>--- Select Gender ---</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" name="address" id="address" placeholder="Address" required>
            </div>

            <div class="form-group">
                <label for="telephone">Telephone</label>
                <input type="tel" class="form-control" name="telephone" id="telephone" placeholder="+256711111111" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="example@gmail.com">
            </div>

            <div class="form-group">
                <label for="maritalstatus">Marital Status</label>
                <select class="form-select" name="maritalstatus" id="maritalstatus">
                    <option value="" disabled selected>Select Marital Status</option>
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Widow/widower">Widow/Widower</option>
                    <option value="Others">Others</option>
                </select>
            </div>

            <div class="form-group">
                <label for="residentialtype">Residential Type</label>
                <select class="form-select" name="residentialtype" id="residentialtype">
                    <option value="" disabled selected>--- Select Residential Type ---</option>
                    <option value="At Campus">Hostel</option>
                    <option value="Home">Home</option>
                    <option value="Renting">Rent</option>
                </select>
            </div>

            <div class="form-group">
                <label for="image">Passport Photo</label>
                <input type="file" class="form-control" name="image" id="image">
            </div>
            <div class="form-group">
            <button type="submit" class="btn btn-submit">Add Student</button>
            </div>
            <div class="form-group">
                <a href="manage_students.php" class="btn btn-primary w-100">Back to Manage Students</a>

            </div>
           
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            // Enhance file input display with Bootstrap
            $('#image').on('change', function () {
                const fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').addClass("selected").html(fileName);
            });
        });
    </script>
</body>
</html>
