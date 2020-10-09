function soloNumeros(e) {
var key = window.Event ? e.which : e.keyCode
return (key >= 48 && key <= 57)
}

function soloLetras(e) {
key = e.keyCode || e.which;
tecla = String.fromCharCode(key).toLowerCase();
letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
especiales = "8-37-39-46";

tecla_especial = false
for (var i in especiales) {
	if (key == especiales[i]) {
		tecla_especial = true;
		break;
	}
}

if (letras.indexOf(tecla) == -1 && !tecla_especial) {
	return false;
}
}


function quit_espacios(e) {
if (e.target.value.trim() == "") {
	//alert("Debe ingresar un valor en el campo");
	e.target.value = "";
}
}

function validarEmail(e) {
expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
if (!expr.test(e.target.value)) {
	e.target.value= "";
}
if (e.target.value.trim() === "") {
	//alert("Debe ingresar un valor en el campo");
	e.target.value= "";
}
}

function __soloDecimal(e, field) {
key = e.keyCode ? e.keyCode : e.which
	// backspace
if (key == 8) return true
	// 0-9
if (key > 47 && key < 58) {
	if (field.value == "") return true
	regexp = /.[0-9]{2}$/
	return !(regexp.test(field.value))
}
// .
if (key == 46) {
	if (field.value == "") return false
	regexp = /^[0-9]+$/
	return regexp.test(field.value)
}
// other key
return false

}
function soloDecimal(evt,input){
// Backspace = 8, Enter = 13, ‘0′ = 48, ‘9′ = 57, ‘.’ = 46, ‘-’ = 43
var key = window.Event ? evt.which : evt.keyCode;    
var chark = String.fromCharCode(key);
var tempValue = input.value+chark;
if(key >= 48 && key <= 57){
    if(filter(tempValue)=== false){
        return false;
    }else{       
        return true;
    }
}else{
      if(key == 8 || key == 13 || key == 0) {     
          return true;              
      }else if(key == 46){
            if(filter(tempValue)=== false){
                return false;
            }else{       
                return true;
            }
      }else{
          return false;
      }
}
}

function filter(__val__){
var preg = /^([0-9]+\.?[0-9]{0,2})$/; 
if(preg.test(__val__) === true){
    return true;
}else{
   return false;
}
}