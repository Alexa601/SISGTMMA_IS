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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Torneos</title>
    <link rel="icon" type="image/png" href="../resourses/img/logo2.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../resourses/style.css">
</head>
<body>


    <nav class="navbar navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="../organizador/homeOrganizador.php"><img src="../resourses/img/logo_sisgtmma.png" alt="logo" >
      <strong>Torneos - Sistema de Gestión de Torneos de MMA</strong></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel"><?php echo htmlspecialchars($_SESSION['usuario']); ?></h5>
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
      </div>
    </div>
  </div>
</nav>

<div class="Espacio">

</div>
<div class="opciones">   
<div class="card" id="opc">
  <h5 class="card-header">Crear Torneo</h5>
  <div class="card-body">
    <p class="card-text">Realiza la creacion de un nuevo torneo para que participen las academias 
      <br> Llena las bases correspondientes referentes a: 
          <ul>
            <li>Nombre del torneo</li>
            <li>Fecha de inicio</li>
            <li>Fecha de fin</li>
            <li>Lugar</li>
            <li>Costo</li>
          </ul>
    </p>
    <a href="../organizador/torneo.php" class="btn">Nuevo Torneo</a>
  </div>
</div>

<div class="card">
  <h5 class="card-header">Registrar Staff a Torneo</h5>
  <div class="card-body">
    <p class="card-text">Registrar al staff que ayudara para cubrir el torneo</p>
    <a href="../organizador/staff.php" class="btn">Registrar Staff</a>
  </div>
</div>

<div class="card">
  <h5 class="card-header">Ver Torneos</h5>
  <div class="card-body">
    <p class="card-text">Visualizar todos los torneos que estan activos actualmente</p>
    <a href="../organizador/homeTorneo.php" class="btn">Ver Torneos</a>
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
                    <a href="#"><img class="imgRS" src="../resourses/img/facebook.png" alt="Facebook"></a>
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