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
  <link rel="stylesheet" href="1main.css">

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
            <a class="a nav-link" href="1main.php">HOME</a>
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
          <a class="nav-link " href="1contact.php">CONTACT US</a>
          </li>
        </ul>
        <form class="d-flex">
          <a class="btn1 text-center" href="2login.php" role="button">LOGIN</a>
        </form>
      </div>
    </div>
  </nav>

  <!---------------------- NAVBAR ------------------------->


  <!---------------------- TITLE MAIN ------------------------->

  <section class="main">
    <div class="container">
      <div class="row">
        <div class="col">
          <img class="logo1" src="assets/logo.png ">
          <h2>Where Learning Meets Fun
            <br>And Every Child Feels Valued.
          </h2>
        </div>
      </div>
    </div>
  </section>

  <!---------------------- TITLE MAIN ------------------------->

  <!---------------------- ABOUT ------------------------->

  <main id="about">
    <div class="about mt-5">
      <div class="container">
        <h2 class="title h2-responsive">
          ABOUT
        </h2>
        <p class="line text-center w-responsive mx-auto mb-1">We take pride in nurturing young minds through
          playful learning
          and joyful exploration as well as inspiring creativity, curiosity, and confidence in every little learner.</p>

        <div class="row pt-5">
          <div class="col-md-6 align-items-stretch">
            <!------------CAROUSEL------------->
            <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="3000">
                  <img src="assets/about1.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="3000">
                  <img src="assets/about2.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="3000">
                  <img src="assets/about3.jpg" class="d-block w-100" alt="...">
                </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
            <!------------CAROUSEL------------->
          </div>

          <div class="col-md-6">
            <h2 class="paratitle h2-responsive fw-bold text-start">OUR PLAYSCHOOL</h2>
            <p class="para">Nano Kids is committed to providing a safe, nurturing, and stimulating environment where
              children can thrive. Our play-based approach encourages exploration, creativity, and curiosity, fostering
              a love for learning from an early age. We believe in nurturing each child's unique abilities, supporting
              both their academic and social development.
            </p>
            <a class="btn btn-primary" href="1about.php">EXPLORE</a><br>
            <a class="btn btn-primary" href="1contact.php">BOOK A TOUR</a>            
       </div>
      </div>
    </div>
  </main>
  <!---------------------- ABOUT ------------------------->

  <!---------------------- COURSES ------------------------->
  <main class="courses mb-5">
    <div class="container">
      <h2 class="title h2-responsive mb-2">
        PROGRAMS
      </h2>
      <p class="line text-center w-responsive mb-4">Our courses focus on interactive learning, creativity, social
        skills, and early childhood development, ensuring a well-rounded educational experience.</p>
      <div class="row">
        <div class="col-sm-4">
          <div class="card box">
            <img src="assets/courses1.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">PLAYSCHOOL</h5>
              <p class="card-text">Our playschool encourages early learning through play, fostering creativity,
                curiosity, and social development in a fun, nurturing environment.</p>
            </div>
            <a class="stretched-link" href="1program.php"></a> 
          </div>
        </div>

        <div class="col-sm-4">
          <div class="card box">
            <img src="assets/courses2.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">DAYCARE</h5>
              <p class="card-text">Our daycare offers a safe, caring environment where children can play, learn, and
                grow, under attentive, experienced supervision.</p>
            </div>
            <a class="stretched-link" href="1program.php"></a> 
          </div>
        </div>

        <div class="col-sm-4">
          <div class="card box">
            <img src="assets/courses3.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">AFTER SCHOOL</h5>
              <p class="card-text">Our after-school activities provide a fun, engaging space for children to explore
                new skills, enhance creativity, and build friendships.</p>
            </div>
            <a class="stretched-link" href="1program.php"></a> 
          </div>
        </div>
      </div>
    </div>
  </main>

  <!---------------------- GALLERY ------------------------->

  <main>
    <div class="container mb-5">
      <h2 class="title h2-responsive">
        GALLERY
      </h2>
      <p class="galtext line text-center w-responsive mb-4">Explore our gallery to see joyful moments of children learning,
        playing, and growing in a vibrant, nurturing environment.</p>

      <div class="gallery row">
        <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
          <a href="1gallery.php">
          <img src="assets/gallery1.jpg" class="w-100 shadow-1-strong mb-4" alt="Boat on Calm Water" /></a>
          <a href="1gallery.php">
          <img src="assets/gallery2.jpg" class="w-100 shadow-1-strong mb-4"
            alt="Wintry Mountain Landscape" /></a>
        </div>
        <div class="col-lg-4 mb-4 mb-lg-0">
        <a href="1gallery.php">
          <img src="assets/gallery3.jpg" class="w-100 shadow-1-strong mb-4"
            alt="Mountains in the Clouds" /></a>
            <a href="1gallery.php">
          <img src="assets/gallery4.jpg" class="w-100 shadow-1-strong mb-4" alt="Boat on Calm Water" /></a>
        </div>
        <div class="col-lg-4 mb-4 mb-lg-0">
        <a href="1gallery.php">
          <img src="assets/gallery5.jpg" class="w-100 shadow-1-strong mb-4" alt="Waves at Sea" /></a>
          <a href="1gallery.php">
          <img src="assets/gallery6.jpg" class="w-100 shadow-1-strong mb-4"
            alt="Yosemite National Park" /></a>
        </div>
      </div>
    </div>
  </main>

  <!---------------------- GALLERY ------------------------->

  <footer class="pt-5 pb-4">
    <div class="foot container text-center text-md-left">
        <div class="row text-center text-md-left">

                       <!-- Contact Info -->
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold">Contact Us</h5>
                <p><i class="fas fa-envelope"></i> info@nanokidsplayschool.com</p>
                <p><i class="fas fa-phone"></i> +91 98765 43210</p>
            </div>

            <!-- Quick Links -->
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold">Quick Links</h5>
                <p><a href="1about.php">About Us</a></p>
                <p><a href="1gallery.php">Gallery</a></p>
                <p><a href="1contact.php">Admissions</a></p>
                <p><a href="1contact.php">Contact</a></p>
            </div>

            
        </div>

        <hr class="mb-4">
        
        <!-- Copyright -->
        <div class="copy row align-items-center">
            <div class="col-md-7 col-lg-8">
                <p class="text-center text-md-left">© 2024 Nano Kids Play School | All Rights Reserved.</p>
            </div>
            <div class="col-md-5 col-lg-4">
                <p class="text-center text-md-right">Designed by NANDHANA C H</a></p>
            </div>
        </div>
    </div>
</footer>

</body>
</html>  