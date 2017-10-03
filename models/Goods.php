<?php
class Goods extends Model{
	public $template;
	public $mainTemplate;
	public function __construct()
	{
		$this->template = ROOT.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.'goods.php';
		$this->mainTemplate = ROOT.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.'marys.php';
	}
	public function get($page = null,$limit = null,$sort = null)
	{
		
	}
	public function getMainGoods($category = null)
	{
		return array(
			array('id'=>5,'name'=>'Smelly Soap','price'=>12),
			array('id'=>137,'name'=>'Soap Banan Figure','price'=>134),
			array('id'=>1065,'name'=>'Smelly Soap Kit','price'=>12500)
		);
	}
	public function set($data)
	{
		if(!$this->validate($data))
			$data = new Object($err = 'Invalid data', $item = null);
			return $data;	
		
	}
	public function update($data)
	{
		
	}
	public function del($id)
	{
		
	}
	private function validate($data)
	{
		return true;
	}
}
?>