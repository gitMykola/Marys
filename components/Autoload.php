<?php
//Autoload function

spl_autoload_register(function($class_name)
{
	// folder arrays
	$array_path = array(
		DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR,
		DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR,
		DIRECTORY_SEPARATOR.'controllers'.DIRECTORY_SEPARATOR
	);
	foreach($array_path as $e)
	{
		//echo $e.'<br>';
		$path = ROOT.$e.$class_name.'.php';
		//echo $path.'<br>'.is_file($path).'<br>';
		if(file_exists($path)){include_once $path;/*echo $path.'<br>';*/}
	}
});

?>