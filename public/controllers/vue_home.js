var url = "../models/php_home.php";
var app = new Vue({
  el: "#main",
  data: {
    total_contratantes:0,
    total_trabajadores:0,
    total_oficios:0,
    total_servicios:0
  },
  methods: {
    listar_contratantes: function () {
      axios.post(url, { opcion: 1 }).then((response) => {
        this.total_contratantes = response.data[0].total;
      });
    },
    listar_trabajadores: function () {
      axios.post(url, { opcion: 2 }).then((response) => {
        this.total_trabajadores = response.data[0].total;
      });
    },
    listar_oficios: function () {
      axios.post(url, { opcion: 3 }).then((response) => {
        this.total_oficios = response.data[0].total;
      });
    },
    listar_servicios: function () {
      axios.post(url, { opcion: 4 }).then((response) => {
        this.total_servicios = response.data[0].total;
      });
    }
  },
  created: function () {
    this.listar_contratantes();
    this.listar_trabajadores();
    this.listar_oficios();
    this.listar_servicios();
  }
});
