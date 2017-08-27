<?php
class Router
{
	private $routes; //routes array
	public function __construct()
	{
		$routesPath = ROOT.'/components/routes.php';
		//take routes from file
		$this->routes = include($routesPath);
	}
	
	//Return request string
	private function getURI()
	{
		if(!empty($_SERVER['REQUEST_URI']))return trim($_SERVER['REQUEST_URI'],'/');
	}
	public function run()
	{
		//get request string
		$uri = strtolower($this->getURI());
		//set lang
		$uriLang = explode('/',$uri);
		$paramsPath = ROOT.'/config/config.php';
		$params = include($paramsPath);
		$params = $params['lang'];
		$lang = Lang::get(strtolower(isset($uriLang[0])?$uriLang[0]:''),$params['languages']);
		if($lang !== '')$uri = trim(str_replace($uriLang[0],'',$uri),'/');
		else $lang = $params['default_lang'];
		define('LANG',$lang);
		//check in routes array
		foreach($this->routes as $uriPattern => $path)
		{
			if($uriPattern == $uri/*preg_match("~$uriPattern~",$uri)*/)
			{
				//echo 'Pat: '.$uriPattern.' Uri:'.$uri."<br>";
				//get internal path from outside according to rule
				$internalRoute = preg_replace("~$uriPattern~",$path,$uri);
				
				$segments = explode('/',$internalRoute);
								
				$controllerName = array_shift($segments).'Controller';
				$controllerName = ucfirst($controllerName);
				
				$actionName = 'action'.ucfirst(array_shift($segments));
				
				$parameters = $segments;
				
				$controllerFile = ROOT.'/controllers/'.$controllerName.'.php';
				
				if(file_exists($controllerFile))include_once($controllerFile);
				$user = Auth::authorization(new User);
				$controllerObject = new $controllerName($user);
				//echo $controllerName.' '.$actionName.'<br>';
				if(method_exists($controllerObject, $actionName))
				{
					$result = call_user_func_array(array($controllerObject,$actionName),$parameters);
					if($result !== null)break;
					//else header('Location: /404/');
				}
			}
		}
		
						
	}
}

?>