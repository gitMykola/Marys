<?php
abstract class Model{
	public $template;
	public $mainTemplate;
	abstract public function __construct();
	abstract public function get();
	abstract public function set();
	abstract public function update();
	abstract public function del();
}
?>