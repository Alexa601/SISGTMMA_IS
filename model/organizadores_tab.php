<?php
class Organizadores_tab extends Orm{
    function __construct(PDO $connection){
        parent::__construct('id','organizadores_tab',$connection);
    }

    function getNombreOrganizador() {
        $sql = "SELECT CONCAT(NOMBRE, ' ', APELLIDO_PATERNO) AS nombreCompleto FROM organizadores_tab WHERE ID_ROL_ORGANIZADOR_FK = 1";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        return $result['nombreCompleto'];
    }
}
?>