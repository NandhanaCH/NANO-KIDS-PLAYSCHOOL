<?php
    session_start();
    if(isset($_SESSION['username'])){
        header("Location: 1main.php");
    }
?>
<?php
    include("2connect.php");
    if(isset($_POST['submit'])){
        $child = $_POST['child'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        
        $sql="select * from signin where child='$child'";
        $result = mysqli_query($conn, $sql);
        $count_user = mysqli_num_rows($result);

        $sql="select * from signin where email='$email'";
        $result = mysqli_query($conn, $sql);
        $count_email = mysqli_num_rows($result);

        if($count_user == 0 & $count_email==0){
            if($password==$cpassword){
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO signin(child, email, password) VALUES('$child', '$email', '$hash')";
                $result = mysqli_query($conn, $sql);
                if($result){
                    echo '<script>
                alert("Signed in Successfully");
                window.location.href = "1main.php";
            </script>';
                  }               
            }
            else{
                echo '<script>
                    alert("Passwords do not match");
                    window.location.href = "2signup.php";
                </script>';
            }
        }
        else{
            if($count_user>0){
                echo '<script>
                    window.location.href="2login.php";
                    alert("Username already exists!!");
                </script>';
            }
            if($count_email>0){
                echo '<script>
                    window.location.href="2login.php";
                    alert("Email already exists!!");
                </script>';
            }
        }
        
    }
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
        <div class="container">
            <div class="row justify-content-center">
                <div class="box col-md-4">
                <img src="assets/logo.png"/>   
                    <h2 class="text-center"> Sign up</h2>
                    <form name="form" action="2signup.php" method="POST">
                        <div class="mb-3">
                            <label for="child" class="form-label">Child's Name:</label>
                            <input type="text" class="form-control" name="child" placeholder="Enter name">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" class="form-control" name="password" placeholder="Enter username">
                        </div>
                        <div class="mb-3">
                            <label for="cpassword" class="form-label">Confirm Password:</label>
                            <input type="password" class="form-control" name="cpassword" placeholder="Enter password">
                        </div>
                        <button type="submit" class="btn btn-primary w-100" name="submit">Sign up</button>
                    </form>
                    <p class="text-center mt-3">Already have an account? <a href="2login.php">Login</a><br>
                    <a  href="1main.php">Go Back</a></p>
                </div>
            </div>
        </div>
    </body>
    </html>