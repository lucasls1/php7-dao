<?php 

require_once("config.php");

//$sql = new sql();

//$usuario = $sql->select("SELECT * FROM tb_usuario");

//echo json_encode($usuario);
//carrega 1 usuario
//$root = new usuario();

//$root->loadbyId(3);

//echo $root;

//carrega uma lista de usuario
//$lista = usuario::getList();

//echo json_encode($lista);

//carrega uma lista de usuarios buscando pelo login
//$search = usuario::search("u");
//echo json_encode($search);


//carrega um usuario usando o login e senha 

$user= new usuario();
$user->login("lucas","12345rrsxx");

echo json_encode($user);
 ?>