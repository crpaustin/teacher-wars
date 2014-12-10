<?php
require('functions.php');
if(isset($_COOKIE['user'])) {
	// Set user name cookie
	setcookie('user',$_COOKIE['user'],time()+(3600*24*30),'/');
	// Add aside to tell user's name (for js)
	echo '<aside user="-'.$_COOKIE['user'].'"></aside>';
	// Set stat cookie
	setcookie('stat',$_COOKIE['stat'],time()+(3600*24*30),'/');
	// Get stat cookie and remove slashes
	$stat = stripslashes($_COOKIE['stat']);
	// Decode stat cookie
	$stat = json_decode($stat, true);
	// Set counts array
	$counts = $stat['counts'];
	// Set stocks array
	$stocks = $stat['stocks'];
	// Turn stocks array into a string to be used by js
	$stocks_str = '';
	for($i=0;$i<6;$i++){$stocks_str.=$stocks[$i].',';}
	// Set prices array
	$prices = $stat['prices'];
	// Turn prices array into a string to be used by js
	$prices_str = '';
	for($i=0;$i<6;$i++){$prices_str.=$prices[$i].',';}
} else {
	// Set to new user
	echo '<aside user="new"></aside>';
}
?>
<html>
<head>
	<title>Teacher Wars</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" src="jquery.min.js"></script>
	<script type="text/javascript" src="script.js"></script>
</head>
<body lang="en">
	<h1>Teacher Wars</h1>
	<div id="popup">
		<p>Game Saved!</p>
	</div>
	<div id="event">
		<article>
			<h2>Event Name</h2>
			<p>Event description. This will tell about whatever is happening. For now there is just this text. Sorry. Actually I'm not. It's my game, and I can do what I want.</p>
			<aside>X</aside>
			<button type="button">Action 1 - Something Long</button>
			<button type="button">Action 2 - Something Longer</button>
			<button type="button">Action 3 - Something Longest</button>
		</article>
	</div>
	<div id="newuser">
		<form action="newuser.php" method="post">
			<input type="text" maxlength="25" placeholder="Your Name" name="name">
			<button type="submit">Start</button>
		</form>
	</div>
	<div id="game">
		<div id="stat">
			<article id="name" class="big"
				><p>Name: <?php echo $_COOKIE['user'] ?></p></article
			><article id="location" class="big"
				><p loc="<?php echo $stat['location'] ?>">Location: <?php echo getLocation($stat['location']) ?></p
			></article
			><article id="money" class="sml first"
				><p>Money: $<?php echo $stat['money'] ?></p
			></article
			><article id="day" class="sml"
				><p>Day: <?php echo $stat['day'] ?></p
			></article
			><br><article id="debt" class="newl sml first"
				><p>Debt: $<?php echo $stat['debt'] ?></p
			></article
			><article id="respect" class="newl sml"
				><p>Respect: <?php echo $stat['respect'] ?></p
			></article>
		</div>
		<nav id="tabs">
			<article class="sel">Materials</article>
			<article>Locations</article>
			<article>Upgrades</article>
			<article>Bank</article>
			<article>Settings</article>
		</nav>
		<div class="main" id="mats" stocks="<?php echo $stocks_str ?>" prices="<?php echo $prices_str ?>">
			<?php
			for($i=0;$i<$stat['unlocks'];$i++) {
				echo '<article apos="'.$i.'">';
				echo '<nav class="text">';
				echo '<p>'.getUnlock($i).'</p>';
				echo '<p>Count: '.$counts[$i].'</p>';
				echo '<p>Stock: '.$stocks[$i].'</p>';
				echo '</nav>';
				echo '<nav class="prices">';
				for($j=0;$j<3;$j++){echo '<button class="buy" num="'.pow(10,$j).'" price="'.($prices[$i]*pow(10,$j)).'" type="button"><p>Buy '.pow(10,$j).'</p></button>';}
				for($j=0;$j<3;$j++){echo '<p class="pr">Price: '.numCon($prices[$i]*pow(10,$j)).'</p>';}
				for($j=0;$j<3;$j++){echo '<button class="sell" num="'.pow(10,$j).'" price="'.($prices[$i]*pow(10,$j)).'" type="button"><p>Sell '.pow(10,$j).'</p></button>';}
				echo '</nav>';
				echo '</article>';
			}
			?>
		</div>
		<div class="main" id="locs">
			<?php
			for($i=0;$i<$stat['unlocks'];$i++) {
				echo '<article loc="'.$i.'">';
				echo '<p>'.getLocation($i).'</p>';
				if($stat['location']==$i){echo '<button type="button">Stay Here</button>';}
				else{echo '<button type="button">Travel Here</button>';}
				echo '</article>';
			}
			?>
		</div>
		<div class="main" id="upgs" unlocks="<?php echo $stat['unlocks'] ?>">
			<?php
			for($i=0;$i<5;$i++) {
				$j = $i + 1;
				$pr = floor(750+($j*3000)*($j/4));
				echo '<article>';
				echo '<p>Stage '.($i+2).'</p>';
				echo '<p>Price: $'.$pr.'</p>';
				if($j<$stat['unlocks']) {echo '<p class="unl">Unlocked</p>';}
				elseif($j==$stat['unlocks']) {echo '<button type="button" class="upgrade" price="'.$pr.'">Unlock</button>';}
				else{echo '<p class="unl">Locked</p>';}
				echo '</article>';
			}
			?>
		</div>
		<div class="main" id="bank">
			<article>
				<p>Borrow Money</p>
				<button class="button">$1</button>
				<button class="button">$10</button>
				<button class="button">$100</button>
				<button class="button">$1,000</button>
			</article>
			<article>
				<p>Pay <a class="scr">D</a>ebt</p>
				<button class="button">$1</button>
				<button class="button">$10</button>
				<button class="button">$100</button>
				<button class="button">$1,000</button>
			</article>
		</div>
		<div class="main" id="sets">
			<article>
				<button class="reset">Reset Game</button>
				<p>This cannot be undone.</p>
			</article>
		</div>
	</div>
</body>
</html>