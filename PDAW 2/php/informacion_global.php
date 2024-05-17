<?php
// informacion_global.php

header('Content-Type: application/json; charset=utf-8');

$response = array();

try {
    // Crear conexión
    $conexion = new mysqli("localhost", "root", "", "pdaw-alberto");

    // Verificar la conexión
    if ($conexion->connect_error) {
        throw new Exception("Error de conexión: " . $conexion->connect_error);
    }

    // Establecer la codificación de la conexión MySQL
    $conexion->set_charset("utf8");

    // Obtener el número total de usuarios
    $sqlUsuarios = "SELECT COUNT(*) AS totalUsuarios FROM usuario";
    $resultUsuarios = $conexion->query($sqlUsuarios);

    if (!$resultUsuarios) {
        throw new Exception("Error en la consulta de usuarios: " . $conexion->error);
    }

    if ($resultUsuarios->num_rows > 0) {
        $row = $resultUsuarios->fetch_assoc();
        $response['totalUsuarios'] = $row['totalUsuarios'];
    } else {
        $response['totalUsuarios'] = 0;
    }



    
    $sqlHabitos = "SELECT IFNULL(categoria, 'Sin categoría') AS categoria, COUNT(*) AS totalHabitos FROM categoria GROUP BY categoria";
    $resultHabitos = $conexion->query($sqlHabitos);

    if (!$resultHabitos) {
        throw new Exception("Error en la consulta de hábitos: " . $conexion->error);
    }

    if ($resultHabitos->num_rows > 0) {
        $habitosPorCategoria = array();
        while ($row = $resultHabitos->fetch_assoc()) {
            // Convertir los datos a UTF-8
            $categoria = utf8_encode($row['categoria']);
            $habitosPorCategoria[$categoria] = $row['totalHabitos'];
        }
        $response['habitosPorCategoria'] = $habitosPorCategoria;
    } else {
        $response['habitosPorCategoria'] = array();
    }

    // Devolver la respuesta JSON
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
    $response['error'] = "Error al obtener la información global: " . $e->getMessage();
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
} finally {
    // Cerrar la conexión
    if ($conexion) {
        $conexion->close();
    }
}
?>
