<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nanokids";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch students from the register table
$sql = "SELECT name FROM register";
$result = $conn->query($sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'];

    // Loop through the submitted attendance for each student
    foreach ($_POST['attendance'] as $name => $attendance_status) {
        $name = $conn->real_escape_string($name);
        $attendance_status = $conn->real_escape_string($attendance_status);
        
        // Insert the attendance record
        $insert_sql = "INSERT INTO attendance (name, date, attendance) 
                       VALUES ('$name', '$date', '$attendance_status')";
        $conn->query($insert_sql);
    }

    echo "Attendance recorded successfully!";
}
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <!-- CSS Link-->
  <link rel="stylesheet" href="3attendance.css">

  <title>NANO KIDS</title>
</head> 

<body>
  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

  <!---------------------- NAVBAR ------------------------->

  <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
      <img class="logo" src="assets/logo.png" />
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
        aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarScroll">
        <ul class="navbar-nav m-auto my-2 my-lg-0 ">
          <li class="nav-item">
            <a class="nav-link" href="3admin.php">ADMIN</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="3admission.php">REGISTRATION</a>
          </li>
          <li class="nav-item dropdown">
          <a class="a nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            ATTENDANCE
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="3attendance.php">DAILY ATTENDANCE</a></li>
            <li><a class="dropdown-item" href="3month.php">MONTHLY REPORT</a></li>
          </ul>
        </li>
          <li class="nav-item"></li>
          <a class="nav-link " href="3fees.php">FEES</a>
          </li>
        </ul>
        <form class="d-flex">
          <a class="btn1 text-center" href="2logout.php" role="button">LOGOUT</a>
        </form>
      </div>
    </div>
  </nav>
    <!---------------------- NAVBAR ------------------------->

<h1>ATTENDANCE</h1>
<div class="att container">
    <center>
    <form method="POST" action="">
        <label for="date">DATE:</label>
        <input type="date" name="date" required><br><br>

        <table border="1">
            <tr>
                <th>Name</th>
                <th>Present</th>
                <th>Absent</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td><input type='radio' name='attendance[" . $row['name'] . "]' value='Present' required></td>";
                    echo "<td><input type='radio' name='attendance[" . $row['name'] . "]' value='Absent' required></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No students found in the register.</td></tr>";
            }
            ?>
        </table>
        <br>
        <input class="btn btn-primary" type="submit" value="RECORD">
    </form>
    </center>
    <?php
    $conn->close();
    ?>
</div>    
</body>
</html>