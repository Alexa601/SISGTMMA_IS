<?php
require '../model/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_registro_torneo_fk = $_POST["id_registro_torneo_fk"];
    $competidor_ids = $_POST["id_competidor_fk"];
    $id_nivel_competidor_fk = $_POST["id_nivel_competidor_fk"];
    $id_peso_competidor_fk = $_POST["id_peso_competidor_fk"];
    $id_edad_competidor_fk = $_POST["id_edad_competidor_fk"];

    $db = new Database();
    $conn = $db->getConnection();

    foreach ($competidor_ids as $competidor_id) {
        $sql = "INSERT INTO competidores_inscritos (ID_COMPETIDOR_PK, ID_REGISTRO_TORNEO_FK, ID_NIVEL_COMPETIDOR_FK, ID_PESO_COMPETIDOR_FK, ID_EDAD_COMPETIDOR_FK) 
                VALUES (:id_competidor_fk, :id_registro_torneo_fk, :id_nivel_competidor_fk, :id_peso_competidor_fk, :id_edad_competidor_fk)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_competidor_fk', $competidor_id);
        $stmt->bindParam(':id_registro_torneo_fk', $id_registro_torneo_fk);
        $stmt->bindParam(':id_nivel_competidor_fk', $id_nivel_competidor_fk);
        $stmt->bindParam(':id_peso_competidor_fk', $id_peso_competidor_fk);
        $stmt->bindParam(':id_edad_competidor_fk', $id_edad_competidor_fk);

        $stmt->execute();
    }

    header("Location: torneos.php");
    exit();
}
?>
