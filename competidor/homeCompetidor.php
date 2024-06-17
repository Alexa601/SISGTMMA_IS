<?php
require_once('../model/conexion.php');
require_once('../model/ORM.php');
require_once('../model/atletas_tab.php');
// Verifica si el usuario tiene rol de ADMIN

$db = new Database();
$encontrado = $db->verificarDriver();

if ($encontrado) {
  $cnn = $db->getConnection();
    $atletaModelo = new Atletas_tab($cnn);
    $nombreAtleta = $atletaModelo->getNombreAtleta(); 
  
} 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Competidor</title>
    <link rel="icon" type="image/png" href="../resourses/img/logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../resourses/style.css">
</head>
<body>

    

    <div class="bienvenido">
        
        <h1 class="montserrat-custom"><strong>Bienvenid@:  <?php echo $nombreAtleta; ?></strong></h1>
        <div class="header">
        <a class="header-competidor">
            <img src="../resourses/img/logo_sisgtmma.png" alt="logo" >
        </a>
    </div>
    </div>

    <div class="navbar">
       <ul class="nav nav-underline">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#">Perfil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Rankeo Nacional</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Torneos</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Mis Torneos</a></li>
              <li><a class="dropdown-item" href="#">Ver Torneos</a></li>
            </ul>
        <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Otros</a>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="#">Preguntas Frecuentes</a></li>
      <li><a class="dropdown-item" href="#">Contactanos</a></li>
      <li><a class="dropdown-item" href="#"></a></li>
    </ul>
  </li>
      </ul> 
    </div>
    

    <div class="label-not">
        <h1 class="montserrat-custom"><strong>Noticias</strong></h1>
    </div>

    <div class="card-group">
        <div class="card">
          <img src="../resourses/img/Noticia_ej.jpeg" class="card-img-top" alt="campOaxaca" id="img-not">
          <div class="card-body">
            <h5 class="card-title">1er. Campeonato Estatal de Oaxaca 2024</h5>
            <p class="card-text">Sede: Complejo Deportivo: "Hermanos Flores Magón".</p>
          </div>
          <div class="card-footer">
            <small class="text-body-secondary">Publicado: 23 de mayo de 2024</small>
          </div>
        </div>
        <div class="card">
          <img src="../resourses/img/image.png" class="card-img-top" alt="..." id="img-not">
          <div class="card-body">
            <h5 class="card-title">Nuevo presidente de MMA </h5>
            <p class="card-text">Panamérica se convierte en la primera federación continental bajo la IMMAF en celebrar elecciones para la presidencia y puestos clave.</p>
          </div>
          <div class="card-footer">
            <small class="text-body-secondary">Publicado: 17 de mayo de 2024</small>
          </div>
        </div>
        <div class="card">
          <img src="../resourses/img/noticia_ej2.jpeg" class="card-img-top" alt="..." id="img-not">
          <div class="card-body">
            <h5 class="card-title">1er. Campeonato Estatal de Hidalgo 2024</h5>
            <p class="card-text">Auditorio Municipal de Doxey, Tlaxcoapan Hidalgo.</p>
          </div>
          <div class="card-footer">
            <small class="text-body-secondary">Publicado: 24 de abril de 2024</small>
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
