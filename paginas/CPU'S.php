<?php
$mensaje = "";
if(isset($_POST['btnGuardar'])){
    $NUsuario = $_POST['NUsuario'];
    $APMaterno = $_POST['APMaterno'];
    $APParteno = $_POST['APParteno'];
    $Marca = $_POST['Marca'];
    $Modelo = $_POST['Modelo'];
    $numSerie = $_POST['numSerie'];
    $numInventario = $_POST['numInventario'];
    $So = $_POST['So'];
    $Procesador = $_POST['Procesador'];
    $DiscoDuro = $_POST['DiscoDuro'];
    $Ram = $_POST['Ram'];
    $TipoMemoria = $_POST['TipoMemoria'];
    $Observaciones = $_POST['Observaciones'];
    $contraseña = $_POST['contraseña'];
    $NEquipo = $_POST['NEquipo'];
    $IP = $_POST['IP'];
    $Mac = $_POST['Mac'];

    include('../bd/bd.php');
    $cone = conectar();
    if ($cone == false) {
        $mensaje = "Error: Falla en la conexion a la BD...";
      }else{
        echo "conexion exitosa";
        $sql = "SELECT * FROM usuario WHERE (nombre = '$NUsuario')";
        $rs = consulta($sql,$cone);
        if ($rs == false) {
            $mensaje = "Error: Al consultar la BD...";
          }
          else{
            $sql = "INSERT INTO usuario VALUES(NULL,'$NUsuario','$APParteno','$APMaterno')";

            if (operacion($sql,$cone) == true) {
                $sql = "SELECT * FROM usuario WHERE nombre = '$NUsuario'";
                $rs = consulta($sql,$cone);
                $datos = mysqli_fetch_assoc($rs);
                $id = $datos['iduser'];

                $sql = "INSERT INTO usuario VALUES('$NUsuario','$APParteno','$APMaterno')";
                if (operacion($sql,$cone)) {
                  $mensaje = "Registro con exito!!!";
                }
                else {
                  $mensaje = "Error: Al registrar los datos ";
                }
              }
              else {
                $mensaje = "Error: Al gurdar los datos...";
              }
        }
        mysqli_close($cone);
      }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CPU'S</title>
    <link rel="stylesheet" href="../css/pagina.css">
    <script src="../js/validar.js" charset="utf-8"></script>
</head>
<header>
    <h1>Asistencia Tecnica y Mantenimiento</h1>
</header>
<body>
    <main> 
        <section> 
            <form action="#" method="post" id="formu" name="formu">
            <table>  
                <caption id="titFormu">CAPTURA DE DATOS</caption>
            <tr>
                <td> <br>
                    <h1>Datos del Equipo</h1>
                </td>
                <td> <br>
                    <h1>Desempeño del Equipo</h1>
                </td>
                <td> <br>
                    <h1>Datos de Red</h1>
                </td>
           
                </tr>
    
                <td> 

                <label for="NUsuario" >Nombre del Usuario:
                <input type="text" name="NUsuario" id="NUsuario" class="entrada" pattern="[A-Z ]+" required>

                <span class="error"></span><br>
                </label>

                    <label for="APParteno">Apellido Paterno:
                    <input type="text" id="APParteno" name="APParteno" class="entrada" pattern="[A-Z]+" required>
                    <span class="error"></span><br>
                    </label>

                    <label for="APMaterno">Apellido Materno:
                    <input type="text" id="APMaterno" name="APMaterno" class="entrada" pattern="[A-Z]+" required>
                    <span class="error"></span><br>
                    </label>
            
                    <label for="Marca">Marca:
                    <input type="text" id="Marca" name="Marca" class="entrada" pattern="[A-Z ]+" required>
                    <span class="error"></span><br>
                    </label>

                    <label for="Modelo">Modelo:
                    <input type="text" id="Modelo" name="Modelo" class="entrada" pattern="[A-Z]+" required>
                    <span class="error"></span><br>
                    </label>

                    <label for="numSerie">Numero de Serie:
                    <input type="number" id="numSerie" name="numSerie" class="entrada" pattern="[0-9]+" required>
                    <span class="error"></span><br>
                    </label>

                    <label for="numInventario">Numero de Inventario:
                    <input type="number" id="numInventario" name="numInventario" class="entrada" pattern="[0-9]+" required>
                    <span class="error"></span><br>
                    </label>
                </td>

                <td> 
                    <label for="So">So:
                    <input type="text" id="So" name="So" class="entrada" required>
                    <span class="error"></span><br>
                    </label>
            
                    <label for="Procesador">Procesador:
                    <input type="text" id="Procesador" name="Procesador" class="entrada" required>
                    <span class="error"></span><br>
                    </label>

                    <label for="DiscoDuro">Disco Duro:
                    <input type="text" id="DiscoDuro" name="DiscoDuro" class="entrada" pattern="[G,M,B,0-9 ]+" required>
                    <span class="error"></span><br>
                    </label>

                    <label for="Ram">Memoria Ram:
                    <input type="text" id="Ram" name="Ram" class="entrada" pattern="[G,M,B,0-9 ]+" required>
                    <span class="error"></span><br>
                    </label>

                    <label for="TipoMemoria">Tipo de Memoria:
                    <input type="text" id="TipoMemoria"  name="TipoMemoria" class="entrada" required>
                    <span class="error"></span><br>
                    </label>

                    <label for="Observaciones">Observaciones:
                    <input type="text" id="Observaciones"  name="Observaciones" class="CajonGrande">
                    <span class="error"></span><br>
                    </label>
                </td>
                <td> 
                    <label for="contraseña">Contraseña:
                    <input type="password" id="contraseña"  name="contraseña" class="entrada" required>
                    <span class="error"></span><br>
                    </label>

                    <label for="NEquipo">Nombre del Equipo:
                    <input type="text" id="NEquipo"  name="NEquipo" class="entrada" pattern="[A-Z]+" required>
                    <span class="error"></span><br>
                    </label>

                    <label for="IP">IP:
                    <input type="text" id="IP"  name="IP" class="entrada" required>
                    <span class="error"></span><br>
                    </label>

                    <label for="Mac" >Mac:
                    <input type="text" id="Mac"  name="Mac" class="entrada" required>
                    <span class="error"></span><br>
                    </label>

                    <button id="btnGuardar" name="btnGuardar" class="boton" type="submit">GUARDAR</button>
                </td>
               
            </table>
            <?php
                if ($mensaje!="") {
                    echo "<span class='error'>$mensaje</span>'";
                }
            ?>
        </form>
    </section>
</main>

<footer>

</footer>
</body>
</html>

<!-- localhost:8017/PRACTICA/paginas/CPU'S.php -->