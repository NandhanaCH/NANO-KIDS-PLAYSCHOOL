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

// Initialize variables
$attendance_summary = [];
$total_classes = 0;
$present_days = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $month = $_POST['month']; // Format: YYYY-MM
    $student_name = $_POST['student_name'];

    // Query to get attendance records for the selected student and month
    $sql = "SELECT date, attendance 
            FROM attendance 
            WHERE DATE_FORMAT(date, '%Y-%m') = '$month' AND name = '$student_name' 
            ORDER BY date ASC";

    $result = $conn->query($sql);

    // Count present days
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $attendance_summary[] = $row;
            if ($row['attendance'] === 'Present') {
                $present_days++;
            }
        }
    }

    // Query to get total classes in the selected month
    $total_classes_query = "SELECT COUNT(DISTINCT date) as total_classes 
                            FROM attendance 
                            WHERE DATE_FORMAT(date, '%Y-%m') = '$month'";

    $total_classes_result = $conn->query($total_classes_query);
    if ($total_classes_result->num_rows > 0) {
        $total_classes_row = $total_classes_result->fetch_assoc();
        $total_classes = $total_classes_row['total_classes'];
    }
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

    <h1>MONTHLY ATTENDANCE REPORT</h1>
    
    <div class="mon container">    
    <form method="POST" action="3month.php">
        <div class="row">
            <div class="col"><center>
        <label for="month">SELECT MONTH : </label>
        <input type="month" name="month" required>
        </center></div>
        <div class="col"> <center>       
        <label for="student_name">SELECT STUDENT : </label>
        <select name="student_name" required>
            <?php
            // Fetch student names from the register table for dropdown
            $student_query = "SELECT name FROM register";
            $student_result = $conn->query($student_query);

            if ($student_result->num_rows > 0) {
                while ($row = $student_result->fetch_assoc()) {
                    echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
                }
            }
            ?>
        </select>
        </center></div>
        <div class="col"><center>
        <input class="btn btn-primary" type="submit" value="VIEW REPORT">
        </center></div>
        </div>
    </form>

    <br>

    <!-- Display attendance summary -->
    <?php if (!empty($attendance_summary)): ?>
        <h2>Attendance Summary for <?php echo $student_name; ?></h2>
        <p>Total Classes in Month: <?php echo $total_classes; ?></p>
        <p>Days Present: <?php echo $present_days; ?></p>

        <center><table border="1">
            <tr>
                <th>Date</th>
                <th>Attendance</th>
            </tr>
            <?php foreach ($attendance_summary as $record): ?>
                <tr>
                    <td><?php echo $record['date']; ?></td>
                    <td><?php echo $record['attendance']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table></center>
    <?php endif; ?>
</div>

</body>
</html>

<?php
$conn->close();
?>
