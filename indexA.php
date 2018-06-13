<?php 

	require_once("config.php");

	//$sql = new Sql();
	//$usuarios = $sql->select("SELECT * FROM tb_usuarios");
	//echo json_encode($usuarios);


	// chama um usuário específico de acordo com a ID
	//$root = new Usuario();
	//$root->loadID(12);
	//echo $root;
	


	/*
	$lista = Usuario::getList(); //Neste caso como o método ´estático, não foi necessário instaciar a classe, chamei direto desta forma NomeClass::NomeMetodo
	echo json_encode($lista);
	*/


	//$busca = Usuario::search("a"); //Este método busca todos os usuario com o cirério informado
	//echo json_encode($busca);


	//carregar um usaurio de acordo com o logi e senha
	//$logar = new Usuario();
	//$logar->login("Joca","123");
	//echo $logar;

	//iNSERIR DADOS
	//$aluno = new Usuario("Zeca","zangrjo");
	//$aluno->insert();
	//echo $aluno;

	//ATUALIZAR DADOS
	//$aluno = new Usuario();
	//$aluno->loadID(12);
	//$aluno->update("Nitro","gas");
	//echo $aluno;


	//DELETANDO UM USUARIO
	$usuario = new Usuario();
	$usuario->loadID(12);
	$usuario->delete();

	echo $usuario;
	
?>