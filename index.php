<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión de Torneos de MMA</title>
    <link rel="icon" type="image/png" href="../resourses/img/logo2.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
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
            font-family: "Montserrat", sans-serif;
        }
        .login-container h1 span2 {
            color: #ffffff; 
            font-family: "Montserrat", sans-serif;
        }
        .login-container h1 span3 {
            color: #FF0000; 
            font-family: "Montserrat", sans-serif;
        }
        .login-container h2, .login-container label, .login-container a {
            color: white;

        }

    </style>
</head>
<body>
    <div class="login-container">
        <h1><span1><strong>SIS</strong></span1><span2><strong>GT</strong></span2><span3><strong>MMA</strong></span3></h1>
        
        <?php
        include('model/conexion.php'); // Incluir el archivo de conexión a la base de datos
        
        $mensaje = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $usuario = $_POST['usuario'];
            $correo = $_POST['correo'];
            $contrasena = $_POST['contrasena'];
            
            $database = new Database();
            $conn = $database->getConnection();

            // Verificar en la tabla usuarios
            $sql = "SELECT * FROM usuarios WHERE contrasena=:contrasena AND correo=:correo AND usuario=:usuario";
            $stmt = $conn->prepare($sql);
            $stmt->execute(['contrasena' => $contrasena, 'correo' => $correo, 'usuario' => $usuario]);
            
            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                session_start();
                $_SESSION['usuario'] = $row['usuario'];
                $_SESSION['correo_eletronico'] = $row['correo'];
                $_SESSION['rol'] = $row['rol'];
                
                // Redirección según el rol del usuario
                switch ($row['rol']) {
                    case 'Entrenador':
                        header("Location: ../entrenador/homeEntrenador.php");
                        break;
                    case 'Estudiante':
                        header("Location: ../alumnos/homeAlumno.php");
                        break;
                    case 'Staff':
                        header("Location: ../staff/homeStaff.php");
                        break;
                    default:
                        // Rol nulo (Administrador)
                        // Validar en la tabla organizadores_tab
                        $sql_org = "SELECT * FROM organizadores_tab WHERE contrasena=:contrasena AND correo_electronico=:correo AND usuario=:usuario";
                        $stmt_org = $conn->prepare($sql_org);
                        $stmt_org->execute(['contrasena' => $contrasena, 'correo' => $correo, 'usuario' => $usuario]);

                        if ($stmt_org->rowCount() > 0) {
                            header("Location:../organizador/homeOrganizador.php");
                        } else {
                            $mensaje = "<div class='alert alert-danger'>Correo, contraseña o nombre de usuario incorrectos en la tabla de organizadores</div>";
                        }
                        break;
                }
                exit();
            } else {
                // Verificar en la tabla organizadores_tab si no se encuentra en usuarios
                $sql_org = "SELECT * FROM organizadores_tab WHERE contrasena=:contrasena AND correo_electronico=:correo AND usuario=:usuario";
                $stmt_org = $conn->prepare($sql_org);
                $stmt_org->execute(['contrasena' => $contrasena, 'correo' => $correo, 'usuario' => $usuario]);

                if ($stmt_org->rowCount() > 0) {
                    header("Location: ../organizador/homeOrganizador.php");
                    exit();
                } else {
                    $mensaje = "<div class='alert alert-danger'>Correo, contraseña o nombre de usuario incorrectos</div>";
                }
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
