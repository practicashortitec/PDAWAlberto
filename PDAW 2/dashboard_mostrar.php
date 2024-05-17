<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Hábitos | Habit Tracker</title>

    <link rel="stylesheet" href="css/estiloDashboard.css">
    <link rel="stylesheet" href="css/estiloDashboard.css">
    <link rel="stylesheet" href="css/darkmode.css">
    <script src="js/darkmode.js"></script>

    <link rel="icon" href="img/favicon.png" type="image/x-icon">

    <meta name="title" content="Mostrar Hábitos | Habit Tracker">
    <meta name="description" content="Controla tus hábitos con eficacia. Habit Tracker PDAW Alberto te ayuda a seguir tus rutinas diarias y alcanzar tus metas de manera organizada.">
    <meta name="keywords" content="Seguimiento de hábitos, Gestión de rutinas, Organizador personal, Productividad diaria, Planificación de actividades, Registro de objetivos, Seguimiento de progreso, Mejora de hábitos, Administrador de tareas, Control de actividades diarias">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="Spanish">
    <meta name="author" content="Alberto Saporta Albelda">
    <style>

    </style>

</head>

<body>

    <?php
    session_start();

    if (isset($_SESSION['email'])) {
        echo "<p class='mensajeU'>¿Has cumplido tus objetivos, " . $_SESSION['nombre'] . "? 🤔 " . "</p>";
    } else {
        header("Location: login.php");
        exit();
    }

    ?>

    <div class="dark-mode">
        <label class="switch" for="input">
            <input type="checkbox" id="input">
            <span class="slider"></span>

        </label>

        <img onclick="window.location.href='logout.php'" src="img/logout.png" width="30" id="imgLogout">

    </div>

    <div class="logout">

    </div>
    <div class='container'>
        <div class="logo">
            <img src="img/logo.png" id="logoPDAW" alt="Logo PDAW" width="176">
        </div>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class='window'>
                <div class='content'>
                    <h1>Tracker</h1>
                    <div class="fechas">
                        <div id="in">
                            <label dia="dia_in">Selecciona Día Inicio Semana</label>
                            <input type="date" id="dia_in" class="dia_in" name="dia_in" required="required">
                        </div>
                        <div id="out">
                            <label for="dia_out">Selecciona Día Fin Semana</label>
                            <input type="date" id="dia_out" class="dia_out" name="dia_out" required="required">
                        </div>
                        <div class="nota">
                            <img src="img/nota.png" width="25" height="25" id="nota">
                        </div>
                    </div>

                </div>
                <div class="container-secundario">

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

                        <?php

                        if (!isset($_SESSION['email'])) {
                            header("Location: login.php");
                            exit();
                        }

                        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['dia_in']) && isset($_POST['dia_out'])) {
                            $email = $_SESSION['email'];

                            $dia_in = $_POST['dia_in'];
                            $dia_out = $_POST['dia_out'];

                            $conexion = new mysqli("localhost", "root", "", "pdaw-alberto");


                            if ($conexion->connect_error) {
                                die("Error de conexión: " . $conexion->connect_error);
                            }

                            $sql = "SELECT * FROM tracker WHERE email = ? AND dia_in >= ? AND dia_out <= ?";
                            $consulta = $conexion->prepare($sql);
                            $consulta->bind_param("sss", $email, $dia_in, $dia_out);
                            $consulta->execute();
                            $resultado = $consulta->get_result();

                            if ($resultado->num_rows > 0) {
                                echo "<table border='0'>";
                                echo "<tr><th>Día Inicio</th><th>Día Fin</th><th>Hábito</th>
                                        <th style=' width: 60px; '>Lunes</th>
                                        <th style=' width: 60px; '>Martes</th>
                                        <th style=' width: 60px; '>Miércoles</th>
                                        <th style=' width: 60px; '>Jueves</th>
                                        <th style=' width: 60px; '>Viernes</th>
                                        <th style=' width: 60px; '>Sábado</th>
                                        <th style=' width: 60px; '>Domingo</th></tr>";
                                while ($fila = $resultado->fetch_assoc()) {
                                    echo "<tr style='margin-bottom:2em;'>";
                                    echo "<td style='font-style: italic; font-size: 0.875em; color:rgba(255, 255, 255, 0.42);'>" . $fila['dia_in'] . "</td>";
                                    echo "<td style='font-style: italic; font-size: 0.875em; color:rgba(255, 255, 255, 0.42);'>" . $fila['dia_out'] . "</td>";
                                    echo "<td style='text-align: center;'>" . $fila['habit'] . "</td>";
                                    echo "<td" . ($fila['dia1'] == 1 ? " style='background-color: #0fffc1; text-align: center;'" : " style='background-color: #ff0f0f81; text-align: center;'") . "> </td>";
                                    echo "<td" . ($fila['dia2'] == 1 ? " style='background-color: #0fffc1; text-align: center;'" : " style='background-color: #ff0f0f81; text-align: center;'") . "> </td>";
                                    echo "<td" . ($fila['dia3'] == 1 ? " style='background-color: #0fffc1; text-align: center;'" : " style='background-color: #ff0f0f81; text-align: center;'") . "> </td>";
                                    echo "<td" . ($fila['dia4'] == 1 ? " style='background-color: #0fffc1; text-align: center;'" : " style='background-color: #ff0f0f81; text-align: center;'") . "> </td>";
                                    echo "<td" . ($fila['dia5'] == 1 ? " style='background-color: #0fffc1; text-align: center;'" : " style='background-color: #ff0f0f81; text-align: center;'") . "> </td>";
                                    echo "<td" . ($fila['dia6'] == 1 ? " style='background-color: #0fffc1; text-align: center;'" : " style='background-color: #ff0f0f81; text-align: center;'") . "> </td>";
                                    echo "<td" . ($fila['dia7'] == 1 ? " style='background-color: #0fffc1; text-align: center;'" : " style='background-color: #ff0f0f81; text-align: center;'") . "> </td>";
                                    echo "</tr>";
                                }
                                echo "</table>";
                            } else {
                                echo "No se encontraron datos para el rango de fechas seleccionado.";
                            }

                            $conexion->close();
                        }
                        ?>
                    </form>

                    <div class="categoria-div">
                        <p id="categorias"></p>
                    </div>


                </div>


                <div class="input-añadir">
                    <input type="submit" value="Mostrar" id="añadir">
                </div>





                <div class="input-mostrar">
                    <input type="button" value="Añadir ➕ Hábitos" id="mostrar" onclick="window.location.href='dashboard.php'">
                </div>

            </div>

        </form>
    </div>

    <script>
        document.getElementById('nota').addEventListener('click', function() {
            var xhr = new XMLHttpRequest();

            xhr.open('GET', 'php/obtener_notas.php', true);

            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 300) {
                    var notas = JSON.parse(xhr.responseText);
                    var mensaje = "";
                    notas.forEach(function(nota) {
                        mensaje += "Del día: " + nota.dia_in + " al día: " + nota.dia_out + ": " + nota.nota + "\n";
                    });
                    alert(mensaje);
                } else {
                    alert('Hubo un error al obtener las notas del servidor.');
                }
            };

            xhr.onerror = function() {
                alert('Error de red al intentar obtener las notas.');
            };

            xhr.send();

        });


    </script>

</body>

</html>