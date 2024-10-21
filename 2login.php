<?php
    session_start();
    if(isset($_SESSION['username'])){
        header("Location: 1main.php");
    }
?>
<?php
    $login = false;
    $valid_email = 'nandhunah17@gmail.com';
    include('2connect.php');
    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        echo $password;
        if ($email === $valid_email) {
            $_SESSION['email'] = $email; // Store email in session
            header('Location: 3admin.php'); // Redirect to admin page
            exit();
        }
        $sql = "select * from signin where email = '$email'or password = '$password'";  
        $result = mysqli_query($conn, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  
        
        if($row){   
            echo $count;
            if(password_verify($password, $row["password"])){
                $login=true;
                session_start();

                $sql = "select child from signin where email = '$email'";     
                $r = mysqli_fetch_array(mysqli_query($conn, $sql), MYSQLI_ASSOC);  

                $_SESSION['username']= $r['username'];
                $_SESSION['loggedin'] = true;
                header("Location: 4parent.php");
            }
        }  
        else{  
            echo  '<script>
                        
                        alert("Login failed. Invalid username or password!!")
                        window.location.href = "2login.php";
                    </script>';
        }     
    }
    ?>
    <?php 
    include("2connect.php");
    ?>
    


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Playschool Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="2login.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="box col-md-4 mt-5">
                <img src="assets/logo.png"/>            
                <h2 class="text-center">LOGIN</h2>
                <form name="form" action="2login.php" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Email:</label>
                        <input type="text" class="form-control" name="email" placeholder="Enter Email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter password">
                    </div>
                    <button type="submit" class="btn w-100" name="submit">Login</button>
                </form>
               <center> <a href="2forgetpsw.php">Forgot Password?</a></center>
                <p class="text-center mt-3">Don't have an account? <a href="2signup.php">Sign up</a><br>
                <a  href="index.php">Go Back</a></p>
            </div>
        </div>
    </div>
</body>
</html>
