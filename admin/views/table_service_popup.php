<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google. ">
  <title>Servicios</title>

  <link rel="stylesheet" type="text/css" href="js/alertifyjs/css/alertify.css">
  <link rel="stylesheet" type="text/css" href="js/alertifyjs/css/themes/default.css">
  <link rel="stylesheet" href="js/sweetalert/css/sweetalert2.min.css">
  <link rel="stylesheet" href="js/lightbox/lightbox.min.css">

  <script src="js/alertifyjs/jquery-3.2.1.min.js"></script>
  <script src="js/alertifyjs/alertify.js"></script>


  <!-- Favicons-->
  <link rel="icon" href="img/favicon/favicon-32x32.png" sizes="32x32">
  <!-- Favicons-->
  <link rel="apple-touch-icon-precomposed" href="img/favicon/apple-touch-icon-152x152.png">
  <!-- For iPhone -->
  <meta name="msapplication-TileColor" content="#00bcd4">
  <meta name="msapplication-TileImage" content="favicon/mstile-144x144.png">
  <!-- For Windows Phone -->
  <!-- CORE CSS-->
  <link href="css/jquery-confirm.min.css" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="css/jquery.dataTables.min.css" type="text/css" rel="stylesheet" media="screen,projection">

  <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
  <link href="css/prism.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="js/plugins/data-tables/css/jquery.dataTables.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="js/plugins/chartist-js/chartist.min.css" type="text/css" rel="stylesheet" media="screen,projection">
</head>

<body>
  <!-- Start Page Loading -->
  <div id="loader-wrapper">
    <div id="loader"></div>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
  </div>
  <!-- End Page Loading -->
  <main id="content">
    <!-- START MAIN -->
      <!-- START WRAPPER -->
      <div class="wrapper">
        <!-- START CONTENT -->
        <section>
          <!--start container-->
          <div class="container">
            <!--DataTables example Row grouping-->
            <div id="table-datatables">
              <div id="row-grouping" class="section">
                <h4 class="header">Selección de servicios</h4>
                <div class="divider"></div>
                <div class="col s12 m8 l9">
                  <table id="tbl_services" class="responsive-table display" cellspacing="0">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Costo</th>
                        <th>Categoría</th>
                        <th style="text-align: center;">Seleccionar</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Costo</th>
                        <th>Categoría</th>                       
                        <th style="text-align: center;">Seleccionar</th>
                      </tr>
                    </tfoot>
                    <tbody>
                      <tr v-for="(rows,i) of servicios">
                        <td>{{rows.clave_servicio}}</td>
                        <td>{{rows.servicio_nombre}}</td>
                        <td>{{rows.servicio_descripcion}}</td>
                        <td>{{rows.servicio_costo}}</td>
                        <td>{{rows.categoria}}</td>
                        <td style="text-align: center;"><a @click="btn_select(rows)" class="btn-floating waves-effect waves-light purple"><i class="mdi-action-done"></i></a></td>                          
                        </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!--end container-->
        </section>
      </div>
      <!-- END WRAPPER -->
  </main>
  <!-- END CONTENT -->
  <!-- ========= Scripts ========================== -->
  <script type="text/javascript" src="js/vue/vue.js"></script>
  <script type="text/javascript" src="js/vue/axios.js"></script>
  <script type="text/javascript" src="js/sweetalert/sweetalert2.all.min.js"></script>
  <script type="text/javascript" src="js/lightbox/lightbox-plus-jquery.min.js"></script>
  <script type="text/javascript" src="../controllers/vue_service_popup.js"></script>

  <script type="text/javascript" src="js/plugins/jquery-1.11.2.min.js"></script>
  <script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
  <script type="text/javascript" src="js/plugins/data-tables/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="js/plugins/data-tables/data-tables-script.js"></script>
  <script type="text/javascript" src="js/plugins/chartist-js/chartist.min.js"></script>
  <script type="text/javascript" src="js/plugins/materialize.js"></script>
  <script type="text/javascript" src="js/plugins/prism.js"></script>
  <script type="text/javascript" src="js/plugins/plugins.js"></script>

</body>

</html>