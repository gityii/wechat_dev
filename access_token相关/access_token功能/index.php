<?php

    define('APP_ID', 'wxc71e1e8c468e226d');
	define('APP_SECRET', '33e506f139b63c2d14569a3ed120cf9c');
	require_once './WxAccessToken.class.php';
	$wx = new WxAccessToken(APP_ID, APP_SECRET);
	echo "<pre>";
	print_r("access_token:<br>".$wx->getAccessToken());