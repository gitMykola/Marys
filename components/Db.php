<?php
class Db
{
	public static function getConnection()
	{
		
		$paramsPath = ROOT.'/config/db_params.php';
		$params = include_once($paramsPath);
		
		$dsn = "mysql:host={$params['host']};dbname = {$params['dbname']}";
		$db = new PDO($dsn,$params['username'],$params['password']);
		
		$db->exec("set name utf8");
		return $db;
	}
	
}
?>