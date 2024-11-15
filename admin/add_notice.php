<?php
include '../utils/session.php';
include '../config/db_config.php';
CheckRole('Admin');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = trim($_POST['message']);

    // Insert the message into the notice table
    if (!empty($message)) {
        $stmt = $pdo->prepare("INSERT INTO notice (message) VALUES (?)");
        $stmt->execute([$message]);

        // Redirect to manage notices or display a success message
        header("Location: manage_notices.php?notice=success");
        exit;
    } else {
        $error = "Please enter a valid message.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Notice</title>
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

textarea.form-control {
    resize: vertical;
    font-size: 1rem;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ced4da;
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

textarea.form-control:focus {
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
            <h2 class="text-center mb-4">Add New Notice</h2>
            <?php if (isset($error)) : ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <form action="add_notice.php" method="post">
                
                <!-- Message Input -->
                <div class="mb-3">
                    <label for="message" class="form-label">Notice Message</label>
                    <textarea name="message" id="message" class="form-control" rows="4" placeholder="Enter your notice message here..." required></textarea>
                </div>

                <!-- Submit Button -->
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary w-100">Add Notice</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
