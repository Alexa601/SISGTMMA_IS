<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

include('../model/conexion.php');
$db = new Database();
$conn = $db->getConnection(); // Obtener la conexión PDO

// Verificar si 'usuario_id' está configurado
if (!isset($_SESSION['usuario_id'])) {
    echo "Error: ID de usuario no encontrado en la sesión.";
    exit();
}

$entrenador_id = $_SESSION['usuario_id']; // Obtener el ID del entrenador desde la sesión

// Obtener la lista de competidores inscritos
$competidores_stmt = $conn->prepare("SELECT c.ID_COMPETIDOR_PK, CONCAT(a.NOMBRE, ' ', a.APELLIDO_PATERNO, ' ', a.APELLIDO_MATERNO) AS NOMBRE_COMPLETO, c.ID_REGISTRO_TORNEO_FK, c.ID_NIVEL_COMPETIDOR_FK, c.ID_PESO_COMPETIDOR_FK, c.ID_EDAD_COMPETIDOR_FK, t.NOMBRE_TORNEO, n.NOMBRE_NIVEL, p.NOMBRE_CATEGORIA AS PESO, e.NOMBRE_CATEGORIA_EDAD AS EDAD
                                    FROM competidores_inscritos c
                                    INNER JOIN registro_torneo_cat t ON c.ID_REGISTRO_TORNEO_FK = t.ID_REGISTRO_TORNEO_PK
                                    INNER JOIN nivel_competidores_cat n ON c.ID_NIVEL_COMPETIDOR_FK = n.ID_CATEGORIA_NIVEL_PK
                                    INNER JOIN peso_competidores_cat p ON c.ID_PESO_COMPETIDOR_FK = p.ID_CATEGORIA_PESO_PK
                                    INNER JOIN edad_competidores_cat e ON c.ID_EDAD_COMPETIDOR_FK = e.ID_CATEGORIA_EDAD_PK
                                    INNER JOIN atletas_tab a ON a.ID_ATLETA_PK = c.ID_COMPETIDOR_PK");
$competidores_stmt->execute();
$competidores = $competidores_stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Competidores Inscritos</title>
    <link rel="icon" type="image/png" href="../resourses/img/logo2.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../resourses/style.css">


    <style>
        .container{
            margin-top: 200px;
            font-family: "Montserrat", sans-serif;;
        }
        

        .form-label{
            font-size: 20px;
            font-weight: bold;
            color: white;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark fixed-top" >
        <div class="container-fluid">
            <a class="navbar-brand" href="../entrenador/homeEntrenador.php"id="E1"><img src="../resourses/img/logo_sisgtmma.png" alt="logo">
                <strong>Reporte de Competidores Inscritos</strong></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel"><strong>Entrenador</strong></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../entrenador/homeEntrenador.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../entrenador/vistatorneos.php">Volver</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../model/cerrarSesion.php">Cerrar Sesion</a>
                    </li>
                </div>
            </div>
        </div>
    </nav>

    <div class="Espacio"></div>

    <div class="container">
        <h1 class="mt-5"></h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Competidor</th>
                    <th scope="col">Peso</th>
                    <th scope="col">Nivel</th>
                    <th scope="col">Edad</th>
                    <th scope="col">Torneo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($competidores as $competidor): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($competidor['NOMBRE_COMPLETO']); ?></td>
                        <td><?php echo htmlspecialchars($competidor['PESO']); ?></td>
                        <td><?php echo htmlspecialchars($competidor['NOMBRE_NIVEL']); ?></td>
                        <td><?php echo htmlspecialchars($competidor['EDAD']); ?></td>
                        <td><?php echo htmlspecialchars($competidor['NOMBRE_TORNEO']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>


    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Enlaces útiles</h5>
                    <a href="#">Política de Privacidad</a><br>
                    <a href="#">Términos y Condiciones</a>
                </div>
                <div class="col-md-4">
                    <h5>Contáctanos</h5>
                    <p>Email: info@sisgtmma.com</p>
                    <p>Tel: +1 (234) 567-890</p>
                </div>
                <div class="col-md-4">
                    <h5>Síguenos</h5>
                    <a href=""><img class="imgRS" src="../resourses/img/facebook.png" alt="Facebook"></a>
                    <a href="#"><img class="imgRS" src="../resourses/img/x.png" alt="Twitter"></a>
                    <a href="#"><img class="imgRS" src="../resourses/img/instagram.png" alt="Instagram"></a>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <p>&copy; 2024 SISGTMMA. Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
