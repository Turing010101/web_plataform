var url = "../models/php_contratacion.php";
var contentLoad = document.querySelector('.load_icon');
var app = new Vue({
  el: "#main",
  data: {
    contrataciones: [],
    subtotal:0,
    id_contrato:0,
    id_cliente:0,
    paises: [
      { value: "Afganistán", text: "Afganistán" },
      { value: "Albania", text: "Albania" },
      { value: "Alemania", text: "Alemania" },
      { value: "Andorra", text: "Andorra" },
      { value: "Angola", text: "Angola" },
      { value: "Argentina", text: "Argentina" },
      { value: "Armenia", text: "Armenia" },
      { value: "Australia", text: "Australia" },
      { value: "Austria", text: "Austria" },
      { value: "Bélgica", text: "Bélgica" },
      { value: "Belice", text: "Belice" },
      { value: "Bolivia", text: "Bolivia" },
      { value: "Brasil", text: "Brasil" },
      { value: "Canadá", text: "Canadá" },
      { value: "Chile", text: "Chile" },
      { value: "China", text: "China" },
      { value: "Colombia", text: "Colombia" },
      { value: "Cuba", text: "Cuba" },
      { value: "Dinamarca", text: "Dinamarca" },
      { value: "Ecuador", text: "Ecuador" },
      { value: "España", text: "España" },
      { value: "Estados Unidos", text: "Estados Unidos" },
      { value: "México", text: "México" },
    ],
    pais:'México',
    meses: [
      { value: "01", text: "01" },
      { value: "02", text: "02" },
      { value: "03", text: "03" },
      { value: "04", text: "04" },
      { value: "05", text: "05" },
      { value: "06", text: "06" },
      { value: "07", text: "07" },
      { value: "08", text: "08" },
      { value: "09", text: "09" },
      { value: "10", text: "10" },
      { value: "11", text: "11" },
      { value: "12", text: "12" }
    ],
    mes:'10',
    anos: [
      { value: "2020", text: "2020" },
      { value: "2021", text: "2021" },
      { value: "2022", text: "2022" },
      { value: "2023", text: "2023" },
      { value: "2024", text: "2024" },
      { value: "2025", text: "2025" },
      { value: "2026", text: "2026" },
      { value: "2027", text: "2027" },
      { value: "2028", text: "2028" },
      { value: "2029", text: "2029" },
      { value: "2030", text: "2030" }
    ],
    ano:'2025',
    nombre_targeta:'Jorge Luis Alonso Hernández',
    numero_targeta:'4152313661173945',
    cvc:'456'
  },
  methods: {
    listar_contrataciones: function () {
      axios.post(url, { opcion: 1 }).then((response) => {
      if(response.data.length!=0){
        this.contrataciones = response.data;
        this.id_contrato =  response.data[0].id_contrato;
        this.id_cliente =  response.data[0].id_cliente;
      }else{
        Swal.fire({
          title: "Información",
          type: "success",
          text: "¡No hay ninguna contratación!",
          timer:1800
        });
        this.contrataciones = response.data;
        this.subtotal=0;
        this.id_contrato=0;
        this.id_cliente=0;
      }
      this.restart();
      });
    },
    total_contrataciones: function () {
      axios.post(url, { opcion: 3 }).then((response) => {
        if(response.data[0].subtotal!=null){
        this.subtotal = response.data[0].subtotal;
        }else{
        this.subtotal=0;
        }
      });
    },
    btn_pagar: function(){
      if(this.subtotal!=0){
        axios.post(url, {opcion:4,subtotal:this.subtotal}).then((response) => {
        if(response.data.msj=='success'){
          this.listar_contrataciones();
          window.open("report_contrato.php?id_contrato="+this.id_contrato+"&id_cliente="+this.id_cliente,"_blank");
        }
        });
      }else{
        Swal.fire({
          title: "Advertencia",
          type: "warning",
          text: "¡No hay ninguna contratación!",
          timer:1400
        });
      }
    },
    btn_delete:function(id){    
        Swal.fire({
          title: "Eliminar registro",
          text: "¿Está seguro de borrar el servicio: "+id+" ?",         
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
    delete: function (id) {
        contentLoad.style.visibility = 'visible';
        axios.post(url, { opcion: 2, id: id }).then((response) => {
        if(response.data.msj=='success'){
          setTimeout(() =>{
          Swal.fire({
            title: "Eliminación",
            type: "success",
            text: "¡El servicio ha sido eliminado!",
            timer:1400
          });
          this.listar_contrataciones();
          this.total_contrataciones();
          contentLoad.style.visibility = 'hidden';
        }, 1400);
        }else{
          contentLoad.style.visibility = 'hidden';
        }
        });
    },
    restart() {
        $("#tbl_contrataciones").DataTable().destroy();
        app.$nextTick(function () {
          $("#tbl_contrataciones")
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
    this.listar_contrataciones();
    this.total_contrataciones();
  }
});
