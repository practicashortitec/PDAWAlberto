<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro | Habit Tracker</title>

    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/darkmode.css">
    <script src="js/darkmode.js"></script>
    <script src="js/validarFormulario.js"></script>

    <link rel="icon" href="img/favicon.png" type="image/x-icon">

    <meta name="title" content="Registro | Habit Tracker">
    <meta name="description" content="Controla tus hábitos con eficacia. Habit Tracker PDAW Alberto te ayuda a seguir tus rutinas diarias y alcanzar tus metas de manera organizada.">
    <meta name="keywords" content="Seguimiento de hábitos, Gestión de rutinas, Organizador personal,    Productividad diaria, Planificación de actividades, Registro de objetivos, Seguimiento de progreso, Mejora de hábitos, Administrador de tareas, Control de actividades diarias">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="Spanish">
    <meta name="author" content="Alberto Saporta Albelda">
</head>

<body>
    <div class="dark-mode">
        <label class="switch">
            <input type="checkbox" id="input">
            <span class="slider"></span>
        </label>
    </div>

    <div class='container'>
        <div class="logo">
            <img src="img/logo.png" alt="Logo PDAW" width="176">
        </div>

        <div class='window'>
            <div class='content'>
                <form action="php/registrar_usuario.php" method="POST" name="f1" onsubmit="return validarFormulario()">
                    <h1>Registro</h1>
                    <h2>Si aún no tienes cuenta, registrate aquí 👇</h2>
                    <div class='input-fields'>
                        <input type='text' placeholder='Nombre' class='input-line full-width' id="nombre" name="nombre" required><br>
                        <input type='text' placeholder='Apellidos' class='input-line full-width' id="apellidos" name="apellidos" required><br>
                        <input type='text' placeholder='Usuario' class='input-line full-width' id="usuario" name="usuario" required><br>
                        <input type='email' placeholder='Email' class='input-line full-width' id="email" name="email" required><br>
                        <input type='password' placeholder='Password' class='input-line full-width' name="clave1" id="clave1" required><br>
                        <input type='password' placeholder='Repetir Password' class='input-line full-width' name="clave2" id="clave2" required><br>
                    </div>
                    <div class='spacing'>
                        <p>o continua con <a href="#"> Facebook</a></p>
                    </div>
                    <div><button id="boton-f1" class='ghost-round full-width'>Crear
                            Cuenta</button></div>
                </form>
            </div>
        </div>

        <div class="footer">
            <div class='spacing'>
                <p>Si ya estás registrado/a</p>
            </div>
            <div><button onclick="location.href='login.php'" class='ghost-round full-width'>Login</button></div>
        </div>
    </div>
</body>
</html>