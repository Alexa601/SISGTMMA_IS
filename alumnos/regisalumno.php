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
    $sexo = $_POST['sexo'];
    $telefono = $_POST['telefono'];
    $correo_electronico = $_POST['correo_electronico'];
    $id_entrenador_fk = $_POST['id_entrenador_fk'];
    $id_discapacidad_fk = $_POST['id_discapacidad_fk'];
    $estatus_atleta = 'Activo';

    // Preparar la declaración SQL con marcadores de posición
    $sql = "INSERT INTO competidores_tab (nombre, apellido_paterno, apellido_materno, fecha_nacimiento, sexo, telefono, ,correo_electronico, id_entrenador_fk, estatus_atleta, id_discapacidad_fk, fecha_registro ) 
            VALUES (:nombre, :apellido_paterno, :apellido_materno, :fecha_nacimiento, :sexo, :telefono, :correo_electronico, :id_entrenador_fk, :estatus_atleta, :id_discapacidad_fk, NOW())";

    // Preparar la declaración SQL
    $stmt = $conn->prepare($sql);

    // Binding de parámetros
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':apellido_paterno', $apellido_paterno);
    $stmt->bindParam(':apellido_materno', $apellido_materno);
    $stmt->bindParam(':fecha_nacimiento', $fecha_nacimiento);
    $stmt->bindParam(':sexo', $sexo);
    $stmt->bindParam(':telefono', $telefono);
    $stmt->bindParam(':correo_electronico', $correo_electronico);  
    $stmt->bindParam(':id_entrenador_fk', $id_entrenador_fk);  
    $stmt->bindParam(':estatus_atleta:', $estatus_atleta);
    $stmt->bindParam(':id_discapacidad_fk:', $id_discapacidad_fk);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        $mensaje = "Registro exitoso";
        // Redirigir a la página principal de competidores
        header("Location: homeAlumno.php?mensaje=" . urlencode($mensaje));
        exit();
    } else {
        // Si hay un error al ejecutar la consulta
        $error = "Error al registrar el competidor: " . $stmt->errorInfo()[2];
        header("Location: alumno.php?error=" . urlencode($error));
        exit();
    }

    // Cerrar la conexión y liberar recursos
    $stmt = null;
    $conn = null;
}
?>
