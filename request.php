<!--
* Nombre: JESUS ANGEL RUIZ GONZALEZ
* Fecha: 06/11/2024 
* Modulo: DWES
* UD2 
* Tarea: DWES02 - Tarea de Evaluación - Página Gestión de Vehículos
-->

<?php
    session_start();
    require 'usuarios_y_coches.php';
?>

<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Reserva no válida</title>
</head>
<body>
    <header>
        <h1>Reserva no valida</h1>
    </header>
    
    <main>
        <?php
            //Recuperamos los datos del formulario
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $dni = $_POST['dni'];
            $modelo = $_POST['modelo'];
            $fechaInicio = $_POST['fechaInicio'];
            $dias = $_POST['dias'];

            //Comprobamos los campos vacíos
            $verificarCamposVacios = comprobarCamposVacios($nombre, $apellido);
            
            //Validamos el DNI
            $verificarDNI = false;
            if(validarDNI($dni)){
                echo '<span style="color: green;">El DNI '. $dni .'  es válido</span><br>';
                $verificarDNI = true;
            } else {
                echo '<span style="color: red;">El DNI no es válido</span><br>';
                $verificarDNI = false;
            }
            
            //Validamos los datos de usuario
            $verificarUsuario = false;
            if(buscarUsuario($nombre, $apellido, $dni, USUARIOS)){
                echo '<span style="color: green;">El usuario '. $nombre .', '. $apellido .', '. $dni .' es válido</span><br>';
                $verificarUsuario = true;
            } else {
                echo '<span style="color: red;">El usuario no es válido</span><br>';
                $verificarUsuario = false;
            }

            //Validamos la fecha que no sea anterior
            $verificarFecha = comparaFecha($fechaInicio);

            //Validamos el rango de días
            $verificarDias = comprobarDías($dias);

            //echo cocheDisponible($coches, $modelo);
            $verificarDisponible = false;
            if (cocheDisponible($coches, $modelo)) {
                echo '<span style="color: green;">El coche '. $modelo . ' está disponible.</span><br>'; 
                $verificarDisponible = true;
            } else { 
                echo '<span style="color: red;">El coche ' . $modelo . ' no está disponible.</span><br>'; 
                $verificarDisponible = false;
            }
       ?>

        <br>
        <a href="index.php">Volver a inicio</a>

        <?php
            if($verificarCamposVacios === true && $verificarDNI === true && $verificarUsuario === true && $verificarFecha === true && $verificarDias === true && $verificarDisponible === true) {

                //Guardamos datos de reserva en la sesión
                $_SESSION['nombre'] = $nombre;
                $_SESSION['apellido'] = $apellido;
                $_SESSION['dni'] = $dni;
                $_SESSION['modelo'] = $modelo;
                $_SESSION['fechaInicio'] = $fechaInicio;
                $_SESSION['dias'] = $dias;

                //Enlaza con la página de verificación
                header("Location: verificado.php");
            }
        ?>
    </main>
</body>
</html>

<?php
    // Función para comprobar si los campos nombre y apellido están vacios.
    function comprobarCamposVacios($nombre, $apellido){
        
        if (!empty($nombre) && !empty($apellido)){
            //echo '<span style="color: green;">Los campos nombre y apellido están rellenados.</span><br>';
            echo '<span style="color: green;">Nombre: '.$nombre.'</span><br>';
            echo '<span style="color: green;">Apellido: '.$apellido.'</span><br>';
            return true;
        } else if(empty($nombre) && !empty($apellido)){
            echo '<span style="color: red;">El campo nombre está vacío.</span><br>';
            echo '<span style="color: green;">Apellido: '.$apellido.'</span><br>';
        } else if(!empty($nombre) && empty($apellido)){
            echo '<span style="color: green;">Nombre: '.$nombre.'</span><br>';
            echo '<span style="color: red;">El campo apellido está vacío.</span><br>';
        } else {
            echo '<span style="color: red;">El campo nombre está vacío.</span><br>';
            echo '<span style="color: red;">El campo apellido está vacío.</span><br>';
        }
        return false;
    }

    // Función para validar la letra del DNI
    function validarDNI($dni){
        if (empty($dni)){
            return false;
        }

        $letras = "TRWAGMYFPDXBNJZSQVHLCKE";
        $numero = substr($dni, 0, -1);
        $letra = substr($dni, -1);

        $calculaLetra = strtoupper(substr($letras,strtr($numero,"XYZ","012")%23,1));
        if($calculaLetra === $letra) {
            $devuelve = true;
        } else {
            $devuelve = false;
        }
        return $devuelve;
    }

    // Función que busca que coincidan todos los datos de un usuario en el array.
    function buscarUsuario($nombre, $apellido, $dni, $arrayUsuarios) {
        
        foreach ($arrayUsuarios as $usuario) {
            foreach ($usuario as $key => $value) {
                if ($usuario['nombre'] === $nombre && $usuario['apellido'] === $apellido && $usuario['dni'] === $dni) {
                    return $usuario; 
                }
            }
            
        }
        return false; 
    }

    // Función que compara la fecha introducida con la fecha actual
    function comparaFecha($fechaInicio) {
        if ($fechaInicio<date("Y-m-d")) {
            echo '<span style="color: red;">La fecha '. $fechaInicio .' es anterior a la actual.</span><br>';
            return false;
        } else {
            echo '<span style="color: green;">La fecha '. $fechaInicio .' es igual ó posterior a la actual.</span><br>';
            return true;
        }
    }

    // Función que comprueba que el número de días esté dentro del margen establecido.
    function comprobarDías($dias) {
        if ($dias<1 || $dias>30) {
            echo '<span style="color: red;">La duración debe ser un número entero entre 1 y 30 días.</span><br>';
            return false;
        } else {
            echo '<span style="color: green;">La duración es correcta.</span><br>';
            return true;
        }
    }

    // Función para comprobar si el coche está disponible.
    function cocheDisponible($coches, $modelo) {
        
        foreach ($coches as $coche) {
            if (strcmp($coche['modelo'], $modelo) === 0){
                return $coche['disponible'];
            }
        }
        return false;
    }
?>