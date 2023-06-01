<?php
$listDepartamentos=[
'ST'=>"Subdirección técnica",
'SA'=>"Subdirección administrativa",
'RMS'=>"Recursos materiales y de servicios",
'RM'=>"Recursos humanos",
'RF'=>"Recursos financieros",
'PRO'=>"Producción",
'PPP'=>"Planeación, Programación y Presupuestación",
'MTG'=>"Metrologia",
'GTV'=>"Gestión tecnológica y vinculación",
'DDE'=>"Diseño y Desarrollo de Equipo",
'DIR'=>"Dirección",
'CIT'=>"Centro de información técnica",
'ATM'=>"Asistencia técnica y mantenimiento",
'AM'=>"Administración de la Calidad",
'NA'=>"ninguna"
];

$mensaje = "";
$ID = "";

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
            $resultado = mysqli_query($cone, $sql);
        
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
                $Departamento = $fila['Departamento'];
                
                $mensaje ="¡Registros Encontrados Correctamente.!";
                }   
            } 
            else {
                $mensaje =  "El ID que buscaste No existe en la Base de Datos";
            }
        }  
    }
}
if (isset($_POST['btnBorrar'])) {
    include('../bd/bd.php');
    $cone = conectar();
    $ID = $_POST['ID'];

    $sql = "SELECT * FROM datosequipo WHERE iduser = '$ID'";
    $resultado = mysqli_query($cone, $sql);

    if ($ID == "") {
        $mensaje = "Escribe el ID del Usuario a Borrar";
    } else if (mysqli_num_rows($resultado) == 0) {
        $mensaje = "El ID Que Quieres Borrar No Existe en la Base de Datos";
    } else {
        if ($cone == false) {
            $mensaje = "Error: Falla en la conexión a la BD...";
        } else {
            $sql = "DELETE FROM datosequipo WHERE iduser = '$ID'";
            if (mysqli_query($cone, $sql)) {
                $mensaje = "¡Se a Eliminado el Registro con el ID: $ID Exitosamente!";
            } else {
                $mensaje = "Error al eliminar registros: " . mysqli_error($cone);
            }
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
        
        $resultado2 = $cone->query($sql);
        $resultado = mysqli_query($cone, $sql2);
                
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

                
                $id = $fila["iduser"];
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
                $Departamento = $fila['Departamento'];
                
                }   
                require_once('../pdf/tcpdf.php');


                $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
                
                $pdf->SetMargins(10, 10, 10, true);
                $pdf->AddPage();
            
                                    //Agregando los Datos al PDF
            
                $pdf->SetFont('dejavusans', '', 12, '', true);
                $pdf->Cell(0, 10, 'Número de registro: '.str_pad($id, 6, '0', STR_PAD_LEFT), 0, 1, 'R');
                $pdf->Cell(0, 10, 'Año actual: ' . date('Y'), 0, 1, 'R');
            
            
                // Establecer el ancho de las columnas
                $columnWidth = $pdf->GetPageWidth() / 2;

                $pdf->SetFont('dejavusans', 'B', 15);

                // Título columna izquierda
                $pdf->Cell($columnWidth, 10, 'DATOS  DEL EQUIPO: ', 0, 0, 'L');

                // Título columna derecha
                $pdf->SetX($columnWidth+17);
                $pdf->Cell($columnWidth, 10, 'DESEMPEÑO DEL EQUIPO: ', 0, 1, 'L');

                $pdf->SetFont('dejavusans', '', 12, '', true);

                // Contenido columna izquierda
                $pdf->SetY($pdf->GetY() +5); // Agregar espacio entre títulos y contenido izquierdo
                $pdf->SetX(10); // Establecer la posición X para la columna izquierda
                $pdf->MultiCell($columnWidth, 10, 'Nombre: ' . str_pad($NUsuario, STR_PAD_LEFT), 0, 'L');
                $pdf->SetX(10);
                $pdf->MultiCell($columnWidth, 10, 'Apellido Materno: ' . str_pad($APMaterno, STR_PAD_LEFT), 0, 'L');
                $pdf->SetX(10);
                $pdf->MultiCell($columnWidth, 10, 'Apellido Paterno: ' . str_pad($APParteno, STR_PAD_LEFT), 0, 'L');
                $pdf->SetX(10);
                $pdf->MultiCell($columnWidth, 10, 'Marca: ' . str_pad($Marca, STR_PAD_LEFT), 0, 'L');
                $pdf->SetX(10);
                $pdf->MultiCell($columnWidth, 10, 'Modelo: ' . str_pad($Modelo, STR_PAD_LEFT), 0, 'L');
                $pdf->SetX(10);
                $pdf->MultiCell($columnWidth, 10, 'Número de Serie: ' . str_pad($numSerie, STR_PAD_LEFT), 0, 'L');
                $pdf->SetX(10);
                $pdf->MultiCell($columnWidth, 10, 'Número de Inventario: ' . str_pad($numInventario, STR_PAD_LEFT), 0, 'L');
                
        

                // Contenido columna derecha
                $pdf->SetY($pdf->GetY() - 70); // Restablecer la posición Y al mismo nivel que el título
                $pdf->SetX($columnWidth + 20); // Establecer la posición X para la columna derecha
                $pdf->MultiCell($columnWidth, 10, 'SO: ' . str_pad($So, STR_PAD_LEFT), 0, 'L');
                $pdf->SetX($columnWidth + 20);
                $pdf->MultiCell($columnWidth, 10, 'Procesador: ' . str_pad($Procesador, STR_PAD_LEFT), 0, 'L');
                $pdf->SetX($columnWidth + 20);
                $pdf->MultiCell($columnWidth, 10, 'Disco Duro: ' . str_pad($DiscoDuro, STR_PAD_LEFT), 0, 'L');
                $pdf->SetX($columnWidth + 20);
                $pdf->MultiCell($columnWidth, 10, 'Ram: ' . str_pad($Ram, STR_PAD_LEFT), 0, 'L');
                $pdf->SetX($columnWidth + 20);
                $pdf->MultiCell($columnWidth, 10, 'Tipo de Memoria: ' . str_pad($TipoMemoria, STR_PAD_LEFT), 0, 'L');
                $pdf->SetX($columnWidth + 20);
                $pdf->MultiCell($columnWidth, 10, 'Observaciones: ' . str_pad($Observaciones, STR_PAD_LEFT), 0, 'L');
              

                // Título columna izquierda inferior
                $pdf->SetFont('dejavusans', 'B', 15);
                $pdf->Cell($columnWidth, 40, 'DATOS DE LA RED: ', 0, 1, 'L');

            
                // Contenido columna izquierda inferior
                $pdf->SetY($pdf->GetY() -11); 
                $pdf->SetFont('dejavusans', '', 12, '', true);
                $pdf->SetX(10); // Establecer la posición X para la columna izquierda inferior
                $pdf->MultiCell($columnWidth, 10, 'Contraseña: ' . str_pad($contraseña, STR_PAD_LEFT), 0, 'L');
                $pdf->SetX(10);
                $pdf->MultiCell($columnWidth, 10, 'Nombre del Equipo: ' . str_pad($NEquipo, STR_PAD_LEFT), 0, 'L');
                $pdf->SetX(10);
                $pdf->MultiCell($columnWidth, 10, 'IP: ' . str_pad($IP, STR_PAD_LEFT), 0, 'L');
                $pdf->SetX(10);
                $pdf->MultiCell($columnWidth, 10, 'Mac: ' . str_pad($Mac, STR_PAD_LEFT), 0, 'L');
                // Agregar más contenido a la columna izquierda inferior

                // Título columna derecha inferior
                $pdf->SetY($pdf->GetY() - 55); // Restablecer la posición Y al mismo nivel que el título
                $pdf->SetX($columnWidth + 20); // Establecer la posición X para la columna derecha inferior
                $pdf->SetFont('dejavusans', 'B', 15);
                $pdf->Cell($columnWidth, 10, 'DEPARTAMENTO: ', 0, 1, 'L'); // Añadir un sal
               

                // Contenido columna derecha inferior
                $pdf->SetFont('dejavusans', '', 12, '', true);
                $pdf->SetY($pdf->GetY() +3);
                $pdf->SetX($columnWidth + 20); // Establecer la posición X para la columna derecha inferior
                $pdf->MultiCell($columnWidth, 10, 'Departamento: ' . str_pad($Departamento, STR_PAD_LEFT), 0, 'L');
                // Agregar más contenido a la columna derecha inferior

                // Título columna central
                $pdf->SetY($pdf->GetY() +30); // Restablecer la posición Y al mismo nivel que el título
                $pdf->SetX($columnWidth -30); // Establecer la posición X para la columna central
                $pdf->SetFont('dejavusans', 'B', 15);
                $pdf->Cell($columnWidth, 10, 'CODIGO DE BARRAS: ', 0, 1, 'L'); // Añadir un salto de línea después del título

                // Contenido columna central
                $pdf->SetFont('dejavusans', '', 12, '', true);
                $pdf->SetX($columnWidth -30); // Establecer la posición X para la columna central
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

    if($NUsuario == "" || $APMaterno == "" || $APParteno == "" ||$Marca == "" ||$Modelo == "" ||$numSerie == "" ||$numInventario == "" 
    ||$So == "" ||$Procesador == "" ||$DiscoDuro == "" ||$Ram == "" ||$TipoMemoria == "" ||$Observaciones == "" ||$contraseña == "" ||
    $NEquipo == "" ||$IP == "" ||$Mac == ""){
        $mensaje ="Se Deben Llenar Todos los Campos Disponibles Exepto el ID";
    }else{
        include('../bd/bd.php');
        $cone = conectar();
        if ($cone == false) {
            $mensaje = "Error: Falla en la conexion a la BD...";
          }
          else{
                $sql = "INSERT INTO DatosEquipo VALUES(NULL,'$NUsuario','$APParteno','$APMaterno','$Marca','$Modelo','$numSerie','$numInventario',
                '$So','$Procesador','$DiscoDuro','$Ram','$TipoMemoria','$Observaciones','$contraseña','$NEquipo','$IP','$Mac','$Departamento')";
                
                    if (operacion($sql,$cone)) {

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
                        $Departamento =  "";
                      $mensaje = "¡Datos registrados correctamente!";
                    }
                    else {
                      $mensaje = "Error: Al registrar los datos ";
                    }
                  
            
            mysqli_close($cone);
          }
    } 
}
if(isset($_POST['btnModificar'])){
    $ID = $_POST['ID'];

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
      }else {
        $sql = "SELECT * FROM DatosEquipo WHERE iduser = $ID";
        $resultado = mysqli_query($cone, $sql);

        // Aquí se realiza la consulta de modificación
        $sql = "UPDATE DatosEquipo SET nombre='$NUsuario', apellidoP='$APParteno', apellidoM='$APMaterno',
        marca='$Marca', modelo='$Modelo', numserie='$numSerie', numInventario='$numInventario', So='$So',
        Procesador='$Procesador', DiscoDuro='$DiscoDuro', Ram='$Ram', TipoMemoria='$TipoMemoria', 
        Observaciones='$Observaciones', contraseña='$contraseña', NEquipo='$NEquipo', IP='$IP',
        Mac='$Mac', Departamento='$Departamento' WHERE iduser=$ID";

        if (operacion($sql, $cone)) {
            $mensaje = "¡Datos modificados correctamente!";

        } 
        else {
            $mensaje = "Error: Al modificar los datos";
        }
    }
}
if (isset($_POST['IDPasar'])) {
   
    $ID = $_POST['IDPasar'];
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

       include('../bd/bd.php');
       $cone = conectar();
       if ($cone == false) {
           $mensaje = "Error: Falla en la conexion a la BD...";
         }
         else{
       
           $sql = "SELECT * FROM datosequipo WHERE iduser = '$ID'";
           $resultado = mysqli_query($cone, $sql);
       
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
               $Departamento = $fila['Departamento'];
               
               $mensaje ="¡Registros Encontrados Correctamente.!";
               }   
           } 
           else {
               $mensaje =  "El ID que buscaste No existe en la Base de Datos";
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
    <script>
    function confirmarBorrado() {
        return confirm('¿Estás seguro de que deseas borrar este registro?');
    }
</script>
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
                <label for="ID" >Número de ID:
                <input type="number" name="ID" id="ID" class="entrada" pattern="[0-9]+" value="<?php if(isset($_POST['btnBuscar']) || isset($_POST['IDPasar']))echo $ID; ?>">

                <span class="error"></span><br>
                <p class="Notas"><b>NOTA:</b> No es necesario llenar el campo del <b>ID</b> en caso de querer Guardar</p>
                </label>

                <label for="NUsuario" >Nombre del Usuario:
                <input type="text" name="NUsuario" id="NUsuario" class="entrada" pattern="[A-Z ]+"  value="<?php if(isset($_POST['btnBuscar']) || isset($_POST['IDPasar']) || isset($_POST['btnGuardar']))echo $NUsuario; ?>">

                <span class="error"></span><br>
                </label>

                    <label for="APParteno">Apellido Paterno:
                    <input type="text" id="APParteno" name="APParteno" class="entrada" pattern="[A-Z ]+"  value="<?php if(isset($_POST['btnBuscar']) || isset($_POST['IDPasar'])|| isset($_POST['btnGuardar']))echo $APParteno; ?>">
                    <span class="error"></span><br>
                    </label>

                    <label for="APMaterno">Apellido Materno:
                    <input type="text" id="APMaterno" name="APMaterno" class="entrada" pattern="[A-Z ]+"  value="<?php if(isset($_POST['btnBuscar']) || isset($_POST['IDPasar'])|| isset($_POST['btnGuardar']))echo $APMaterno; ?>">
                    <span class="error"></span><br>
                    </label>
            
                    <label for="Marca">Marca:
                    <input type="text" id="Marca" name="Marca" class="entrada" pattern="[A-Z ]+"  value="<?php if(isset($_POST['btnBuscar']) || isset($_POST['IDPasar'])|| isset($_POST['btnGuardar']))echo $Marca; ?>">
                    <span class="error"></span><br>
                    </label>

                    <label for="Modelo">Modelo:
                    <input type="text" id="Modelo" name="Modelo" class="entrada" pattern="[A-Z,0-9,-]+"  value="<?php if(isset($_POST['btnBuscar']) || isset($_POST['IDPasar'])|| isset($_POST['btnGuardar']))echo $Modelo; ?>">
                    <span class="error"></span><br>
                    </label>

                    <label for="numSerie">Numero de Serie:
                    <input type="text" id="numSerie" name="numSerie" class="entrada" value="<?php if(isset($_POST['btnBuscar']) || isset($_POST['IDPasar'])|| isset($_POST['btnGuardar']))echo $numSerie; ?>">
                    <span class="error"></span><br>
                    </label>

                    <label for="numInventario">Numero de Inventario:
                    <input type="number" id="numInventario" name="numInventario" class="entrada" pattern="[0-9]+"  value="<?php if(isset($_POST['btnBuscar']) || isset($_POST['IDPasar']) || isset($_POST['btnGuardar']))echo $numInventario; ?>">
                    <span class="error"></span><br>
                    </label>
                </td>

                <td> 
                    <label for="So">So:
                    <input type="text" id="So" name="So" class="entrada"  value="<?php if(isset($_POST['btnBuscar']) || isset($_POST['IDPasar'])|| isset($_POST['btnGuardar']))echo $So; ?>">
                    <span class="error"></span><br>
                    </label>
            
                    <label for="Procesador">Procesador:
                    <input type="text" id="Procesador" name="Procesador" class="entrada"  value="<?php if(isset($_POST['btnBuscar']) || isset($_POST['IDPasar'])|| isset($_POST['btnGuardar']))echo $Procesador; ?>">
                    <span class="error"></span><br>
                    </label>

                    <label for="DiscoDuro">Disco Duro:
                    <input type="text" id="DiscoDuro" name="DiscoDuro" class="entrada" pattern="[0-9]+([G,M,B,]{1})"  value="<?php if(isset($_POST['btnBuscar']) || isset($_POST['IDPasar'])|| isset($_POST['btnGuardar']))echo $DiscoDuro; ?>">
                    <span class="error"></span><br>
                    </label>

                    <label for="Ram">Memoria Ram:
                    <input type="text" id="Ram" name="Ram" class="entrada" pattern="[0-9]+([G,M,B,]{1})"  value="<?php if(isset($_POST['btnBuscar']) || isset($_POST['IDPasar'])|| isset($_POST['btnGuardar']))echo $Ram; ?>">
                    <span class="error"></span><br>
                    </label>

                    <label for="TipoMemoria">Tipo de Memoria:
                    <input type="text" id="TipoMemoria"  name="TipoMemoria" class="entrada"  value="<?php if(isset($_POST['btnBuscar']) || isset($_POST['IDPasar'])|| isset($_POST['btnGuardar']))echo $TipoMemoria; ?>">
                    <span class="error"></span><br>
                    </label>

                    <label for="Observaciones">Observaciones:
                    <input type="text" id="Observaciones"  name="Observaciones" class="CajonGrande"  value="<?php if(isset($_POST['btnBuscar']) || isset($_POST['IDPasar'])|| isset($_POST['btnGuardar']))echo $Observaciones; ?>">
                    <span class="error"></span><br>
                    </label>
                </td>
                <td> 
                    <label for="contraseña">Contraseña:
                    <input type="password" id="contraseña"  name="contraseña" class="entrada"  value="<?php if(isset($_POST['btnBuscar']) || isset($_POST['IDPasar'])|| isset($_POST['btnGuardar']))echo $contraseña; ?>">
                    <span class="error"></span><br>
                    </label>

                    <label for="NEquipo">Nombre del Equipo:
                    <input type="text" id="NEquipo"  name="NEquipo" class="entrada" pattern="[A-Z,0-9]+"  value="<?php if(isset($_POST['btnBuscar']) || isset($_POST['IDPasar'])|| isset($_POST['btnGuardar']))echo $NEquipo; ?>">
                    <span class="error"></span><br>
                    </label>

                    <label for="IP">IP:
                    <input type="text" id="IP"  name="IP" class="entrada" pattern="((^|\.)((25[0-5]_*)|(2[0-4]\d_*)|(1\d\d_*)|([1-9]?\d_*))){4}_*$"  value="<?php if(isset($_POST['btnBuscar']) || isset($_POST['IDPasar'])|| isset($_POST['btnGuardar']))echo $IP; ?>">
                    <span class="error"></span><br>
                    </label>

                    <label for="Mac" >Mac:
                    <input type="text" id="Mac"  name="Mac" class="entrada"  value="<?php if(isset($_POST['btnBuscar']) || isset($_POST['IDPasar'])|| isset($_POST['btnGuardar']))echo $Mac; ?>">
                    <span class="error"></span><br>
                    </label>

                    <button id="btnBuscar" name="btnBuscar" class="boton" type="submit">BUSCAR</button>
                    <button id="btnGuardar" name="btnGuardar" class="boton" type="submit">GUARDAR</button>
                    
                    <br><br><br>
                    <button id="btnBorrar" name="btnBorrar" class="boton" type="submit" onclick="return confirmarBorrado()">BORRAR</button>
                    <button id="btnModificar" name="btnModificar" class="boton" type="submit">MODIFICAR</button>
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
                    <select name="Departamento" class="entradaS" >
                    <option value="">Seleccione un Departamento</option>
                        <?php foreach($listDepartamentos as $item =>$key  ):?>
                            <option value="<?=$item?>" <?php if(isset($Departamento))echo ((ltrim($Departamento)==$item)?'selected':'')?> >
                              <?=$key?>
                            </option>    
                        <?php endforeach;?>                      
                    </select>
                    <br><br>
                </td>
               
            </table><br>
            <?php
                if ($mensaje == "¡Datos modificados correctamente!" || $mensaje == "¡Datos registrados correctamente!" || $mensaje == "¡Se a Eliminado el Registro con el ID: $ID Exitosamente!" || $mensaje == "¡Registros Encontrados Correctamente.!" || $mensaje == "¡Registro Descargado Correctamente.!") {
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