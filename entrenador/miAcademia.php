<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: homeEntrenador.php");
    exit();
}

require_once('../model/conexion.php');
require_once('../model/ORM.php');

$db = new Database();
$conn = $db->getConnection();


$entrenadorOrm = new Orm(null, 'entrenadores_tab', $conn);
$alumnosOrm = new Orm(null, 'atletas_tab', $conn);
$academiaOrm = new Orm(null, 'academias_cat', $conn);


$entrenadores = $entrenadorOrm->getAll();
$alumnos = $alumnosOrm->getAll();
$academia = $academiaOrm->getAll();

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrenador</title>
    <link rel="icon" type="image/png" href="../resourses/img/logo2.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../resourses/style.css">
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

        .header .username {
            margin-left: 20px;
        }

        .container {
            margin-top: 80px;
            /* Para evitar que el contenido quede detrás del encabezado */
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
    <header class="header">
        <div class="title">
        <img src="../resourses/img/logo_sisgtmma.png" alt="logo">
        </div>
        <div class="username">Entrenador, <?php echo htmlspecialchars($_SESSION['usuario']); ?></div>
        <div>
            <a class="btn btn-danger" href="homeEntrenador.php">Volver</a>
        </div>
    </header>
    <div class="container">
        <nav>
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="#academia" data-bs-toggle="tab">Academia</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#estudiantes" data-bs-toggle="tab">Estudiantes</a>
                </li>
            </ul>
        </nav>
        <div class="tab-content">

            <!-- Información de la Academia -->
            <div class="tab-pane fade show active" id="academia">
                <div class="news-container">
                    <div class="news-title">Información de la Academia</div>
                    <?php if (!empty($academia)) : ?>
                        <?php $infoAcademia = $academia[0]; ?>
                        <div class="news-item">
                            <p><strong>Id:</strong> <?php echo htmlspecialchars($infoAcademia['ID_ACADEMIA_PK']); ?></p>
                            <p><strong>Nombre:</strong> <?php echo htmlspecialchars($infoAcademia['NOMBRE_ACADEMIA']); ?></p>
                            <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($infoAcademia['TELEFONO']); ?></p>
                            <p><strong>Correo Electrónico:</strong> <?php echo htmlspecialchars($infoAcademia['CORREO_ELECTRONICO']); ?></p>
                            <p><strong>Estatus:</strong> <?php echo htmlspecialchars($infoAcademia['ESTATUS_ACADEMIA']); ?></p>
                            <p><strong>Fecha de Registro:</strong> <?php echo htmlspecialchars($infoAcademia['FECHA_REGISTRO']); ?></p>
                        </div>
                    <?php else : ?>
                        <p>No se encontraron datos de la academia.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Lista de Estudiantes -->
            <div class="tab-pane fade" id="estudiantes">
                <div class="news-container">
                    <div class="news-title">Lista de Estudiantes</div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Apellido Paterno</th>
                                    <th>Apellido Materno</th>
                                    <th>Fecha de Nacimiento</th>
                                    <th>Sexo</th>
                                    <th>Teléfono</th>
                                    <th>Correo Electrónico</th>
                                    <th>Estatus</th>
                                    <th>Fecha de Registro</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($alumnos as $alumno) : ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($alumno['ID_ATLETA_PK']); ?></td>
                                        <td><?php echo htmlspecialchars($alumno['NOMBRE']); ?></td>
                                        <td><?php echo htmlspecialchars($alumno['APELLIDO_PATERNO']); ?></td>
                                        <td><?php echo htmlspecialchars($alumno['APELLIDO_MATERNO']); ?></td>
                                        <td><?php echo htmlspecialchars($alumno['FECHA_NACIMIENTO']); ?></td>
                                        <td><?php echo htmlspecialchars($alumno['SEXO']); ?></td>
                                        <td><?php echo htmlspecialchars($alumno['TELEFONO']); ?></td>
                                        <td><?php echo htmlspecialchars($alumno['CORREO_ELECTRONICO']); ?></td>
                                        <td><?php echo htmlspecialchars($alumno['ESTATUS_ATLETA']); ?></td>
                                        <td><?php echo htmlspecialchars($alumno['FECHA_REGISTRO']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>