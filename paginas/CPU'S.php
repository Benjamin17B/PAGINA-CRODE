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
    $Departamento =  $_POST['Departamento'];

    include('../bd/bd.php');
    $cone = conectar();
    if ($cone == false) {
        $mensaje = "Error: Falla en la conexion a la BD...";
      }else{
        echo "conexion exitosa";
        $sql = "SELECT * FROM DatosEquipo WHERE (nombre = '$NUsuario')";
        $rs = consulta($sql,$cone);
        if ($rs == false) {
            $mensaje = "Error: Al consultar la BD...";
          }
          else{
            $sql2 = "INSERT INTO area VALUES(NULL, 'Subdirección técnica', 20, 1, 'E010', '1 ', '1 ', '1 ', 84, 'ST')";
            $sql = "INSERT INTO DatosEquipo VALUES(NULL,'$NUsuario','$APParteno','$APMaterno','$Marca','$Modelo','$numSerie','$numInventario',
            '$So','$Procesador','$DiscoDuro','$Ram','$TipoMemoria','$Observaciones','$contraseña','$NEquipo','$IP','$Mac')";

            if (operacion($sql,$cone) == true) {
                $sql = "SELECT * FROM DatosEquipo WHERE nombre = '$NUsuario'";
                $rs = consulta($sql,$cone);
                $datos = mysqli_fetch_assoc($rs);
                $id = $datos['iduser'];
                /* ↓ Muestra datos ↓
                    echo "$datos";*/
                
               
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
              if(operacion($sql2,$cone)){
                $sql2 = "SELECT * FROM DatosEquipo WHERE área = '$Departamento'";
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
    <link rel="shortcut icon" href="../img/crode.png">
    <script src="../js/validar.js" charset="utf-8"></script>
</head>
<header>
    <h1>Asistencia Técnica y Mantenimiento</h1>
</header>
<nav>
		<ul>
			<li><a href="../index.php">INICIO</a></li>
			<li><a href="#">SERVICIOS</a>
				<ul>
					<li><a href="#">CPU'S</a></li>
					<li><a href="#">IMPRESORAS</a></li>
				</ul>
			</li>
		</ul>
	</nav>
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
                    <input type="text" id="Modelo" name="Modelo" class="entrada" pattern="[A-Z,0-9,-]+" required>
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
                    <input type="text" id="DiscoDuro" name="DiscoDuro" class="entrada" pattern="[0-9]+([G,M,B,]{1})" required>
                    <span class="error"></span><br>
                    </label>

                    <label for="Ram">Memoria Ram:
                    <input type="text" id="Ram" name="Ram" class="entrada" pattern="[0-9]+([G,M,B,]{1})" required>
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
                    <input type="text" id="NEquipo"  name="NEquipo" class="entrada" pattern="[A-Z,0-9]+" required>
                    <span class="error"></span><br>
                    </label>

                    <label for="IP">IP:
                    <input type="text" id="IP"  name="IP" class="entrada" pattern="((^|\.)((25[0-5]_*)|(2[0-4]\d_*)|(1\d\d_*)|([1-9]?\d_*))){4}_*$" required>
                    <span class="error"></span><br>
                    </label>

                    <label for="Mac" >Mac:
                    <input type="text" id="Mac"  name="Mac" class="entrada" required>
                    <span class="error"></span><br>
                    </label>

                    <button id="btnGuardar" name="btnGuardar" class="boton" type="submit">GUARDAR</button>
                </td>

                <tr>
                    <td> <br>
                        <h1>DEPARTAMENTO ENCARGADO</h1>
                    </td>
                </tr>

                <td>
                    <label for="Departamento">Departamento:</label>
                     <select name="Departamento" class="entradaS" required>
                        <option value="">Seleccione un Departamento</option>
                        <option value="ST">Subdirección técnica</option>
                        <option value="SA">Subdirección administrativa</option>
                        <option value="RMS">Recursos materiales y de servicios</option>
                        <option value="RM">Recursos humanos</option>
                        <option value="RF">Recursos financieros</option>
                        <option value="PRO">Producción</option>
                        <option value="PPP">Planeación, Programación y Presupuestación</option>
                        <option value="MTG">Metrologia</option>
                        <option value="GTV">Gestión tecnológica y vinculación</option>
                        <option value="DDE">Diseño y Desarrollo de Equipo</option>
                        <option value="DIR">Dirección</option>
                        <option value="CIT">Centro de información técnica</option>
                        <option value="ATM">Asistencia técnica y mantenimiento</option>
                        <option value="AM">Administración de la Calidad</option>
                        <option value="NA">ninguna</option>
                    </select>
                    <br><br>
                </td>
               
            </table><br>
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