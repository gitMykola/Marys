<?php
class Router
{
	private $routes; //routes array
	public function __construct()
	{
		$routesPath = ROOT.'/config/routes.php';
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
		$uri = $this->getURI();
		
		//check in routes array
		foreach($this->routes as $uriPattern => $path)
		{
			if(preg_match("~$uriPattern~",$uri))
			{
				//get internal path from outside according to rule
				$internalRoute = preg_replace("~$uriPattern~",$path,$uri);
				
				$segments = explode('/',$internalRoute);
				$controllerName = array_shift($segments).'Controller';
				$controllerName = ucfirst($controllerName);
				
				$actionName = 'action'.ucfirst(array_shift($segments));
				$parameters = $segments;
				
				$controllerFile = ROOT.'/controlers/'.$controllerName.'.php';
				
				if(file_exists($controllerFile))include_once($controllerFile);
				
				$controlerObject = new $controllerName;
				
				if(method_exists($controlerObject, $actionName))
				{
					$result = call_user_func_array(array($controllerObject,$actionName),$parameters);
					if(!$result)break
					else header();
				}
			}
		}
		
						
	}
}

?>