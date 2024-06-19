<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

include('../model/conexion.php');
$db = new Database();
$conn = $db->getConnection(); // Obtener la conexión PDO

// Verificar la existencia del ID del organizador
if (isset($_POST['id_organizador_fk'])) {
    $organizador_id = $_POST['id_organizador_fk'];

    $sql_check = "SELECT ID_ORGANIZADOR_PK FROM organizadores_tab WHERE ID_ORGANIZADOR_PK = :organizador_id";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bindParam(':organizador_id', $organizador_id, PDO::PARAM_INT);
    $stmt_check->execute();

    // Comprobar si se encontró el ID del organizador
    if ($stmt_check->rowCount() === 0) {
        // Si no se encuentra el ID del organizador en la tabla, mostrar un mensaje de error o manejar la situación adecuadamente.
        $error = "El ID del organizador seleccionado no existe.";
        header("Location: torneo.php?error=" . urlencode($error));
        exit();
    }
}

// Continuar con la inserción del torneo
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $nombre_torneo = $_POST['nombre_torneo'];
    $fecha_torneo = $_POST['fecha_torneo'];
    $hora_inicio_torneo = $_POST['hora_inicio_torneo'];
    $lugar = $_POST['lugar'];
    $id_organizador_fk = $_POST['id_organizador_fk']; // Asegúrate de recibir este valor correctamente
    $nivel_torneo = $_POST['nivel_torneo'];
    $rankeo = $_POST['rankeo'];
    $costo_ficha = $_POST['costo_ficha'];
    $modalidad = $_POST['modalidad'];
    $fecha_limite_inscripciones = $_POST['fecha_limite_inscripciones'];
    $premiacion = $_POST['premiacion'];
    $responsable_registro = $_POST['responsable_registro'];

    // Preparar la declaración SQL con marcadores de posición
    $sql = "INSERT INTO registro_torneo_cat (NOMBRE_TORNEO, FECHA_TORNEO, HORA_INICIO_TORNEO, LUGAR, ID_ORGANIZADOR_FK, NIVEL_TORNEO, RANKEO, COSTO_FICHA, MODALIDAD, FECHA_LIMITE_INSCRIPCIONES, PREMIACION, RESPONSABLE_REGISTRO) 
            VALUES (:nombre_torneo, :fecha_torneo, :hora_inicio_torneo, :lugar, :id_organizador_fk, :nivel_torneo, :rankeo, :costo_ficha, :modalidad, :fecha_limite_inscripciones, :premiacion, :responsable_registro)";

    // Preparar la declaración SQL
    $stmt = $conn->prepare($sql);

    // Binding de parámetros
    $stmt->bindParam(':nombre_torneo', $nombre_torneo);
    $stmt->bindParam(':fecha_torneo', $fecha_torneo);
    $stmt->bindParam(':hora_inicio_torneo', $hora_inicio_torneo);
    $stmt->bindParam(':lugar', $lugar);
    $stmt->bindParam(':id_organizador_fk', $id_organizador_fk);
    $stmt->bindParam(':nivel_torneo', $nivel_torneo);
    $stmt->bindParam(':rankeo', $rankeo);
    $stmt->bindParam(':costo_ficha', $costo_ficha);
    $stmt->bindParam(':modalidad', $modalidad);
    $stmt->bindParam(':fecha_limite_inscripciones', $fecha_limite_inscripciones);
    $stmt->bindParam(':premiacion', $premiacion);
    $stmt->bindParam(':responsable_registro', $responsable_registro);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        $mensaje = "Registro de torneo exitoso";
        // Redirigir a la página principal de torneos
        header("Location: homeTorneo.php?mensaje=" . urlencode($mensaje));
        exit();
    } else {
        // Si hay un error al ejecutar la consulta
        $error = "Error al registrar el torneo: " . $stmt->errorInfo()[2];
        header("Location: registro_torneo.php?error=" . urlencode($error));
        exit();
    }

    // Cerrar la conexión y liberar recursos
    $stmt = null;
    $conn = null;
}
?>
