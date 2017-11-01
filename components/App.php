<?php
class App
{
	public static function redirect($url = '')
	{
		$paramsPath = ROOT.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php';
		$params = include($paramsPath);
		$params = $params['app'];
		header('Location: '.$params['site_url'].$url, true, 301);
		echo"OK";
		exit;
	}
	public static function loged($str)
	{
		$db = Db::getConnection();
		$sql = "insert into `logs` (`message`) values(:message)";
		$result = $db->prepare($sql);
		$result->bindParam(':message',$str,PDO::PARAM_STR);
        //$result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
	}
	public static function reqAJ($data)
	{
		return print_r(json_encode($data));
	}
	public static function is_session() {
	//return (session_status() == 2)?true:false;	
    return true; 
	}
}
?>