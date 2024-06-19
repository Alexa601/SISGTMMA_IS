<?php
include('../model/conexion.php');
$db = new Database();
$conn = $db->getConnection(); // Obtener la conexión PDO

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $id_academia_fk = $_POST['id_academia_fk'];
    $nombre = $_POST['nombre'];
    $apellido_paterno = $_POST['apellido_paterno'];
    $apellido_materno = $_POST['apellido_materno'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $telefono = $_POST['telefono'];
    $correo_electronico = $_POST['correo_electronico'];
    $id_rol_staff_fk = $_POST['id_rol_staff_fk'];
    $estatus_staff = 'Activo';

    // Preparar la declaración SQL con marcadores de posición
    $sql = "INSERT INTO staff_tab (id_academia_fk,nombre,apellido_paterno,apellido_materno,fecha_nacimiento,telefono,correo_electronico,id_rol_staff_fk,fecha_registro,estatus_staff) 
            VALUES (:id_academia_fk,:nombre,:apellido_paterno,:apellido_materno,:fecha_nacimiento,:telefono,:correo_electronico,:id_rol_staff_fk,NOW(),:estatus_staff)";

    // Preparar la declaración SQL
    $stmt = $conn->prepare($sql);

    // Binding de parámetros
    $stmt->bindParam(':id_academia_fk', $id_academia_fk);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':apellido_paterno', $apellido_paterno);
    $stmt->bindParam(':apellido_materno', $apellido_materno);
    $stmt->bindParam(':fecha_nacimiento', $fecha_nacimiento);
    $stmt->bindParam(':telefono', $telefono);
    $stmt->bindParam(':correo_electronico', $correo_electronico);
    $stmt->bindParam(':id_rol_staff_fk', $id_rol_staff_fk);
    $stmt->bindParam(':estatus_staff', $estatus_staff);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        $mensaje = "Registro exitoso";
        // Redirigir a la página principal de entrenadores
        header("Location: homeStaff.php?mensaje=" . urlencode($mensaje));
        exit();
    } else {
        // Si hay un error al ejecutar la consulta
        $error = "Error al registrar el staff: " . $stmt->errorInfo()[2];
        header("Location: staff.php?error=" . urlencode($error));
        exit();
    }

    // Cerrar la conexión y liberar recursos
    $stmt = null;
    $conn = null;
}
?>
