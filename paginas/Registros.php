<?php
$mensaje = "";
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
        <select name="Departamento" class="entradaS" >
                    <option value="">Seleccione un Departamento</option>
                        <?php foreach($listDepartamentos as $item =>$key  ):?>
                            <option value="<?=$item?>" <?php if(isset($Departamento))echo ((ltrim($Departamento)==$item)?'selected':'')?> >
                              <?=$key?>
                            </option>    
                        <?php endforeach;?>                      
                    </select>
        
    </section>
</main>

</body>
</html>

<!-- localhost:8017/PRACTICA/paginas/CPU'S.php -->