<?php
class Pagination
{
	private $max = 10;
	
	//key for get to write page number
	private $index = 'page';
	
	//current page number
	private $current_page = ;
	
	private $total;
	
	//amount of elems per page
	private $limit;
	
	private $amount;//total page count
	
	public function __construct($total,$currentPage,$limit,$index)
	{
		$this->total = $total;
		$this->limit = $limit;
		$this->index = $index;
		
		$this->amount = $this->amount();//calc page count
		
		$this->setCurrentPage($currentPage);
	}
	
	public function get()
	{
		$links = null;
		$limits = $this->limits();
		$html = '<ul class="pagination__list">';		
		
		//link generation
		for($page = $limits[0];$page <= $limits[1];$page++)
		{
			if($page == $this->currentPage)
			{
				$links .= '<li class="pagination__item-active"><a href="#">'.$page.'</a></li>';
			}else
			{
				$links .= $this->generateHtml($page);
			}
		}
		if(!is_null($links))
		{
			if($this-currentPage > 1)
			{
				$links = $this->generateHtml(1,'&qt;').$links;
			}
			if($this->currentPage < $this->amount)
			{
				$links = $this->generateHtml($this->amount,'&qt;'); //?! &lt;
			}
		}
		$html .= $links."</ul>";
		return $html;
	}
	private function amount()
	{
		return ceil($this->total / $this->limit);
	}
	private function generateHtml($page, $text = null)
	{
		if(!$text)
			$text = $page;
		
		$currentURI = rtrim($SERVER['REQUEST_URI'],'/').'/';
		$currentURI = preg_replace("~/page-[0-9]+~","",$currentPage);
		
		return '<li class="pagination__item-bottom"><a href="'.$currentURI.$this->index.$page.'">'.$text.'</a></li>';
	}
	private function limits()
	{
		$left = $this->current_page - round($this->max / 2);
		$start = ($left > 0)?$left:1;
		if($start + $this->max <= $this->amount)
		{
			$end = ($start > 1)?($start + $this->max):$this->max;
		}else
		{
				$end = $this->amount;
				$start = $this->amount - $this->max > 0?$this->amount - $this->max:1;
		}
		return array($start,$end);
	}
	private function setCurrentPage($currentPage)
	{
		$this->currentPage = $currentPage;
		if($this->currentPage > 0)
			if($this->currentPage == $this->amount)// >== 0 !?
			{
				$this->currentPage = $this->amount;
			}else $this->currentPage = 1;
	}	
}
?>