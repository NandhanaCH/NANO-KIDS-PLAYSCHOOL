<?php
// Database connection (modify credentials as per your database)
$host = 'localhost';
$db = 'nanokids';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assume the reset token is passed via URL as a query parameter (e.g., ?token=exampletoken)
$token = $_GET['token'];

// Find the user with the provided reset token
$sql = "SELECT * FROM users WHERE reset_token = '$token'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        if ($new_password == $confirm_password) {
            // Hash the new password before saving to the database
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Update the password in the database
            $update_sql = "UPDATE signin SET password = '$hashed_password', reset_token = NULL WHERE id = " . $user['id'];
            
            if ($conn->query($update_sql) === TRUE) {
                echo "Your password has been reset successfully!";
            } else {
                echo "Error updating password: " . $conn->error;
            }
        } else {
            echo "Passwords do not match!";
        }
    }
} else {
    echo "Invalid or expired reset token!";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="2login.css">
</head>
<body>
<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="box col-md-4 mt-5">
                <img src="assets/logo.png"/>            
                <h2 class="text-center">LOGIN</h2>
                <form name="form" action="2reset.php" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">New Password:</label>
                        <input type="text" class="form-control" name="new" placeholder="Enter Email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Confirm Password:</label>
                        <input type="password" class="form-control" name="confirm" placeholder="Enter password">
                    </div>
                    <button type="submit" class="btn w-100" name="submit">Reset Password</button>
                </form>
               
            </div>
        </div>
    </div>
    
</body>
</html>
