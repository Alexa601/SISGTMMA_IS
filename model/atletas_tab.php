<?php
class Atletas_tab extends Orm{
    function __construct(PDO $connection){
        parent::__construct('id','atletas_tab',$connection);
    }

    function getNombreAtleta() {
        $sql = "SELECT CONCAT(NOMBRE, ' ', APELLIDO_PATERNO) AS nombreCompleto FROM atletas_tab WHERE ID_ATLETA_PK = 2";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        return $result['nombreCompleto'];
    }
}
?>