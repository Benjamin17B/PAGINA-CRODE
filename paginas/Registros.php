<?php
$mensaje = "";
$listDepartamentos = [
    'STD'=> "Seleccionar Todos los Departamentos",
    'ST' => "Subdirección técnica",
    'SA' => "Subdirección administrativa",
    'RMS' => "Recursos materiales y de servicios",
    'RM' => "Recursos humanos",
    'RF' => "Recursos financieros",
    'PRO' => "Producción",
    'PPP' => "Planeación, Programación y Presupuestación",
    'MTG' => "Metrología",
    'GTV' => "Gestión tecnológica y vinculación",
    'DDE' => "Diseño y Desarrollo de Equipo",
    'DIR' => "Dirección",
    'CIT' => "Centro de información técnica",
    'ATM' => "Asistencia técnica y mantenimiento",
    'AM' => "Administración de la Calidad",
    'NA' => "ninguna"
];

// Obtén el valor del parámetro 'departamentos' enviado por el formulario
if (isset($_POST['departamentos'])) {
    $departamentos = $_POST['departamentos'];

    // Realiza la conexión a la base de datos y realiza la consulta
    // Asegúrate de utilizar las credenciales correctas para tu base de datos
    include('../bd/bd.php');
    $conn = conectar();

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM datosequipo WHERE Departamento = '$departamentos'";
    if($departamentos == "STD"){
        $sql = "SELECT * FROM datosequipo";
    }
    $result = $conn->query($sql);

    // Genera la tabla HTML con los datos obtenidos
    if ($result->num_rows > 0) {
        $mensaje .= "<table>";
        $mensaje .= "<tr><th>ID del Usuario</th><th>Número de Equipo</th><th>IP</th><th>No°Inventario</th><th>Departamento</th></tr>";
        while ($row = $result->fetch_assoc()) {
            $mensaje .= "<tr>";
            $mensaje .= "<td>" . $row['iduser'] . "</td>";
            $mensaje .= "<td>" . $row['NEquipo'] . "</td>";
            $mensaje .= "<td>" . $row['IP'] . "</td>";
            $mensaje .= "<td>" . $row['numInventario'] . "</td>";
            $mensaje .= "<td>" . $row['Departamento']. "</td>";
            $mensaje .= "<td>  
                            <form method='post' action='CPUS.php'>
                                <input type='hidden' name='IDPasar' value='" . $row['iduser'] . "'>
                                <button type='submit' class='boton'>Acceder</button>
                            </form>
                        </td>";
            $mensaje .= "</tr>";
        }
        $mensaje .= "</table>";
    } else {
        if($departamentos == ""){
            $mensaje = "Seleccione un Departamento";
        }
        else if($departamentos == "NA"){
            $mensaje = "No hay Registros que no se Hallan Asignado a Ningun Departamento";
        }
        else{
            $mensaje .= "No se encontraron registros en el departamento de $departamentos";
        }
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>CPU'S</title>
    <link rel="stylesheet" href="../css/pagina.css">
    <link rel="shortcut icon" href="../img/crode.png">
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
				</ul>
			</li>
		</ul>
	</nav>

<body>
    <main>
        <p class="tituloCorto">Seleccione un departamento</p>
        <section>
            <form method="post" action="">
                <label for="departamentos">Departamento:</label>
                <select name="departamentos" id="departamentos" class="entrada">
                <option value="">Seleccione un Departamento</option>
                    <?php
                    foreach ($listDepartamentos as $key => $value) {
                        echo "<option value='$key'>$value</option>";
                    }
                    ?>
                </select>
                <button type="submit" class="boton">Buscar</button>
            </form><br><br>
      
        <?php echo $mensaje; ?><br><br>

        </section>
    </main>
</body>

</html>
