<?php
	$menu = require ROOT.'/config/menu.php';
	$out = '<div class="menu-top">';
	$out .= '<a class="menu-brand" href="/'.LANG.'">'.$lex['title'].'</a>';
	$out .= '<div class="menu-container">';
	$out .= '<div class="right-panel">';
	if($user->auth) $out .= '<a class="logout" href="/logout"><span class="glyphicon glyphicon-log-out"></span>'.$lex['auth']['logout'].'</a>';
	else {
			$out .= '<a class="login" href="javascript:void(0);"><span class="glyphicon glyphicon-log-in"></span>'.$lex['auth']['login'].'</a>';
			$out .= '<a class="register" href="javascript:void(0);"><span class="glyphicon glyphicon-user"></span>'.$lex['auth']['register'].'</a>';
		}
	$out .= '</div></div>';
	$out .= '<div class="menu-under"><div class="menu-container"><ul class="menu-list">';
	foreach($menu as $key=>$li)
		$out .= '<li><a href="/'.LANG.'/'.$li[0].'"><span>'.$lex['menu'][$key].'</span><span class="'.$li[1].'"></span></a></li>';
	if($user->admin) $out .= '<li><a href="/admin">Admin</a></li>';
	$out .= '</ul>';
	$out .= '<a class="cart" href="/chart" title="'.$lex['menu']['shopcart'].'"><span>'.$lex['menu']['shopcart'].'</span><span class="glyphicon glyphicon-shopping-cart"></span><b>0</b></a>';
	$out .= '</div></div></div>';
	$out .= '
	<div class="form-block" name="loginForm">
	<form method="POST" action="" class="auth col-sm-6 col-sm-offset-3">
		<div class="alarm-login"></div>
		  <div class="form-group">
			<label for="email">'.$lex['auth']['email'].':</label>
			<input type="email" class="form-control input-lg" id="email" name="email">
		  </div>
		  <div class="form-group">
			<label for="password">'.$lex['auth']['password'].':</label>
			<input type="password" class="form-control input-lg" id="password" name="password">
		  </div>
		  <button type="submit" class="btn btn-default marys-btn">'.$lex['auth']['login'].'</button>
		  <div class="form-btn" onclick="$(this.parentNode.parentNode).fadeOut();"><span class="glyphicon glyphicon-off" title="'.$lex['buttons']['close'].'"></span></div>
	</form></div>';
	$out .= '
	<div class="form-block " name="registerForm">
	<form method="POST" action="" class="auth col-sm-6 col-sm-offset-3">
		<div class="alarm-register"></div>
		  <div class="form-group">
			<label for="name">'.$lex['auth']['name'].':</label>
			<input type="text" class="form-control input-lg" id="name" name="name">
		  </div>
		  <div class="form-group">
			<label for="email">'.$lex['auth']['email'].':</label>
			<input type="email" class="form-control input-lg" id="email" name="email">
		  </div>
		  <div class="form-group">
			<label for="password">'.$lex['auth']['password'].':</label>
			<input type="password" class="form-control input-lg" id="password" name="password">
		  </div>
		  <div class="form-group">
			<label for="cpassword">'.$lex['auth']['cpassword'].':</label>
			<input type="password" class="form-control input-lg" id="cpassword" name="cpassword">
		  </div>
		  <button type="submit" class="btn btn-default marys-btn">'.$lex['auth']['register'].'</button>
		  <div class="form-btn" onclick="$(this.parentNode.parentNode).fadeOut();"><span class="glyphicon glyphicon-off" title="'.$lex['buttons']['close'].'"></span></div>
	</form></div>';
	echo $out;?>  