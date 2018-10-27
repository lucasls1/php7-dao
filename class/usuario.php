<?php 

class usuario{
	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;
	public function getIdusuario(){
		return $this->idusuario;
	}
	public function setIdusuario($value){
		$this->idusuario = $value;
	}
	public function getDeslogin(){
		return $this->deslogin;
	}
	public function setDeslogin($login){
		$this->deslogin = $login;
	}
	public function getSenha(){
		return $this->dessenha;
	}
	public function setSenha($senha){
		$this->dessenha=$senha;
	}
	public function getCadastro(){
		return $this->dtcadastro;
	}
	public  function setCadastro($cadastro){

		$this->dtcadastro=$cadastro;

	}

	public function loadById($id){

		$sql = new sql();
		$result = $sql->select("SELECT * FROM tb_usuario WHERE idusuario =:ID",array(

				":ID"=>$id
		));

		if (isset($result[0])) {
			# code...
			$row = $result[0];

			$this->setIdusuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setSenha($row['dessenha']);
			$this->setCadastro(new DateTime($row['dtcadastro']));
		}


	}

public function __toString(){

	return json_encode(array(
		"idusuario"=>$this->getIdusuario(),
		"deslogin"=>$this->getDeslogin(),
		"dessenha"=>$this->getSenha(),
		"dtcadastro"=>$this->getCadastro()->format("d/m/Y H:i:s")


	));
}


}

 ?>