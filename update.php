<?php
echo $_POST['user'].' --- ';
echo $_POST['location'].' --- ';
echo $_POST['money'].' --- ';
echo $_POST['day'].' --- ';
setcookie('user',$_POST['user'],time()+(3600*24*30),'/');
$stat = array(
	'money'=>$_POST['money'],
	'day'=>$_POST['day'],
	'location'=>$_POST['location']
	);
$stat_enc = json_encode($stat);
setcookie('stat',$stat_enc,time()+(3600*24*30),'/');
?>