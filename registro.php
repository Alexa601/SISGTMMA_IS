<?php
include('model/conexion.php'); // Incluir el archivo de conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $mensaje = "";
    $error = "";

    // Crear instancia de la clase Database y obtener la conexión
    $database = new Database();
    $conn = $database->getConnection();

    // Validación de la contraseña
    if (strlen($contrasena) < 8) {
        $error = "La contraseña debe tener al menos 8 caracteres.";
        header("Location: registrousu.php?error=" . urlencode($error));
        exit();
    }

    // Comprobar si el usuario ya existe
    $sql = "SELECT * FROM usuarios WHERE usuario = :usuario";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['usuario' => $usuario]);
    if ($stmt->rowCount() > 0) {
        $error = "El nombre de usuario ya está en uso. Por favor, elija otro.";
        header("Location: registrousu.php?error=" . urlencode($error));
        exit();
    }

    // Comprobar si el correo ya existe
    $sql = "SELECT * FROM usuarios WHERE correo = :correo";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['correo' => $correo]);
    if ($stmt->rowCount() > 0) {
        $error = "El correo ya está en uso. Por favor, elija otro.";
        header("Location: registrousu.php?error=" . urlencode($error));
        exit();
    }

    // Insertar el nuevo usuario
    $sql = "INSERT INTO usuarios (usuario, correo, contrasena) VALUES (:usuario, :correo, :contrasena)";
    $stmt = $conn->prepare($sql);
    if ($stmt->execute(['usuario' => $usuario, 'correo' => $correo, 'contrasena' => $contrasena])) {
        // Obtener el ID del usuario recién creado
        $id = $conn->lastInsertId();

        // Guardar el ID del usuario en la sesión
        session_start();
        $_SESSION['id'] = $id;
        $_SESSION['usuario'] = $usuario;
        $_SESSION['correo'] = $correo;

        // Redirigir a la página de roles
        header("Location: model/roles.php");
        exit();
    } else {
        $error = "Error: No se pudo registrar el usuario.";
        header("Location: registrousu.php?error=" . urlencode($error));
        exit();
    }

    $conn = null; // Cerrar la conexión
}
?>
