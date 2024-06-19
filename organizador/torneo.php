<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

include('../model/conexion.php');
$db = new Database();
$conn = $db->getConnection(); // Obtener la conexión PDO

// Obtener ID del organizador desde la sesión
$id_organizador_fk = $_SESSION['id_organizador']; // Asegúrate de tener este valor en tu sesión

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
    <title>Crear Torneo - Sistema de Gestión de Torneos de MMA</title>
    <link rel="icon" type="image/png" href="../resourses/img/logo2.png">
    <link rel="icon" type="image/png" href="../resourses/img/logo2.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../resourses/style.css">
</head>
<body>
<nav class="navbar navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="../organizador/homeOrganizador.php">
      <img src="../resourses/img/logo_sisgtmma.png" alt="logo">
      <strong>Torneos - Sistema de Gestión de Torneos de MMA</strong>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title"><?php echo htmlspecialchars($_SESSION['usuario']); ?></h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../organizador/homeOrganizador.php">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../model/cerrarSesion.php">Cerrar Sesion</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>

<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-dark text-white">
            <h5 class="card-title text-center">Crear Torneo</h5>
        </div>
        <div class="card-body">
            <form action="registorneo.php" method="POST">
                <div class="mb-3">
                    <label for="nombre_torneo" class="form-label">Nombre del Torneo</label>
                    <input type="text" class="form-control" id="nombre_torneo" name="nombre_torneo" required>
                </div>
                <div class="mb-3">
                    <label for="fecha_torneo" class="form-label">Fecha del Torneo</label>
                    <input type="date" class="form-control" id="fecha_torneo" name="fecha_torneo" required>
                </div>
                <div class="mb-3">
                    <label for="hora_inicio_torneo" class="form-label">Hora de Inicio del Torneo</label>
                    <input type="time" class="form-control" id="hora_inicio_torneo" name="hora_inicio_torneo" required>
                </div>
                <div class="mb-3">
                    <label for="lugar" class="form-label">Lugar del Torneo</label>
                    <input type="text" class="form-control" id="lugar" name="lugar" required>
                </div>
                <div class="mb-3">
                    <label for="nivel_torneo" class="form-label">Nivel del Torneo</label>
                    <select class="form-select" id="nivel_torneo" name="nivel_torneo" required>
                        <option value="NACIONAL">Nacional</option>
                        <option value="ESTATAL">Estatal</option>
                        <option value="MUNICIPAL">Municipal</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="rankeo" class="form-label">¿Rankeo?</label>
                    <select class="form-select" id="rankeo" name="rankeo" required>
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="costo_ficha" class="form-label">Costo de la Ficha</label>
                    <input type="number" class="form-control" id="costo_ficha" name="costo_ficha" required>
                </div>
                <div class="mb-3">
                    <label for="modalidad" class="form-label">Modalidad del Torneo</label>
                    <select class="form-select" id="modalidad" name="modalidad" required>
                        <option value="MMA">MMA</option>
                        <option value="GRAPLING">GRAPLING</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="fecha_limite_inscripciones" class="form-label">Fecha Límite de Inscripciones</label>
                    <input type="date" class="form-control" id="fecha_limite_inscripciones" name="fecha_limite_inscripciones" required>
                </div>
                <div class="mb-3">
                    <label for="premiacion" class="form-label">Premiación</label>
                    <select class="form-select" id="premiacion" name="premiacion" required>
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="id_organizador_fk">ID del Organizador</label>
                    <select class="form-control" id="id_organizador_fk" name="id_organizador_fk" required>
                        <?php
                        $result = $conn->query("SELECT ID_ORGANIZADOR_PK, NOMBRE, APELLIDO_PATERNO, APELLIDO_MATERNO FROM organizadores_tab");
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='" . htmlspecialchars($row['ID_ORGANIZADOR_PK']) . "'>" . htmlspecialchars($row['NOMBRE']) . " " . htmlspecialchars($row['APELLIDO_PATERNO']) . " " . htmlspecialchars($row['APELLIDO_MATERNO']) . "</option>";
                        }
                        ?>
                    </select>

                </div>

                <div class="mb-3">
                    <label for="responsable_registro" class="form-label">Responsable de Registro</label>
                    <input type="text" class="form-control" id="responsable_registro" name="responsable_registro" value="Hector Del Ángel" required readonly>
                </div>
                <button type="submit" class="btn btn-primary">Crear Torneo</button>
            </form>
        </div>
    </div>
</div>

<!-- Scripts de Bootstrap y jQuery -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
