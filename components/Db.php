<?php
class Db
{
	public static function getConnection()
	{
		$paramsPath = ROOT.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php';
		$params = include($paramsPath);
		$params = $params['db'];
		$dsn = "mysql:host=".$params['host'].";dbname=".$params['dbname'].";charset=".$params['charset'];
		$db = new PDO($dsn,$params['user'],$params['password']);
		return $db;
	}
	
}
?>