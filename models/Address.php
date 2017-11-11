<?php
class Address extends Model{
	public $template;
	public $mainTemplate;
	public function __construct()
	{
		$this->template = ROOT.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.'address.php';
		$this->mainTemplate = ROOT.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.'marysChild.php';
	}
	public function get($page = null,$limit = null,$sort = null)
	{
		try{
		$db = Db::getConnection();
		$sql = "select `id`,`code`,`country_".LANG."`,`city_".LANG."`,`region_"
            .LANG."`, `street_".LANG."`, `appartment_".LANG."` from `address` where `deleted` = false";
		$result = $db->prepare($sql);
		$result->setFetchMode(PDO::FETCH_ASSOC);
		if(!$result->execute()) return false;
		return $result->fetchAll();
		}
		catch(PDOException $Exception){App::loged($Exception);}
		return null;
	}
	public function set($data)
	{
		try{
        if(!$this->validate($data))return false;
		$db = Db::getConnection();
		$sql = "insert into `address` "
            ."(`country_".LANG."`,`city_".LANG."`,`region_".LANG."`,`street_"
            .LANG."`,`appartment_".LANG."`)"
		." values(:country, :city, :region, :street, :appartment)";
		$result = $db->prepare($sql);
		$result->bindParam(':country',$data['country'],PDO::PARAM_STR);
		$result->bindParam(':city',$data['city'],PDO::PARAM_STR);
		$result->bindParam(':region',$data['region'],PDO::PARAM_STR);
		$result->bindParam(':appartment',$data['appartment'],PDO::PARAM_STR);
		$result->bindParam(':street',$data['street'],PDO::PARAM_STR);
		$result->setFetchMode(PDO::FETCH_ASSOC);
		if(!$result->execute()) return false;
		return $result->fetch();
		}
		catch(PDOException $Exception){App::loged($Exception);}
		return null;
	}
	public function update($data)
	{
		
	}
    public function setDel($id)
    {
        try{
            $db = Db::getConnection();
            $sql = "update `address` set `deleted` = true where id=:id";
            $result = $db->prepare($sql);
            $result->bindParam(':id',$id,PDO::PARAM_INT);
            if(!$result->execute()) return false;
            return true;
        }
        catch(PDOException $Exception){App::loged($Exception);}
        return false;
    }
	public function del($id)
	{
		try{
		$db = Db::getConnection();
		$sql = "delete from `address` where id=:id";
		$result = $db->prepare($sql);
		$result->bindParam(':id',$id,PDO::PARAM_INT);
		if(!$result->execute()) return false;
		return true;
		}
		catch(PDOException $Exception){App::loged($Exception);}
		return false;
	}
	private function validate($data)
	{
		return true;
	}
}
?>