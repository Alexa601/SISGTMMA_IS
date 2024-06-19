<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión de Torneos de MMA</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: black;
            background-image: url('resourses/img/rejas.png');
            background-repeat: no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: white;
        }
        .login-container {
            background-color: rgba(0, 0, 0, 0.8); 
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            width: 100%;
            max-width: 400px;
        }
        .login-container h1 span1 {
            color: #0e8418; 
        }
        .login-container h1 span2 {
            color: #ffffff; 
        }
        .login-container h1 span3 {
            color: #FF0000; 
        }
        .login-container h2, .login-container label, .login-container a {
            color: white;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1><span1>SIS</span1><span2>GT</span2><span3>MMA</span3></h1>
        
        <?php
        include('model/conexion.php'); // Incluir el archivo de conexión a la base de datos
        
        $mensaje = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $usuario = $_POST['usuario'];
            $correo = $_POST['correo'];
            $contrasena = $_POST['contrasena'];
            
            $database = new Database();
            $conn = $database->getConnection();

            $sql = "SELECT * FROM usuarios WHERE contrasena=:contrasena AND correo=:correo AND usuario=:usuario";
            $stmt = $conn->prepare($sql);
            $stmt->execute(['contrasena' => $contrasena, 'correo' => $correo, 'usuario' => $usuario]);
            
            if ($stmt->rowCount() > 0) {
                session_start();
                $_SESSION['usuario'] = $usuario;
                $_SESSION['correo'] = $correo;
                header("Location: ../php/bienvenida.php");
                exit();
            } else {
                $mensaje = "<div class='alert alert-danger'>Correo, contraseña o nombre de usuario incorrectos</div>";
            }
        }
        ?>
        <?php if (!empty($mensaje)) echo $mensaje; ?>
        <form action="index.php" method="POST">
            <div class="form-group">
                <label for="usuario">Usuario</label>
                <input type="text" class="form-control" id="usuario" name="usuario" required>
            </div>
            <div class="form-group">
                <label for="correo">Correo</label>
                <input type="email" class="form-control" id="correo" name="correo" required>
            </div>
            <div class="form-group">
                <label for="contrasena">Contraseña</label>
                <input type="password" class="form-control" id="contrasena" name="contrasena" required>
            </div>
            
            <button type="submit" class="btn btn-success btn-block">Iniciar Sesión</button>
        </form>
        <div class="mt-3">
            <a href="registrousu.php">Registrarse</a>
        </div>
    </div>
</body>
</html>
