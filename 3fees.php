<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nanokids"; // Change to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$fees_records = [];
$message = "";

// Handle form submission to record fees
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['record_fees'])) {
    $name = $_POST['name'];
    $paid = $_POST['paid'];
    $dop = $_POST['dop'];

    // Insert the fees record
    $insert_sql = "INSERT INTO fees (name, paid, dop) 
                   VALUES ('$name', '$paid', '$dop')";
    
    if ($conn->query($insert_sql) === TRUE) {
        $message = "Fees recorded successfully!";
    } else {
        $message = "Error: " . $conn->error;
    }
}

// Fetching fees records
$sql = "SELECT * FROM fees ORDER BY dop DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $fees_records[] = $row;
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
          <a class="a nav-link " href="3fees.php">FEES</a>
          </li>
          </li>
          <li class="nav-item"></li>
          <a class="nav-link " href="3book.php">TOUR</a>
          </li>
        </ul>
        <form class="d-flex">
          <a class="btn1 text-center" href="2logout.php" role="button">LOGOUT</a>
        </form>
      </div>
    </div>
  </nav>
    <!---------------------- NAVBAR ------------------------->

    <h1>FEE PAYMENT</h1>
    <div class="fee container">
    
    <!-- Form to record fees -->
    <form method="POST" action="3fees.php">
        <div class="row">
            <div class="col"><center>
        <label for="name">NAME : </label>
        <input type="text" name="name" required><br><br>
        </center></div>
        <div class="col"><center>
        <label for="paid">AMOUNT : </label>
        <input type="number" name="paid" step="0.01" required><br><br>
        </center></div>
        <div class="col"><center>
        <label for="dop">DATE : </label>
        <input type="date" name="dop" required><br><br>
        </center></div>
        </div>

        <center><input class="btn btn-primary" type="submit" name="record_fees" value="RECORD PAYMENT"></center>
    </form>

    <br>
    <p><?php echo $message; ?></p>

    <!-- Display fees records -->
    <center><h2>FEES RECORD</h2></center><br>
    <center>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Amount Paid</th>
            <th>Date of Payment</th>
        </tr>
        <?php foreach ($fees_records as $record): ?>
            <tr>
                <td><?php echo $record['name']; ?></td>
                <td><?php echo $record['paid']; ?></td>
                <td><?php echo $record['dop']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    </center>
    </div>

</body>
</html>

<?php
$conn->close();
?>
