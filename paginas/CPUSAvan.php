<?php
$mensaje = "";
if(isset($_POST['btnBuscar'])){
    $ID = $_POST['ID'];

     $NUsuario = "";
     $APMaterno = "";
     $APParteno = "";
     $Marca = "";
     $Modelo = "";
     $numSerie = "";
     $numInventario = "";
     $So = "";
     $Procesador = "";
     $DiscoDuro = "";
     $Ram = "";
     $TipoMemoria = "";
     $Observaciones = "";
     $contraseña = "";
     $NEquipo = "";
     $IP = "";
     $Mac = "";

    if($ID == ""){
        $mensaje = "Ingresa el ID de Usuario.";
    }
    else{
        include('../bd/bd.php');
        $cone = conectar();
        if ($cone == false) {
            $mensaje = "Error: Falla en la conexion a la BD...";
          }
          else{
        
            $sql = "SELECT * FROM datosequipo WHERE iduser = '$ID'";
            $sql3 = "SELECT * FROM area";
            $resultado = mysqli_query($cone, $sql);
            $resultado3 = mysqli_query($cone, $sql3);
    
        if (mysqli_num_rows($resultado) > 0) {
            // Imprimir los resultados
            while($fila = mysqli_fetch_assoc($resultado)) {
    
                $NUsuario = $fila["nombre"];
                $APMaterno = $fila['apellidoM'];
                $APParteno = $fila['apellidoP'];
                $Marca = $fila['marca'];
                $Modelo = $fila['modelo'];
                $numSerie = $fila['numserie'];
                $numInventario = $fila['numInventario'];
                $So = $fila['So'];
                $Procesador = $fila['Procesador'];
                $DiscoDuro = $fila['DiscoDuro'];
                $Ram = $fila['Ram'];
                $TipoMemoria = $fila['TipoMemoria'];
                $Observaciones = $fila['Observaciones'];
                $contraseña = $fila['contraseña'];
                $NEquipo = $fila['NEquipo'];
                $IP = $fila['IP'];
                $Mac = $fila['Mac'];
                
                $mensaje ="¡Registros Encontrados Correctamente.!";
                    //Obtener el Departamento
                if (mysqli_num_rows($resultado3) > 0) {
                    // Imprimir los resultados
                    while($fila2 = mysqli_fetch_assoc($resultado3)) {
            
                        $Departamento = $fila2['area'];
                        }   
                    } 
                }   
            } 
            else {
                $mensaje =  "El ID que buscaste No existe en la Base de Datos";
            }
        }  
    }
}
if(isset($_POST['btnBorrar'])){
    include('../bd/bd.php');
    $cone = conectar();
    $ID = $_POST['ID'];
    $sql = "SELECT * FROM datosequipo WHERE iduser = '$ID'";
    $resultado = mysqli_query($cone, $sql);
    
    if($ID == ""){
        $mensaje =  "Escribe el ID del Usuario a Borrar";
    }
    else if(mysqli_num_rows($resultado) == 0) {
        $mensaje =  "El ID Que Quieres Borrar No Existe en la Base de Datos";
    }
    else{

       
        if ($cone == false) {
            $mensaje = "Error: Falla en la conexion a la BD...";
          }
          else{
                // Eliminar los registros de la tabla area que referencian a las filas que se desean eliminar de la tabla DatosEquipo
                $sql = "DELETE FROM area WHERE iduser IN (SELECT iduser FROM DatosEquipo WHERE iduser = '$ID')";

                if (mysqli_query($cone, $sql)) {
                    // Si se eliminaron las filas de la tabla area, se pueden eliminar las filas de la tabla DatosEquipo
                    $sql = "DELETE FROM DatosEquipo WHERE iduser = '$ID'";

                    if (mysqli_query($cone, $sql)) {
                        $mensaje = "¡Registros eliminados correctamente.!";
                    } else {
                        $mensaje =  "Error al eliminar registros: " . mysqli_error($cone);
                    }
                } else {
                    $mensaje =  "Error al eliminar registros: " . mysqli_error($cone);
                }

                // Cerrar la conexión a la base de datos
                mysqli_close($cone);
          }
    }
   
}
if(isset($_POST['btnPDF'])){
    $ID = $_POST['ID'];
    if($ID == ""){
        $mensaje = "Ingresa el ID de Usuario para Descargar un PDF.";
    }
    else{

        include('../bd/bd.php');
        $cone = conectar();
        $sql = "SELECT iduser FROM datosequipo ORDER BY iduser DESC LIMIT 1";
        $sql2 = "SELECT * FROM datosequipo WHERE iduser = '$ID'";

        $sql3 = "SELECT * FROM area";
        
        $resultado2 = $cone->query($sql);
        $resultado = mysqli_query($cone, $sql2);
        $resultado3 = mysqli_query($cone, $sql3);
                
        if ($resultado2->num_rows > 0) {
            $fila = $resultado2->fetch_assoc();
            $ultimo_id = $fila['iduser'];
        } 
        else {
            $ultimo_id = 0;
        }
        
        $nuevo_id = $ultimo_id;

        //Obtener los Datos para Agregar en el PDF
        if (mysqli_num_rows($resultado) > 0) {
            // Imprimir los resultados
            while($fila = mysqli_fetch_assoc($resultado)) {

                $NUsuario = $fila["nombre"];
                $APMaterno = $fila['apellidoM'];
                $APParteno = $fila['apellidoP'];
                $Marca = $fila['marca'];
                $Modelo = $fila['modelo'];
                $numSerie = $fila['numserie'];
                $numInventario = $fila['numInventario'];
                $So = $fila['So'];
                $Procesador = $fila['Procesador'];
                $DiscoDuro = $fila['DiscoDuro'];
                $Ram = $fila['Ram'];
                $TipoMemoria = $fila['TipoMemoria'];
                $Observaciones = $fila['Observaciones'];
                $contraseña = $fila['contraseña'];
                $NEquipo = $fila['NEquipo'];
                $IP = $fila['IP'];
                $Mac = $fila['Mac'];
                
                }   
                //Obtener el Departamento
            if (mysqli_num_rows($resultado3) > 0) {
                // Imprimir los resultados
                while($fila = mysqli_fetch_assoc($resultado3)) {
        
                    $Departamento = $fila["area"];
                    
                    }   
                } 

                require_once('../pdf/tcpdf.php');


                $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
                
                $pdf->SetMargins(10, 10, 10, true);
                $pdf->AddPage();
            
                                    //Agregando los Datos al PDF
            
                $pdf->SetFont('dejavusans', '', 12, '', true);
                $pdf->Cell(0, 10, 'Número de registro: '.str_pad($nuevo_id, 6, '0', STR_PAD_LEFT), 0, 1, 'R');
                $pdf->Cell(0, 10, 'Año actual: ' . date('Y'), 0, 1, 'R');
                
            
            
                                    $pdf->SetFont('dejavusans', 'B', 15);
                                    $pdf->Cell(0, 10, 'DATOS  DEL EQUIPO: ', 0, 1, 'C');
                                    
                $pdf->SetFont('dejavusans', '', 12, '', true);
                $pdf->Cell(0, 10, 'Nombre: '.str_pad($NUsuario, STR_PAD_LEFT), 0, 1);
                $pdf->Cell(0, 10, 'Apellido Materno: '.str_pad($APMaterno, STR_PAD_LEFT), 0, 1);
                $pdf->Cell(0, 10, 'Apellido Paterno: '.str_pad($APParteno, STR_PAD_LEFT), 0, 1);
                $pdf->Cell(0, 10, 'Marca: '.str_pad($Marca, STR_PAD_LEFT), 0, 1);
                $pdf->Cell(0, 10, 'Modelo: '.str_pad($Modelo, STR_PAD_LEFT), 0, 1);
                $pdf->Cell(0, 10, 'Número de Serie: '.str_pad($numSerie, STR_PAD_LEFT), 0, 1);
                $pdf->Cell(0, 10, 'Número de Inventario: '.str_pad($numInventario, STR_PAD_LEFT), 0, 1);
            
                                    $pdf->SetFont('dejavusans', 'B', 15);
                                    $pdf->Cell(0, 10, 'DESEMPEÑO DEL EQUIPO: ', 0, 1, 'C');
            
                $pdf->SetFont('dejavusans', '', 12, '', true);
                $pdf->Cell(0, 10, 'SO: '.str_pad($So, STR_PAD_LEFT), 0, 1);
                $pdf->Cell(0, 10, 'Procesador: '.str_pad($Procesador, STR_PAD_LEFT), 0, 1);
                $pdf->Cell(0, 10, 'Disco Duro: '.str_pad($DiscoDuro, STR_PAD_LEFT), 0, 1);
                $pdf->Cell(0, 10, 'Ram: '.str_pad($Ram, STR_PAD_LEFT), 0, 1);
                $pdf->Cell(0, 10, 'Tipo de Memoria: '.str_pad($TipoMemoria, STR_PAD_LEFT), 0, 1);
                $pdf->Cell(0, 10, 'Observaciones: '.str_pad($Observaciones, STR_PAD_LEFT), 0, 1);
            
                                    $pdf->SetFont('dejavusans', 'B', 15);
                                    $pdf->Cell(0, 10, 'DATOS DE LA RED: ', 0, 1, 'C');
            
                $pdf->SetFont('dejavusans', '', 12, '', true);
                $pdf->Cell(0, 10, 'Contraseña: '.str_pad($contraseña, STR_PAD_LEFT), 0, 1);
                $pdf->Cell(0, 10, 'Nombre del Equipo: '.str_pad($NEquipo, STR_PAD_LEFT), 0, 1);
                $pdf->Cell(0, 10, 'IP: '.str_pad($IP, STR_PAD_LEFT), 0, 1);
                $pdf->Cell(0, 10, 'Mac: '.str_pad($Mac, STR_PAD_LEFT), 0, 1);
            
                                    $pdf->SetFont('dejavusans', 'B', 15);
                                    $pdf->Cell(0, 10, 'DEPARTAMENTO: ', 0, 1, 'C');
            
                $pdf->SetFont('dejavusans', '', 12, '', true);
                $pdf->Cell(0, 10, 'Departamento: '.str_pad($Departamento, STR_PAD_LEFT), 0, 1);

                            
                $pdf->AddPage();

                                    $pdf->SetFont('dejavusans', 'B', 15);
                                    $pdf->Cell(0, 10, 'CODIGO DE BARRAS: ', 0, 1, 'C');
                
                $pdf->SetFont('dejavusans', '', 12, '', true);

                // Obtener las dimensiones del código de barras
                $barcodeWidth = 80;
                $barcodeHeight = 15;
                                    
                // Calcular la posición horizontal para centrar el código de barras
                $pageWidth = $pdf->GetPageWidth();
                $x = ($pageWidth - $barcodeWidth) / 2;
                                    
                $pdf->write1DBarcode($nuevo_id, 'C128', $x, '', $barcodeWidth, $barcodeHeight, 0.4, $style = array('position' => 'S', 'border' => 0, 'padding' => 0, 'fontsize' => 8, 'text' => true, 'stretchtext' => 0, 'align' => 'C'), 'N');
                                 
                $pdf->Output('Mantenimiento.pdf', 'D');
        }
        else{
            $mensaje =  "El ID no Existe";
        } 
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
					<li><a href="MenuCpu.php">CPU'S</a></li>
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
                <caption id="titFormu">CAPTURA DE DATOS <i>(OPCIONES AVANZADAS)</i></caption>
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
                <label for="ID" >Número de ID:
                <input type="number" name="ID" id="ID" class="entrada" pattern="[0-9]+" value="<?php if(isset($_POST['btnBuscar']))echo $ID; ?>">

                <span class="error"></span><br>
                </label>

                <label for="NUsuario" >Nombre del Usuario:
                <input type="text" name="NUsuario" id="NUsuario" class="entrada" pattern="[A-Z ]+" disabled value="<?php if(isset($_POST['btnBuscar']))echo $NUsuario; ?>">

                <span class="error"></span><br>
                </label>

                    <label for="APParteno">Apellido Paterno:
                    <input type="text" id="APParteno" name="APParteno" class="entrada" pattern="[A-Z]+" disabled value="<?php if(isset($_POST['btnBuscar']))echo $APParteno; ?>">
                    <span class="error"></span><br>
                    </label>

                    <label for="APMaterno">Apellido Materno:
                    <input type="text" id="APMaterno" name="APMaterno" class="entrada" pattern="[A-Z]+" disabled value="<?php if(isset($_POST['btnBuscar']))echo $APMaterno; ?>">
                    <span class="error"></span><br>
                    </label>
            
                    <label for="Marca">Marca:
                    <input type="text" id="Marca" name="Marca" class="entrada" pattern="[A-Z ]+" disabled value="<?php if(isset($_POST['btnBuscar']))echo $Marca; ?>">
                    <span class="error"></span><br>
                    </label>

                    <label for="Modelo">Modelo:
                    <input type="text" id="Modelo" name="Modelo" class="entrada" pattern="[A-Z,0-9,-]+" disabled value="<?php if(isset($_POST['btnBuscar']))echo $Modelo; ?>">
                    <span class="error"></span><br>
                    </label>

                    <label for="numSerie">Numero de Serie:
                    <input type="number" id="numSerie" name="numSerie" class="entrada" pattern="[0-9]+" disabled value="<?php if(isset($_POST['btnBuscar']))echo $numSerie; ?>">
                    <span class="error"></span><br>
                    </label>

                    <label for="numInventario">Numero de Inventario:
                    <input type="number" id="numInventario" name="numInventario" class="entrada" pattern="[0-9]+" disabled value="<?php if(isset($_POST['btnBuscar']))echo $numInventario; ?>">
                    <span class="error"></span><br>
                    </label>
                </td>

                <td> 
                    <label for="So">So:
                    <input type="text" id="So" name="So" class="entrada" disabled value="<?php if(isset($_POST['btnBuscar']))echo $So; ?>">
                    <span class="error"></span><br>
                    </label>
            
                    <label for="Procesador">Procesador:
                    <input type="text" id="Procesador" name="Procesador" class="entrada" disabled value="<?php if(isset($_POST['btnBuscar']))echo $Procesador; ?>">
                    <span class="error"></span><br>
                    </label>

                    <label for="DiscoDuro">Disco Duro:
                    <input type="text" id="DiscoDuro" name="DiscoDuro" class="entrada" pattern="[0-9]+([G,M,B,]{1})" disabled value="<?php if(isset($_POST['btnBuscar']))echo $DiscoDuro; ?>">
                    <span class="error"></span><br>
                    </label>

                    <label for="Ram">Memoria Ram:
                    <input type="text" id="Ram" name="Ram" class="entrada" pattern="[0-9]+([G,M,B,]{1})" disabled value="<?php if(isset($_POST['btnBuscar']))echo $Ram; ?>">
                    <span class="error"></span><br>
                    </label>

                    <label for="TipoMemoria">Tipo de Memoria:
                    <input type="text" id="TipoMemoria"  name="TipoMemoria" class="entrada" disabled value="<?php if(isset($_POST['btnBuscar']))echo $TipoMemoria; ?>">
                    <span class="error"></span><br>
                    </label>

                    <label for="Observaciones">Observaciones:
                    <input type="text" id="Observaciones"  name="Observaciones" class="CajonGrande" disabled value="<?php if(isset($_POST['btnBuscar']))echo $Observaciones; ?>">
                    <span class="error"></span><br>
                    </label>
                </td>
                <td> 
                    <label for="contraseña">Contraseña:
                    <input type="password" id="contraseña"  name="contraseña" class="entrada" disabled value="<?php if(isset($_POST['btnBuscar']))echo $contraseña; ?>">
                    <span class="error"></span><br>
                    </label>

                    <label for="NEquipo">Nombre del Equipo:
                    <input type="text" id="NEquipo"  name="NEquipo" class="entrada" pattern="[A-Z,0-9]+" disabled value="<?php if(isset($_POST['btnBuscar']))echo $NEquipo; ?>">
                    <span class="error"></span><br>
                    </label>

                    <label for="IP">IP:
                    <input type="text" id="IP"  name="IP" class="entrada" pattern="((^|\.)((25[0-5]_*)|(2[0-4]\d_*)|(1\d\d_*)|([1-9]?\d_*))){4}_*$" disabled value="<?php if(isset($_POST['btnBuscar']))echo $IP; ?>">
                    <span class="error"></span><br>
                    </label>

                    <label for="Mac" >Mac:
                    <input type="text" id="Mac"  name="Mac" class="entrada" disabled value="<?php if(isset($_POST['btnBuscar']))echo $Mac; ?>">
                    <span class="error"></span><br>
                    </label>

                    <button id="btnBuscar" name="btnBuscar" class="boton" type="submit">BUSCAR</button>
                    <button id="btnBorrar" name="btnBorrar" class="boton" type="submit">BORRAR</button>
                    <br><br><br>
                    <button id="btnPDF" name="btnPDF" class="boton" type="submit">DESCARGAR PDF</button>
                </td>

                <tr>
                    <td> <br>
                        <h1>DEPARTAMENTO ENCARGADO</h1>
                    </td>
                </tr>

                <td>
                    <label for="Departamento">Departamento:</label>
                    <select name="Departamento" class="entradaS" disabled>
                        <option value="">Seleccione un Departamento</option>
                        <option value="ST" <?php if ($Departamento == 'ST') echo 'selected'; ?>>Subdirección técnica</option>
                        <option value="SA" <?php if ($Departamento == 'SA') echo 'selected'; ?>>Subdirección administrativa</option>
                        <option value="RMS" <?php if ($Departamento == 'RMS') echo 'selected'; ?>>Recursos materiales y de servicios</option>
                        <option value="RM" <?php if ($Departamento == 'RM') echo 'selected'; ?>>Recursos humanos</option>
                        <option value="RF" <?php if ($Departamento == 'RF') echo 'selected'; ?>>Recursos financieros</option>
                        <option value="PRO" <?php if ($Departamento == 'PRO') echo 'selected'; ?>>Producción</option>
                        <option value="PPP" <?php if ($Departamento == 'PPP') echo 'selected'; ?>>Planeación, Programación y Presupuestación</option>
                        <option value="MTG" <?php if ($Departamento == 'MTG') echo 'selected'; ?>>Metrologia</option>
                        <option value="GTV" <?php if ($Departamento == 'GTV') echo 'selected'; ?>>Gestión tecnológica y vinculación</option>
                        <option value="DDE" <?php if ($Departamento == 'DDE') echo 'selected'; ?>>Diseño y Desarrollo de Equipo</option>
                        <option value="DIR" <?php if ($Departamento == 'DIR') echo 'selected'; ?>>Dirección</option>
                        <option value="CIT" <?php if ($Departamento == 'CIT') echo 'selected'; ?>>Centro de información técnica</option>
                        <option value="ATM" <?php if ($Departamento == 'ATM') echo 'selected'; ?>>Asistencia técnica y mantenimiento</option>
                        <option value="AM" <?php if ($Departamento == 'AM') echo 'selected'; ?>>Administración de la Calidad</option>
                        <option value="NA" <?php if ($Departamento == 'NA') echo 'selected'; ?>>ninguna</option>
                    </select>
                    <br><br>
                </td>
               
            </table><br>
            <?php
                if ($mensaje == "¡Registros eliminados correctamente.!" || $mensaje == "¡Registros Encontrados Correctamente.!" || $mensaje == "¡Registro Descargado Correctamente.!") {
                    echo '<div style="position: absolute ; top: 50%; left: 50%; transform: translate(50%, 800%); 
                    background-color: #f2f2f2; border: 1px solid #ddd; border-radius: 5px; padding: 10px; display: inline-block;">';
                    echo '<span style="color: #4CAF50; font-size: 24px; margin-right: 10px;">&#10004;</span>';
                    
                    echo "<span style='color: #333; font-size: 18px;'>$mensaje</span>";
                    echo '</div>';
                    }
                    else {
                        echo "<div style='background-color: #f2dede; border: 1px solid #ebccd1; border-radius: 5px; padding: 10px; display: inline-block;'>";
                        echo "<span style='color: #a94442; font-size: 24px; margin-right: 10px;'>&#10006;</span>";
                        echo "<span style='color: #a94442; font-size: 18px;'>$mensaje</span>";
                        echo "</div>";
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