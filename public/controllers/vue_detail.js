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
    detalle:'',
    estado_trabajador:''
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
        this.estado_trabajador= response.data[0].estado_trabajador;
      });
    },
    contratar:async function(){
      if (this.estado_trabajador == "Disponible") {
        axios
          .post(url, {
            opcion: 2,
            id_svc: this.id_servicio,
            id_price: this.precio,
          })
          .then((response) => {
            if(response.data.msj != "trj"){
            if (response.data.msj == "true") {
              Swal.fire({
                title: "Añadido",
                type: "success",
                text: "¡El servicio ha sido guardado a tu contrato!",
                timer: 1700,
              });
            } else {
              window.location.href = "view_contact.php";
            }
            }else{
              Swal.fire({
                title: "Cuenta",
                type: "warning",
                text: "¡Para contratar inicia sesión como contratante!",
                timer: 1700,
              });
            }
          });
      } else {
        Swal.fire({
          title: "Estado",
          type: "success",
          text: "¡El trabajador no se encuentra disponible!",
          timer: 1700,
        });
      }
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
