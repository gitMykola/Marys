<?php
class Goods extends Model{
	public $template;
	public $mainTemplate;
	public function __construct()
	{
		$this->template = ROOT.'/templates/goods.php';
		$this->mainTemplate = ROOT.'/templates/marys.php';
	}
	public function get()
	{
		
	}
	public function getMainGoods()
	{
		return array(
			array('id'=>5,'name'=>'Smelly Soap','price'=>12),
			array('id'=>137,'name'=>'Soap Banan Figure','price'=>134),
			array('id'=>1065,'name'=>'Smelly Soap Kit','price'=>12500)
		);
	}
	public function set()
	{
		
	}
	public function update()
	{
		
	}
	public function del()
	{
		
	}
}
?>