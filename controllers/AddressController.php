<?php
class AddressController
{
	private $model;
	private $view;
	private $data;
	public $user;
	
	public function __construct($user)
	{
		$this->model = new Address();
		$this->view = new View();
		$this->data = array();
		$this->user = $user;
	}
	public function actionIndex()
	{
		if($this->user['auth'])
		{
			$this->view->generate($this->model->mainTemplate,
                $this->model->template,
                array(),
                $this->user);
		}else echo "Access denided.";
	}
	public function actionGet($page = null)
	{
		$err = "";
		if($_SERVER["REQUEST_METHOD"] == "GET")
		{
			$data = $this->model->get();
			if(!$data) return $err = "Error with address get data.";
			else {
				$lex = Lang::getLexicon();
				$res = "";
				foreach($data as $d)
					$res .= '<tr><td name="id">'.$d["id"].'</td>
						<td>'.$d["country_".LANG].'</td>
						<td>'.$d["city_".LANG].'</td>
						<td>'.$d["region_".LANG].'</td>
						<td>'.$d["street_".LANG].'</td>
						<td>'.$d["appartment_".LANG].'</td>
						<td><div class="btn btn-default marys-btn btn-edit" title="'.$lex['buttons']['edit'].'"><span class="glyphicon glyphicon-pencil"></span></div>
						<div class="btn btn-default marys-btn btn-delete" title="'.$lex['buttons']['delete'].'"><span class="glyphicon glyphicon-remove"></span></div></td>
				</tr>';
				echo $res;
			};
		}else die;
	}
	public function actionSet()
	{
		$err = "";
		if($_SERVER["REQUEST_METHOD"] == "POST")
		{
			//var_export($_POST);
			$this->data["country"] = isset($_POST["country"])?$_POST["country"]:"";
			$this->data["city"] = isset($_POST["city"])?$_POST["city"]:"";
			$this->data["region"] = isset($_POST["region"])?$_POST["region"]:"";
			$this->data["street"] = isset($_POST["street"])?$_POST["street"]:"";
			$this->data["appartment"] = isset($_POST["appartment"])?$_POST["appartment"]:"";
			
		}else $err .= " Invalid address!";
		if($err !== "") App::loged($err);
		else if(!$this->model->set($this->data)) App::loged('database error with address set function.');
	}
	public function actionDel()
	{
		$err="";
		if($_SERVER["REQUEST_METHOD"] == "POST")
		{
			//if(!$this->model->del)
				$this->data["id"] = isset($_POST["id"])?$_POST["id"]:"";
			//var_dump((int)$this->data["id"]);
			if((int) $this->data["id"] > 0 && $this->model->setDel((int)$this->data['id']))
				App::loged('Address '.$this->data["id"].' deleted.');
			else App::loged('Error with address delete. '.$this->data["id"]);	
		}else die;
	}
}	
?>