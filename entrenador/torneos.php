<?php
// Conexión a la base de datos
try {
    $conn = new PDO("mysql:host=localhost;dbname=tu_base_de_datos", "tu_usuario", "tu_contraseña");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}

// Obtener torneos
try {
    $sql_torneos = "SELECT ID_TORNEO_PK, NOMBRE_TORNEO FROM registro_torneo_cat";
    $result_torneos = $conn->query($sql_torneos);
} catch (PDOException $e) {
    echo "Error al obtener torneos: " . $e->getMessage();
}

// Obtener competidores
try {
    $sql_competidores = "SELECT ID_COMPETIDOR_PK, NOMBRE_COMPETIDOR, APELLIDO_COMPETIDOR FROM competidores_tab";
    $result_competidores = $conn->query($sql_competidores);
} catch (PDOException $e) {
    echo "Error al obtener competidores: " . $e->getMessage();
}

// Obtener niveles
try {
    $sql_niveles = "SELECT ID_CATEGORIA_NIVEL_PK, NOMBRE_NIVEL FROM nivel_competidores_cat";
    $result_niveles = $conn->query($sql_niveles);
} catch (PDOException $e) {
    echo "Error al obtener niveles: " . $e->getMessage();
}

// Obtener pesos
try {
    $sql_pesos = "SELECT ID_CATEGORIA_PESO_PK, NOMBRE_CATEGORIA_PESO FROM peso_competidores_cat";
    $result_pesos = $conn->query($sql_pesos);
} catch (PDOException $e) {
    echo "Error al obtener pesos: " . $e->getMessage();
}

// Obtener categorías de edad
try {
    $sql_edades = "SELECT ID_CATEGORIA_EDAD_PK, NOMBRE_CATEGORIA_EDAD FROM edad_competidores_cat";
    $result_edades = $conn->query($sql_edades);
} catch (PDOException $e) {
    echo "Error al obtener categorías de edad: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Competidores</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Registrar Competidor a Torneo</h2>
    <form action="registorneo.php" method="POST">
        <div class="form-group">
            <label for="torneo">Torneo:</label>
            <select name="torneo" id="torneo" class="form-control">
                <?php
                if ($result_torneos->rowCount() > 0) {
                    while ($row = $result_torneos->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . htmlspecialchars($row['ID_TORNEO_PK']) . "'>" . htmlspecialchars($row['NOMBRE_TORNEO']) . "</option>";
                    }
                } else {
                    echo "<option value=''>No hay torneos disponibles</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="competidor">Competidor:</label>
            <select name="competidor" id="competidor" class="form-control">
                <?php
                if ($result_competidores->rowCount() > 0) {
                    while ($row = $result_competidores->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . htmlspecialchars($row['ID_COMPETIDOR_PK']) . "'>" . htmlspecialchars($row['NOMBRE_COMPETIDOR']) . " " . htmlspecialchars($row['APELLIDO_COMPETIDOR']) . "</option>";
                    }
                } else {
                    echo "<option value=''>No hay competidores disponibles</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="nivel">Nivel:</label>
            <select name="nivel" id="nivel" class="form-control">
                <?php
                if ($result_niveles->rowCount() > 0) {
                    while ($row = $result_niveles->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . htmlspecialchars($row['ID_CATEGORIA_NIVEL_PK']) . "'>" . htmlspecialchars($row['NOMBRE_NIVEL']) . "</option>";
                    }
                } else {
                    echo "<option value=''>No hay niveles disponibles</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="peso">Peso:</label>
            <select name="peso" id="peso" class="form-control">
                <?php
                if ($result_pesos->rowCount() > 0) {
                    while ($row = $result_pesos->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . htmlspecialchars($row['ID_CATEGORIA_PESO_PK']) . "'>" . htmlspecialchars($row['NOMBRE_CATEGORIA_PESO']) . "</option>";
                    }
                } else {
                    echo "<option value=''>No hay categorías de peso disponibles</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="edad">Edad:</label>
            <select name="edad" id="edad" class="form-control">
                <?php
                if ($result_edades->rowCount() > 0) {
                    while ($row = $result_edades->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . htmlspecialchars($row['ID_CATEGORIA_EDAD_PK']) . "'>" . htmlspecialchars($row['NOMBRE_CATEGORIA_EDAD']) . "</option>";
                    }
                } else {
                    echo "<option value=''>No hay categorías de edad disponibles</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
</div>
</body>
</html>
