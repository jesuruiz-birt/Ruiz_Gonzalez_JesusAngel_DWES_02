<!--
* Nombre: JESUS ANGEL RUIZ GONZALEZ
* Fecha: 06/11/2024 
* Modulo: DWES
* UD2 
* Tarea: DWES02 - Tarea de Evaluación - Página Gestión de Vehículos
-->

<?php
    session_start();
?>

<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Reserva válida</title>
</head>
<body>
    <header>
        <h1>Reserva válida</h1>
    </header>
    
    <main>

        <p>Nombre: <?=$_SESSION['nombre']?></p>
        <p>Apellido: <?=$_SESSION['apellido']?></p>
                
        <p>Vehículo elegido: <?=$_SESSION['modelo']?></p>
        <?='<img src="./imagenes/'.$_SESSION['modelo'].'.jpg" width="640" height="460" alt="'.$_SESSION['modelo'].'"/><br>'?>

        <br>
        <a href="cerrar.php">Cerrar sesión</a>

    </main>
</body>
</html>

