<!--
* Nombre: JESUS ANGEL RUIZ GONZALEZ
* Fecha: 06/11/2024 
* Modulo: DWES
* UD2 
* Tarea: DWES02 - Tarea de Evaluación - Página Gestión de Vehículos
-->

<?php
    session_start();
    session_destroy();
    $index = 'http://localhost/ud2-te/index.php';
    header('Location: '.$index);
?>