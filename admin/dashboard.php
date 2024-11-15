<?php
include('../config/db_config.php');
include('../utils/session.php');
CheckRole('Admin');
$stmt = $pdo->prepare("SELECT * FROM notice ORDER BY ID DESC");
$stmt->execute();
$notices = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.1/css/boxicons.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"> <link rel="stylesheet" href="styles.css">
    <title>Admin Dashboard</title>
    <link rel="icon" type="image/x-icon" href="../public/images/log2_2.png">
</head>
<body>
    <div class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="dashboard.php">Admin Dashboard</a>
       
        <div class="collapse navbar-collapse" id="navbarNav">
        
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a href="search.php" class="nav-link"><i class='bx bx-search'></i> Search</a></li>
                <li class="nav-item"><a class="nav-link" href="feedbacks.php"><i class='bx bx-bell'></i> Notifications</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <i class='bx bx-user'></i> Profile
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">View Profile</a>
                        <a class="dropdown-item" href="#">Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../auth/logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="wrapper d-flex">
        <nav class="sidebar bg-dark text-white p-3">
            <header>
                <h3>Menu</h3>
            </header>
            <ul class="list-unstyled">
                <li><a href="manage_students.php"><i class='bx bx-user'></i> Manage Students</a></li>
                <li><a href="manage_courses.php"><i class='bx bx-book'></i> Manage Courses</a></li>
                <li><a href="manage_instructors.php"><i class='bx bx-chalkboard'></i> Manage Instructors</a></li>
                <li><a href="manage_enrollments.php"><i class='bx bx-calendar'></i> Manage Enrollments</a></li>
                <li><a href="manage_user.php"><i class='bx bx-user'></i> Manage Users</a></li>
                <li><a href="manage_notices.php"><i class='bx bx-note'></i> Manage Notices</a></li>
                <li><a href="admin_feedback_management.php"><i class='bx bx-message'></i> Manage Feedbacks</a></li>
                <li><a href="../auth/logout.php"><i class="bx bx-cog>"></i>Log Out</a></li>
            </ul>
            
        </nav>
        <div class="main-content flex-grow-1 p-3">
            <div class="container card-container" id="feature-cards">
                <div class="row g-5 show-cards">
                    <div class="col-12 col-md-4">
                        <div class="card border-0 shadow p-3 h-100">
                            <div class="py-3">
                                <h3 class="fs-4 justify-content-center">
                                    <span class="text-primary icon-hover"><i class='bx bxs-book'></i></span>
                                    Features
                                </h3>
                            </div>
                            <p>
                                A robust academic career is typically essential for securing financial stability, with
                                few exceptions. School provides opportunities to forge new friendships, with some
                                classmates evolving into lifelong companions.</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="card border-0 shadow p-3 h-100">
                            <div class="py-3">
                                <h3 class="fs-4">
                                    <span class="text-primary icon-hover"><i class='bx bxs-star-half'></i></span>
                                    Achievement
                                </h3>
                            </div>
                            <p>At the school awards, Students receive...</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="card border-0 shadow p-3 h-100">
                            <div class="py-3">
                                <h3 class="fs-4">
                                    <span class="text-primary icon-hover"><i class='bx bxs-notepad'></i></span>
                                    Notices
                                </h3>
                            </div>
                            <?php
                            foreach ($notices as $notice) {
                                echo '<p>' . $notice['Message'] . '</p>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="chart-container mt-3">
                <canvas id="studentsChart"></canvas>
            </div>
            <div class="chart-container mt-3">
                <canvas height="150" style="display: block;" id="instructorsChart"></canvas>
            </div>
            <div class="chart-container mt-3">
                <canvas id="coursesChart"></canvas>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="../public/js/bootstrap.bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="script.js"></script>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <!-- Insert website logo -->
                    <img src="../public/images/log2_2.png" alt="Website Logo">
                    <!-- Display visitor count -->
                    <p>MUKONO TECHNICAL BUSINESS INSTITUTE SCHOOL MANAGEMENT SYSTEM</p>
                    <!-- Display time zone -->
                    <p>Nakiwaate, Nakifuma, Mukono, Uganda</p>
                </div>
                <div class="col-md-4">
                    <p>Time Zone:
                        <?php
                        date_default_timezone_set('Africa/Kampala');
                        $current_time = date('D M d Y H:i:s \G\M\TO (T)');
                        echo "<p>$current_time</p>";
                        ?>
                    </p>
                </div>
                <div class="col-md-4">
                    <div class="footer-links">
                        <p>Follow us on</p>
                    </div>
                    <div class="social-icons">
                        <a href="https://www.facebook.com/econi.frank"><i class="fab fa-facebook-f facebook"></i></a>
                        <a href="https://x.com/@econi_frank"><i class="fa-brands fa-x-twitter twitter"></i>X</a>
                        <a href="https://www.instagram.com/econi.frank"><i class="fab fa-instagram instagram"></i></a>
                        <a href="https://www.linkedin.com/econifarnk"><i class="fab fa-linkedin-in linked-in"></i></a>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-12">
                    <p>&copy; 2024 - <?php echo date('Y'); ?> By <a href="https://www.github.com/econi1" target="_blank">Econi Frank</a>. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>
</html>
 