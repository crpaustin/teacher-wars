<?php
require('functions.php');
setcookie('user',$_POST['name'],time()+(3600*24*30),'/');
$stat = array(
	'money'=>400,
	'day'=>1,
	'location'=>0,
	'debt'=>10000,
	'respect'=>20,
	'counts'=>array(0,0,0,0,0,0),
	'stocks'=>genStocks(0,false,0,0),
	'prices'=>genPrices(false,0,0),
	'unlocks'=>1
	);
$stat_enc = json_encode($stat);
setcookie('stat',$stat_enc,time()+(3600*24*30),'/');
header('Location: index.php');
?>