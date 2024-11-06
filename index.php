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
    <title>Procesamiento de Reserva</title>
</head>
<body>
    <header>
        <h1>Procesamiento de Reserva</h1>
    </header>
    
    <main>
        <!-- Sección de Introducción de Datos -->
        <section id="input-section">
            <h2>Introducir Datos de Usuario</h2>
            <form action="request.php" method="post" id="datosUsuario">
                <label for="nombre">Nombre:</label>
                <input id="nombre" name="nombre">
                <br>
                <label for="apellido">Apellido:</label>
                <input id="apellido" name="apellido">
                <br>
                <label for="dni">DNI:</label>
                <input id="dni" name="dni">
                <br>

                
                <label for="modeloVehiculo">Elige un vehículo:</label>
                <select id="vehiculo" name="modelo">
                    <option value="Lancia Stratos">Lancia Stratos</option>
                    <option value="Audi Quattro">Audi Quattro</option>
                    <option value="Ford Escort RS1800">Ford Escort RS1800</option>
                    <option value="Subaru Impreza 555">Subaru Impreza 555</option>
                </select>
                <br>
                
                <label for="date">Fecha de Inicio de la Reserva:</label>
                <input type="date" id="date" name="fechaInicio">
                <br>
                <label for="kilometers">Duración de la Reserva (en días):</label>
                <input type="number" id="dias" name="dias">
                <br>
                <button type="submit">Procesar reserva</button>
            </form>
        </section>
    </main>
</body>
</html>