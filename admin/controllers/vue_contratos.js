var url = "../models/php_contratos.php";
var app = new Vue({
  el: "#main",
  data: {
    contratos: [],
    contrataciones:[],
    id_contrato:0,
    id_cliente:0
  },
  methods: {
    listar_contratos: function () {
      axios.post(url, { opcion: 1 }).then((response) => {
        console.log(response.data);
      if(response.data.length!=0){
        this.contratos = response.data;
      }else{
        Swal.fire({
          title: "Información",
          type: "success",
          text: "¡No hay ningun contrato!",
          timer:1800
        });
        this.contratos = response.data;
      }
      this.restart('#tbl_contratos');
      });
    },
    listar_contrataciones: function (id) {
      axios.post(url, { opcion: 2,id_contrato:id}).then((response) => {
        this.contrataciones = response.data;
        this.restart('#tbl_contrataciones');
      });
    },
    btn_generar: async function(){
      window.open("report_contrato.php?id_contrato="+this.id_contrato+"&id_cliente="+this.id_cliente,"_blank");
    },
    btn_select:async function(row){
      $('#mdl_datelle').openModal();   
      this.listar_contrataciones(row.id_contrato);
      this.id_contrato=row.id_contrato;
      this.id_cliente=row.id_cliente;
    },
    restart(tbl) {
        $(tbl).DataTable().destroy();
        app.$nextTick(function () {
          $(tbl)
            .DataTable({
              language: { url: "js/Spanish.json" },
              destroy: true,
              stateSave: true,
            })
            .draw();
        });
      }
  },
  created: function () {
    this.listar_contratos();
  }
});
