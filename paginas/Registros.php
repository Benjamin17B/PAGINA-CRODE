<?php
$mensaje = "";
$listDepartamentos = [
    'ST' => "Subdirección técnica",
    'SA' => "Subdirección administrativa",
    'RMS' => "Recursos materiales y de servicios",
    'RM' => "Recursos humanos",
    'RF' => "Recursos financieros",
    'PRO' => "Producción",
    'PPP' => "Planeación, Programación y Presupuestación",
    'MTG' => "Metrologia",
    'GTV' => "Gestión tecnológica y vinculación",
    'DDE' => "Diseño y Desarrollo de Equipo",
    'DIR' => "Dirección",
    'CIT' => "Centro de información técnica",
    'ATM' => "Asistencia técnica y mantenimiento",
    'AM' => "Administración de la Calidad",
    'NA' => "ninguna"
];

if (isset($_GET['Departamento'])) {
    $departamento = $_GET['Departamento'];

    // Realiza la conexión a la base de datos y realiza la consulta
    // Asegúrate de utilizar las credenciales correctas para tu base de datos
    include('../bd/bd.php');
    $conn = conectar();

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM tu_tabla WHERE Departamento = '$departamento'";
    $result = $conn->query($sql);

    // Genera la tabla HTML con los datos obtenidos
    if ($result->num_rows > 0) {
        $mensaje .= "<table>";
        $mensaje .= "<tr><th>ID User</th><th>Número de Equipo</th><th>IP</th></tr>";
        while ($row = $result->fetch_assoc()) {
            $mensaje .= "<tr>";
            $mensaje .= "<td>" . $row['iduser'] . "</td>";
            $mensaje .= "<td>" . $row['NEquipo'] . "</td>";
            $mensaje .= "<td>" . $row['IP'] . "</td>";
            $mensaje .= "</tr>";
        }
        $mensaje .= "</table>";
    } else {
        $mensaje = "No se encontraron resultados.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
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
                <li><a href="#">IMPRESORAS</a></li>
            </ul>
        </li>
    </ul>
</nav>
<body>
    <main>
        <section>
            <select name="Departamento" class="entradaS" onchange="mostrarTabla()">
                <option value="">Seleccione un Departamento</option>
                <?php foreach ($listDepartamentos as $item => $key) : ?>
                    <option value="<?= $item ?>" <?php if (isset($departamento) && $departamento == $item) echo 'selected' ?>>
                        <?= $key ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <div id="tablaDatos"><?= $mensaje ?></div>

        </section>
    </main>

    <script>
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
                xhttp.open("GET", "CPUS.php?departamento=" + departamento, true);
                xhttp.send();
            } else {
                document.getElementById("tablaDatos").innerHTML = "";
            }
        }
    </script>
</body>
</html>
