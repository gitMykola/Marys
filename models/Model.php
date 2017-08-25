<?php
abstract class Model{
	public $template;
	public $mainTemplate;
	abstract public function __construct();
	abstract public function get($page = null,$limit = null,$sort = null);
	abstract public function set($data);
	abstract public function update($data);
	abstract public function del($id);
}
?>