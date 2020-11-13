var url = "../models/php_account.php";
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
    tipos_usuarios: [
      { value: "1", text: "Contratante" },
      { value: "2", text: "Trabajador" },
    ],
    tipo_usuario: "0",
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
        console.log(response.data);
        this.registros = response.data;
        this.setValues();
      });
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

      axios.post(url, formData).then((response) => {
        if (response.data.msj == this.message_crud) {
          window.location.href = "table_account.php?email=" + app.email;
          this.clear();
          this.listar_registros();
        } else if (response.data.msj == this.message_img) {
          this.message(
            "error",
            "Formato",
            "¡Seleccionar una imagen apropiado!",
            1400
          );
        }
      });
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
    
            axios.post(url, formData).then((response) => {
              if (response.data.msj == this.message_crud) {
                this.message(
                  "success",
                  "Tipo de perfil",
                  "¡Tu perfil de trabajador ha sido registrada!",
                  1700
                );
                window.location.href = "table_account.php?email=" + app.email;
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
      if (formData.get("txt_rfc") == "") {
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
