<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Habit Tracker</title>

    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/darkmode.css">
    <script src="js/darkmode.js"></script>


    <link rel="icon" href="img/favicon.png" type="image/x-icon">

    <meta name="title" content="Login | Habit Tracker">
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

            <form action="php/login_usuario.php" method="POST" name="loginForm">
                <div class='content'>
                    <h1>Login</h1>
                    <h2>Si ya tienes cuenta, logeate aquí 👇</h2>
                    <div class='input-fields'>
                        <input type='email' name="email" placeholder='Email' class='input-line full-width' required></input><br>
                        <input type='password' name="password" placeholder='Password' class='input-line full-width' required></input><br>
                    </div>
                    <div class='spacing'>
                        <p>Login con <a href="#"> Facebook</a></p>
                    </div>
                    <div><button type="submit" class='ghost-round full-width'>Login</button>
                    </div>
                </div>
            </form>

            <?php
            $error = isset($_GET['error']) ? $_GET['error'] : '';

            if ($error != '') {
                echo "<p id='p-password'style='color:red;  display: flex;
                justify-content: center;
                text-align: center;'>$error</p>";
            }
            ?>

        </div>

        <div class="footer">
            <div class='spacing'>
                <p>Si no tienes cuenta</p>
            </div>
            <div><button onclick="location.href='registro.php'" class='ghost-round full-width'>Registrate Aquí</button>
            </div>
        </div>

    </div>
    <script>

    </script>
</body>

</html>