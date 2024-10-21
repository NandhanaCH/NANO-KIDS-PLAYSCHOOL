<?php
session_start();
if (isset($_SESSION['username'])) {
    header("Location: 1main.php");
}
?>
<?php
include("2connect.php");

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $id = $_POST['id'];
    $father = $_POST['father'];
    $mother = $_POST['mother'];
    $fno = $_POST['fno'];
    $mno = $_POST['mno'];
    $dob = $_POST['dob'];
    $doa = $_POST['doa'];
    $emergencyno = $_POST['emergencyno'];
    $address = $_POST['address'];

    // Handle photo upload or capture
    if (isset($_POST['photo_data']) && !empty($_POST['photo_data'])) {
        $photo_data = $_POST['photo_data'];

        // Extract the Base64 data (remove "data:image/png;base64," prefix)
        $photo_data = str_replace('data:image/png;base64,', '', $photo_data);
        $photo_data = str_replace(' ', '+', $photo_data);
        $decoded_photo = base64_decode($photo_data);

        // Create a unique filename for the photo
        $photo_filename = "uploads/" . uniqid() . ".png";

        // Save the decoded image to the server
        if (file_put_contents($photo_filename, $decoded_photo)) {
            echo "Photo saved successfully as " . $photo_filename . "<br>";

            // Prepare the SQL statement
            $stmt = $conn->prepare("INSERT INTO register (name, id, father, mother, fno, mno, dob, doa, emergencyno, address, photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssssssss", $name, $id, $father, $mother, $fno, $mno, $dob, $doa, $emergencyno, $address, $photo_filename);

            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo "Registration successful!";
            } else {
                echo "Error: " . $stmt->error;
            }
        }
    } elseif (isset($_FILES['uploaded_photo']) && $_FILES['uploaded_photo']['error'] == UPLOAD_ERR_OK) {
        // Handle uploaded photo
        $photo_filename = "uploads/" . uniqid() . ".png";

        if (move_uploaded_file($_FILES['uploaded_photo']['tmp_name'], $photo_filename)) {
            echo "Photo uploaded successfully as " . $photo_filename . "<br>";

            // Prepare the SQL statement
            $stmt = $conn->prepare("INSERT INTO register (name, id, father, mother, fno, mno, dob, doa, emergencyno, address, photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssssssss", $name, $id, $father, $mother, $fno, $mno, $dob, $doa, $emergencyno, $address, $photo_filename);

            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo "Registration successful!";
            } else {
                echo "Error: " . $stmt->error;
            }
        } else {
            echo "Error uploading the photo.";
        }
    }
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
  <link rel="stylesheet" href="3admission.css">

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
            <a class="a nav-link" href="3admission.php">REGISTRATION</a>
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

    <!---------------------- FORM ------------------------->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="box col-md-6 bg-pink p-5 rounded">
                <h2 class="text-center mb-4">ADMISSION FORM</h2>
                <form name="register" action="3admission.php" method="post">
                    <div class="mb-3">
                        <label for="childsName" class="form-label">Child's Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="registerNo" class="form-label">Register No</label>
                        <input type="text" class="form-control" name="id" required>
                    </div>
                    <div class="mb-3">
                        <label for="fathersName" class="form-label">Father's Name</label>
                        <input type="text" class="form-control" name="father" required>
                    </div>
                    <div class="mb-3">
                        <label for="mothersName" class="form-label">Mother's Name</label>
                        <input type="text" class="form-control" name="mother" required>
                    </div>
                    <div class="mb-3">
                        <label for="fathersNumber" class="form-label">Father's Number</label>
                        <input type="tel" class="form-control" name="fno" required>
                    </div>
                    <div class="mb-3">
                        <label for="mothersNumber" class="form-label">Mother's Number</label>
                        <input type="tel" class="form-control" name="mno" required>
                    </div>
                    <div class="mb-3">
                        <label for="dateOfBirth" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" name="dob" required>
                    </div>
                    <div class="mb-3">
                        <label for="dateOfAdmission" class="form-label">Date of Admission</label>
                        <input type="date" class="form-control" name="doa" required>
                    </div>
                    <div class="mb-3">
                        <label for="emergencyNumber" class="form-label">Emergency Number</label>
                        <input type="tel" class="form-control" name="emergencyno" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" name="address" required></textarea>
                    </div> 
                    <h3>PHOTO</h3>
                    <div class="mb-3"><center>
                        <input type="radio" id="uploadPhoto" name="photo_method" value="upload" checked>
                        <label for="uploadPhoto">Upload a Photo</label><br>
                        <input type="radio" id="takePhoto" name="photo_method" value="take">
                        <label for="takePhoto">Take a Photo</label></center>
                    </div>

                    <div id="uploadSection"><center>
                        <h3>Upload Photo</h3>
                        <input type="file" class="form-control" name="uploaded_photo" accept="image/*" id="uploaded_photo">
                        <button type="button" class="btn btn-danger mt-2" id="deleteUpload">Delete Photo</button></center>
                    </div>

                    <div id="captureSection" style="display:none;">
                        <h3>Take a Live Photo</h3>
                        <center>
                            <video id="video" width="320" height="240" autoplay></video><br>
                            <button class="btn" type="button" id="capture">Capture Photo</button><br>
                            <canvas id="canvas" width="320" height="240" style="display: none;"></canvas>
                            <img id="photo" src="#" alt="Captured Photo" style="display:none;"><br>
                            <button type="button" class="btn btn-danger mt-2" id="deleteCapture">Delete Photo</button>
                        </center>
                        <input type="hidden" name="photo_data" id="photo_data">
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mt-3" name="submit">Submit</button>
                </form>

                <script>
                    // Access the webcam
                    const video = document.getElementById('video');
                    const canvas = document.getElementById('canvas');
                    const photo = document.getElementById('photo');
                    const photoData = document.getElementById('photo_data');
                    const uploadedPhotoInput = document.getElementById('uploaded_photo');

                    // Get video stream from the webcam
                    navigator.mediaDevices.getUserMedia({ video: true })
                        .then(function(stream) {
                            video.srcObject = stream;
                        })
                        .catch(function(err) {
                            console.error("Error accessing the webcam: " + err);
                        });

                    // Capture the photo when the user clicks the button
                    document.getElementById('capture').addEventListener('click', function() {
                        const context = canvas.getContext('2d');
                        context.drawImage(video, 0, 0, 320, 240);
                        const dataUrl = canvas.toDataURL('image/png');
                        photo.src = dataUrl;
                        photo.style.display = 'block';
                        photoData.value = dataUrl;
                    });

                    // Show/hide the appropriate photo section based on user selection
                    document.querySelectorAll('input[name="photo_method"]').forEach((elem) => {
                        elem.addEventListener('change', function() {
                            if (document.getElementById('uploadPhoto').checked) {
                                document.getElementById('uploadSection').style.display = 'block';
                                document.getElementById('captureSection').style.display = 'none';
                                photo.style.display = 'none'; // Hide captured photo when switching
                            } else {
                                document.getElementById('uploadSection').style.display = 'none';
                                document.getElementById('captureSection').style.display = 'block';
                            }
                        });
                    });

                    // Delete uploaded photo input
                    document.getElementById('deleteUpload').addEventListener('click', function() {
                        uploadedPhotoInput.value = '';
                    });

                    // Delete captured photo
                    document.getElementById('deleteCapture').addEventListener('click', function() {
                        photoData.value = '';
                        photo.style.display = 'none';
                    });
                </script>
            </div>
        </div>
    </div>

    <!---------------------- FORM ------------------------->    

</body>
</html>  