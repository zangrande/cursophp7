<?php 

	require_once("config.php");

	//$sql = new Sql();
	//$usuarios = $sql->select("SELECT * FROM tb_usuarios");
	//echo json_encode($usuarios);


	/* chama um usuário específico de acordo com a ID
	$root = new Usuario();
	$root->loadID(1);
	echo $root;
	*/


	/*
	$lista = Usuario::getList(); //Neste caso como o método ´estático, não foi necessário instaciar a classe, chamei direto desta forma NomeClass::NomeMetodo
	echo json_encode($lista);
	*/


	//$busca = Usuario::search("a"); //Este método busca todos os usuario com o cirério informado
	//echo json_encode($busca);


	//carregar um usaurio de acordo com o logi e senha
	$logar = new Usuario();
	$logar->login("user","12345");
	echo $logar;
?>