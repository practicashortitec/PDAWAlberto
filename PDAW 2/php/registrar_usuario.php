<?php
$conexion = mysqli_connect("localhost", "root", "", "pdaw-alberto");

if (!$conexion) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$usuario = $_POST['usuario'];
$email = $_POST['email'];
$password = $_POST['clave1']; 

$hash = password_hash($password, PASSWORD_DEFAULT);

$rol = 'user';

if (strpos($email, '@admin.com') !== false || strpos($email, '@pdawalberto.com') !== false) {
    $rol = 'admin';
}

$sql = "INSERT INTO `usuario` (`nombre`, `apellidos`, `usuario`, `email`, `password`) VALUES ('$nombre', '$apellidos', '$usuario', '$email', '$hash')";

if (mysqli_query($conexion, $sql)) {
    $sqlRol = "INSERT INTO `rol` (`email`, `rol`) VALUES ('$email', '$rol')";
    if (!mysqli_query($conexion, $sqlRol)) {
        echo "Error al asignar el rol al usuario: " . mysqli_error($conexion);
        exit();
    }

    header("Location: ../login.php");
    exit();
} else {
    echo "Error al registrar el usuario: " . mysqli_error($conexion);
}

mysqli_close($conexion);

