var url = "../models/php_account.php";
var app = new Vue({
  el: "#main",
  data: {
    message_crud:'success',
    usuario:'',
    correo:'',
    contrasena:''
  },
  methods: {
    //BOTTONS
    btn_ok: async function () {
      if (this.not_empty('frm_add_account')) {
        this.message("warning","Advertencia","¡No dejar datos incompletos!",1700);
      }else {
       this.insert();
      }
    },
    //CRUD
    insert: function () {
      var formData = new FormData(document.getElementById('frm_add_account'));
      formData.append('opcion',1);

      axios.post(url,formData).then((response) => {
        console.log("fff: "+response.data);

        if(response.data.msj==this.message_crud){
        this.message("success","Inserción","¡El registro ha sido guardado!",1400);
        window.location.href="../../admin/views/table_account.php?email="+ app.correo;          
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
