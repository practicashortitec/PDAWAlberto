<?php
$conexion = new mysqli("localhost", "root", "", "pdaw-alberto");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$sql = "SELECT email FROM usuario";
$resultado = $conexion->query($sql);

$usuarios = array();

if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $usuarios[] = $row['email'];
    }
}

echo json_encode($usuarios);

$conexion->close();

