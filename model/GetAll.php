<?php
require_once('../model/conexion.php');
require_once('../model/ORM.php');
require_once('../model/organizadores_tab.php');
$db = new Database();
$encontrado = $db->verificarDriver();
$productos = [];


if ($encontrado) {
    $cnn = $db->getConnection();
    $oragnizadorModelo = new Organizadores_tab($cnn);
    $nombreOrganizador = $oragnizadorModelo->getNombreOrganizador(); 
    $organizadores = $oragnizadorModelo->getAll();

}

if ($encontrado) {
    $cnn = $db->getConnection();
    $atletaModelo = new Atletas_tab($cnn);
    $nombreAtleta = $atletaModelo->getNombreAtleta(); 
    $atletas = $atletaModelo->getAll();
    
}


?>