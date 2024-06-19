<?php
require '../model/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_registro_torneo_fk = $_POST["id_registro_torneo_fk"];
    $id_organizador_fk = $_POST["id_organizador_fk"];
    $staff_ids = $_POST["id_staff_fk"];

    $db = new Database();
    $conn = $db->getConnection();

    foreach ($staff_ids as $staff_id) {
        $sql = "INSERT INTO staff_torneo (id_registro_torneo_fk, id_staff_fk, id_organizador_fk) 
                VALUES (:id_registro_torneo_fk, :id_staff_fk, :id_organizador_fk)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_registro_torneo_fk', $id_registro_torneo_fk);
        $stmt->bindParam(':id_staff_fk', $staff_id);
        $stmt->bindParam(':id_organizador_fk', $id_organizador_fk);

        $stmt->execute();
    }

    header("Location: torneos.php");
    exit();
}
?>
