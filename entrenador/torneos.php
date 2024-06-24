<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}
include('../model/conexion.php');
$db = new Database();
$conn = $db->getConnection(); // Obtener la conexión PDO

// Obtener la lista de torneos disponibles
$torneos_stmt = $conn->prepare("SELECT ID_REGISTRO_TORNEO_PK, NOMBRE_TORNEO FROM registro_torneo_cat");
$torneos_stmt->execute();
$torneos = $torneos_stmt->fetchAll(PDO::FETCH_ASSOC);

// Obtener la lista de alumnos del entrenador
$entrenador_id = $_SESSION['usuario_id'];
$alumnos_stmt = $conn->prepare("SELECT ID_ATLETA_PK, CONCAT(NOMBRE, ' ', APELLIDO_PATERNO, ' ', APELLIDO_MATERNO) AS NOMBRE_COMPLETO FROM atletas_tab WHERE ID_ENTRENADOR_FK = ?");
$alumnos_stmt->execute([$entrenador_id]);
$alumnos = $alumnos_stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_alumno = $_POST['id_alumno'];
    $id_torneo = $_POST['id_torneo'];
    $id_nivel = $_POST['id_nivel'];
    $id_peso = $_POST['id_peso'];
    $id_edad = $_POST['id_edad'];

    // Insertar el registro en la tabla competidores_inscritos
    $insert_stmt = $conn->prepare("INSERT INTO competidores_inscritos (ID_COMPETIDOR_PK, ID_REGISTRO_TORNEO_FK, ID_NIVEL_COMPETIDOR_FK, ID_PESO_COMPETIDOR_FK, ID_EDAD_COMPETIDOR_FK) VALUES (?, ?, ?, ?, ?)");
    if ($insert_stmt->execute([$id_alumno, $id_torneo, $id_nivel, $id_peso, $id_edad])) {
        header("Location: torneos.php?mensaje=Alumno inscrito correctamente");
    } else {
        header("Location: torneos.php?error=Error al inscribir al alumno");
    }
    exit();
}

// Obtener las categorías de nivel, peso y edad
$niveles_stmt = $conn->prepare("SELECT ID_CATEGORIA_NIVEL_PK, NOMBRE_NIVEL FROM nivel_competidores_cat");
$niveles_stmt->execute();
$niveles = $niveles_stmt->fetchAll(PDO::FETCH_ASSOC);

$peso_stmt = $conn->prepare("SELECT ID_CATEGORIA_PESO_PK, NOMBRE_CATEGORIA FROM peso_competidores_cat");
$peso_stmt->execute();
$peso = $peso_stmt->fetchAll(PDO::FETCH_ASSOC);

$edad_stmt = $conn->prepare("SELECT ID_CATEGORIA_EDAD_PK, NOMBRE_CATEGORIA_EDAD FROM edad_competidores_cat");
$edad_stmt->execute();
$edad = $edad_stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscribir Alumnos a Torneo</title>
    <link rel="icon" type="image/png" href="../resourses/img/logo2.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../resourses/style.css">

    <style>
        .container{
            margin-top: 100px;
            font-family: "Montserrat", sans-serif;;
        }
        #E1{
            font-size: 30px;
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
                <strong>Inscribir Alumnos a Torneo</strong></a>
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

    <div class="card-body">
    <div class="container">
        <?php
        if (isset($_GET['mensaje'])) {
            echo "<div class='alert alert-success'>" . htmlspecialchars($_GET['mensaje']) . "</div>";
        }
        if (isset($_GET['error'])) {
            echo "<div class='alert alert-danger'>" . htmlspecialchars($_GET['error']) . "</div>";
        }
        ?>
        <form method="POST">
            <div class="mb-3">
                <label for="id_alumno" class="form-label">Alumno</label>
                <select class="form-select" id="id_alumno" name="id_alumno" required>
                    <option value="">Seleccionar Alumno</option>
                    <?php foreach ($alumnos as $alumno): ?>
                        <option value="<?php echo htmlspecialchars($alumno['ID_ATLETA_PK']); ?>"><?php echo htmlspecialchars($alumno['NOMBRE_COMPLETO']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="id_torneo" class="form-label">Torneo</label>
                <select class="form-select" id="id_torneo" name="id_torneo" required>
                    <option value="">Seleccionar Torneo</option>
                    <?php foreach ($torneos as $torneo): ?>
                        <option value="<?php echo htmlspecialchars($torneo['ID_REGISTRO_TORNEO_PK']); ?>"><?php echo htmlspecialchars($torneo['NOMBRE_TORNEO']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="id_nivel" class="form-label">Nivel</label>
                <select class="form-select" id="id_nivel" name="id_nivel" required>
                    <option value="">Seleccionar Nivel</option>
                    <?php foreach ($niveles as $nivel): ?>
                        <option value="<?php echo htmlspecialchars($nivel['ID_CATEGORIA_NIVEL_PK']); ?>"><?php echo htmlspecialchars($nivel['NOMBRE_NIVEL']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="id_peso" class="form-label">Peso</label>
                <select class="form-select" id="id_peso" name="id_peso" required>
                    <option value="">Seleccionar Peso</option>
                    <?php foreach ($peso as $p): ?>
                        <option value="<?php echo htmlspecialchars($p['ID_CATEGORIA_PESO_PK']); ?>"><?php echo htmlspecialchars($p['NOMBRE_CATEGORIA']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="id_edad" class="form-label">Edad</label>
                <select class="form-select" id="id_edad" name="id_edad" required>
                    <option value="">Seleccionar Edad</option>
                    <?php foreach ($edad as $e): ?>
                        <option value="<?php echo htmlspecialchars($e['ID_CATEGORIA_EDAD_PK']); ?>"><?php echo htmlspecialchars($e['NOMBRE_CATEGORIA_EDAD']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Inscribir Alumno</button>
        </form>
    </div>
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
