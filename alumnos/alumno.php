<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../model/roles.php");
    exit();
}

include('../model/conexion.php'); // Incluir la conexión a la base de datos

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
    <title>COMPETIDOR - Sistema de Gestión de Torneos de MMA</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fafafa;
            color: #333;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
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

        .header .logout {
            margin-right: 20px;
        }

        .container {
            max-width: 600px;
            margin-top: 80px;
            /* Para evitar que el formulario quede detrás del encabezado */
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group label {
            font-weight: bold;
            color: #333;
        }

        .btn-primary {
            background-color: #0e8418;
            border-color: #0e8418;
        }

        .btn-primary:hover {
            background-color: #0e6e14;
            border-color: #0e6e14;
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
        <div class="username">Alumn@, <?php echo htmlspecialchars($_SESSION['usuario']); ?></div>
    </div>

    <div class="container mx-auto">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="card-title text-center">Registro del Alumno</h5>
            </div>
            <div class="card-body">
                <form action="regisalumno.php" method="POST">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="apellido_paterno">Primer Apellido</label>
                        <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" required>
                    </div>
                    <div class="form-group">
                        <label for="apellido_materno">Segundo Apellido</label>
                        <input type="text" class="form-control" id="apellido_materno" name="apellido_materno">
                    </div>
                    <div class="form-group">
                        <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                    </div>
                    <div class="form-group">
                        <label for="sexo">Sexo</label>
                        <select class="form-control" id="sexo" name="sexo" required>
                            <option value="M">M</option>
                            <option value="F">F</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" required>
                    </div>
                    <div class="form-group">
                        <label for="correo_electronico">Correo</label>
                        <input type="email" class="form-control" id="correo_electronico" name="correo_electronico" value="<?php echo htmlspecialchars($_SESSION['correo']); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="id_entrenador_fk">Id del Entrenador</label>
                        <select class="form-control" id="id_entrenador_fk" name="id_entrenador_fk" required>
                            <?php
                            $result = $conn->query("SELECT ID_ENTRENADOR_PK, NOMBRE, APELLIDO_MATERNO, APELLIDO_PATERNO FROM entrenadores_tab");
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='" . htmlspecialchars($row['ID_ENTRENADOR_PK']) . "'>" . htmlspecialchars($row['ID_ENTRENADOR_PK']) ." ". htmlspecialchars($row['NOMBRE']) ." ". htmlspecialchars($row['APELLIDO_PATERNO']) ." ". htmlspecialchars($row['APELLIDO_PATERNO']) ."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_discapacidad_fk">Discapacidad</label>
                        <select class="form-control" id="id_discapacidad_fk" name="id_discapacidad_fk" required>
                            <?php
                            $result = $conn->query("SELECT ID_DISCAPACIDAD_PK, NOMBRE_DISCAPACIDAD FROM discapacidad_cat");
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='" . htmlspecialchars($row['ID_DISCAPACIDAD_PK']) . "'>" . htmlspecialchars($row['NOMBRE_DISCAPACIDAD']) . "</option>";
                            }
                            ?>
                        </select>
                    </div>



                    <button type="submit" class="btn btn-primary btn-block">Registrar</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts de jQuery y Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>