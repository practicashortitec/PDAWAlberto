<?php

// Iniciar sesión
session_start();

// Verificar si se recibieron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conexion = new mysqli("localhost", "root", "", "pdaw-alberto");

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $consulta = $conexion->prepare("INSERT INTO tracker (email,dia_in, dia_out ,habit ,dia1 ,dia2 ,dia3 ,dia4 ,dia5 ,dia6 ,dia7) VALUES (?,?,?,?,?,?,?,?,?,?,?)");

    foreach ($_POST['rutina'] as $fila) {



        $mail = $_SESSION['email'];

        $dia_in = $_POST['dia_in'];
        $dia_out = $_POST['dia_out'];

        $habit = $fila['habit'];
        $categoria = $fila['categoria'];
        $dia1 = isset($fila['fila_lunes']) && $fila['fila_lunes'] == 'on' ? 1 : 0;
        $dia2 = isset($fila['fila_martes']) && $fila['fila_martes'] == 'on' ? 1 : 0;
        // $dia3=isset($fila['fila_miércoles'])&& $fila['fila_miércoles'] == 'on' ? 1:0;
        $dia3 = (isset($fila['fila_miércoles']) && $fila['fila_miércoles'] == 'on') || (isset($fila['fila_miercoles']) && $fila['fila_miercoles'] == 'on') ? 1 : 0;
        $dia4 = isset($fila['fila_jueves']) && $fila['fila_jueves'] == 'on' ? 1 : 0;
        $dia5 = isset($fila['fila_viernes']) && $fila['fila_viernes'] == 'on' ? 1 : 0;
        //   $dia6=isset($fila['fila_sábado'])&& $fila['fila_sábado'] == 'on' ? 1:0;
        $dia6 = (isset($fila['fila_sábado']) && $fila['fila_sábado'] == 'on') || (isset($fila['fila_sabado']) && $fila['fila_sabado'] == 'on') ? 1 : 0;
        $dia7 = isset($fila['fila_domingo']) && $fila['fila_domingo'] == 'on' ? 1 : 0;

        $consulta->bind_param('ssssiiiiiii', $mail, $dia_in, $dia_out, $habit, $dia1, $dia2, $dia3, $dia4, $dia5, $dia6, $dia7);

       
     

        if ($consulta->execute()) {
            $id_habito = $conexion->insert_id;

            $consulta3 = $conexion->prepare("INSERT INTO categoria (categoria, id_habito) VALUES (?, ?)");
            $consulta3->bind_param('si', $categoria, $id_habito);
            if (!$consulta3->execute()) {
                echo "Fallo al insertar en la tabla categoria: " . $consulta3->error;
                exit();
            }
        } else {
            header("Location: ../dashboard.php?error=Usuario y/o contraseña incorrectos");
            exit(); 
        }



        header("Location: ../dashboard.php?exito=1");
    }

    $email = $_SESSION['email'];
    $dia_in = $_POST['dia_in'];
    $dia_out = $_POST['dia_out'];

    $nota = $_POST['nota'];

    $consultaNota = $conexion->prepare("INSERT INTO nota (nota, email, dia_in, dia_out) VALUES (?, ?, ?, ?)");

    $consultaNota->bind_param('ssss', $nota, $email, $dia_in, $dia_out);

    if ($consultaNota->execute()) {

    } else {
        echo "Error al insertar la nota: " . $conexion->error;
    }

    $conexion->close();
}
