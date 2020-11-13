var url = "../models/php_login.php";
var app = new Vue({
  el: "#main",
  data: {
    msg:'1',
    tipo_usuario:0,
    usuario:'',
    contrasena:''
  },
  methods: {
    //BOTTONS
    btn_ok: async function () {
      if (this.not_empty('frm_login')) {
        this.message("warning","Advertencia","¡No dejar datos incompletos!",1700);
      }else {
       this.insert();
      }
    },
    //CRUD
    insert: function () {
      var formData = new FormData(document.getElementById('frm_login'));
      formData.append('opcion',1);

      axios.post(url,formData).then((response) => {
        if(this.msg==response.data[0]["res"]){
        window.location.href="../../admin/views/table_account.php?email="+response.data[0]["email"];    
        }else{
          this.message("warning","Advertencia","¡Verfica las credenciales de acceso!",1700);
        }
      });
    },
    empty() { 
      this.tipo_usuario=0;  
      this.usuario=null;  
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
      if(formData.get('cmb_tipo')==null || formData.get('txt_user')=='' || formData.get('txt_pswd')==''){
        return true;
      }else{
        return false;
      }
    }
  }
});
