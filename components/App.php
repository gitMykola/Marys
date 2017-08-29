<?php
class App
{
	public static function redirect($url = '')
	{
		$paramsPath = ROOT.'/config/config.php';
		$params = include($paramsPath);
		$params = $params['app'];
		header('Location: '.$params['site_url'].$url, true, 301);
		die();
	}
	public static function loged($str)
	{
		
	}
}
?>