var popup_service;
var url = "../models/php_service_image.php";
var contentLoad = document.querySelector('.load_icon');
var app = new Vue({
  el: "#main",
  data: {
    id_registro:0,
    id_trabajador:1,
    id_servicio:0,
    registros: [],
    servicios: [],
    servicio:'',
    nombre_img:'',
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
    btn_change_servicio:async function(){
      let formData = new FormData(document.getElementById('frm_add_service_image'));
      let object = document.getElementById('id_img_servicio');
      var name = "img_servicio";
      this.render_image(formData,object,name);
    },
    btn_modal_tbl:async function(){
     popup_service=window.open("table_service_popup.php","tbl_servicios","menubar=yes,location=yes,resizable=yes,scrollbars=yes,status=yes");
    },
    btn_clear:async function(){
      this.empty();
    },
    btn_delete:function(obj){    
        Swal.fire({
          title: "Eliminar registro",
          text: "¿Está seguro de borrar el registro: "+obj.id_clave_servicio_imagen+" ?",         
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
    }, 
    //CRUD
    listar_registros: function () {
      var formData = new FormData();
      formData.append('opcion',5);
      formData.append('clave_trabajador',this.id_trabajador);
      axios.post(url,formData).then((response) => {
        this.registros = response.data;
        this.restart('#tbl_service_image');
      });
    },
    insert: function () {
      var formData = new FormData(document.getElementById('frm_add_service_image'));
      formData.append('opcion',1);
      formData.append('clave_servicio',this.id_servicio);
      contentLoad.style.visibility = 'visible';
      axios.post(url,formData).then((response) => {
        if(response.data.msj==this.message_crud){
        setTimeout(() =>{
        this.message("success","Inserción","¡El registro ha sido guardado!",1400);
        this.listar_registros();
        contentLoad.style.visibility = 'hidden';
        }, 1400);
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
      formData.append('id_registro',obj.id_clave_servicio_imagen);
      formData.append('img_servicio',obj.img_servicio);
      contentLoad.style.visibility = 'visible';
      axios.post(url,formData).then((response) => {
      if(response.data.msj==this.message_crud){
        setTimeout(() =>{
        this.message("success","Eliminación","¡El registro ha sido eliminado!",1400);
        this.listar_registros();
        contentLoad.style.visibility = 'hidden';
      }, 1400);
      }else{
        contentLoad.style.visibility = 'hidden';
      }
      this.empty();
      });
    },
    restart(id_table) {
      $(id_table).DataTable().destroy();
      app.$nextTick(function () {
        $(id_table)
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
      this.servicio='';
      this.nombre_img='';
      document.getElementById('id_img_servicio').style.display='none';
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
      let formData = new FormData(document.getElementById('frm_add_service_image'));
      if(formData.get('img_servicio').name=='' || formData.get('txt_servicio')==''){
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

function popup_select_service(id,name){
  popup_service.close();
  app.id_servicio=id;
  app.servicio=name;
}