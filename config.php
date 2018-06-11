<?php 

spl_autoload_register(function($class_name){

	$file_name = "class". DIRECTORY_SEPARATOR .$class_name.".php";

	//echo $class_name.":::<br>";

	if (file_exists($file_name)){
		require_once($file_name);
	}

	
});


?>