<?php
//Autoload function

function __autoload($class_name)
{
	// folder arrays
	$array_path = [
		'models',
		'components',
		'controllers',
	];
	foreach($array_path)
	{
		$path = ROOT.$path.$class_name.'.php';
		if(is_file($path))include_once $path;
	}
}

?>