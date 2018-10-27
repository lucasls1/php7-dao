<?php 

require_once("config.php");

//$sql = new sql();

//$usuario = $sql->select("SELECT * FROM tb_usuario");

//echo json_encode($usuario);

$root = new usuario();

$root->loadbyId(3);

echo $root;

 ?>