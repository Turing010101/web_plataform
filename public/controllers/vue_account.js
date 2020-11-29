var url = "../models/php_account.php";
var contentLoad = document.querySelector('.load_icon');
var app = new Vue({
  el: "#main",
  data: {
    message_crud:'success',
    usuario:'',
    correo:'',
    contrasena:'',
    correo_respuesta:'',
    correo_valido:'',
    correo_clase:'',
    usuario_respuesta:'',
    usuario_valido:'',
    usuario_clase:'',
    contrasena_respuesta:'',
    contrasena_valido:'',
    contrasena_clase:''
  },
  methods: {
    //BOTTONS
    btn_ok: async function () {
      if (this.not_empty('frm_add_account')) {
        this.message("warning","Advertencia","¡No dejar datos incompletos!",1700);
      }else {
        if(this.correo_valido==true && this.usuario_valido==true && this.contrasena_valido==true){
        this.insert();
        }else{
          this.message("warning","Advertencia","¡Datos invalidos!",1700);
        }
      }
    },
    validate_email: function(){
      var expReg= /^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/;
      var valido = expReg.test(this.correo);
      if(this.correo.length != 0){
        if(valido!=true){
            this.correo_clase="dato_invalido";
            this.correo_respuesta= "Correo invalido";
            this.correo_valido = false;           
        }else{
            this.correo_clase="dato_valido";
            this.correo_respuesta= "Correo valido";
            this.correo_valido = true;
        }
      }else{
        this.correo_respuesta= "";
      }
    },
    validate_user: function(){
      var expReg= /^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/;
      var valido = expReg.test(this.usuario);
      if(this.usuario.length != 0){
        if(valido!=true){
            this.usuario_clase="dato_invalido";
            this.usuario_respuesta= "Usuario invalido";
            this.usuario_valido = false;           
        }else{
            this.usuario_clase="dato_valido";
            this.usuario_respuesta= "Usuario valido";
            this.usuario_valido = true;
        }
      }else{
        this.usuario_respuesta= "";
      }
    },
    validate_paswd: function(){
      var expReg= /^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])\S{10,20}$/;
      var valido = expReg.test(this.contrasena);
      if(this.contrasena.length != 0){
        if(valido!=true){
            this.contrasena_clase="dato_invalido";
            this.contrasena_respuesta= "Contraseña debil";
            this.contrasena_valido = false;           
        }else{
            this.contrasena_clase="dato_valido";
            this.contrasena_respuesta= "Contraseña fuerte";
            this.contrasena_valido = true;
        }
      }else{
        this.contrasena_respuesta= "";
      }
    },
    //CRUD
    insert: function () {
      var formData = new FormData(document.getElementById('frm_add_account'));
      formData.append('opcion',1);
      contentLoad.style.visibility = 'visible';
      axios.post(url,formData).then((response) => {
        if(response.data.msj==this.message_crud){
        window.location.href="../../admin/views/table_account.php?email="+ app.correo;          
        }else{
          contentLoad.style.visibility = 'hidden';
        }
        this.empty();
      });
    },
    empty() { 
      this.usuario=null;  
      this.correo=null;  
      this.contrasena=null;
    },
    message(_type,_title,_text,_timer){
      Swal.fire({
        type: _type,
        title: _title,
        text: _text,
        timer:_timer
      });
    },
    not_empty(frm){
      let formData = new FormData(document.getElementById(frm));
      if(formData.get('txt_user')=='' || formData.get('txt_email')=='' || formData.get('txt_pswd')==''){
        return true;
      }else{
        return false;
      }
    }
  }
});
