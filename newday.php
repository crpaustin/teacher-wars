<?php
require('functions.php');
setcookie('user',$_POST['user'],time()+(3600*24*30),'/');
$day = $_POST['day'] + 1;
$debt = $_POST['debt'] + (0.1*$_POST['debt']);
$event = doEventChance($_POST['unlocks']);
$stat = array(
	'money'=>$_POST['money'],
	'day'=>$day,
	'location'=>$_POST['location'],
	'debt'=>$debt,
	'respect'=>$_POST['respect'],
	'counts'=>$_POST['counts'],
	'stocks'=>genStocks($_POST['location'],$event[0],$event[1],$event[2]),
	'prices'=>genPrices($event[0],$event[1],$event[2]),
	'unlocks'=>$_POST['unlocks']
	);
$stat_enc = json_encode($stat);
setcookie('stat',$stat_enc,time()+(3600*24*30),'/');
header('Location: index.php');
?>