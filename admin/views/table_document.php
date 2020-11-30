<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google. ">
  <title>Requisitos</title>

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
  <div class="load_icon" class="justify-content-center">
    <img src="img/loading.gif" alt="">
  </div>
  <main id="content">
    <!-- START HEADER -->
    <header id="header" class="page-topbar">
      <!-- start header nav-->
      <div class="navbar-fixed">
        <nav>
          <div class="nav-wrapper">
            <h1 class="logo-wrapper"><a class="brand-logo darken-1"><img src="img/logo.png" alt="Trabajos.com"></a> <span class="logo-text">Trabajos.com</span></h1>
            <ul class="right hide-on-med-and-down">
              <li id="btn_open_frm" style="display:none"><a href="#mdl_add_document" class="waves-effect waves-block waves-light modal-trigger">
                  <i class="mdi-content-add-circle-outline"></i></a>
              </li>
              <li><a href="javascript:void(0);" class="waves-effect waves-block waves-light toggle-fullscreen"><i class="mdi-action-settings-overscan"></i></a>
              </li>
            </ul>
          </div>
        </nav>
      </div>
      <!-- end header nav-->
    </header>
    <!-- END HEADER -->
    <!-- START MAIN -->
    <div id="main">
      <!-- START WRAPPER -->
      <div class="wrapper">
        <!-- START LEFT SIDEBAR NAV-->
        <?php include("left_sidebar.php") ?>
        <!-- END LEFT SIDEBAR NAV-->
        <!-- START CONTENT -->
        <section>
          <!--start container-->
          <div class="container">
            <div class="section">
              <!--Modal add_category -->
              <div id="mdl_add_document" class="modal">
                <div class="modal-content">
                  <form id="frm_add_document" class="col s12">
                    <div class="row">
                      <div class="col s12">
                        <label>Credencial del elector</label>
                        <div class="row">
                          <div class="col s12 m8 l9">
                            <div class="file-field input-field">
                              <input class="file-path validate" type="text"/>
                              <div class="btn mdi-action-search">
                                <input type="file" name="img_credencial" @change="btn_change_credencial"/>
                              </div>                       
                            </div>
                          </div>
                          <div class="col l3 m4"><img id="id_img_credencial" class="render_img"></div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col s12">
                        <label>Certificado de trabajo</label>
                        <div class="row">
                          <div class="col s12 m8 l9">
                            <div class="file-field input-field">
                              <input class="file-path validate" type="text" />
                              <div class="btn mdi-action-search">
                                <input type="file" name="img_certificado" @change="btn_change_certificado"/>
                              </div>
                            </div>
                          </div>
                          <div class="col l3 m4"><img id="id_img_certificado" class="render_img"></div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col s12">
                        <label>Comprobante de domicilio</label>
                        <div class="row">
                          <div class="col s12 m8 l9">
                            <div class="file-field input-field">
                              <input class="file-path validate" type="text" />
                              <div class="btn mdi-action-search">
                                <input type="file" name="img_comprobante" @change="btn_change_comprobante"/>
                              </div>
                            </div>
                          </div>
                          <div class="col l3 m4"><img id="id_img_comprobante" class="render_img"></div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <a @click="btn_insert" class="waves-effect waves-green btn-flat modal-action modal-close">Guardar</a>
                  <a @click="btn_clear" class="waves-effect waves-red btn-flat modal-action modal-close">Cancelar</a>
                </div>
              </div>
            </div>
            <!--DataTables example Row grouping-->
            <div id="table-datatables">
              <div id="row-grouping" class="section">
                <h4 class="header">Requisitos solicitados</h4>
                <div class="divider"></div>
                <div class="col s12 m8 l9">
                  <table id="tbl_documents" class="responsive-table display" cellspacing="0">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Credencial</th>
                        <th>Certificado</th>
                        <th>Comprobante</th>
                        <th>Estado</th>
                        <th>Observaciones</th>
                        <th>Fecha de evaluación</th>
                        <th>Eliminar</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>ID</th>
                        <th>Credencial</th>
                        <th>Certificado</th>
                        <th>Comprobante</th>
                        <th>Estado</th>
                        <th>Observaciones</th>
                        <th>Fecha de evaluación</th>
                        <th>Eliminar</th>
                      </tr>
                    </tfoot>
                    <tbody>
                      <tr v-for="(rows,i) of registros">
                        <td>{{rows.clave}}</td>
                        <td>
                          <a class="example-image-link" :href="'img/document/'+rows.credencial" data-lightbox="example-1">
                            <img :src="'img/document/'+rows.credencial" width="30" height="30" class="example-image" alt="Pendiente">
                          </a>
                        </td>
                        <td>
                          <a class="example-image-link" :href="'img/document/'+rows.certificado" data-lightbox="example-1">
                            <img :src="'img/document/'+rows.certificado" width="30" height="30" class="example-image" alt="Pendiente">
                          </a>
                        </td>
                        <td>
                          <a class="example-image-link" :href="'img/document/'+rows.comprobante_domicilio" data-lightbox="example-1">
                            <img :src="'img/document/'+rows.comprobante_domicilio" width="30" height="30" class="example-image" alt="Pendiente">
                          </a>
                        </td>
                        <td>{{rows.estado}}</td>
                        <td>{{rows.observacion}}</td>
                        <td>{{rows.fecha_evaluacion}}</td>
                        <td><a @click="btn_delete(rows)" class="btn-floating waves-effect waves-light red darken-4"><i class="mdi-action-delete"></i></a></td>
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
    </div>
    <!-- END MAIN -->
  </main>
  <!-- END CONTENT -->
  <!-- START FOOTER -->
  <?php include("footer_bottom.php") ?>
  <!-- END FOOTER -->
  <!-- ========= Scripts ========================== -->
  <script type="text/javascript" src="js/vue/vue.js"></script>
  <script type="text/javascript" src="js/vue/axios.js"></script>
  <script type="text/javascript" src="js/sweetalert/sweetalert2.all.min.js"></script>
  <script type="text/javascript" src="js/lightbox/lightbox-plus-jquery.min.js"></script>

  <script type="text/javascript" src="../controllers/validation.js"></script>
  <script type="text/javascript" src="../controllers/vue_perfil.js"></script>
  <script type="text/javascript" src="../controllers/vue_document.js"></script>

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