<?php
include ('../config/db_config.php');
include ('../utils/session.php');
CheckRole('Admin');
generateCSRFToken();
if($_SERVER['REQUEST_METHOD']==='POST'){
    if(VerifyCSRFToken($_POST['csrf_token'])){
        $stmt = $pdo->prepare("INSERT INTO intructors (InstructorID,Fname,Lname,Telephone,Email) values
        (?,?,?,?,?)");
        $stmt->execute([$_POST['instructorid'],$_POST['firstname'],$_POST['lastname'],$_POST['telephone'],$_POST['email']]);   

        $stmt1 = $pdo->prepare("INSERT INTO users (username,passwordhash,usertype,InstructorID,email) values
        (?,?,?,?)");
         $plainpassword = $_POST['instructorid'];
         $hashedpassword = password_hash($plainpassword,PASSWORD_BCRYPT);
         $usertype = 'Instructor';
         $stmt1->execute([$_POST['instructorid'],$hashedpassword,$usertype,$_POST['instructorid'],$_POST['email']]);
        header("Location: manage_instructors.php");
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
    <title>Add Instructor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../public/images/log2_2.png">
    <style>
        body {
    background-color: #f8f9fa;
    font-family: Arial, sans-serif;
}

.container {
    max-width: 600px;
}

.card {
    background: #ffffff;
    border-radius: 8px;
    padding: 2rem;
    border: none;
}

h2 {
    font-size: 1.75rem;
    font-weight: 700;
    color: #343a40;
}

.form-label {
    font-weight: 500;
    color: #495057;
}

.form-control {
    height: 45px;
    padding: 10px;
    font-size: 1rem;
    border-radius: 5px;
    border: 1px solid #ced4da;
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #80bdff;
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1), 0 0 6px rgba(0, 123, 255, 0.25);
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
    font-size: 1.1rem;
    font-weight: 500;
    padding: 10px;
    transition: background-color 0.3s ease;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #004085;
}

.text-center {
    text-align: center;
}

    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            <h2 class="text-center mb-4">Add Instructor</h2>
            <form action="add_instructor.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'];?>">
                
                <div class="mb-3">
                    <label for="instructorid" class="form-label">Instructor ID</label>
                    <input type="text" name="instructorid" id="instructorid" class="form-control" placeholder="MTBI/S/C001" required>
                </div>
                
                <div class="mb-3">
                    <label for="firstname" class="form-label">First Name</label>
                    <input type="text" name="firstname" id="firstname" class="form-control" placeholder="First Name" required>
                </div>

                <div class="mb-3">
                    <label for="lastname" class="form-label">Last Name</label>
                    <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Last Name" required>
                </div>

                <div class="mb-3">
                    <label for="telephone" class="form-label">Telephone</label>
                    <input type="tel" name="telephone" id="telephone" class="form-control" placeholder="+256711111111" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="example@gmail.com">
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Passport Photo</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary w-100">Add Instructor</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
