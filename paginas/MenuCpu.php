<?php
if(isset($_POST['btnCPU'])){
    header('CPUS.php');
}
if(isset($_POST['btnCPUAvan'])){
    header('CPUSAvan.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MANTENIMIENTO DE CPU'S</title>
    <link rel="stylesheet" href="../css/pagina.css">
    <link rel="shortcut icon" href="../img/crode.png">
</head>
<header>
    <h1>MANTENIMIENTO DE CPU'S</h1>
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
            <table>
                <tr>
                    <td><h1>GUARDAR</h1></td>
                    <td><h1>AVANZADA</h1></td>
                </tr>
                
           <td>
           <a href="CPUS.php"> 
            <button type = "submit" name="btnCPU"> 
                <img src="../img/crode.png" class="imagen">
            </button>
            </td>

            <td>
            <a href="CPUSAvan.php">
                <button type = "submit" name="btnCPUAvan"> 
                <img src="../img/crode.png" class="imagen">
            </button>
           </td>
       
            </table>
             
        </section>
    </main>
    <footer>

    </footer>
</body>
</html>