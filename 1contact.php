<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = ""; // Your database password
$dbname = "nanokids"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $tour_date = $_POST['date']; // Format: YYYY-MM-DD

    // Prepare SQL statement
    $sql = "INSERT INTO tour (name, email, phone, date) VALUES (?, ?, ?, ?)";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind the parameters
    $stmt->bind_param("ssss", $name, $email, $phone, $tour_date);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Tour booking successfully recorded!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
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
  <link rel="stylesheet" href="1about.css">

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
            <a class="nav-link" href="1main.php">HOME</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="1about.php">ABOUT US</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="1program.php">PROGRAMS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="1gallery.php">GALLERY</a>
          </li>
          <li class="nav-item"></li>
          <a class="a nav-link " href="1contact.php">CONTACT US</a>
          </li>
        </ul>
        <form class="d-flex">
          <a class="btn1 text-center" href="2login.php" role="button">LOGIN</a>
        </form>
      </div>
    </div>
  </nav>
  
    <!---------------------- NAVBAR ------------------------->
<h1>CONTACT US</h1>
    <!---------------------- CONTACT US ------------------------->
  
    <div class="con container contact-section">
    <div class="row">
        <div class="col-md-6">
            <h2>Get In Touch</h2>
            <p>If you have any questions or would like to know more about Nano Kids Play School, feel free to reach out to us. You can also book a tour using the form below.</p>
            <div class="contact-info">
                <h4>Our Location:</h4>
                <p>No 26, Rainbow Flats, Thulassi Das Nagar,<br>Kumananchavadi, Chennai 600056,<br>Tamil Nadu, India</p>
                <p><strong>Phone:</strong> +91 98765 43210</p>
                <p><strong>Email:</strong> info@nanokidsplayschool.com</p>
            </div>
        </div>

        <div class="book col-md-6">
            <h2>Book a Tour</h2>
            <form action="1contact.php" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="tel" class="form-control" id="phone" name="phone" required>
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">Preferred Date for the Tour</label>
                    <input type="date" class="form-control" id="date" name="date" required>
                </div>
                <center><button type="submit" class="btn btn-custom">Book Tour</button></center>
            </form>
        </div>
    </div>

    <div class="row mt-5">
        <div class="maps col-12">
            <h3>Find Us on Google Maps</h3>
            <center><iframe class="map-container"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.966196202252!2d80.10671511462216!3d13.03983549081101!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a5260c54b8ed835%3A0x46dd4f6d11fa91aa!2sThulasi%20Das%20Nagar%2C%20Kumananchavadi%2C%20Chennai%2C%20Tamil%20Nadu%20600056!5e0!3m2!1sen!2sin!4v1697444974012!5m2!1sen!2sin" 
                allowfullscreen="" loading="lazy"></iframe></center>
        </div>
    </div>
</div>
<div class="last">
    <h2>hiii</h2>

</div>

</body>
</html>
