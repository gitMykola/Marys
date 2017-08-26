<?
class View{
	public $lang;
	
	function __construct(){
	} 
	
	function generate($mainTemplate, $template = null, $data = array(), $user = null){
		$lex = Lang::getLexicon();
		$view = $mainTemplate;
		if(file_exists($view))include_once $view;
		else echo"No view file: ".$view;
	}
}

