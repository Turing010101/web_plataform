<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google. ">
  <title>Mi perfil</title>

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
              <li><a href="#mdl_change" class="waves-effect waves-block waves-light modal-trigger">
                  <i class="mdi-hardware-security"></i></a>
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
          <div class="section">
            <!--Modal add_category -->
            <div id="mdl_change" class="modal" style="width: 30%;">
              <div class="modal-content">
                <form class="col s12" id="frm_change">
                  <div class="row">
                    <div class="input-field col s12">
                     <span v-bind:class="contrasena_actual_clase">{{contrasena_actual_respuesta}}</span>
                      <input placeholder="..." class="validate" type="password" name="txt_contrasena_actual" v-model="contrasena_actual" maxlength="30" length="30" @keyup="validate_paswd_actual">
                      <label>Contraseña actual</label>
                    </div>
                    <div class="input-field col s12">
                     <span v-bind:class="contrasena_nueva_clase">{{contrasena_nueva_respuesta}}</span>
                      <input placeholder="..." class="validate" type="password" name="txt_contrasena_nueva" v-model="contrasena_nueva" maxlength="30" length="30" @keyup="validate_paswd_nueva">
                      <label>Contraseña nueva</label>
                    </div>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <a @click="btn_change" class="waves-effect waves-green btn-flat modal-action modal-close">Guardar</a>
                <a class="waves-effect waves-red btn-flat modal-action modal-close">Cancelar</a>
              </div>
            </div>
          </div>
          <!--start container-->
          <div class="container">
            <!--Form Advance-->
            <div class="row">
              <div class="col s12 m12 l12">
                <div class="card-panel">
                  <h4 class="header2">Datos Generales</h4>
                  <div class="row">
                    <form id="frm_perfil" class="col s12">
                      <div class="row">
                        <div class="input-field col s3">
                          <input placeholder=".." type="text" name="txt_rfc" v-model="rfc">
                          <label>RFC</label>
                        </div>
                        <div class="file-field input-field col s6">
                          <input class="file-path validate" type="text" v-model="nombre_img" disabled />
                          <div class="btn">
                            <span>FOTO</span>
                            <input type="file" name="img_usuario" @change="btn_change_usuario" />
                          </div>
                        </div>
                        <div class="file-field input-field col s3">
                          <div><img id="id_img_usuario" v-bind:src="'./img/users/'+nombre_img"></div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="input-field col s3">
                          <input placeholder=".." type="text" name="txt_nombre" v-model="nombre">
                          <label>Nombre</label>
                        </div>
                        <div class="input-field col s3">
                          <input placeholder=".." type="text" name="txt_ap_paterno" v-model="ap_paterno">
                          <label>Apellido paterno</label>
                        </div>
                        <div class="input-field col s3">
                          <input placeholder=".." type="text" name="txt_ap_materno" v-model="ap_materno">
                          <label>Apellido materno</label>
                        </div>
                        <div class="input-field col s3">
                          <select class="browser-default" name="cmb_sexo" v-bind:value="sexo">
                            <option value="X" disabled selected>Sexo</option>
                            <option v-for="row in sexos" v-bind:value="row.value">{{ row.text }}</option>
                          </select>
                        </div>
                      </div>
                      <div class="row">
                        <div class="input-field col s3">
                          <input placeholder=".." type="text" name="txt_tel_personal" v-model="tel_personal">
                          <label>Teléfono personal</label>
                        </div>
                        <div class="input-field col s3">
                          <input placeholder=".." type="text" name="txt_tel_conocido" v-model="tel_conocido">
                          <label>Teléfono conocido</label>
                        </div>
                        <div class="input-field col s3">
                          <input placeholder=".." type="text" name="txt_localidad" v-model="localidad">
                          <label>Localidad</label>
                        </div>
                        <div class="input-field col s3">
                          <input placeholder=".." type="text" name="txt_nombre_calle" v-model="nombre_calle">
                          <label for="last_name">Nombre calle</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="input-field col s3">
                          <input placeholder=".." type="text" name="txt_numero_calle" v-model="numero_calle">
                          <label>Número de calle</label>
                        </div>
                        <div class="input-field col s3">
                          <input placeholder=".." type="text" name="txt_municipio" v-model="municipio">
                          <label>Municipio</label>
                        </div>
                        <div class="input-field col s3">
                          <input placeholder=".." type="text" name="txt_estado" v-model="estado">
                          <label>Estado</label>
                        </div>
                        <div class="input-field col s3">
                          <input placeholder=".." type="text" name="txt_cp" v-model="cp">
                          <label>Código postal</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="input-field col s6">
                          <input placeholder=".." type="email" name="txt_email" v-model="email">
                          <label>Correo electrónico</label>
                        </div>
                        <div class="input-field col s3">
                          <input placeholder=". ." type="text" name="txt_usuario" v-model="usuario">
                          <label>Usuario</label>
                        </div>
                        <div class="input-field col s3">
                          <input placeholder=".." type="text" name="txt_pswd" v-model="pswd" disabled>
                          <label>Contraseña</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="input-field col s12">
                          <button @click="btn_update" class="btn cyan waves-effect waves-light right" type="button" name="action">GUARDAR
                            <i class="mdi-content-send right"></i>
                          </button>
                        </div>
                      </div>
                  </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <div id="ctn_trabjador" style="display:none">
            <div class="container">
              <!--Form Advance-->
              <div class="row">
                <div class="col s12 m12 l12">
                  <div class="card-panel">
                    <h4 class="header2">DATOS DEL TRABAJADOR</h4>
                    <div class="row">
                      <form id="frm_trabajador" class="col s12">
                        <div style="padding-left: 1px; margin-bottom: -15px;">
                          <label>Estado del trabajador</label>
                        </div>
                        <div class="row">
                          <div class="input-field col s4">
                            <select class="browser-default" name="cmb_estado_trabajador" v-bind:value="estado_trabajador" id="slt_trabajador">
                              <option value="X" disabled selected>Elegir</option>
                              <option v-for="row in estados_trabajador" v-bind:disabled="row.disabled" v-bind:value="row.value">{{ row.text }}</option>
                            </select>
                          </div>
                          <div class="input-field col s8">
                            <input placeholder=".." type="text" name="txt_experiencia" v-model="experiencia">
                            <label>Experiencia</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s8">
                            <blockquote>
                              <strong>Significado de estados:</strong>
                              <br><strong>Disponible:</strong> <i>El trabajador esta en disposición de realizar la contratación.</i>
                              <br><strong>Ocupado: </strong> <i>El trabajador no esta disponible.</i>
                              <br><strong>Suspendido:</strong> <i>EL trabajador no ha pagado la suscripción.</i>
                              <br><strong>Solicitud: </strong> <i>El trabajador esta en el proceso de selección.</i>
                              <br><strong>Rechazado: </strong> <i>EL trabajdor no aprobó las pruebas realizadas.</i>
                            </blockquote>
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                            <button @click="btn_update_trabajador" class="btn cyan waves-effect waves-light right" type="button" name="action" style="margin-top: -64px;">GUARDAR
                              <i class="mdi-content-send right"></i>
                            </button>
                          </div>
                        </div>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!--end container-->
          <div class="container">
            <div class="row">
              <div class="col s12 m12 l12">
                <div class="card-panel">
                  <div class="row">
                    <form class="col s12">
                      <h4 class="header2 center-align">TRABAJADOR</h4>
                      <div class="center-align">
                        <img src="./img/logotipo.png" height="100px" width="100px">
                      </div>

                      <div id="card-stats">
                        <div class="row">
                          <div style="padding-bottom: 15px;" class="input-field col s12">
                            <p class="center-align">
                              <h6>Para postularse como trabajador en la plataforma, debe seguir las siguientes instrucciones que serán gestionadas por la administración:</h6>
                            </p>
                          </div>
                          <div class="col s12 m6 l3">
                            <div class="card">
                              <div class="card-content blue white-text">
                                <h4 class="card-stats-number">1</h4>
                                <p class="card-stats-compare center-align"><i></i>Subir los requrimientos solicitados <br>(Apartado Documentos)</p>
                                </p>
                              </div>
                              <div class="card-action blue darken-2">
                                <div id="clients-bar"></div>
                              </div>
                            </div>
                          </div>
                          <div class="col s12 m6 l3">
                            <div class="card">
                              <div class="card-content purple white-text">
                                <h4 class="card-stats-number">2</h4>
                                <p class="card-stats-compare center-align"><i></i>Seleccionar las categorias a pertenecer <br>(Apartado Categorias)</p>
                                </p>
                              </div>
                              <div class="card-action purple darken-2">
                                <div id="sales-compositebar"></div>
                              </div>
                            </div>
                          </div>
                          <div class="col s12 m6 l3">
                            <div class="card">
                              <div class="card-content blue-grey white-text">
                                <h4 class="card-stats-number">3</h4>
                                <p class="card-stats-compare center-align"><i></i>Verificar las observaciones de los requerimientos <br>(Apartado Documentos)</p>
                                </p>
                              </div>
                              <div class="card-action blue-grey darken-2">
                                <div id="profit-tristate"></div>
                              </div>
                            </div>
                          </div>
                          <div class="col s12 m6 l3">
                            <div class="card">
                              <div class="card-content deep-purple white-text">
                                <h4 class="card-stats-number">4</h4>
                                <p class="card-stats-compare center-align"><i></i>Acudir a la sucursal en la fecha de evaluación <br>(Apartado Documentos)</p>
                                </p>
                              </div>
                              <div class="card-action  deep-purple darken-2">
                                <div id="invoice-line"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="input-field col s12">
                          <div class="input-field col s12 center-align">
                            <button @click="btn_trabajador" class="btn cyan waves-effect waves-light" type="button"><i class="mdi-action-perm-identity"></i> Registrar</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </section>
      </div>
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
  <script type="text/javascript" src="../controllers/vue_account.js"></script>

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