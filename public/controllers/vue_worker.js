var url = "../models/php_worker.php";
var app = new Vue({
  el: "#main",
  data: {
    trabajadores: [],
    id_categoria:0,
    categoria:''
  },
  methods: {
    listar_trabajadores: function () {
      this.id_categoria = this.get_variable_url("cat");

      axios.post(url, { opcion: 1,id_cat: this.id_categoria }).then((response) => {
        this.trabajadores = response.data;
        this.categoria = (response.data[0].categoria).toLowerCase();
      });
    },
    select:async function(rows){
      window.location.href="view_service.php?cat="+this.id_categoria+"&trb="+rows.clave_trabajador;  
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
    this.listar_trabajadores();
  }
});
