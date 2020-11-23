var url = "../models/php_perfil.php";
var app = new Vue({
  el: "#left-sidebar-nav",
  data: {
    registros: []
  },
  methods: {
    datos_usuario: function () {
      axios.post(url, { opcion: 1}).then((response) => {
        document.getElementById('foto').src = "./img/users/"+response.data[0]['foto'];
        document.getElementById('usuario').innerHTML= response.data[0]['usuario'];
        document.getElementById('tipo').innerHTML= response.data[0]['tipo'];
        document.getElementById('inicio').setAttribute('target',"_blank");
        document.getElementById('inicio').setAttribute('href',"../../");
        document.getElementById('cuenta').setAttribute('href',"table_account.php?email="+response.data[0]['email']);
        document.getElementById('cerrar').setAttribute('href',"../models/php_cerrar_session.php");
      });
    },
    permisos: function () {
      axios.post(url, { opcion: 2}).then((response) => {
        for (let i = 0; i < response.data.length; i++) {
          switch (response.data[i]['id_modulo']) {
            case '20':
              document.getElementById('contratacion').style.display = "inline";
              break;
            case '21':
              document.getElementById('documentos').style.display = "inline";   
              break;
            case '22':              
              document.getElementById('categorias').style.display = "inline"; 
              break;
            case '23':
              document.getElementById('servicios').style.display = "inline";  
              break;
            case '24':    
              document.getElementById('imagenes').style.display = "inline";
              break;
            case '25':    
              document.getElementById('contratos').style.display = "inline";
              break;
            default:
              break;
          }
        }
      });
    }
  },
  created: function () {
    this.datos_usuario();
    this.permisos();
  }
});
