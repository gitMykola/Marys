<?php
class Db
{
	public static function getConnection()
	{
		
		$paramsPath = ROOT.'/config/config.php';
		$params = include_once($paramsPath)['db'];
		
		$dsn = "mysql:host={$params['host']};dbname = {$params['dbname']}";
		$db = new PDO($dsn,$params['username'],$params['password']);
		
		$db->exec("set name utf8");
		return $db;
	}
	
}
?>