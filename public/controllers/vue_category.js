var url = "../models/php_category.php";
var app = new Vue({
  el: "#main",
  data: {
    categorias: []
  },
  methods: {
    listar_categorias: function () {
      axios.post(url, { opcion: 1 }).then((response) => {
        this.categorias = response.data;
      });
    },
    select:async function(rows){
      window.location.href="view_worker.php?cat="+rows.id;  
    },
  },
  created: function () {
    this.listar_categorias();
  }
});
