<?php
include ('../config/db_config.php');
include ('../utils/session.php');
CheckRole('Admin');
generateCSRFToken();
if($_SERVER['REQUEST_METHOD']==='POST'){
    if(VerifyCSRFToken($_POST['csrf_token'])){
        $stmt = $pdo->prepare("INSERT INTO users (username,passwordhash,usertype,email) values
        (?,?,?,?)");
         $plainpassword = $_POST['pass'];
         $hashedpassword = password_hash($plainpassword,PASSWORD_BCRYPT);
        $stmt->execute([$_POST['username'],$hashedpassword,$_POST['usertype'],$_POST['email']]);
        header("Location: manage_user.php");
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
    <title>Add User</title>
    <link rel="icon" type="image/x-icon" href="../public/images/log2_2.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Body and container styling */
body {
    background-color: #f8f9fa;
    font-family: Arial, sans-serif;
}

.container {
    max-width: 500px;
}

h2 {
    color: #343a40;
    font-weight: bold;
    margin-bottom: 20px;
}

/* Card styling */
.card {
    border-radius: 8px;
    padding: 20px;
    background-color: #ffffff;
}

/* Form label styling */
.form-label {
    font-weight: 600;
    color: #495057;
}

/* Form input styling */
.form-control, .form-select {
    border-radius: 5px;
    box-shadow: none;
    border: 1px solid #ced4da;
    transition: border-color 0.3s;
}

.form-control:focus, .form-select:focus {
    border-color: #80bdff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

/* Button styling */
.btn-primary {
    padding: 10px 20px;
    font-weight: bold;
    font-size: 16px;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.btn-primary:hover {
    background-color: #0056b3;
}

    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-body">
                <h2 class="text-center">Add User</h2>
                <form action="add_user.php" method="post">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'];?>">
                    
                    <div class="mb-3">
                        <label for="username" class="form-label">User Name</label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="User Name" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="pass" class="form-label">Password</label>
                        <input type="password" name="pass" id="pass" class="form-control" placeholder="Password" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="usertype" class="form-label">User Type</label>
                        <select name="usertype" id="usertype" class="form-select" required>
                            <option value="Admin">Admin</option> 
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>

                    </div>
                    
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Add User</button>
                    </div>
                    <div class="text-center mt-3">
                        <a href="manage_user.php" class="btn btn-primary">Back to Manage User</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
