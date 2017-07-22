<?php
return[
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
	
	'page-([0-9]+)'		=>'site/index/$1', //actionIndex in SiteController + page
	''		=>'site/index', //actionIndex
];
?>