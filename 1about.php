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
            <a class="a nav-link" href="1about.php">ABOUT US</a>
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

  <h1>ABOUT US</h1>

   <!---------------------- CAROUSEL ------------------------->

   <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
   <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="assets/about1.jpg" class="d-block w-100" alt="First Slide">
      <div class="carousel-caption carousel-caption-top">
        <h5>Albert Einstein</h5>
        <p>"Play is the highest form of research."</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="assets/about2.jpg" class="d-block w-100" alt="Second Slide">
      <div class="carousel-caption carousel-caption-top">
        <h5>O. Fred Donaldson</h5>
        <p>"Children learn as they play. Most importantly, in play, children learn how to learn."</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="assets/about3.jpg" class="d-block w-100" alt="Third Slide">
      <div class="carousel-caption carousel-caption-top">
      <h5>Lev Vygotsky</h5>
      <p>"In play, a child is always above his average age, above his daily behavior. In play, it is as though he were a head taller than himself."</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

   <!---------------------- CAROUSEL ------------------------->

 <!-- Vision, Mission & Approach Section -->

 <section class="vision-mission py-5">
        <div class="vma container">
            <h2 class="text-center mb-5">Our Vision, Mission, and Approach</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <h4 class="card-title">Our Vision</h4>
                            <img src="assets/gallery4.jpg"/>
                            <p class="card-text">To nurture young minds and build a strong foundation for lifelong learning, encouraging creativity, curiosity, and compassion in every child.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <h4 class="card-title">Our Mission</h4>
                            <img src="assets/gallery2.jpg"/>
                            <p class="card-text">To create a safe, fun, and engaging environment where children can explore, grow, and learn through play-based, hands-on experiences. We strive to empower every child to achieve their full potential.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <h4 class="card-title">Our Approach</h4>
                            <img src="assets/gallery3.jpg"/>
                            <p class="card-text">We focus on a holistic development approach, blending academic learning with social, emotional, and physical development. Our child-centered programs inspire growth through discovery and collaborative play.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

     <!-- Vision, Mission & Approach Section -->

    <!-- Why Nano Kids Play School Section -->

    <section class="why-nano py-5">
        <div class="why container">
            <h3 class="text text-center mb-5">Why Choose Nano Kids Play School?</h3>
            <div class="row">
                <div class="col-md-6">
                    <h5>Child-Centered Learning</h5>
                    <p>At Nano Kids, we believe in fostering each child's unique strengths. Our curriculum is designed to adapt to the interests and abilities of each child, making learning fun and personalized.</p>
                </div>
                <div class="col-md-6">
                    <h5>Play-Based Curriculum</h5>
                    <p>We embrace the philosophy of learning through play. Our programs encourage exploration, imagination, and collaboration to help children understand the world around them in a natural, engaging way.</p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-6">
                    <h5>Safe and Nurturing Environment</h5>
                    <p>Safety is our top priority. We provide a warm, inclusive environment where every child feels secure and supported, ensuring their physical and emotional well-being.</p>
                </div>
                <div class="col-md-6">
                    <h5>Experienced and Caring Educators</h5>
                    <p>Our teachers are passionate, highly qualified, and dedicated to the development of each child. They guide children with care, compassion, and expertise, fostering a lifelong love for learning.</p>
                </div>
            </div>
        </div>
    </section>

        <!-- Why Nano Kids Play School Section -->







  </body>
</html>  

