<?php 	

spl_autoload_register(function($class_name){

	$file_name = "class". DIRECTORY_SEPARATOR .$class_name.".php";

	//echo $class_name.":::<br>";

	if (file_exists($file_name)){
		require_once($file_name);
	}
	
});

	$root = new Usuario();
	$root->loadID(1);
	echo $root;


class Sql extends PDO {

	private $conn;

	public function __construct(){

		$this->conn = new PDO("mysql:host=localhost;dbname=dbphp7","root","");
		//PDO("mysql:dbname=dbphp7;host=localhost","root","")

	}

	private function setParams($statment, $parameters = array()){
		foreach ($parameters as $key => $value) {
			$this->setParam($statment,$key,$value);		
		}
	}

	private function setParam($statment, $key, $value){
		$statment->bindParam($key,$value);	
	}

	public function query($rawQuery,$params = array()){

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt,$params);

		$stmt->execute();

		return $stmt;

	}

	public function select($rawQuery,$Params = array())//:array
	{
		$stmt = $this->query($rawQuery,$Params);
		
		return $stmt->fetchAll(PDO::FETCH_ASSOC);

		//return $Params; 
	}

}



class Usuario{
	
	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	public function getIdUsuario(){
		return $this->idusuario;
	}

	public function setIdUsuario($value){
		$this->idusuario = $value;
	}


	public function getDeslogin(){
		return $this->deslogin;
	}

	public function setDeslogin($value){
		$this->deslogin = $value;
	}


	public function getDessenha(){
		return $this->dessenha;
	}

	public function setDessenha($value){
		$this->dessenha = $value;
	}

	public function getDtCadastro(){
		return $this->dtcadastro;
	}

	public function setDtCadastro($value){
		$this->dtcadastro = $value;
	}

	public function loadID($id){
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(":ID"=>$id));

		//if (isset($results[0])) ou

		if (count($results) > 0){

			$row = $results[0]; //Busca por ID retorna apenas um registro

			$this->setIdUsuario($row['idusuario']);			
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtCadastro(new DateTime($row['dtcadastro']));
			
		}

	}


		public function __toString(){

			return json_encode(array(
				"idusuario"=>$this->getIdUsuario(),
				"deslogin"=>$this->getDeslogin(),
				"dessenha"=>$this->getDessenha(),
				"dtcadastro"=>$this->getDtCadastro()->format("d/m/Y H:i:s")
			));
		}

}




?>