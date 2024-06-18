<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}
include('../model/conexion.php');
$db = new Database();
$conn = $db->getConnection(); // Obtener la conexión PDO

// Mostrar mensajes de éxito o error
if (isset($_GET['mensaje'])) {
    echo "<div class='alert alert-success'>" . htmlspecialchars($_GET['mensaje']) . "</div>";
}
if (isset($_GET['error'])) {
    echo "<div class='alert alert-danger'>" . htmlspecialchars($_GET['error']) . "</div>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido - Competidor</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .header {
            background-color: #343a40;
            color: #fff;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
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
        .container {
            margin-top: 80px; /* Para evitar que el contenido quede detrás del encabezado */
        }
        .news-container {
            background-color: white;
            border-radius: 5px;
            padding: 20px;
            margin-top: 20px;
        }
        .news-title {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }
        .news-item {
            margin-bottom: 15px;
        }
        .news-item:last-child {
            margin-bottom: 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">
            <span1>SIS</span1>
            <span2>GT</span2>
            <span3>MMA</span3>
        </div>
        <div class="username">Competidor, <?php echo htmlspecialchars($_SESSION['usuario']); ?></div>
        <div>
            <a class="btn btn-secondary" href="../index.php">Cerrar sesión</a>
        </div>
    </div>

    <div class="container">
        <div class="news-container">
            <h2 class="news-title">Noticias Recientes</h2>
            <div class="news-item">
                <h4>Título de la Noticia 1</h4>
                <p>Descripción breve de la noticia 1. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
            <div class="news-item">
                <h4>Título de la Noticia 2</h4>
                <p>Descripción breve de la noticia 2. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
            <div class="news-item">
                <h4>Título de la Noticia 3</h4>
                <p>Descripción breve de la noticia 3. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
