<?php
include('../model/conexion.php');
$db = new Database();
$conn = $db->getConnection(); // Obtener la conexión PDO

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $nombre = $_POST['nombre'];
    $apellido_paterno = $_POST['apellido_paterno'];
    $apellido_materno = $_POST['apellido_materno'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $telefono = $_POST['telefono'];
    $correo_electronico = $_POST['correo_electronico'];
    $sexo = $_POST['sexo'];
    $id_academia_fk = $_POST['id_academia_fk'];
    $estatus_entrenador = 'Activo';

    // Preparar la declaración SQL con marcadores de posición
    $sql = "INSERT INTO entrenadores_tab (nombre, apellido_paterno, apellido_materno, fecha_nacimiento, telefono, correo_electronico, sexo, estatus_entrenador, id_academia_fk, fecha_registro) 
            VALUES (:nombre, :apellido_paterno, :apellido_materno, :fecha_nacimiento, :telefono, :correo_electronico, :sexo, :estatus_entrenador, :id_academia_fk, NOW())";

    // Preparar la declaración SQL
    $stmt = $conn->prepare($sql);

    // Binding de parámetros
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':apellido_paterno', $apellido_paterno);
    $stmt->bindParam(':apellido_materno', $apellido_materno);
    $stmt->bindParam(':fecha_nacimiento', $fecha_nacimiento);
    $stmt->bindParam(':telefono', $telefono);
    $stmt->bindParam(':correo_electronico', $correo_electronico);
    $stmt->bindParam(':sexo', $sexo);
    $stmt->bindParam(':estatus_entrenador', $estatus_entrenador);
    $stmt->bindParam(':id_academia_fk', $id_academia_fk);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        $mensaje = "Registro exitoso";
        // Redirigir a la página principal de entrenadores
        header("Location: homeEntrenador.php?mensaje=" . urlencode($mensaje));
        exit();
    } else {
        // Si hay un error al ejecutar la consulta
        $error = "Error al registrar el entrenador: " . $stmt->errorInfo()[2];
        header("Location: entrenador.php?error=" . urlencode($error));
        exit();
    }

    // Cerrar la conexión y liberar recursos
    $stmt = null;
    $conn = null;
}
?>
