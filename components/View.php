<?php
/**
 * Created by PhpStorm.
 * User: ASus
 * Date: 05.09.2017
 * Time: 12:54
 */

class View
{
    public function __construct()
    {}
    public function generate($mainTemplate, $template = null, $data = array(), $user){
        $lex = Lang::getLexicon();
        $view = $mainTemplate;
        if(file_exists($view))include_once $view;
        else echo "No view file: ".$view;
    }
}