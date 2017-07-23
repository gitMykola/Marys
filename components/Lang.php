<?php
class Lang
{
	private $lang;
	
	public static function get($segment,$languages)
	{
		foreach($languages as $elem)
			if($segment == $elem)return $elem;
		return '';
	}
	public static function getLexicon()
	{
		$langFile = ROOT.'/assets/lexicons/'.LANG.'_lexicon.php';
		return (file_exists($langFile))?include_once $langFile:array();
	}
}
?>