<?php
require('functions.php');
setcookie('user',$_POST['user'],time()+(3600*24*30),'/');
$stat = array(
	'money'=>$_POST['money'],
	'day'=>$_POST['day'],
	'location'=>$_POST['location'],
	'debt'=>$_POST['debt'],
	'respect'=>$_POST['respect'],
	'counts'=>$_POST['counts'],
	'stocks'=>$_POST['stocks'],
	'prices'=>$_POST['prices'],
	'unlocks'=>$_POST['unlocks']
	);
$stat_enc = json_encode($stat);
setcookie('stat',$stat_enc,time()+(3600*24*30),'/');
?>