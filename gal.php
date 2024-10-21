<?php
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

// Handle editing student details
if (isset($_POST['edit'])) {
    $name = $_POST['name'];
    $father = $_POST['father'];
    $mother = $_POST['mother'];
    $fno = $_POST['fno'];
    $mno = $_POST['mno'];
    $dob = $_POST['dob'];
    $doa = $_POST['doa'];
    $emergencyno = $_POST['emergencyno'];
    $address = $_POST['address'];
    $photo_filename = '';

    if (isset($_POST['photo_data'])) {
        // Process the live photo
        $photo_data = $_POST['photo_data'];
        $photo_data = str_replace('data:image/png;base64,', '', $photo_data);
        $photo_data = str_replace(' ', '+', $photo_data);
        $decoded_photo = base64_decode($photo_data);
        $photo_filename = "uploads/" . uniqid() . ".png";
        file_put_contents($photo_filename, $decoded_photo);
    } elseif (isset($_FILES['upload_photo']) && $_FILES['upload_photo']['error'] == 0) {
        // Process uploaded photo
        $photo_filename = "uploads/" . uniqid() . "-" . basename($_FILES["upload_photo"]["name"]);
        move_uploaded_file($_FILES['upload_photo']['tmp_name'], $photo_filename);
    }

    // Update student details
    $sql = "UPDATE register SET father = ?, mother = ?, fno = ?, mno = ?, dob = ?, doa = ?, emergencyno = ?, address = ?, photo = ? WHERE name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssss", $father, $mother, $fno, $mno, $dob, $doa, $emergencyno, $address, $photo_filename, $name);
    $stmt->execute();
    $stmt->close();
}

$conn->close();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="3admin.css">
    <title>NANO KIDS</title>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <img class="logo" src="assets/logo.png" />
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav m-auto my-2 my-lg-0 ">
                    <li class="nav-item"><a class="a nav-link" href="3admin.php">ADMIN</a></li>
                    <li class="nav-item"><a class="nav-link" href="3admission.php">REGISTRATION</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">ATTENDANCE</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="3attendance.php">DAILY ATTENDANCE</a></li>
                            <li><a class="dropdown-item" href="3month.php">MONTHLY REPORT</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link " href="3fees.php">FEES</a></li>
                </ul>
                <form class="d-flex"><a class="btn1 text-center" href="2logout.php" role="button">LOGOUT</a></form>
            </div>
        </div>
    </nav>

    <h1>ADMIN</h1>
    <div class="std container mt-5">
        <form method="POST" class="mb-4">
            <div class="mb-3">
                <div class="select row">
                    <div class="col">
                        <center><label for="name" class="form-label">SELECT NAME</label></center>
                    </div>
                    <div class="col">
                        <center>
                            <select name="name" id="name" class="form-select" required>
                                <option value="">Select a Name</option>
                                <?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </center>
                    </div>
                    <div class="col">
                        <center><button type="submit" class="btn btn-primary">SUBMIT</button></center>
                    </div>
                </div>
            </div>
        </form>

        <?php if ($user_data): ?>
            <div class="container">
                <h3><?php echo htmlspecialchars($user_data['name']); ?></h3>
                <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($user_data['dob']); ?></p>
                <p><strong>Father's Name:</strong> <?php echo htmlspecialchars($user_data['father']); ?></p>
                <p><strong>Mother's Name:</strong> <?php echo htmlspecialchars($user_data['mother']); ?></p>
                <p><strong>Father's Number:</strong> <?php echo htmlspecialchars($user_data['fno']); ?></p>
                <p><strong>Mother's Number:</strong> <?php echo htmlspecialchars($user_data['mno']); ?></p>
                <p><strong>Date of Admission:</strong> <?php echo htmlspecialchars($user_data['doa']); ?></p>
                <p><strong>Emergency Number:</strong> <?php echo htmlspecialchars($user_data['emergencyno']); ?></p>
                <p><strong>Address:</strong> <?php echo htmlspecialchars($user_data['address']); ?></p>
                <img src="<?php echo htmlspecialchars($user_data['photo']); ?>" alt="User Photo" class="img-fluid mb-3" style="max-width: 100%;">
                
                <!-- Edit Button -->
                <form method="POST" class="mt-3">
                    <input type="hidden" name="name" value="<?php echo htmlspecialchars($user_data['name']); ?>">
                    <button type="submit" class="btn btn-warning" name="edit_mode">Edit</button>
                </form>
            </div>
        <?php endif; ?>

        <?php if (isset($_POST['edit_mode']) && $user_data): ?>
            <div class="container">
                <form method="POST" enctype="multipart/form-data" class="mt-4">
                    <h4>Edit Student Details</h4>
                    <input type="hidden" name="name" value="<?php echo htmlspecialchars($user_data['name']); ?>">
                    <div class="mb-3">
                        <label for="father" class="form-label">Father's Name</label>
                        <input type="text" class="form-control" name="father" value="<?php echo htmlspecialchars($user_data['father']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="mother" class="form-label">Mother's Name</label>
                        <input type="text" class="form-control" name="mother" value="<?php echo htmlspecialchars($user_data['mother']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="fno" class="form-label">Father's Number</label>
                        <input type="text" class="form-control" name="fno" value="<?php echo htmlspecialchars($user_data['fno']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="mno" class="form-label">Mother's Number</label>
                        <input type="text" class="form-control" name="mno" value="<?php echo htmlspecialchars($user_data['mno']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" name="dob" value="<?php echo htmlspecialchars($user_data['dob']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="doa" class="form-label">Date of Admission</label>
                        <input type="date" class="form-control" name="doa" value="<?php echo htmlspecialchars($user_data['doa']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="emergencyno" class="form-label">Emergency Number</label>
                        <input type="text" class="form-control" name="emergencyno" value="<?php echo htmlspecialchars($user_data['emergencyno']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" name="address" required><?php echo htmlspecialchars($user_data['address']); ?></textarea>
                    </div>

                    <!-- Photo Upload Options -->
                    <div class="mb-3">
                        <label for="photo" class="form-label">Upload Photo</label>
                        <input type="file" name="upload_photo" accept="image/*">
                        <p>OR</p>
                        <label for="photo_data" class="form-label">Take Live Photo</label>
                        <input type="hidden" name="photo_data" id="photo_data">
                        <video id="video" width="320" height="240" autoplay></video>
                        <button type="button" id="capture" class="btn btn-primary">Capture</button>
                        <canvas id="canvas" style="display:none;"></canvas>
                    </div>
                    <button type="submit" name="edit" class="btn btn-success">Update</button>
                </form>
            </div>

            <script>
                const video = document.getElementById('video');
                const canvas = document.getElementById('canvas');
                const photoDataInput = document.getElementById('photo_data');
                const captureButton = document.getElementById('capture');

                // Access the device camera and stream to video element
                navigator.mediaDevices.getUserMedia({ video: true })
                    .then(stream => {
                        video.srcObject = stream;
                    })
                    .catch(err => {
                        console.error("Error accessing the camera: ", err);
                    });

                captureButton.addEventListener('click', () => {
                    const context = canvas.getContext('2d');
                    context.drawImage(video, 0, 0, canvas.width, canvas.height);
                    const dataURL = canvas.toDataURL('image/png');
                    photoDataInput.value = dataURL; // Save the data URL to input
                    alert("Photo captured! You can submit the form now.");
                });
            </script>

        <?php endif; ?>
    </div>
</body>
</html>
