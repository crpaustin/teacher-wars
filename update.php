<?php
setcookie('user',$_POST['user'],time()+(3600*24*30),'/');
$stat = array(
	'money'=>$_POST['money'],
	'day'=>$_POST['day'],
	'location'=>$_POST['location'],
	'debt'=>$_POST['debt'],
	'respect'=>$_POST['respect'],
	'counts'=>$_POST['counts']
	);
$stat_enc = json_encode($stat);
setcookie('stat',$stat_enc,time()+(3600*24*30),'/');
?>