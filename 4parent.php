<?php
session_start(); // Start session to use session variables

// Database connection
$servername = "localhost"; // Change if necessary
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "nanokids"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming user is logged in and email is stored in session
$email = $_SESSION['email']; // Make sure to set this after login

// Fetch announcements and syllabus
$sql = "SELECT announcement, syllabus FROM announcements ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$currentAnnouncement = $row['announcement'] ?? 'No announcement available.';
$currentSyllabus = $row['syllabus'] ?? 'No syllabus available.';

// Fetch child name from signin table
$sql = "SELECT child FROM signin WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($childName);
$stmt->fetch();
$stmt->close();

// Fetch fee status
$sql = "SELECT paid, dop FROM fees WHERE name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $childName);
$stmt->execute();
$result = $stmt->get_result();

$feesPaid = false;
$feeDetails = [];
if ($result->num_rows > 0) {
    while ($feeRow = $result->fetch_assoc()) {
        $feesPaid = true; // If any record exists, fees are paid for that month
        $feeDetails[] = [
            'amount' => $feeRow['paid'],
            'dop' => $feeRow['dop']
        ];
    }
} else {
    $feeDetails = [
        'amount' => 'Not paid',
        'dop' => 'N/A'
    ];
}

$stmt->close();
$conn->close();
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
  <link rel="stylesheet" href="4parent.css">

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
              <form class="d-flex">
          <a class="btn1 text-center" href="2logout.php" role="button">LOGOUT</a>
        </form>
      </div>
  </nav>
    <!---------------------- NAVBAR ------------------------->
    <h1 class="head text-center mt-7">WELCOME, <?php echo htmlspecialchars($childName); ?>PARENT</h1>
    <div class="container">

    <div class="ann card">
        <div class="card-body">
            <h2>Announcement</h2>
            <p><?php echo htmlspecialchars($currentAnnouncement); ?></p>
        </div>
    </div>

    <div class="ann card">
        <div class="card-body">
            <h2>Syllabus</h2>
            <p><?php echo htmlspecialchars($currentSyllabus); ?></p>
        </div>
    </div>

    <div class="ann card">
        <div class="card-body">
            <h2>Fee Status</h2>
            <?php if ($feesPaid): ?>
                <p>Fees Paid:</p>
                <ul>
                    <?php foreach ($feeDetails as $fee): ?>
                        <li>Amount: <?php echo htmlspecialchars($fee['amount']); ?> on <?php echo htmlspecialchars($fee['dop']); ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Fees Status: Not Paid</p>
            <?php endif; ?>
        </div>
    </div>
<div class="live"><center>
    <div id="videoContainer">
        <h2>LIVE VIDEO FEED</h2>
        <video id="video" autoplay></video></div></center>
    </div>
   </div>
   </div>

<script>
    // Access the webcam
    const video = document.getElementById('video');
    navigator.mediaDevices.getUserMedia({ video: true })
        .then(stream => {
            video.srcObject = stream;
        })
        .catch(err => {
            console.error("Error accessing webcam: " + err);
        });
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
 

</body>
</html>

