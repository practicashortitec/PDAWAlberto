<?php
// Establecer la conexión a la base de datos

// include('login.php');
// $conexion = new mysqli($servername,$username,$password,$dbname);

$conexion = new mysqli("localhost", "root", "", "pdaw-alberto");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener el email del usuario seleccionado
$email = $_GET['email'];

// Consulta SQL para obtener la información del usuario seleccionado
$sqlUsuario = "SELECT * FROM usuario WHERE email = ?";
$consultaUsuario = $conexion->prepare($sqlUsuario);
$consultaUsuario->bind_param("s", $email);
$consultaUsuario->execute();
$resultadoUsuario = $consultaUsuario->get_result();

// Verificar si se obtuvieron resultados
if ($resultadoUsuario->num_rows > 0) {
    // Obtener la información del usuario
    $usuario = $resultadoUsuario->fetch_assoc();

    // Consulta SQL para contar el número de hábitos del usuario
    $sqlHabitos = "SELECT COUNT(*) AS totalHabitos FROM tracker WHERE email = ?";
    $consultaHabitos = $conexion->prepare($sqlHabitos);
    $consultaHabitos->bind_param("s", $email);
    $consultaHabitos->execute();
    $resultadoHabitos = $consultaHabitos->get_result();

    // Verificar si se obtuvieron resultados de la consulta de hábitos
    if ($resultadoHabitos->num_rows > 0) {
        // Obtener el número total de hábitos del usuario
        $filaHabitos = $resultadoHabitos->fetch_assoc();
        $usuario['totalHabitos'] = $filaHabitos['totalHabitos'];
    } else {
        // Si no se obtuvieron resultados de la consulta de hábitos, establecer totalHabitos en 0
        $usuario['totalHabitos'] = 0;
    }

    // Consulta SQL para contar el número de notas del usuario
    $sqlNotas = "SELECT COUNT(*) AS totalNotas FROM nota WHERE email = ?";
    $consultaNotas = $conexion->prepare($sqlNotas);
    $consultaNotas->bind_param("s", $email);
    $consultaNotas->execute();
    $resultadoNotas = $consultaNotas->get_result();

    // Verificar si se obtuvieron resultados de la consulta de notas
    if ($resultadoNotas->num_rows > 0) {
        // Obtener el número total de notas del usuario
        $filaNotas = $resultadoNotas->fetch_assoc();
        $usuario['totalNotas'] = $filaNotas['totalNotas'];
    } else {
        // Si no se obtuvieron resultados de la consulta de notas, establecer totalNotas en 0
        $usuario['totalNotas'] = 0;
    }

    // Consulta SQL para obtener el total de hábitos cumplidos del usuario
  //  $sqlCumplidos = "SELECT COUNT(*) AS totalCumplidos FROM tracker WHERE email = ? AND (dia1=1 OR dia2=1 OR dia3=1 OR dia4=1 OR dia5=1 OR dia6=1 OR dia7=1)";
   $sqlCumplidos = "SELECT SUM(dia1+dia2+dia3+dia4+dia5+dia6+dia7) AS totalCumplidos FROM tracker WHERE email=? AND (dia1=1 OR dia2=1 OR dia3=1 OR dia4=1 OR dia5=1 OR dia6=1 OR dia7=1)";

   
    $consultaCumplidos = $conexion->prepare($sqlCumplidos);
    $consultaCumplidos->bind_param("s", $email);
    $consultaCumplidos->execute();
    $resultadoCumplidos = $consultaCumplidos->get_result();

    // Verificar si se obtuvieron resultados de la consulta de hábitos cumplidos
    if ($resultadoCumplidos->num_rows > 0) {
        // Obtener el número total de hábitos cumplidos del usuario
        $filaCumplidos = $resultadoCumplidos->fetch_assoc();
        $usuario['totalCumplidos'] = $filaCumplidos['totalCumplidos'];
    } else {
        // Si no se obtuvieron resultados de la consulta de hábitos cumplidos, establecer totalCumplidos en 0
        $usuario['totalCumplidos'] = 0;
    }

    // Consulta SQL para obtener el total de hábitos no cumplidos del usuario
 //  $sqlNoCumplidos = "SELECT COUNT(*) AS totalNoCumplidos FROM tracker WHERE email = ? AND (dia1=0 OR dia2=0 OR dia3=0 OR dia4=0 OR dia5=0 OR dia6=0 OR dia7=0)";
   // $sqlNoCumplidos = "SELECT SUM(dia1+dia2+dia3+dia4+dia5+dia6+dia7) AS totalNoCumplidos FROM tracker WHERE email=? AND (dia1=0 OR dia2=0 OR dia3=0 OR dia4=0 OR dia5=0 OR dia6=0 OR dia7=0)";
   $sqlNoCumplidos = "SELECT SUM(dia1+dia2+dia3+dia4+dia5+dia6+dia7) AS totalNoCumplidos FROM tracker WHERE email=? AND (dia1=0 OR dia2=0 OR dia3=0 OR dia4=0 OR dia5=0 OR dia6=0 OR dia7=0)";



   
    $consultaNoCumplidos = $conexion->prepare($sqlNoCumplidos);
    $consultaNoCumplidos->bind_param("s", $email);
    $consultaNoCumplidos->execute();
    $resultadoNoCumplidos = $consultaNoCumplidos->get_result();

    // Verificar si se obtuvieron resultados de la consulta de hábitos no cumplidos
    if ($resultadoNoCumplidos->num_rows > 0) {
        // Obtener el número total de hábitos no cumplidos del usuario
        $filaNoCumplidos = $resultadoNoCumplidos->fetch_assoc();
        $usuario['totalNoCumplidos'] = $filaNoCumplidos['totalNoCumplidos'];
    } else {
        // Si no se obtuvieron resultados de la consulta de hábitos no cumplidos, establecer totalNoCumplidos en 0
        $usuario['totalNoCumplidos'] = 0;
    }


    $sqlTotalCategorias = "SELECT COUNT(DISTINCT categoria) AS totalCategorias
                           FROM categoria
                           INNER JOIN tracker ON categoria.id_habito = tracker.id_habito
                           WHERE tracker.email = ?";
    $consultaTotalCategorias = $conexion->prepare($sqlTotalCategorias);
    $consultaTotalCategorias->bind_param("s", $email);
    $consultaTotalCategorias->execute();
    $resultadoTotalCategorias = $consultaTotalCategorias->get_result();
    $rowTotalCategorias = $resultadoTotalCategorias->fetch_assoc();
    $usuario['totalCategorias'] = $rowTotalCategorias['totalCategorias'];

    echo json_encode($usuario);
} else {
    // Si no se encontró información para el usuario seleccionado, devolver un mensaje de error en formato JSON
    echo json_encode(array("error" => "No se encontró información para el usuario seleccionado."));
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
