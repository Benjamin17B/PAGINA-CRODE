function mostrarTabla() {
    var select = document.getElementsByName("Departamento")[0];
    var departamento = select.value;
  
    if (departamento !== "") {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("tablaDatos").innerHTML = this.responseText;
        }
      };
      xhttp.open("GET", "obtener_datos.php?departamento=" + departamento, true);
      xhttp.send();
    } else {
      document.getElementById("tablaDatos").innerHTML = "";
    }
  }
  