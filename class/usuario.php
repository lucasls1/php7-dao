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
			$this->setData($result[0]);
		}


	}

	public static function getList(){

		$sql = new sql();
		return $sql->select("SELECT * FROM tb_usuario ORDER BY deslogin;");

	}

	public static function search($login){
		$sql = new sql();

		return $sql->select("SELECT * FROM tb_usuario WHERE deslogin LIKE :SEARCH ORDER BY deslogin",array(

			':SEARCH'=>"%".$login."%"

		));
	}

	public function login($login,$password){


		$sql = new sql();

		$result = $sql->select(" SELECT * FROM tb_usuario WHERE deslogin = :LOGIN AND dessenha = :PASSWORD ",array(

				":LOGIN"=> $login,
				":PASSWORD"=> $password
		));

		if (isset($result[0])) {
			# code...
			$this->setData($result[0]);
		} else {
			throw new Exception("Login e/ou senha invalidos.");
		}

	}
	public function insert(){
		$sql = new sql();
		$result = $sql->select("CALL sp_usuario_insert(:LOGIN , :PASSWORD)",array(

			':LOGIN'=>$this->getDeslogin(),
			':PASSWORD'=>$this->getSenha()
		));
		if (count($result) > 0) {
			# code...
			$this->setData($result[0]);
		}


	}


	public function delete(){
		$sql = new sql();
		$result = $sql->query("DELETE FROM tb_usuario WHERE idusuario = :ID",array(
			':ID'=>$this->getIdusuario()


		));	
		$this->setIdusuario(0);
		$this->setDeslogin("");
		$this->setSenha("");
		$this->setCadastro(new DateTime());
	}

	public function update($login,$password){

		$this->setDeslogin($login);
		$this->setSenha($password);

		$sql = new sql();
		$results = $sql->query("UPDATE tb_usuario SET deslogin = :LOGIN ,dessenha = :PASSWORD WHERE idusuario = :ID",array(
			':LOGIN'=>$this->getDeslogin(),
			':PASSWORD'=>$this->getSenha(),
			':ID'=>$this->getIdusuario()

		));
	}

public function __construct($login="",$password=""){

	$this->setDeslogin($login);
	$this->setSenha($password);
}

public function setData($data){

			$this->setIdusuario($data['idusuario']);
			$this->setDeslogin($data['deslogin']);
			$this->setSenha($data['dessenha']);
			$this->setCadastro(new DateTime($data['dtcadastro']));	
}
public function __toString(){

	return json_encode(array(
		"idusuario"=>$this->getIdusuario(),
		"deslogin"=>$this->getDeslogin(),
		"dessenha"=>$this->getSenha(),
		"dtcadastro"=>$this->getCadastro()//->format("d/m/Y H:i:s")

	));
}


}

 ?>