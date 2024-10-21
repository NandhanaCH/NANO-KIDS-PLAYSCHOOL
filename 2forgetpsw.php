<?php
// Database connection
$host = 'localhost';
$db = 'nanokids';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    
    // Check if email exists
    $sql = "SELECT * FROM signin WHERE email = '$email'";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        
        // Generate a unique reset token
        $token = bin2hex(random_bytes(50));
        $expiry = date('Y-m-d H:i:s', strtotime('+1 hour')); // Token expires in 1 hour

        // Save the token and expiry to the database
        $update_sql = "UPDATE signin SET reset_token = '$token', token_expiry = '$expiry' WHERE email = '$email'";
        if ($conn->query($update_sql)) {
            // Send the reset link to the user's email
            $reset_link = "http://yourdomain.com/reset_password.php?token=$token";
            $subject = "Password Reset Request";
            $message = "Click the following link to reset your password: $reset_link";
            $headers = "From: no-reply@yourdomain.com";

            if (mail($email, $subject, $message, $headers)) {
                echo "A password reset link has been sent to your email.";
            } else {
                echo "Failed to send reset link. Please try again.";
            }
        }
    } else {
        echo "Email does not exist!";
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="2login.css">
</head>
<body>
<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="box col-md-4 mt-5">
                <img src="assets/logo.png"/>            
                <h2 class="text-center">Forgot Password</h2>
                <form name="form" action="2forgetpsw.php" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Email:</label>
                        <input type="text" class="form-control" name="email" placeholder="Enter Email">
                    </div>                    
                    <button type="submit" class="btn w-100" name="submit">Send Reset Link</button>
                </form>
               
            </div>
        </div>
    </div>
    
</body>
</html>
