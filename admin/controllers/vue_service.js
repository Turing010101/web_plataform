var url = "../models/php_service.php";
var contentLoad = document.querySelector('.load_icon');
var app = new Vue({
  el: "#main",
  data: {
    id_registro:0,
    id_trabajador:1,
    registros: [],
    categorias: [],
    message_crud:'success',
    nombre:'',
    descripcion:'',
    costo:'',
    categoria: 0
  },
  methods: {
    //BOTTONS
    btn_insert: async function () {
      if (this.not_empty('frm_add_service')) {
        this.message("warning","Advertencia","¡No dejar datos incompletos!",1700);
      }else {
       this.insert();
      }
    },
    btn_update: async function () {
      if (this.not_empty('frm_udt_service')) {
        this.message("warning","Advertencia","¡No dejar datos incompletos!",1700);
      } else {
       this.update();
      }
    },
    btn_select:async function(rows){
      $('#mdl_udt_service').openModal();   
      this.id_registro=rows.clave_servicio;   
      this.nombre=rows.servicio_nombre;  
      this.descripcion=rows.servicio_descripcion;  
      this.costo=rows.servicio_costo;  
      this.categoria=rows.id_asignar_categoria;
    },
    btn_clear:async function(){
      this.empty();
    },
    btn_delete:function(clave){    
        Swal.fire({
          title: "Eliminar registro",
          text: "¿Está seguro de borrar el registro: "+clave+" ?",         
          type: "warning",
          cancelButtonColor:'#3085d6',
          confirmButtonColor:'#d33',
          confirmButtonText: 'Aceptar',
          cancelButtonText: 'Cancelar',
          showCancelButton: true,
          showDenyButton: true
        }).then((result) => {
          if (result.value) {            
            this.delete(clave);
          }
        })                
    }, 
    //CRUD
    listar_registros: function () {
      var formData = new FormData();
      formData.append('opcion',4);
      formData.append('clave_trabajador',this.id_trabajador);
      axios.post(url,formData).then((response) => {
        this.registros = response.data;
        this.restart();
      });
    },
    listar_categorias: function () {
      var formData = new FormData();
      formData.append('opcion',5);
      formData.append('clave_trabajador',this.id_trabajador);
      axios.post(url,formData).then((response) => {
        this.categorias = response.data;
      });
    },
    insert: function () {
      var formData = new FormData(document.getElementById('frm_add_service'));
      formData.append('opcion',1);
      contentLoad.style.visibility = 'visible';
      axios.post(url,formData).then((response) => {
      if(response.data.msj==this.message_crud){
        setTimeout(() =>{
        this.message("success","Inserción","¡El registro ha sido guardado!",1400);
        this.listar_registros();
        contentLoad.style.visibility = 'hidden';
        }, 1400);
      }else{
        contentLoad.style.visibility = 'hidden';
      }
      this.empty();
      });
    },
    update: function () {
      var formData = new FormData(document.getElementById('frm_udt_service'));
      formData.append('opcion',2);
      formData.append('clave_servicio',this.id_registro);
      contentLoad.style.visibility = 'visible';
      axios.post(url,formData).then((response) => {
        if(response.data.msj==this.message_crud){
        setTimeout(() =>{
        this.message("success","Actualización","¡El registro ha sido actualizado!",1400);
        this.listar_registros();
        contentLoad.style.visibility = 'hidden';
        }, 1400);
      }else{
        contentLoad.style.visibility = 'hidden';
      }
      this.empty();
      });
    },
    delete: function (id){
      var formData = new FormData();
      formData.append('opcion',3);
      formData.append('clave_servicio',id);
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
    restart() {
      $("#tbl_services").DataTable().destroy();
      app.$nextTick(function () {
        $("#tbl_services")
          .DataTable({
            language: { url: "js/Spanish.json" },
            destroy: true,
            stateSave: true,
          })
          .draw();
      });
    },
    empty() {
      this.id_registro=0;   
      this.nombre=null;  
      this.descripcion=null;  
      this.costo=null;  
      this.categoria=0;
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
      if(formData.get('txt_nombre')=='' || formData.get('txt_descripcion')=='' || formData.get('txt_costo')=='' || formData.get('cmb_categoria')==null){
        return true;
      }else{
        return false;
      }
    }
  },
  created: function () {
    this.listar_registros();
    this.listar_categorias();
  }
});
