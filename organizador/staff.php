<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Staff</title>
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
            <a class="navbar-brand" href="../organizador/homeOrganizador.php"><img src="../resourses/img/logo_sisgtmma.png" alt="logo">
                <strong>Registro de Staff a torneos</strong></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel"><strong>Organizador</strong></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../organizador/homeOrganizador.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../organizador/vistaTorneos.php">Volver</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../model/cerrarSesion.php">Cerrar Sesion</a>
                    </li>
                </div>
            </div>
        </div>
    </nav>

    <div class="Espacio"></div>

    <div class="opciones">
        <div class="card">
            <h5 class="card-header">Torneos Disponibles</h5>
            <div class="card-body">
                <?php
                session_start();
                require '../model/conexion.php';
                $db = new Database();
                $conn = $db->getConnection();

                $sql = "SELECT NOMBRE_TORNEO, FECHA_TORNEO, HORA_INICIO_TORNEO, LUGAR, NIVEL_TORNEO, RANKEO, COSTO_FICHA, MODALIDAD, FECHA_LIMITE_INSCRIPCIONES, PREMIACION, ID_ORGANIZADOR_FK FROM registro_torneo_cat";
                $result = $conn->query($sql);

                if ($result->rowCount() > 0) {
                    echo '<table class="table table-striped">';
                    echo '<thead><tr><th>Nombre del Torneo</th><th>Fecha</th><th>Hora de Inicio</th><th>Lugar</th><th>Nivel</th><th>Rankeo</th><th>Costo</th><th>Modalidad</th><th>Fecha Límite de Inscripción</th><th>Premiación</th></tr></thead>';
                    echo '<tbody>';
                    while ($row = $result->fetch()) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row["NOMBRE_TORNEO"]) . '</td>';
                        echo '<td>' . htmlspecialchars($row["FECHA_TORNEO"]) . '</td>';
                        echo '<td>' . htmlspecialchars($row["HORA_INICIO_TORNEO"]) . '</td>';
                        echo '<td>' . htmlspecialchars($row["LUGAR"]) . '</td>';
                        echo '<td>' . htmlspecialchars($row["NIVEL_TORNEO"]) . '</td>';
                        echo '<td>' . htmlspecialchars($row["RANKEO"]) . '</td>';
                        echo '<td>' . htmlspecialchars($row["COSTO_FICHA"]) . '</td>';
                        echo '<td>' . htmlspecialchars($row["MODALIDAD"]) . '</td>';
                        echo '<td>' . htmlspecialchars($row["FECHA_LIMITE_INSCRIPCIONES"]) . '</td>';
                        echo '<td>' . htmlspecialchars($row["PREMIACION"]) . '</td>';
                        echo '</tr>';
                    }
                    echo '</tbody>';
                    echo '</table>';
                } else {
                    echo "No hay torneos disponibles.";
                }
                ?>
            </div>
        </div>

        <div class="card">
            <h5 class="card-header">Registrar Staff a Torneo</h5>
            <div class="card-body">
                <form action="regisStaff.php" method="POST">
                    <div class="form-group">
                        <label for="id_registro_torneo_fk">Torneo</label>

                        <select class="form-control" id="id_registro_torneo_fk" name="id_registro_torneo_fk" required>
                            <?php
                            $result = $conn->query("SELECT ID_REGISTRO_TORNEO_PK, NOMBRE_TORNEO FROM registro_torneo_cat");
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='" . htmlspecialchars($row['ID_REGISTRO_TORNEO_PK']) . "'>" . htmlspecialchars($row['NOMBRE_TORNEO']) . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div id="staff-container">
                        <div class="form-group">
                            <label for="id_staff_fk">Staff</label>
                            <select class="form-control" id="id_staff_fk" name="id_staff_fk[]" required>
                                <?php
                                $result = $conn->query("SELECT ID_STAFF_PK, NOMBRE, APELLIDO_PATERNO FROM staff_tab");
                                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option value='" . htmlspecialchars($row['ID_STAFF_PK']) . "'>" . htmlspecialchars($row['NOMBRE']) . ' ' . htmlspecialchars($row['APELLIDO_PATERNO']) . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <button type="button" id="add-staff-btn" class="btn btn-secondary mt-2">+</button>

                    <div class="form-group">
                        <label for="id_organizador_fk">Organizador</label>
                        <select class="form-control" id="id_organizador_fk" name="id_organizador_fk" required>
                            <?php
                            $result = $conn->query("SELECT ID_ORGANIZADOR_PK, NOMBRE, APELLIDO_PATERNO FROM organizadores_tab");
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='" . htmlspecialchars($row['ID_ORGANIZADOR_PK']) . "'>" . htmlspecialchars($row['NOMBRE']) . ' ' . htmlspecialchars($row['APELLIDO_PATERNO']) . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Registrar</button>
                </form>
            </div>
        </div>

        <div class="card">
            <h5 class="card-header">Staff Registrado</h5>
            <div class="card-body">
                <?php
                $sql_staff = "SELECT registro_torneo_cat.NOMBRE_TORNEO, staff_tab.NOMBRE AS NOMBRE_STAFF, staff_tab.APELLIDO_PATERNO AS APELLIDO_STAFF, organizadores_tab.NOMBRE AS NOMBRE_ORG, organizadores_tab.APELLIDO_PATERNO AS APELLIDO_ORG
                              FROM staff_torneo
                              INNER JOIN registro_torneo_cat ON staff_torneo.id_registro_torneo_fk = registro_torneo_cat.ID_REGISTRO_TORNEO_PK
                              INNER JOIN staff_tab ON staff_torneo.id_staff_fk = staff_tab.ID_STAFF_PK
                              INNER JOIN organizadores_tab ON staff_torneo.id_organizador_fk = organizadores_tab.ID_ORGANIZADOR_PK";
                $result_staff = $conn->query($sql_staff);

                if ($result_staff->rowCount() > 0) {
                    echo '<table class="table table-striped">';
                    echo '<thead><tr><th>Nombre del Torneo</th><th>Nombre del Staff</th><th>Apellido del Staff</th><th>Nombre del Organizador</th><th>Apellido del Organizador</th></tr></thead>';
                    echo '<tbody>';
                    while ($row = $result_staff->fetch()) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row["NOMBRE_TORNEO"]) . '</td>';
                        echo '<td>' . htmlspecialchars($row["NOMBRE_STAFF"]) . '</td>';
                        echo '<td>' . htmlspecialchars($row["APELLIDO_STAFF"]) . '</td>';
                        echo '<td>' . htmlspecialchars($row["NOMBRE_ORG"]) . '</td>';
                        echo '<td>' . htmlspecialchars($row["APELLIDO_ORG"]) . '</td>';
                        echo '</tr>';
                    }
                    echo '</tbody>';
                    echo '</table>';
                } else {
                    echo "No hay staff registrado.";
                }
                ?>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('add-staff-btn').addEventListener('click', function () {
            var container = document.getElementById('staff-container');
            var div = document.createElement('div');
            div.classList.add('form-group', 'mt-2');
            div.innerHTML = `
                <label for="id_staff_fk">Staff</label>
                <select class="form-control" name="id_staff_fk[]" required>
                    <?php
                    $result = $conn->query("SELECT ID_STAFF_PK, NOMBRE, APELLIDO_PATERNO FROM staff_tab");
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . htmlspecialchars($row['ID_STAFF_PK']) . "'>" . htmlspecialchars($row['NOMBRE']) . ' ' . htmlspecialchars($row['APELLIDO_PATERNO']) . "</option>";
                    }
                    ?>
                </select>`;
            container.appendChild(div);
        });
    </script>
</body>

</html>
