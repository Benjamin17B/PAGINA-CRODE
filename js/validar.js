var error;
var formulario;
window.onload = carga;

function carga(){
  formulario = document.getElementById('formu');

  document.getElementById('NUsuario').addEventListener('input',VUsuario,false);
  document.getElementById('APMaterno').addEventListener('input',VapeM,false);
  document.getElementById('APParteno').addEventListener('input',VapeP,false);
  document.getElementById('Marca').addEventListener('input',Vmarca,false);
  document.getElementById('Modelo').addEventListener('input',Vmodelo,false);
  document.getElementById('numSerie').addEventListener('input',Vnumserie,false);
  document.getElementById('numInventario').addEventListener('input',Vinventario,false);
  document.getElementById('So').addEventListener('input',Vso,false);
  document.getElementById('Procesador').addEventListener('input',Vproce,false);
  document.getElementById('DiscoDuro').addEventListener('input',Vdiscduro,false);
  document.getElementById('Ram').addEventListener('input',Vram,false);
  document.getElementById('TipoMemoria').addEventListener('input',Vtpmemoria,false);
  document.getElementById('contraseña').addEventListener('input',Vcontra,false);
  document.getElementById('NEquipo').addEventListener('input',VnEquipo,false);
  document.getElementById('IP').addEventListener('input',VIP,false);
  document.getElementById('Mac').addEventListener('input',VMac,false);

  document.getElementById('btnGuardar').addEventListener('click',vENVIAR,false);
}
function vENVIAR(e){
  if(VUsuario() && VapeM() && VapeP() && Vmarca() && Vmodelo() && Vnumserie() && Vinventario()
   && Vproce() && Vdiscduro() && Vram() && Vtpmemoria() && Vcontra() && VnEquipo() && VIP() && VMac() && confirm("Pulsa Aceptar si deseas Enviar el formulario")){
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
    if(elemento.validity.patternMismatch){
      muestra(elemento,"Solo Acepta Letras Mayusculas");
    }
    return false;
  }
}

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
    if(elemento.validity.patternMismatch){
      muestra(elemento,"Solo Acepta Letras Mayusculas");
    }
    return false;
  }
}

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
    if(elemento.validity.patternMismatch){
      muestra(elemento,"Solo Acepta Letras Mayusculas");
    }
    return false;
  }
}

function Vmarca(){
  var elemento = document.getElementById('Marca');
  error = document.querySelector("#Marca + span.error");

  if(elemento.checkValidity()){
    error.innerHTML = "";
    error.className = "error";
    return true;
  }
  else{
    if(elemento.validity.valueMissing){
      muestra(elemento,"Ingrese La marca");
    }
    if(elemento.validity.patternMismatch){
      muestra(elemento,"Solo Acepta Letras Mayusculas");
    }
    return false;
  }
}

function Vmodelo(){
  var elemento = document.getElementById('Modelo');
  error = document.querySelector("#Modelo + span.error");

  if(elemento.checkValidity()){
    error.innerHTML = "";
    error.className = "error";
    return true;
  }
  else{
    if(elemento.validity.valueMissing){
      muestra(elemento,"Ingrese el Modelo");
    }
    if(elemento.validity.patternMismatch){
      muestra(elemento,"Solo Acepta Letras Mayusculas");
    }
    return false;
  }
}

function Vnumserie(){
  var elemento = document.getElementById('numSerie');
  error = document.querySelector("#numSerie + span.error");

  if(elemento.checkValidity()){
    error.innerHTML = "";
    error.className = "error";
    return true;
  }
  else{
    if(elemento.validity.valueMissing){
      muestra(elemento,"Ingrese el Numero de Serie");
    }
    return false;
  }
}

function Vinventario(){
  var elemento = document.getElementById('numInventario');
  error = document.querySelector("#numInventario + span.error");

  if(elemento.checkValidity()){
    error.innerHTML = "";
    error.className = "error";
    return true;
  }
  else{
    if(elemento.validity.valueMissing){
      muestra(elemento,"Ingrese el Numero de Inventario");
    }
    if(elemento.validity.patternMismatch){
      muestra(elemento,"Solo Acepta Letras Mayusculas");
    }
    return false;
  }
}

function Vso(){
  var elemento = document.getElementById('So');
  error = document.querySelector("#So + span.error");

  if(elemento.checkValidity()){
    error.innerHTML = "";
    error.className = "error";
    return true;
  }
  else{
    if(elemento.validity.valueMissing){
      muestra(elemento,"Ingrese el SO");
    }
    return false;
  }
}

function Vproce(){
  var elemento = document.getElementById('Procesador');
  error = document.querySelector("#Procesador + span.error");

  if(elemento.checkValidity()){
    error.innerHTML = "";
    error.className = "error";
    return true;
  }
  else{
    if(elemento.validity.valueMissing){
      muestra(elemento,"Ingrese el Procesador");
    }
    return false;
  }
}

function Vdiscduro(){
  var elemento = document.getElementById('DiscoDuro');
  error = document.querySelector("#DiscoDuro + span.error");

  if(elemento.checkValidity()){
    error.innerHTML = "";
    error.className = "error";
    return true;
  }
  else{
    if(elemento.validity.valueMissing){
      muestra(elemento,"Ingrese el Disco Duro");
    }
    if(elemento.validity.patternMismatch){
      muestra(elemento,"Solo Acepta Numeros");
    }
    return false;
  }
}

function Vram(){
  var elemento = document.getElementById('Ram');
  error = document.querySelector("#Ram + span.error");

  if(elemento.checkValidity()){
    error.innerHTML = "";
    error.className = "error";
    return true;
  }
  else{
    if(elemento.validity.valueMissing){
      muestra(elemento,"Ingrese la Memoria Ram");
    }
    if(elemento.validity.patternMismatch){
      muestra(elemento,"Solo Acepta Giga (G) y Megabits (M)");
    }
    return false;
  }
}

function Vtpmemoria(){
  var elemento = document.getElementById('TipoMemoria');
  error = document.querySelector("#TipoMemoria + span.error");

  if(elemento.checkValidity()){
    error.innerHTML = "";
    error.className = "error";
    return true;
  }
  else{
    if(elemento.validity.valueMissing){
      muestra(elemento,"Ingrese el Tipo de Memoria");
    }
    return false;
  }
}

function Vcontra(){
  var elemento = document.getElementById('contraseña');
  error = document.querySelector("#contraseña + span.error");

  if(elemento.checkValidity()){
    error.innerHTML = "";
    error.className = "error";
    return true;
  }
  else{
    if(elemento.validity.valueMissing){
      muestra(elemento,"Ingrese la Contraseña");
    }
    return false;
  }
}
function VnEquipo(){
  var elemento = document.getElementById('NEquipo');
  error = document.querySelector("#NEquipo + span.error");

  if(elemento.checkValidity()){
    error.innerHTML = "";
    error.className = "error";
    return true;
  }
  else{
    if(elemento.validity.valueMissing){
      muestra(elemento,"Ingrese el Nombre del Equipo");
    }
    if(elemento.validity.patternMismatch){
      muestra(elemento,"Solo Acepta Letras Mayusculas");
    }
    return false;
  }
}
function VIP(){
  var elemento = document.getElementById('IP');
  error = document.querySelector("#IP + span.error");

  if(elemento.checkValidity()){
    error.innerHTML = "";
    error.className = "error";
    return true;
  }
  else{
    if(elemento.validity.valueMissing){
      muestra(elemento,"Ingrese la IP");
    }
    return false;
  }
}

function VMac(){
  var elemento = document.getElementById('Mac');
  error = document.querySelector("#Mac + span.error");

  if(elemento.checkValidity()){
    error.innerHTML = "";
    error.className = "error";
    return true;
  }
  else{
    if(elemento.validity.valueMissing){
      muestra(elemento,"Ingrese la MAC");
    }
    return false;
  }
}