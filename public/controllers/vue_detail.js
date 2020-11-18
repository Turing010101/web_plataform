var url = "../models/php_detail.php";
var app = new Vue({
  el: "#main",
  data: {
    servicios: [],
    id_servicio: 0,
    servicio:'',
    precio:0,
    categoria:'',
    trabajador: '',
    img_servicio:'',
    img_trabajador:'',
    detalle:''
  },
  methods: {
    mostrar_detalle: function () {
      this.id_servicio = this.get_variable_url("svc");

      axios.post(url, { opcion: 1, id_svc: this.id_servicio }).then((response) => {
        this.servicio = response.data[0].servicio_nombre;
        this.precio = response.data[0].servicio_costo;
        this.categoria = response.data[0].categoria;
        this.trabajador = response.data[0].nombre_trabajador;
        this.img_servicio = response.data[0].img_servicio;
        this.img_trabajador = response.data[0].img_trabajador;
        this.detalle = response.data[0].servicio_descripcion;
      });
    },
    contratar:async function(){

      axios.post(url, { opcion: 2, id_svc:this.id_servicio,id_price: this.precio }).then((response) => {
        console.log(response.data);
        if(response.data.msj=='true'){
          Swal.fire({
            title: "Añadido",
            type: "success",
            text: "¡El servicio ha sido guardado a tu contrato!",
            timer:1700
          });  
        }else{
         window.location.href="view_contact.php";  
        }

      });
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
    this.mostrar_detalle();
  }
});
