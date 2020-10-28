var url = "../models/php_service_image.php";
var app = new Vue({
  el: "#content",
  data: {
    id_trabajador:0,
    servicios: []
  },
  methods: {
    btn_select: async function (row) {
      opener.popup_select_service(row.clave_servicio,row.servicio_nombre);
    },
    listar_servicios: function () {
      this.id_trabajador=this.get_variable_url('id');
      var formData = new FormData();
      formData.append('opcion',4);
      formData.append('clave_trabajador',this.id_trabajador);
      axios.post(url,formData).then((response) => {
        this.servicios = response.data;
        this.restart('#tbl_services');
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
    get_variable_url(variable){
      let query = window.location.search.substring(1);
      let vars = query.split("&");
      for (let i=0; i < vars.length; i++) {
         let pair = vars[i].split("=");
         if(pair[0] == variable) {
             return pair[1];
         }
      }
      return false;
      }
  },
  created: function () {
    this.listar_servicios();
  }
});
