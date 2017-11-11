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
					$res .= '<div class="admin-block-card card-8" name="'.$d["id"].'">
                                <div name="id"><p>'.$d["id"].'</p>
                                    </div>
                                <div>
                                    <div name="code"><p>'.$d["code"].','.'</p>
                                        <label>'.$lex['ref']['addr']['code'].'</label>
                                        </div>    
                                    <div name="country"><p>'.$d["country_".LANG].','.'</p>
                                        <label>'.$lex['ref']['addr']['country'].'</label>
                                        </div>
                                    <div name="city"><p>'.$d["city_".LANG].','.'</p>
                                        <label>'.$lex['ref']['addr']['city'].'</label>
                                        </div>
                                    <div name="region"><p>'.$d["region_".LANG].','.'</p>
                                        <label>'.$lex['ref']['addr']['region'].'</label>
                                        </div>
                                    <div name="street"><p>'.$d["street_".LANG].','.'</p>
                                        <label>'.$lex['ref']['addr']['street'].'</label>
                                        </div>
                                    <div name="appartment"><p>'.$d["appartment_".LANG].'.'.'</p>
                                        <label>'.$lex['ref']['addr']['appart'].'</label>
                                        </div>
                                </div>                            
                            </div>
				</div>';
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
		if($_SERVER["REQUEST_METHOD"] == "POST")
		{
            $data = file_get_contents('php://input');
            $data = json_decode($data,true);
			$this->data["id"] = isset($data["id"])?$data["id"]:"";
			if((int) $this->data["id"] > 0 && $this->model->setDel((int)$this->data['id']))
			App::loged('Address '.$this->data["id"].' deleted.');
			else App::loged('Error with address delete. '.$this->data["id"]);	
		}else die;
	}
}	
?>