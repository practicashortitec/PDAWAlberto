<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Hábitos | Habit Tracker</title>

    <link rel="stylesheet" href="css/estiloDashboard.css">
    <link rel="stylesheet" href="css/darkmode.css">
    <script src="js/darkmode.js"></script>


    <link rel="icon" href="img/favicon.png" type="image/x-icon">

    <meta name="title" content="Añadir Hábitos | Habit Tracker">
    <meta name="description" content="Controla tus hábitos con eficacia. Habit Tracker PDAW Alberto te ayuda a seguir tus rutinas diarias y alcanzar tus metas de manera organizada.">
    <meta name="keywords" content="Seguimiento de hábitos, Gestión de rutinas, Organizador personal,    Productividad diaria, Planificación de actividades, Registro de objetivos, Seguimiento de progreso, Mejora de hábitos, Administrador de tareas, Control de actividades diarias">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="Spanish">
    <meta name="author" content="Alberto Saporta Albelda">

</head>

<body>

    <?php
    session_start();

    if (isset($_SESSION['email'])) {
        echo "<p class='mensajeU'>Hola " . $_SESSION['nombre'] . " 👋 " . "</p>";
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

    <div class="logout"></div>

    <div class='container'>
        <div class="logo">
            <img src="img/logo.png" id="logoPDAW" alt="Logo PDAW" width="176">
        </div>

        <form id="formulario-habitos" action="php/guardar_datos.php" method="POST">

            <div class='window'>
                <div class='content'>
                    <h1>Habit Tracker</h1>
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
                            <img src="img/nota.png" width="25" height="25" name="nota" id="nota">
                        </div>
                    </div>

                </div>
                <div class="container-secundario">
                    <table id="tabla-habitos" border="0">
                        <tr>
                            <th>Hábito</th>
                            <th>Categoría</th>
                            <th class="th-dia">Lunes</th>
                            <th class="th-dia">Martes</th>
                            <th class="th-dia">Miércoles</th>
                            <th class="th-dia">Jueves</th>
                            <th class="th-dia">Viernes</th>
                            <th class="th-dia">Sábado</th>
                            <th class="th-dia">Domingo</th>
                            <th class="th-dia"></th>
                        </tr>
                        <tbody id="tbody-habitos">
                            <tr id="fila_1">

                                <td><input type="text" placeholder="Hábito" name="rutina[1][habit]" class="input-line" id="habito_1"></td>

                                <td>
                                    <select class="input-line" name="rutina[1][categoria]" id="categoria_1">
                                        <option name="null" value="null" selected disabled>Elige...</option>
                                        <option name="fisico" value="fisico">Físico</option>
                                        <option name="afectivo" value="afectivo">Afectivo</option>
                                        <option name="social" value="social">Social</option>
                                        <option name="moral" value="moral">Moral</option>
                                        <option name="intelectual" value="intelectual">Intelectual</option>
                                        <option name="mental" value="mental">Mental</option>
                                        <option name="higiene" value="higiene">Higiene</option>
                                        <option name="costumbrista" value="costumbrista">Costumbrista</option>
                                        <option name="saludable" value="saludable">Saludable</option>
                                        <option name="recreativo" value="recreativo">Recreativo</option>

                                    </select>

                                </td>


                                <td>
                                    <div class="checkbox-wrapper-19"><input type="checkbox" id="fila_1_lunes" name="rutina[1][fila_lunes]" /></div>
                                </td>
                                <td>
                                    <div class="checkbox-wrapper-19"><input type="checkbox" id="fila_1_martes" name="rutina[1][fila_martes]" /></div>
                                </td>
                                <td>
                                    <div class="checkbox-wrapper-19"><input type="checkbox" id="fila_1_miercoles" name="rutina[1][fila_miercoles]" /></div>
                                </td>
                                <td>
                                    <div class="checkbox-wrapper-19"><input type="checkbox" id="fila_1_jueves" name="rutina[1][fila_jueves]" /></div>
                                </td>
                                <td>
                                    <div class="checkbox-wrapper-19"><input type="checkbox" id="fila_1_viernes" name="rutina[1][fila_viernes]" /></div>
                                </td>
                                <td>
                                    <div class="checkbox-wrapper-19"><input type="checkbox" id="fila_1_sabado" name="rutina[1][fila_sabado]" /></div>
                                </td>
                                <td>
                                    <div class="checkbox-wrapper-19"><input type="checkbox" id="fila_1_domingo" name="rutina[1][fila_domingo]" /></div>
                                </td>
                                <td><button class="eliminar" id="eliminar_1">X</button></td>


                                <input type="hidden" id="checkboxIds" name="checkboxIds" value="">
                                <input type="hidden" id="campoNota" name="nota" value="">
                            </tr>
                        </tbody>
                    </table>

                </div>

                <div class="input-añadir">
                    <input type="button" value="Añadir Hábito" id="añadir">
                </div>

                <div class="input-guardar">
                    <input type="submit" value="Guardar" id="guardar">
                </div>

                <div class="input-mostrar">
                    <input type="button" value="Mostrar Datos" id="mostrar" onclick="window.location.href='dashboard_mostrar.php'">
                </div>


            </div>
        </form>




        <?php

        if (isset($_GET['exito']) && $_GET['exito'] == 1) {
            echo "<p class='mensajeU'>⚡¡Datos guardados con éxito!⚡</p>";
        }
        ?>
    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Verificar el estado del modo oscuro al cargar la página
            var input = document.getElementById('input');
            if (localStorage.getItem('darkMode') === 'enabled') {
                enableDarkMode();
                input.checked = true;
            }

            // Escuchar el evento 'change' del interruptor
            input.addEventListener('change', toggleDarkMode);

            // Obtener el tbody de la tabla
            var tbody = document.getElementById('tbody-habitos');

            // Asignar evento de eliminación a los botones existentes
            asignarEventoEliminar();

            // Guardar el estado de los checkboxes antes de agregar la nueva fila
            var checkboxStates = {};
            var checkboxes = tbody.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(function(checkbox) {
                var id = checkbox.id;
                checkboxStates[id] = checkbox.checked;
            });

            // Guardar y restaurar el estado de los checkboxes al añadir una nueva fila
            document.getElementById('añadir').addEventListener('click', function() {
                var tabla = document.getElementById('tabla-habitos');
                var tbody = document.getElementById('tbody-habitos');

                // Crear una nueva fila
                var nuevaFila = document.createElement('tr');
                var nuevaFilaID = 'fila_' + (tbody.rows.length + 1);
                nuevaFila.setAttribute('id', nuevaFilaID);

                // Identificador único para el botón "Eliminar"
                var eliminarId = 'eliminar_' + (tbody.rows.length + 1);

                // Contenido de la fila (celdas de input y checkbox)
                //     nuevaFila.innerHTML = '<td><input type="text" placeholder="Hábito" class="input-line" id="habito_' + (tbody.rows.length + 1) + '" name="rutina[' + (tbody.rows.length + 1) + '][habit] "></td>';


                nuevaFila.innerHTML += '<td><input type="text" placeholder="Hábito" class="input-line" id="habito_' + (tbody.rows.length + 1) + '" name="rutina[' + (tbody.rows.length + 1) + '][habit] "></td>' +
                    '<td>' +
                    '<select class="input-line" name="rutina[' + (tbody.rows.length + 1) + '][categoria] " id="categoria_' + (tbody.rows.length + 1) + '">' +
                    '<option name="null" value="null" selected disabled>Elige...</option>' +
                    '<option name="fisico" value="fisico">Físico</option>' +
                    '<option name="afectivo" value="afectivo">Afectivo</option>' +
                    '<option name="social" value="social">Social</option>' +
                    '<option name="moral" value="moral">Moral</option>' +
                    '<option name="intelectual" value="intelectual">Intelectual</option>' +
                    '<option name="mental" value="mental">Mental</option>' +
                    '<option name="higiene" value="higiene">Higiene</option>' +
                    '<option name="costumbrista" value="costumbrista">Costumbrista</option>' +
                    '<option name="saludable" value="saludable">Saludable</option>' +
                    '<option name="recreativo" value="recreativo">Recreativo</option>' +
                    '</select>' +
                    '</td>';


                for (var i = 2; i < tabla.rows[0].cells.length - 1; i++) {
                    var checkboxId = 'rutina[' + (tbody.rows.length + 1) + '][fila_' + tabla.rows[0].cells[i].innerText.toLowerCase() + ']';
                    nuevaFila.innerHTML += '<td><div class="checkbox-wrapper-19"><input type="checkbox" id="' + checkboxId + '" ' + (checkboxStates[checkboxId] ? 'checked' : '') + ' name="' + checkboxId + '"/></div></td>';
                }


                nuevaFila.innerHTML += '<td><button class="eliminar" id="' + eliminarId + '">X</button></td>';

                // Insertar la nueva fila al final del tbody
                tbody.appendChild(nuevaFila);

                // Asignar evento para eliminar la fila recién agregada
                asignarEventoEliminar();
            });




            // Obtener los elementos de fecha
            var diaIn = document.getElementById('dia_in');
            var diaOut = document.getElementById('dia_out');

            // Agregar un evento de cambio a ambos elementos
            diaIn.addEventListener('change', validarDiaIn);
            diaOut.addEventListener('change', validarDiaOut);

            // Función para validar el día de inicio de semana
            function validarDiaIn() {
                // Obtener el valor de la fecha de inicio
                var fechaIn = new Date(diaIn.value);

                // Verificar si el día de inicio es diferente a lunes (valor 1 para lunes)
                if (fechaIn.getDay() !== 1) {
                    alert('Por favor, selecciona Lunes como Día Inicio Semana.');
                    diaIn.value = '';
                }
            }

            // Función para validar el día de fin de semana
            function validarDiaOut() {
                // Obtener el valor de la fecha de fin
                var fechaOut = new Date(diaOut.value);

                // Verificar si el día de fin es diferente a domingo (valor 0 para domingo)
                if (fechaOut.getDay() !== 0) {
                    alert('Por favor, selecciona Domingo como Día Fin Semana.');
                    diaOut.value = '';
                }
            }

            // Función para asignar evento de eliminación a los botones "Eliminar"
            function asignarEventoEliminar() {
                var botonesEliminar = document.querySelectorAll('.eliminar');
                botonesEliminar.forEach(function(boton) {
                    boton.addEventListener('click', function() {
                        var fila = this.parentNode.parentNode;
                        fila.parentNode.removeChild(fila);
                    });
                });
            }



            var notaTexto = '';
            var notaImg = document.getElementById('nota');
            var campoNota = document.getElementById('campoNota');

            notaImg.addEventListener('click', function() {
                var nuevaNotaTexto = prompt('Añadir nota ✍️', notaTexto);
                if (nuevaNotaTexto !== null) {
                    // Actualizar el valor del campo oculto con la nueva nota
                    campoNota.value = nuevaNotaTexto;

                    // Enviar el formulario
               //     document.getElementById('formulario-habitos').submit();
                }
            });


        });
    </script>
</body>

</html>