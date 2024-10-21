<?php
// Database connection parameters
$host = 'localhost'; // Your database host
$user = 'root'; // Your database username
$password = ''; // Your database password
$dbname = 'nanokids'; // Your database name

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the tour table
$sql = "SELECT name, email, phone, date FROM tour";
$result = $conn->query($sql);


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
  <link rel="stylesheet" href="3fees.css">

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
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
          </li>
          <li class="nav-item"></li>
          <a class="a nav-link " href="3book.php">TOUR</a>
          </li>
        </ul>
        <form class="d-flex">
          <a class="btn1 text-center" href="2logout.php" role="button">LOGOUT</a>
        </form>
      </div>
    </div>
  </nav>
    <!---------------------- NAVBAR ------------------------->

    <h1>TOUR ENQUIRIES</h1>
    <div class="fee container mt-5">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row["name"]) . "</td>
                            <td>" . htmlspecialchars($row["email"]) . "</td>
                            <td>" . htmlspecialchars($row["phone"]) . "</td>
                            <td>" . htmlspecialchars($row["date"]) . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No records found</td></tr>";
            }
            $conn->close(); // Close the database connection
            ?>
        </tbody>
    </table>
</div>
</body>
</html>


