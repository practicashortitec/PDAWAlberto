<?php 
$conexion = mysqli_connect("localhost", "root", "", "pdaw-alberto");


if (!$conexion) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

session_start();

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM usuario WHERE email = ?";
$consulta = mysqli_prepare($conexion, $sql);
mysqli_stmt_bind_param($consulta, "s", $email);
mysqli_stmt_execute($consulta);
$resultado = mysqli_stmt_get_result($consulta);

if (mysqli_num_rows($resultado) == 0) {
    header("Location: ../login.php?error=Usuario y/o contraseña incorrectos");
} else {
    $fila = mysqli_fetch_assoc($resultado);
    $passwordBD = $fila['password'];

    if (password_verify($password, $passwordBD)) {
        $_SESSION['email'] = $email;
        $_SESSION['nombre'] = $fila['nombre'];
    
        // Consulta para verificar si el usuario tiene rol de admin
        $sql_admin = "SELECT * FROM rol WHERE email = ? AND rol = 'admin'";
        $consulta_admin = mysqli_prepare($conexion, $sql_admin);
        mysqli_stmt_bind_param($consulta_admin, "s", $email);
        mysqli_stmt_execute($consulta_admin);
        $resultado_admin = mysqli_stmt_get_result($consulta_admin);
    
        if (mysqli_num_rows($resultado_admin) > 0) {
            header("Location: ../dashboard_admin.php");
        } else {

            header("Location: ../dashboard.php");
        }
        exit();
    } else {
        header("Location: ../login.php?error=Usuario y/o contraseña incorrectos");
    }
}

mysqli_close($conexion);
