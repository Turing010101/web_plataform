<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Contacto</title>
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
        <h2>¡Bienvenido! Por favor, registrese</h2>
      </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">
        <div class="justify-content-center row mt-5">
          <div class="col-lg-4 mt-5 mt-lg-0">
            <div class="text-center"><img src="assets/img/logo.png" height="90"></div>
            <div class="text-center mt-3">
              <h6 class="font-weight-bold">Iniciar sesión en Trabajos.com</h6>
            </div>
            <form id="frm_login" role="form" class="php-email-form mt-4">
              <div class="form-row">
                <div class="col-md-12 form-group">
                  <select class="form-control" name="cmb_tipo" v-model="tipo_usuario">
                    <option value="0" disabled selected>Elegir</option>
                    <option value="3">Contratante</option>
                    <option value="4">Trabajador</option>
                  </select>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-12 form-group">
                  <input type="text" name="txt_user" v-model="usuario" class="form-control" id="user" placeholder="Usuario" />
                  <div class="validate"></div>
                </div>
              </div>
              <div class="text-right">
                <a href="#"><small>¿Se te olvidó tu contraseña?</small></a>
              </div>
              <div class="form-row">
                <div class="col-md-12 form-group">
                  <input type="password" class="form-control" name="txt_pswd" v-model="contrasena" id="pswd" placeholder="Contraseña" />
                  <div class="validate"></div>
                </div>
              </div>
              <div class="text-center"><a @click="btn_ok" href="#" class="get-started-btn">Registrarse</a></div>
            </form>
            <div class="text-center mt-4"><small class="font-weight-bold">¿Nuevo en Trabajos.com? </small><a href="view_account.php"><small>Crea una cuenta.</small></a>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <!-- End Footer -->

  <a href="#" class="back-to-top"><i class="bx bx-up-arrow-alt"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/js/vue/vue.js"></script>
  <script src="assets/js/vue/axios.js"></script>
  <script src="assets/js/sweetalert/sweetalert2.all.min.js"></script>
  <script src="../controllers/vue_login.js"></script>

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