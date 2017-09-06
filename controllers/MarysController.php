<?php
class MarysController
{
	private $model;
	private $view;
	public $user;
	
	public function __construct($user)
	{
		$this->model = new Goods();
		$this->view = new View();
		$this->user = $user;
	}
	public function actionIndex($page = null)
	{
		$data = $this->model->getMainGoods();
		//$this->view->generate($this->model->mainTemplate, $this->model->template, $data, $this->user);
        $this->view->generate($this->model->mainTemplate, $this->model->template, $data, $this->user);
	}
}	
?>