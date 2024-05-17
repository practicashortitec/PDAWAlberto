<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Habit Tracker</title>

    <link rel="stylesheet" href="css/estiloDashboardAdmin.css">
    <link rel="stylesheet" href="css/darkmode.css">
    <script src="js/darkmode.js"></script>

    <link rel="icon" href="img/favicon.png" type="image/x-icon">

    <meta name="title" content="Admin Dashboard | Habit Tracker">
    <meta name="description" content="Controla tus hábitos con eficacia. Habit Tracker PDAW Alberto te ayuda a seguir tus rutinas diarias y alcanzar tus metas de manera organizada.">
    <meta name="keywords" content="Seguimiento de hábitos, Gestión de rutinas, Organizador personal, Productividad diaria, Planificación de actividades, Registro de objetivos, Seguimiento de progreso, Mejora de hábitos, Administrador de tareas, Control de actividades diarias">
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="Spanish">
    <meta name="author" content="Alberto Saporta Albelda">

</head>

<body>
    <?php
    session_start();

    if (!isset($_SESSION['email'])) {
        header("Location: login.php");
        exit();
    }

    $email = $_SESSION['email'];

    $conexion = mysqli_connect("localhost", "root", "", "pdaw-alberto");

    if (!$conexion) {
        die("Error al conectar con la base de datos: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM rol WHERE email = '$email' AND rol = 'admin'";
    $resultado = mysqli_query($conexion, $sql);

    if (!$resultado) {
        die("Error en la consulta SQL: " . mysqli_error($conexion));
    }

    if (mysqli_num_rows($resultado) == 0) {
        header("Location: dashboard.php");
        exit();
    }

    mysqli_close($conexion);
    ?>

    <div class="dark-mode">
        <label class="switch" for="input">
            <input type="checkbox" id="input">
            <span class="slider"></span>
        </label>
        <img onclick="window.location.href='logout.php'" src="img/logout.png" width="30" id="imgLogout">
    </div>

    <div class='container'>
        <div class="logo">
            <img src="img/logo.png" id="logoPDAW" alt="Logo PDAW" width="176">
        </div>

        <div class='window'>
            <div class='content'>
                <h1>Panel De Administrador</h1>
                <div class="info-global">
                    <div id="global-info"></div>
                </div>

                <div id="user-select">
                    <h2>Información sobre Usuarios</h2>
                    <div class="seleccion-usuarios">
                        <label for="usuarios">Selecciona un usuario:</label>
                        <select id="usuarios" name="usuarios">
                            <option selected="true" disabled="disabled">--Selecciona Usuario--</option>
                        </select>
                    </div>


                    <div id="user-info"></div>

                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Cargar usuarios y la información global al cargar la página
            cargarUsuarios();
            cargarInformacionGlobal();

            // Manejar el evento de cambio en el select de usuarios
            document.getElementById("usuarios").addEventListener("change", function() {
                var emailSeleccionado = this.value;
                if (emailSeleccionado !== "") {
                    cargarInformacionUsuario(emailSeleccionado);
                } else {
                    limpiarInformacionUsuario();
                }
            });
        });

        // Función para cargar los usuarios desde el servidor
        function cargarUsuarios() {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "php/usuarios.php", true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var usuarios = JSON.parse(xhr.responseText);
                    var selectUsuarios = document.getElementById("usuarios");
                    usuarios.forEach(function(usuario) {
                        var option = document.createElement("option");
                        option.value = usuario;
                        option.textContent = usuario;
                        selectUsuarios.appendChild(option);
                    });
                }
            };
            xhr.send();
        }

        // Función para cargar la información del usuario seleccionado
        function cargarInformacionUsuario(email) {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "php/informacion_usuario.php?email=" + encodeURIComponent(email), true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var usuario = JSON.parse(xhr.responseText);
                    mostrarInformacionUsuario(usuario);
                }
            };
            xhr.send();
        }

        // Función para mostrar la información del usuario seleccionado
        function mostrarInformacionUsuario(usuario) {
            var infoUsuarioDiv = document.getElementById("user-info");
            infoUsuarioDiv.innerHTML = ""; // Limpiar contenido anterior

            if (usuario.error) {
                infoUsuarioDiv.innerHTML = "<p>" + usuario.error + "</p>";
            } else {
                var infoUsuarioHTML = "<h2>Información del Usuario</h2>";
                infoUsuarioHTML += "<div><p style='margin:0; color:rgba(255, 255, 255, 0.42);'><strong>Usuario:</strong> <p float:right; style='margin:0; color:green;'>" + usuario.usuario + "</p></p></div>";
                infoUsuarioHTML += "<div><p style='margin:0; color:rgba(255, 255, 255, 0.42);'><strong>Nombre:</strong> <p float:right; style='margin:0; color:green;'>" + usuario.nombre + "</p></p></div>";
                infoUsuarioHTML += "<div><p style='margin:0; color:rgba(255, 255, 255, 0.42);'><strong>Apellidos:</strong> <p float:right; style='margin:0; color:green;'>" + usuario.apellidos + "</p></p></div>";
                infoUsuarioHTML += "<div><p style='margin:0; color:rgba(255, 255, 255, 0.42);'><strong>Email:</strong> <p float:right; style='margin:0; color:green;'>" + usuario.email + "</p></p></div>";
                infoUsuarioHTML += "<div><p style='margin:0; color:rgba(255, 255, 255, 0.42);'><strong>Total Hábitos:</strong> <p float:right; style='margin:0; color:green;'>" + usuario.totalHabitos + "</p></p></div>";
                infoUsuarioHTML += "<div><p style='margin:0; color:rgba(255, 255, 255, 0.42);'><strong>Total Días Cumplidos:</strong> <p float:right; style='margin:0; color:green;'>" + usuario.totalCumplidos + "</p></p></div>";
                infoUsuarioHTML += "<div><p style='margin:0; color:rgba(255, 255, 255, 0.42);'><strong>Total Días No Cumplidos:</strong> <p float:right; style='margin:0; color:red;'>" + usuario.totalNoCumplidos + "</p></p></div>";
                infoUsuarioHTML += "<div><p style='margin:0; color:rgba(255, 255, 255, 0.42);'><strong>Total Notas:</strong> <p float:right; style='margin:0; color:green;'>" + usuario.totalNotas + "</p></p></div>";
                infoUsuarioHTML += "<div><p style='margin:0; color:rgba(255, 255, 255, 0.42);'><strong>Total Categorías:</strong> <p float:right; style='margin:0; color:green;'>" + usuario.totalCategorias + "</p></p></div>";


                // Agregar más campos según la estructura de tu tabla de usuario

                infoUsuarioDiv.innerHTML = infoUsuarioHTML;
            }
        }

        function limpiarInformacionUsuario() {
            var infoUsuarioDiv = document.getElementById("user-info");
            infoUsuarioDiv.innerHTML = "";
        }

        // Función para cargar la información global desde el servidor
        function cargarInformacionGlobal() {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "php/informacion_global.php", true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var globalInfo = JSON.parse(xhr.responseText);
                    mostrarInformacionGlobal(globalInfo);
                }
            };
            xhr.send();
        }

        // Función para mostrar la información global
        function mostrarInformacionGlobal(globalInfo) {
            var globalInfoDiv = document.getElementById("global-info");
            globalInfoDiv.innerHTML = ""; // Limpiar contenido anterior

            if (globalInfo.error) {
                globalInfoDiv.innerHTML = "<p>" + globalInfo.error + "</p>";
            } else {
                var globalInfoHTML = "<h2>Información Global</h2>";
                globalInfoHTML += "<div><p style=' float:left;margin:0;color:rgba(255, 255, 255, 0.42);'><strong>Total de Usuarios:</strong> <p style='color:green; margin:0;'>" + globalInfo.totalUsuarios + "</p></p></div>";
                globalInfoHTML += "<p style=' margin:0;color:rgba(255, 255, 255, 0.42);'><strong>Hábitos por Categoría:</strong></p>";
                globalInfoHTML += "<ul>";
                for (var categoria in globalInfo.habitosPorCategoria) {
                    globalInfoHTML += "<li style=' margin:0;color:rgba(255, 255, 255, 0.42);'><strong>" + categoria + ":</strong>  <p style='color:green; margin:0;'>" + globalInfo.habitosPorCategoria[categoria] + "</p></li>";
                }
                globalInfoHTML += "</ul>";

                globalInfoDiv.innerHTML = globalInfoHTML;
            }
        }
    </script>

</body>

</html>