<?php
class Orm {
    protected $table;
    protected $db;
    protected $id;

    function __construct($id, $table, PDO $conn) {
        $this->id = $id;
        $this->table = $table;
        $this->db = $conn;
    }
    
    function getAll() {
        $sql = "SELECT * FROM {$this->table}";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->fetchAll();
    }

    function getById($id) {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        $stm = $this->db->prepare($sql);
        $stm->bindParam(':id', $id, PDO::PARAM_INT);
        $stm->execute();
        return $stm->fetch();
    }

    function deleteById($id){
        $succes=false;
        $sql="DELETE FROM {$this->table} WHERE id={$id}";
        $stm=$this->db->prepare($sql);
        $stm->execute();
        return $stm->fetch();
    }

    function getAllUsers(  ){

        $sql="SELECT user, rol FROM {$this->table} ORDER BY rol DESC";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    function getInfoByUser( $user ){

        $sql="SELECT * FROM {$this->table} WHERE user='{$user}'";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->fetch(PDO::FETCH_ASSOC);
    }


    
    
}
?>