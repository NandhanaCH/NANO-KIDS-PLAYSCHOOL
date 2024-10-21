<?php
session_start();
if (isset($_SESSION['username'])) {
    header("Location: 1main.php");
}

$servername = "localhost"; // Change if necessary
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "nanokids"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle announcement update
if (isset($_POST['update_announcement'])) {
    $announcement = $_POST['announcement'];

    // Update announcement
    $sql = "UPDATE announcements SET announcement = ? WHERE id = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $announcement);
    $stmt->execute();
    $stmt->close();
}

// Handle syllabus update
if (isset($_POST['update_syllabus'])) {
    $syllabus = $_POST['syllabus'];

    // Update syllabus
    $sql = "UPDATE announcements SET syllabus = ? WHERE id = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $syllabus);
    $stmt->execute();
    $stmt->close();
}

// Handle student details update
if (isset($_POST['update_student'])) {
    $name = $_POST['name'];
    $father = $_POST['father'];
    $mother = $_POST['mother'];
    $fno = $_POST['fno'];
    $mno = $_POST['mno'];
    $dob = $_POST['dob'];
    $doa = $_POST['doa'];
    $emergencyno = $_POST['emergencyno'];
    $address = $_POST['address'];
    $photo_filename = $_POST['existing_photo'];

    // Handle photo upload if a new photo is provided
    if (isset($_FILES['new_photo']) && $_FILES['new_photo']['error'] == UPLOAD_ERR_OK) {
        $photo_filename = "uploads/" . uniqid() . ".png";
        move_uploaded_file($_FILES['new_photo']['tmp_name'], $photo_filename);
    }

    // Update student details
    $sql = "UPDATE register SET father = ?, mother = ?, fno = ?, mno = ?, dob = ?, doa = ?, emergencyno = ?, address = ?, photo = ? WHERE name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $father, $mother, $fno, $mno, $dob, $doa, $emergencyno, $address, $photo_filename, $name);
    $stmt->execute();
    $stmt->close();
}

// Fetch current announcement and syllabus
$sql = "SELECT announcement, syllabus FROM announcements WHERE id = 1";
$result = $conn->query($sql);

$currentAnnouncement = '';
$currentSyllabus = '';

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $currentAnnouncement = $row['announcement'];
    $currentSyllabus = $row['syllabus'];
}

$sql = "SELECT id, name FROM register";
$result = $conn->query($sql);

$selected_id = isset($_POST['name']) ? $_POST['name'] : null;
$user_data = null;

if ($selected_id) {
    // Fetch user details based on selected name
    $stmt = $conn->prepare("SELECT * FROM register WHERE name = ?");
    $stmt->bind_param("s", $selected_id);
    $stmt->execute();
    $user_data = $stmt->get_result()->fetch_assoc();
}

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
    <link rel="stylesheet" href="3admin.css">

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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav m-auto my-2 my-lg-0 ">
                    <li class="nav-item">
                        <a class="a nav-link" href="3admin.php">ADMIN</a>
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
                </ul>
                <form class="d-flex">
                    <a class="btn1 text-center" href="2logout.php" role="button">LOGOUT</a>
                </form>
            </div>
        </div>
    </nav>
    <!---------------------- NAVBAR ------------------------->

    <!---------------------- ANNOUNCEMENT -------------------------> 
    <h1>ADMIN</h1>
    <div class="ann container mt-10">
        <div class="row">
            <div class="col">
                <h2>ANNOUNCEMENT</h2>
                <form action="3admin.php" method="post">
                    <div class="form-group">
                        <textarea name="announcement" rows="4" cols="50"><?php echo htmlspecialchars($currentAnnouncement); ?></textarea><br>
                    </div>
                    <input class="btn" type="submit" name="update_announcement" value="UPDATE">
                </form>
            </div>

            <div class="col">
                <h2>SYLLABUS</h2>
                <form action="3admin.php" method="post">
                    <div class="form-group">
                        <textarea name="syllabus" rows="4" cols="50"><?php echo htmlspecialchars($currentSyllabus); ?></textarea><br>
                    </div>
                    <input class="btn" type="submit" name="update_syllabus" value="UPDATE">
                </form>
            </div>
        </div>
    </div>

    <!---------------------- ANNOUNCEMENT ------------------------->

    <!---------------------- STUDENT DETAILS -------------------------> 
    <h1>STUDENT DETAILS</h1>
    <div class="std container mt-5">
        <form method="POST" class="mb-4">
            <div class="mb-3">
                <div class="select row">
                    <div class="col"><center>
                        <label for="name" class="form-label">SELECT NAME</label>
                    </center></div>
                    <div class="col"><center>
                        <select name="name" id="name" class="form-select" required>
                            <option value="">Select a Name</option>
                            <?php
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
                                }
                            }
                            ?>
                        </select>
                    </center></div>
                    <div class="col"><center>
                        <button type="submit" class="btn btn-primary">SUBMIT</button>
                    </center></div>
                </div>
            </div>
        </form>

        <?php if ($user_data): ?>
            <h2>Edit Student Details</h2>
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="existing_photo" value="<?php echo htmlspecialchars($user_data['photo']); ?>">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($user_data['name']); ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="father" class="form-label">Father's Name</label>
                    <input type="text" class="form-control" name="father" value="<?php echo htmlspecialchars($user_data['father']); ?>">
                </div>
                <div class="mb-3">
                    <label for="mother" class="form-label">Mother's Name</label>
                    <input type="text" class="form-control" name="mother" value="<?php echo htmlspecialchars($user_data['mother']); ?>">
                </div>
                <div class="mb-3">
                    <label for="fno" class="form-label">Father's Number</label>
                    <input type="text" class="form-control" name="fno" value="<?php echo htmlspecialchars($user_data['fno']); ?>">
                </div>
                <div class="mb-3">
                    <label for="mno" class="form-label">Mother's Number</label>
                    <input type="text" class="form-control" name="mno" value="<?php echo htmlspecialchars($user_data['mno']); ?>">
                </div>
                <div class="mb-3">
                    <label for="dob" class="form-label">Date of Birth</label>
                    <input type="date" class="form-control" name="dob" value="<?php echo htmlspecialchars($user_data['dob']); ?>">
                </div>
                <div class="mb-3">
                    <label for="doa" class="form-label">Date of Admission</label>
                    <input type="date" class="form-control" name="doa" value="<?php echo htmlspecialchars($user_data['doa']); ?>">
                </div>
                <div class="mb-3">
                    <label for="emergencyno" class="form-label">Emergency Number</label>
                    <input type="text" class="form-control" name="emergencyno" value="<?php echo htmlspecialchars($user_data['emergencyno']); ?>">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" name="address" value="<?php echo htmlspecialchars($user_data['address']); ?>">
                </div>
                <div class="mb-3">
                    <label for="new_photo" class="form-label">Upload New Photo</label>
                    <input type="file" class="form-control" name="new_photo" accept="image/*">
                </div>
                <div class="mb-3">
                    <img src="<?php echo htmlspecialchars($user_data['photo']); ?>" alt="User Photo" class="img-fluid mb-3" style="max-width: 100%;">
                </div>
                <button type="submit" name="update_student" class="btn btn-primary">UPDATE</button>
            </form>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
