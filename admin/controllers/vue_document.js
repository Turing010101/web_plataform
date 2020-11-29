var url = "../models/document.php";
var contentLoad = document.querySelector('.load_icon');
var app = new Vue({
  el: "#main",
  data: {
    id_registro:0,
    id_trabajador:1,
    registros: [],
    message_crud:'success',
    message_img :'errimg'
  },
  methods: {
    //BOTTONS
    btn_insert: async function () {
      if (this.not_empty()) {
        this.message("warning","Advertencia","¡No dejar datos incompletos!",1700);
      } else {
       this.insert();
      }
    },
    btn_change_credencial:async function(){
      let formData = new FormData(document.getElementById('frm_add_document'));
      let object = document.getElementById('id_img_credencial');
      var name = "img_credencial";
      this.render_image(formData,object,name);
    },
    btn_change_certificado:async function(){
      let formData = new FormData(document.getElementById('frm_add_document'));
      let object = document.getElementById('id_img_certificado');
      var name = "img_certificado";
      this.render_image(formData,object,name);
    },
    btn_change_comprobante:async function(){
      let formData = new FormData(document.getElementById('frm_add_document'));
      let object = document.getElementById('id_img_comprobante');
      var name = "img_comprobante";
      this.render_image(formData,object,name);
    },
    btn_clear:async function(){
      this.empty();
    },
    btn_delete:function(obj){
      if(obj.estado=='Pendiente'){
        Swal.fire({
          title: "Eliminar registro",
          text: "¿Está seguro de borrar el registro: "+obj.clave+" ?",         
          type: "warning",
          cancelButtonColor:'#3085d6',
          confirmButtonColor:'#d33',
          confirmButtonText: 'Aceptar',
          cancelButtonText: 'Cancelar',
          showCancelButton: true,
          showDenyButton: true
        }).then((result) => {
          if (result.value) {            
            this.delete(obj);
          }
        })  
      }else{
        Swal.fire({
          type: "warning",
          title: "Advertencia",
          text: "¡Ya no puede eliminat!",
          timer:1700
        });
      }
    }, 
    //CRUD
    listar_registros: function () {
      var formData = new FormData();
      formData.append('opcion',4);
      axios.post(url,formData).then((response) => {
        if(response.data.length==0){
          document.getElementById("btn_open_frm").style.display = "inline";
        }
        this.registros = response.data;
        this.restart();
      });
    },
    insert: function () {
      var formData = new FormData(document.getElementById('frm_add_document'));
      formData.append('opcion',1);
      formData.append('clave_trabajador',this.id_trabajador);
      contentLoad.style.visibility = 'visible';
      axios.post(url,formData).then((response) => {
        if(response.data.msj==this.message_crud){
        location.reload();
        }else if(response.data.msj==this.message_img){
        setTimeout(() =>{
        this.message("error","Formato","¡Seleccionar una imagen apropiado!",1400);
        contentLoad.style.visibility = 'hidden';
        }, 1400);
        }
      this.empty();
      });
    },
    delete: function (obj) {
      var formData = new FormData();
      formData.append('opcion',3);
      formData.append('id_registro',obj.clave);
      formData.append('img_credencial',obj.credencial);
      formData.append('img_certificado',obj.certificado);
      formData.append('img_comprobante',obj.comprobante_domicilio);
      contentLoad.style.visibility = 'visible';
      axios.post(url,formData).then((response) => {
      if(response.data.msj==this.message_crud){
      location.reload();
      }else{
        contentLoad.style.visibility = 'hidden';
      }
      this.empty();
      });
    },
    restart() {
      $("#tbl_documents").DataTable().destroy();
      app.$nextTick(function () {
        $("#tbl_documents")
          .DataTable({
            language: { url: "js/Spanish.json" },
            destroy: true,
            stateSave: true,
          })
          .draw();
      });
    },
    render_image(formData,object,name){
      object.style.display='block';
      const file = formData.get(name);
      const image = URL.createObjectURL(file);
      object.setAttribute('src', image);
    },
    empty() {
      this.id_registro=0;
      document.getElementById('frm_add_document').reset();
      document.getElementById('id_img_credencial').style.display='none';
      document.getElementById('id_img_certificado').style.display='none';
      document.getElementById('id_img_comprobante').style.display='none';
    },
    message(_type,_title,_text,_timer){
      Swal.fire({
        type: _type,
        title: _title,
        text: _text,
        timer:_timer
      });
    },
    not_empty(){
      let formData = new FormData(document.getElementById('frm_add_document'));
      if(formData.get('img_credencial').name=='' || formData.get('img_certificado').name=='' || formData.get('img_comprobante').name==''){
        return true;
      }else{
        return false;
      }
    }
  },
  created: function () {
    this.listar_registros();
  }
});
