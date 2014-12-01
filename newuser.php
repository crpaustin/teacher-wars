<?php
setcookie('user',$_POST['name'],time()+(3600*24*30),'/');
$stat = array(
	'money'=>400,
	'day'=>1,
	'location'=>'Parking Lot'
	);
$stat_enc = json_encode($stat);
setcookie('stat',$stat_enc,time()+(3600*24*30),'/');
header('Location: index.php');
?>