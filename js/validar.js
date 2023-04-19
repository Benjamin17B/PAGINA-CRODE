var error;
var formulario;
window.onload = carga;

function carga(){
  formulario = document.getElementById('formu');

  document.getElementById('NUsuario').addEventListener('input',VUsuario,false);
  document.getElementById('APMaterno').addEventListener('input',VapeM,false);
  document.getElementById('APParteno').addEventListener('input',VapeP,false);

  document.getElementById('btnGuardar').addEventListener('click',vENVIAR,false);
}
function vENVIAR(e){
  if(VUsuario() && VapeM() && VapeP() && confirm("Pulsa Aceptar si deseas Enviar el formulario")){
    formulario.submit();
    return true;
  } else {
    e.preventDefault();
    return false;
  }
}
function muestra(elemento,mensaje){
  error.textContent = mensaje;
  elemento.Focus();
  error.className = "error active";
}

//Validar Nombre
function VUsuario(){
  var elemento = document.getElementById('NUsuario');
  error = document.querySelector("#NUsuario + span.error");

  if(elemento.checkValidity()){
    error.innerHTML = "";
    error.className = "error";
    return true;
  }
  else{
    if(elemento.validity.valueMissing){
      muestra(elemento,"Ingrese el Nombre");
    }
    return false;
  }
}
//Validar Apellido Paterno
function VapeP(){
  var elemento = document.getElementById('APParteno');
  error = document.querySelector("#APParteno + span.error");

  if(elemento.checkValidity()){
    error.innerHTML = "";
    error.className = "error";
    return true;
  }
  else{
    if(elemento.validity.valueMissing){
      muestra(elemento,"Ingrese el apellido Paterno");
    }
    return false;
  }
}
//Validar Apellido Materno
function VapeM(){
  var elemento = document.getElementById('APMaterno');
  error = document.querySelector("#APMaterno + span.error");

  if(elemento.checkValidity()){
    error.innerHTML = "";
    error.className = "error";
    return true;
  }
  else{
    if(elemento.validity.valueMissing){
      muestra(elemento,"Ingrese el Apellido Materno");
    }
    return false;
  }
}
