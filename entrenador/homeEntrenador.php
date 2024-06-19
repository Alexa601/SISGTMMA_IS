<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../html/index.php");
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
}
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
    <nav class="navbar bg-body-tertiary fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="../resourses/img/logo_sisgtmma.png" alt="logo" >
    <strong>Bienvenid@: <?php echo htmlspecialchars($_SESSION['usuario']); ?> </strong>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><strong><?php echo htmlspecialchars($_SESSION['usuario']); ?></strong> </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#"> Perfil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../organizador/vistaTorneos.php">Torneos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../organizador/vistaTorneos.php">Mi Academia</a>
          </li>
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Otros
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Preguntas Frecuentes</a></li>
              <li><a class="dropdown-item" href="#">Acerca de</a></li>
              <li>
            </ul>

            <li class="nav-item">
            <a class="nav-link" href="../organizador/vistaTorneos.php">Cerrar Sesion</a>
          </li>
          </li>
        </ul>
        
      </div>
    </div>
  </div>
</nav>
    

    <div class="label-not">
        <h1 class="montserrat-custom"><strong>Noticias</strong></h1>
    </div>

    <div class="card-group">
        <div class="card">
          <a href="https://www.facebook.com/story.php?story_fbid=122131600232217815&id=61556534457512&mibextid=oFDknk&rdid=FJDWe2ws2oHiiYpi" id="img-not" target="_blank">
            <img src="../resourses/img/Noticia_ej.jpeg" class="card-img-top" alt="campOaxaca"></a>
          <div class="card-body">
            <h5 class="card-title">1er. Campeonato Estatal de Oaxaca 2024</h5>
            <p class="card-text">Sede: Complejo Deportivo: "Hermanos Flores Magón".</p>
          </div>
          <div class="card-footer">
            <small class="text-body-secondary">Publicado: 23 de mayo de 2024</small>
          </div>
        </div>
        <div class="card">
        <a href="https://immaf.org/2024/05/17/pan-america-becomes-first-continental-federation-under-the-immaf-to-host-elections-for-presidency-and-key-positions/" target="_blank"  id="img-not"><img src="../resourses/img/image.png" class="card-img-top" alt="..."></a>
          <div class="card-body">
            <h5 class="card-title">Nuevo presidente de MMA </h5>
            <p class="card-text">Panamérica se convierte en la primera federación continental bajo la IMMAF en celebrar elecciones para la presidencia y puestos clave.</p>
          </div>
          <div class="card-footer">
            <small class="text-body-secondary">Publicado: 17 de mayo de 2024</small>
          </div>
        </div>
        <div class="card">
          <a href="https://famm.com.mx/convocatoria/" target="_blank" id="img-not"><img src="https://i0.wp.com/famm.com.mx/wp-content/uploads/2022/04/campeonato-nacional-artes-marciales-mixtas.jpeg?resize=1187%2C1536&ssl=1" class="card-img-top" alt="..." ></a>
          <div class="card-body">
            <h5 class="card-title">Campeonato Nacional de MMA 2024</h5>
            <p class="card-text">Fecha: Del 24 al 26 de junio. 
              <br> Sede: Gimnasio Nuevo León Unido
            </p>
          </div>
          <div class="card-footer">
          <small class="text-body-secondary">Publicado: 17 de mayo de 2024</small>
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
