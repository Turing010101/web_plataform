var url = "../models/category.php";
var app = new Vue({
  el: "#main",
  data: {
    id_registro:0,
    registros: [],
    categorias: [],
    estados: [
      { value: "Solicitud", text: "Solicitud" },
      { value: "Acreditado", text: "Acreditado" },
      { value: "Denegado", text: "Denegado" },
    ],
    id_trabajador: 66,
    cmb_categoria: 0,
    cmb_estado:'Solicitud'
  },
  methods: {
    //BOTTONS
    btn_insert: async function () {
      if (this.cmb_categoria == 0) {
          Swal.fire({
            type: "warning",
            title: "Advertencia",
            text: "¡No dejar datos incompletos!",
            timer:1700
          });
      } else {
        this.insert();
      }
    },
    btn_select:async function(rows){
      $('#mdl_upd_category').openModal();   
      this.id_registro=rows.clave;   
      this.cmb_estado=rows.estado;
      this.cmb_categoria=rows.id_categoria;
    },
    btn_clear:async function(){
      this.empty();
    },
    btn_update:async function(){                    
      if (this.cmb_categoria == 0) {
        Swal.fire({
          type: "warning",
          title: "Advertencia",
          text: "¡No dejar datos incompletos!",
          timer:1700
        });
      } else {
        this.update();
      }
    },
    btn_delete:function(id){    
        Swal.fire({
          title: "Eliminar registro",
          text: "¿Está seguro de borrar el registro: "+id+" ?",         
          type: "warning",
          cancelButtonColor:'#3085d6',
          confirmButtonColor:'#d33',
          confirmButtonText: 'Aceptar',
          cancelButtonText: 'Cancelar',
          showCancelButton: true,
          showDenyButton: true
        }).then((result) => {
          if (result.value) {            
            this.delete(id);
          }
        })                
    }, 
    //CRUD
    listar_registros: function () {
      axios.post(url, { opcion: 4 }).then((response) => {
        this.registros = response.data;
        this.restart();
      });
    },
    listar_categorias: function () {
      axios.post(url, { opcion: 5 }).then((response) => {
        this.categorias = response.data;
      });
    },
    insert: function () {
      axios.post(url, {opcion:1,clave_trabajador:this.id_trabajador,clave_categoria:this.cmb_categoria,opc_estado:this.cmb_estado}).then((response) => {
        if(response.data.msj=='success'){
          Swal.fire({
            title: "Inserción",
            type: "success",
            text: "¡El registro ha sido guardado!",
            timer:1400
          });
        this.listar_registros();
        }
      this.empty();
      });
    },
    update: function () {
      axios.post(url, {opcion:2,id:this.id_registro,clave_trabajador:this.id_trabajador,clave_categoria:this.cmb_categoria,opc_estado:this.cmb_estado}).then((response) => {
        if(response.data.msj=='success'){
          Swal.fire({
            title: "Actualización",
            type: "success",
            text: "¡El registro ha sido actualizado!",
            timer:1400
          });
          this.listar_registros();
        }
      this.empty();
      });
    },
    delete: function (id) {
      axios.post(url, { opcion: 3, id: id }).then((response) => {
      if(response.data.msj=='success'){
        Swal.fire({
          title: "Eliminación",
          type: "success",
          text: "¡El registro ha sido eliminado!",
          timer:1400
        });
        this.listar_registros();
      }
      this.empty();
      });
    },
    restart() {
      $("#tbl_categorias").DataTable().destroy();
      app.$nextTick(function () {
        $("#tbl_categorias")
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
      this.cmb_categoria=0;
      this.cmb_estado='Solicitud';
    }
  },
  created: function () {
    this.listar_registros();
    this.listar_categorias();
  }
});
