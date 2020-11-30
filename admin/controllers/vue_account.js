var url = "../models/php_account.php";
var contentLoad = document.querySelector('.load_icon');
var app = new Vue({
  el: "#main",
  data: {
    id_registro: 0,
    registros: [],
    correo: "",
    sexos: [
      { value: "M", text: "Mujer" },
      { value: "H", text: "Hombre" },
    ],
    sexo: "X",
    nombre_img: "",
    rfc: "",
    rfc_before:"",
    nombre: "",
    ap_paterno: "",
    ap_materno: "",
    tel_personal: "",
    tel_conocido: "",
    localidad: "",
    nombre_calle: "",
    numero_calle: "",
    municipio: "",
    estado: "",
    cp: "",
    email: "",
    usuario: "",
    pswd: "",
    message_crud: "success",
    message_read: "nosuccess",
    message_img: "errimg",
    state_trabajador: "",
    state_contratante: "",
    estados_trabajador: [
      { value: "Disponible", disabled: false, text: "Disponible" },
      { value: "Ocupado", disabled: false, text: "Ocupado" },
      { value: "Suspendido", disabled: true, text: "Suspendido" },
      { value: "Solicitud", disabled: true, text: "Solicitud" },
      { value: "Rechazado", disabled: true, text: "Rechazado" }
    ],
    estado_trabajador: "X",
    experiencia:"",
    contrasena_actual:"",
    contrasena_nueva:"",
    contrasena_actual_respuesta:'',
    contrasena_actual_valido:'',
    contrasena_actual_clase:'',
    contrasena_nueva_respuesta:'',
    contrasena_nueva_valido:'',
    contrasena_nueva_clase:''
  },
  methods: {
    //BOTTONS
    btn_update: async function () {
      if (this.not_empty()) {
        this.message(
          "warning",
          "Advertencia",
          "¡No dejar datos incompletos!",
          1700
        );
      } else {
        this.update();
      }
    },
    btn_contratante: async function () {
      this.contratador();
    },
    btn_trabajador: async function () {
      this.trabajador();
    },
    btn_change_usuario: async function () {
      let formData = new FormData(document.getElementById("frm_perfil"));
      let object = document.getElementById("id_img_usuario");
      var name = "img_usuario";
      this.render_image(formData, object, name);
    },
    //CRUD
    listar_registros: function () {
      this.email = this.get_variable_url("email");
      var formData = new FormData();
      formData.append("opcion", 2);
      formData.append("correo", this.email);
      axios.post(url, formData).then((response) => {
        this.registros = response.data;
        this.setValues();
        this.listar_trabajador(); 
        this.habilitar_datos_trabajador();
      });
    },
    listar_trabajador: function () {
      var formData = new FormData();
      formData.append("opcion", 7);
      formData.append("rfc", this.rfc);
      axios.post(url, formData).then((response) => {
        if(response.data.length!=0){
        app.estado_trabajador = response.data[0]["vch_estado"];
        app.experiencia = response.data[0]["vch_experiencia"];
        }
      });
    },
    habilitar_datos_trabajador: function(){
      var formData = new FormData();
      formData.append("opcion", 6);
      formData.append("rfc", this.rfc);
      axios.post(url, formData).then((response) => {
        if(response.data[0]["res"]=="1") {
          document.getElementById('ctn_trabjador').style.display = "inline";
          this.habilitar_select();
        }
      });
    },
    habilitar_select: function(){
      if (this.estado_trabajador == "Disponible" || this.estado_trabajador == "Ocupado") {
        document.getElementById("slt_trabajador").disabled = false;
      }else{
        document.getElementById("slt_trabajador").disabled = true;
      }
    },
    buscar_contratante: function () {
      var formData = new FormData();
      formData.append("opcion", 5);
      formData.append("rfc", this.rfc);
      axios.post(url, formData).then((response) => {
        app.state_contratante = response.data[0]["res"];
      });
      return this.state_contratante == "1" ? true : false;
    },
    buscar_trabajador: function () {
      var formData = new FormData();
      formData.append("opcion", 6);
      formData.append("rfc", this.rfc);
      axios.post(url, formData).then((response) => {
        app.state_trabajador = response.data[0]["res"];
      });
      return this.state_trabajador == "1" ? true : false;
    },
    setValues() {
      this.id_registro = this.registros[0]["clave"];
      this.nombre_img = this.registros[0]["img"];
      this.rfc = this.registros[0]["rfc"];
      this.rfc_before = this.registros[0]["rfc"]; 
      this.nombre = this.registros[0]["nombre"];
      this.ap_paterno = this.registros[0]["apellido_paterno"];
      this.ap_materno = this.registros[0]["apellido_materno"];
      this.sexo = this.registros[0]["sexo"];
      this.tel_personal = this.registros[0]["telefono_personal"];
      this.tel_conocido = this.registros[0]["telefono_pariente"];
      this.localidad = this.registros[0]["localidad"];
      this.nombre_calle = this.registros[0]["nombre_calle"];
      this.numero_calle = this.registros[0]["numero_calle"];
      this.municipio = this.registros[0]["municipio"];
      this.estado = this.registros[0]["estado"];
      this.cp = this.registros[0]["codigo_postal"];
      this.usuario = this.registros[0]["usuario"];
      this.email = this.registros[0]["correo_electronico"];
      this.pswd = this.registros[0]["contrasena"];
    },
    update: function () {
      var formData = new FormData(document.getElementById("frm_perfil"));
      formData.append("opcion", 1);
      formData.append("rfc_antes", this.rfc_before);
      formData.append("nom_img", this.nombre_img);
      formData.append("clave_usuario", this.id_registro);

      contentLoad.style.visibility = 'visible';
      axios.post(url, formData).then((response) => {
        if (response.data.msj == this.message_crud) {
          setTimeout(() =>{
          window.location.href = "table_account.php?email=" + app.email;
          this.clear();
          this.listar_registros();
          contentLoad.style.visibility = 'hidden';
        }, 1400);
        } else if (response.data.msj == this.message_img) {
          setTimeout(() =>{
          this.message(
            "error",
            "Formato",
            "¡Seleccionar una imagen apropiado!",
            1400
          );
        contentLoad.style.visibility = 'hidden';
        }, 1400);
        }
      });
    },
    btn_update_trabajador: function () {
      var formData = new FormData(document.getElementById("frm_trabajador"));
      formData.append("opcion", 8);
      formData.append("rfc", this.rfc);
      if (
        this.estado_trabajador == "Disponible" ||
        this.estado_trabajador == "Ocupado"
      ) {
        contentLoad.style.visibility = 'visible';
        axios.post(url, formData).then((response) => {
          if (response.data.msj == this.message_crud) {
            setTimeout(() =>{
            this.message(
              "success",
              "Actualización",
              "¡Los datos han sido actualizados!",
              1700
            );
            this.listar_trabajador();
            contentLoad.style.visibility = 'hidden';
          }, 1400);
          }else{
            contentLoad.style.visibility = 'hidden';
          }
        });
      } else {
        this.message("error", "Trabajador", "¡No tiene permiso, verifica su estado!", 1700);
      }
    },
    btn_change: function () {
      var formData = new FormData(document.getElementById("frm_change"));
      formData.append("opcion", 9);
      formData.append("rfc", this.rfc);

      if (this.contrasena_actual != "" && this.contrasena_nueva != "") {
        if(this.contrasena_actual_valido==true && this.contrasena_nueva_valido==true){
        contentLoad.style.visibility = 'visible';
        axios.post(url, formData).then((response) => {
          if (response.data.msj == this.message_crud) {
            window.location.href = "table_account.php?email=" + app.email;
          }else{
            setTimeout(() =>{
              this.message(
                "warning",
                "Advertencia",
                "¡Verifica a contraseña actual!",
                1700
              );
              contentLoad.style.visibility = 'hidden';
            }, 1400);
          }
        });
        }else{
          this.message(
            "warning",
            "Advertencia",
            "¡Datos invalidos!",
            1700
          );
        }
      } else {
        this.message(
          "warning",
          "Advertencia",
          "¡No dejar datos incompletos!",
          1700
        );
      }
    },
    validate_paswd_actual: function(){
      var expReg= /^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])\S{10,20}$/;
      var valido = expReg.test(this.contrasena_actual);
      if(this.contrasena_actual.length != 0){
        if(valido!=true){
            this.contrasena_actual_clase="dato_invalido";
            this.contrasena_actual_respuesta= "Contraseña debil";
            this.contrasena_actual_valido = false;           
        }else{
            this.contrasena_actual_clase="dato_valido";
            this.contrasena_actual_respuesta= "Contraseña fuerte";
            this.contrasena_actual_valido = true;
        }
      }else{
        this.contrasena_actual_respuesta= "";
      }
    },
    validate_paswd_nueva: function(){
      var expReg= /^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])\S{10,20}$/;
      var valido = expReg.test(this.contrasena_nueva);
      if(this.contrasena_nueva.length != 0){
        if(valido!=true){
            this.contrasena_nueva_clase="dato_invalido";
            this.contrasena_nueva_respuesta= "Contraseña debil";
            this.contrasena_nueva_valido = false;           
        }else{
            this.contrasena_nueva_clase="dato_valido";
            this.contrasena_nueva_respuesta= "Contraseña fuerte";
            this.contrasena_nueva_valido = true;
        }
      }else{
        this.contrasena_nueva_respuesta= "";
      }
    },
    contratador: function () {
      if (this.buscar_contratante()) {
        this.message(
          "success",
          "Tipo de perfil",
          "¡Ya cuenta con este perfil!",
          1700
        );
      } else {
        Swal.fire({
          title: "Confirmación",
          text: "¿Está seguro de ser un contratante?",         
          type: "warning",
          cancelButtonColor:'#3085d6',
          confirmButtonColor:'#d33',
          confirmButtonText: 'Aceptar',
          cancelButtonText: 'Cancelar',
          showCancelButton: true,
          showDenyButton: true
        }).then((result) => {
          if (result.value) {    
            var formData = new FormData();
            formData.append("opcion", 3);
            formData.append("rfc", this.rfc);
            axios.post(url, formData).then((response) => {
              if (response.data.msj == this.message_crud) {
                this.message(
                  "success",
                  "Tipo de perfil",
                  "¡Tu perfil de contratante ha sido registrada!",
                  1700
                );
              } else if (response.data.msj == this.message_read) {
                this.message(
                  "success",
                  "Tipo de perfil",
                  "¡Ya cuenta con este perfil!",
                  1700
                );
              }
            });        
          }
        })      
      }
    },
    trabajador: function () {
      if (this.buscar_trabajador()) {
        this.message(
          "success",
          "Tipo de perfil",
          "¡Ya cuenta con este perfil!",
          1700
        );
      } else {
        Swal.fire({
          title: "Confirmación",
          text: "¿Está seguro de ser un trabajador?",         
          type: "warning",
          cancelButtonColor:'#3085d6',
          confirmButtonColor:'#d33',
          confirmButtonText: 'Aceptar',
          cancelButtonText: 'Cancelar',
          showCancelButton: true,
          showDenyButton: true
        }).then((result) => {
          if (result.value) {    
            var formData = new FormData();
            formData.append("opcion", 4);
            formData.append("rfc", this.rfc);
            contentLoad.style.visibility = 'visible';
            axios.post(url, formData).then((response) => {
              if (response.data.msj == this.message_crud) {
                window.location.href = "table_account.php?email=" + app.email;
              } else if (response.data.msj == this.message_read) {
              setTimeout(() =>{
                this.message(
                  "success",
                  "Tipo de perfil",
                  "¡Ya cuenta con este perfil, puede iniciar sesión con ello!",
                  2000
                );
                contentLoad.style.visibility = 'hidden';
              }, 1400);
              }
            }); 
          }
        })      
      }
    },
    render_image(formData, object, name) {
      object.style.display = "block";
      const file = formData.get(name);
      const image = URL.createObjectURL(file);
      object.setAttribute("src", image);
    },
    message(_type, _title, _text, _timer) {
      Swal.fire({
        type: _type,
        title: _title,
        text: _text,
        timer: _timer,
      });
    },
    not_empty() {
      let formData = new FormData(document.getElementById("frm_perfil"));
      if(formData.get("txt_rfc") == "" || formData.get("txt_nombre")=="" || formData.get("txt_ap_paterno")==""
      || formData.get("txt_ap_materno")=="" || formData.get("cmb_sexo")==null || formData.get("txt_tel_personal")==""
      || formData.get("txt_tel_conocido")=="" || formData.get("txt_localidad")=="" || formData.get("txt_nombre_calle")==""
      || formData.get("txt_numero_calle")=="" || formData.get("txt_municipio")=="" || formData.get("txt_estado")==""
      || formData.get("txt_cp")=="" || formData.get("txt_email")=="" || formData.get("txt_usuario")=="") 
      {
        return true;
      } else {
        return false;
      }
    },
    clear() {
      document.getElementById("frm_perfil").reset();
      document.getElementById("id_img_usuario").style.display = "none";
    },
    get_variable_url(variable) {
      let query = window.location.search.substring(1);
      let vars = query.split("&");
      for (let i = 0; i < vars.length; i++) {
        let pair = vars[i].split("=");
        if (pair[0] == variable) {
          return pair[1];
        }
      }
      return false;
    },
  },
  created: function () {
    this.listar_registros();
  },
});
