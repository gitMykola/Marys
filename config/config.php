<?php
return array(
	'lang' => array(
		'languages'=> array('en','ru','ua'),
		'default_lang'=>'en',
	),
	'db' => array(
		'host'=>'localhost',
		'user'=>'root',
		'dbname'=>'marys',
		'password'=>'',
		'charset'=>'utf8',
		),
	'app' => array(
		'site_url'=>'http://www.marys.com.ua',
		'session_auth_live'=>60*60*2,
        'pagination_limit'=>5,
		),		
);
?>