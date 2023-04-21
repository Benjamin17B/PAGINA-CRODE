<?php
  function conectar(){
    $servidor = "localhost";
    $pass = "";
    $usuario = "root";
    $bd = "Mantenimiento";
    $conexion = mysqli_connect($servidor,$usuario,$pass,$bd);
    if ($conexion) {
    return $conexion;
    }
  }
  function consulta($sql,$conexion){
    $resul = mysqli_query($conexion,$sql);
    if ($resul) {
      return $resul;
    }
    else {
      return false;
    }
  }

  function operacion($sql,$conexion){
    if (mysqli_query($conexion,$sql)) {
      return true;
    }
    else {
      return false;
    }
  }
 ?>