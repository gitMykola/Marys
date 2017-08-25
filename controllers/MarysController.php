<?php
class MarysController
{
	private $model;
	private $view;
	
	public function __construct()
	{
		$this->model = new Goods();
		$this->view = new View();
	}
	public function actionIndex($page = null)
	{
		$data = $this->model->getMainGoods();
		$this->view->generate($this->model->mainTemplate, $this->model->template, $data);
	}
}	
?>