<?php
return array(
	'registration/add'	=>'registration/add',
	'registration'		=>'registration/index',
	
	'authorization'		=>'authorization/authoriz',
	
	'logout'		=>'authorization/logout',
	
	//Sale & buy market
	'marketsale/add'		=>'marketsale/add',
	'marketsale/page-([0-9+])'		=>'marketsale/index/$1', //actionIndex in MarketSaleController
	'marketsale'		=>'marketsale/index',
	
	//Buy
	'marketbuy/add'		=>'marketbuy/add',
	'marketbuy/page-([0-9]+)'		=>'marketbuy/index/$1',
	'marketbuy'		=>'marketbuy/index',
	
	'page-([0-9]+)'		=>'marys/index/$1', //actionIndex in MarysController + page
	''		=>'marys/index', //actionIndex
	'address'	=>'address/index',
	'address/get'=>'address/get',
	'address/get/page-([0-9]+)'	=>'address/get/$1',
	'address/set'	=> 'address/set',
	'address/del' => 'address/del',
);
?>