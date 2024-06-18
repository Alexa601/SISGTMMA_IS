<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: registrousu.php");
    exit();
}

require('conexion.php'); // Incluir el archivo de conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_SESSION['id'];
    $rol = $_POST['rol'];

    // Crear instancia de la clase Database y obtener la conexión
    $database = new Database();
    $conn = $database->getConnection();

    // Sanitizar datos para evitar inyecciones SQL
    $id = htmlspecialchars($id, ENT_QUOTES, 'UTF-8');
    $rol = htmlspecialchars($rol, ENT_QUOTES, 'UTF-8');

    // Actualizar el rol en la base de datos usando declaraciones preparadas
    $sql = "UPDATE usuarios SET rol = :rol WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':rol', $rol, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Redirigir a la página correspondiente según el rol
        switch ($rol) {
            case 'Entrenador':
                header("Location: ../entrenador/entrenador.php");
                break;
            case 'Estudiante':
                header("Location: ../alumnos/alumno.php");
                break;
            default:
                header("Location: ../php/roles.php");
                break;
        }
        exit();
    } else {
        echo "Error al actualizar el rol: " . $stmt->errorInfo()[2];
    }

    // Cerrar la conexión
    $conn = null;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Rol - Sistema de Gestión de Torneos de MMA</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            color: #343a40;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .header {
            background-color: #343a40;
            padding: 20px;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }
        .header .title {
            font-size: 2rem;
        }
        .header .title span1 {
            color: #0e8418;
        }
        .header .title span2 {
            color: #ffffff;
        }
        .header .title span3 {
            color: #FF0000;
        }
        .header .username {
            margin-left: 20px;
            color: #ffffff;
        }
        .header .logout a {
            color: #ffffff;
            text-decoration: none;
        }
        .container {
            margin-top: 100px;
        }
        .profile-selection {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 30px;
        }
        .profile {
            text-align: center;
            max-width: 200px;
            margin: 20px; /* Añadido margen para más separación */
        }
        .profile img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-bottom: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .profile button {
            width: 100%;
            border: none;
            padding: 10px;
            font-size: 1rem;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .profile button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="header d-flex justify-content-between align-items-center">
        <div class="title">
            <span1>SIS</span1><span2>GT</span2><span3>MMA</span3>
        </div>
        <div class="username">Bienvenid@, <?php echo htmlspecialchars($_SESSION['usuario']); ?></div>
        <div class="logout">
            <a href="logout.php" class="btn btn-danger">Salir</a>
        </div>
    </div>
    <div class="container text-center">
        <h1 class="mb-5">Selecciona tu perfil</h1>
        <div class="profile-selection">
            <form action="roles.php" method="POST" class="profile">
                <input type="hidden" name="rol" value="Entrenador">
                <img src="/resourses/img/entre.png" alt="Entrenador">
                <button type="submit">Entrenador</button>
            </form>
            <form action="roles.php" method="POST" class="profile">
                <input type="hidden" name="rol" value="Estudiante">
                <img src="/resourses/img/compe.png" alt="Estudiante">
                <button type="submit">Estudiante</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
