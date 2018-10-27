<?php 

class sql extends PDO{

private $conn;

public function __construct(){

	$this->conn = new PDO("mysql:host=localhost;dbname=php7","root","root");
}

public function setParams($statment,$parameters = array()){

	foreach ($parameters as $key => $value) {
		# code...
		$this->setParam($key,$value);
	}

}

private function setParam($statment,$key,$value){

	$statment->bindParam($key,$value);
}

public function query($rawQuery,$params = array()){

	$stmt = $this->conn->prepare($rawQuery);
	$this->setParams($stmt,$params);

	 $stmt->execute();
	return $stmt;
	}

	public function select($rawQuery,$params=array()):array
	{

		$stmt = $this->query($rawQuery,$params);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

}

 ?>