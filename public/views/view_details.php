<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Detalles</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/js/sweetalert/css/sweetalert2.min.css" rel="stylesheet">
  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <?php include('view_header.php') ?>
  <!-- End Header -->
  <div class="load_icon" class="justify-content-center">
    <img src="./assets/img/loading.gif" alt="">
  </div>
  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" style="margin-top: 89px;" data-aos="fade-in">
      <div class="container">
        <h2>Servicio detalle</h2>
      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Cource Details Section ======= -->
    <section id="course-details" class="course-details">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-6">
            <img :src="'../../admin/views/img/service/'+img_servicio" class="img-fluid" alt="">
            <h3>Descripción</h3>
            <p>
              {{detalle}}
            </p>
          </div>
          <div class="col-lg-6">
            <div class="course-info d-flex justify-content-between align-items-center">
              <h5>Servicio</h5>
              <p>{{servicio}}</p>
            </div>
            <div class="course-info d-flex justify-content-between align-items-center">
              <h5>Precio</h5>
              <p>${{precio}}</p>
            </div>
            <div class="course-info d-flex justify-content-between align-items-center">
              <h5>Categoría</h5>
              <p>{{categoria}}</p>
            </div>
            <div class="course-info d-flex justify-content-between align-items-center">
              <img :src="'../../admin/views/img/users/'+img_trabajador" class="img-fluid" width="16%">
              <h5>Trabajador</h5>
              <p>{{trabajador}}</p>
            </div>
            <div class="course-info d-flex justify-content-between align-items-center">
              <h5>Estado</h5>
              <p>{{estado_trabajador}}</p>
            </div>
            <div class="text-center">
              <a style="cursor: pointer;" @click="contratar" class="get-started-btn">Contratar</a>
            </div>
          </div>

        </div>
    </section>
    <!-- End Cource Details Section -->
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include('view_footer.php') ?>
  <!-- End Footer -->

  <a href="#" class="back-to-top"><i class="bx bx-up-arrow-alt"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/js/vue/vue.js"></script>
  <script src="assets/js/vue/axios.js"></script>
  <script src="assets/js/sweetalert/sweetalert2.all.min.js"></script>
  <script src="../controllers/vue_detail.js"></script>

  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/counterup/counterup.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>