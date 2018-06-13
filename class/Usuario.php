<?php  
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

			$this->setData($results[0]);
			
		}

	}

	public static function getList(){ //Metodo estático
		//Este método busca todos os usuarios
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");
	}

	public static function search($login){
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
			':SEARCH'=>"%".$login."%"
		));
	}

	public function login($login,$senha){
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :LOGIN AND dessenha LIKE :PASS", array(
			':LOGIN'=>$login,
			':PASS'=>$senha

	));

		//if (isset($results[0])) ou

		if (count($results) > 0){

			//$row = $results[0]; //Busca por ID retorna apenas um registro

			$this->setData($results[0]);
			
		} else {
			throw new Exception("Login/Senha inválidos");
		}
	}

	public function insert(){
		$sql = new Sql();

		//Chamando a procedure: CALL sp_usuarios_insert ( deve estar gravada no bd )
		$results = $sql->select("CALL sp_usuarios_insert(:LOGIN,:SENHA)",array(
				':LOGIN'=>$this->getDeslogin(),
				':SENHA'=>$this->getDessenha()

			));

			if ( count($results) > 0 ) {
				$this->setData($results[0]);
			}
		
	}

	public function update($login,$password){

		$this->setDeslogin($login);
		$this->setDessenha($password);

		$sql = new Sql();
		$sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID", array(
			':LOGIN'=>$this->getDeslogin(),
			':PASSWORD'=>$this->getDessenha(),
			':ID'=>$this->getIdusuario()
		));
	}


	public function delete(){
		$sql = new Sql();
		$sql->query("DELETE FROM tb_usuarios WHERE idusuario = :ID", array(
			':ID'=>$this->getIdusuario()
		));

		$this->setIdusuario(0); //Apagando da memória do objeto
		$this->setDeslogin(""); //Apagando da memória do objeto
		$this->setDessenha(""); //Apagando da memória do objeto
		$this->setDtCadastro(new DateTime()); //Data atual

	}

	public function __construct($loagin = "",$password = ""){
			//Este parãmetros ( $loagin = "",$password = "" ) aceitam chamada sem valores
			//Se passar executa, senão , não....
			$this->setDeslogin($loagin);
			$this->setDessenha($password);

	}

	public function setData($data){
			$this->setIdUsuario($data['idusuario']);			
			$this->setDeslogin($data['deslogin']);
			$this->setDessenha($data['dessenha']);
			$this->setDtCadastro(new DateTime($data['dtcadastro']));
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