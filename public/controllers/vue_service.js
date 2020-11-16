var url = "../models/php_service.php";
var app = new Vue({
  el: "#main",
  data: {
    servicios: [],
    id_trabajador:0,
    id_categoria: 0,
    nombre_categoria:''
  },
  methods: {
    listar_servicios: function () {
      this.id_categoria = this.get_variable_url("cat");
      this.id_trabajador = this.get_variable_url("trb");

      axios.post(url, { opcion: 1,id_cat: this.id_categoria, id_tbj: this.id_trabajador }).then((response) => {
        this.servicios = response.data;
        this.nombre_categoria = response.data[0].categoria;
      });
    },
    select:async function(rows){
      window.location.href="view_details.php?svc="+rows.clave_servicio;  
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
    }
  },
  created: function () {
    this.listar_servicios();
  }
});
