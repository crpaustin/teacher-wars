<?php
if(isset($_COOKIE['user'])) {
	setcookie('user',$_COOKIE['user'],time()+(3600*24*30),'/');
	echo '<aside user="-'.$_COOKIE['user'].'"></aside>';
	setcookie('stat',$_COOKIE['stat'],time()+(3600*24*30),'/');
	$stat = stripslashes($_COOKIE['stat']);
	$stat = json_decode($stat, true);
	$counts = $stat['counts'];
} else {
	echo '<aside user="new"></aside>';
}
?>
<html>
<head>
	<title>Teacher Wars</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="script.js"></script>
</head>
<body lang="en">
	<h1>Teacher Wars</h1>
	<?php
	require('functions.php');
	if(isset($_COOKIE['user'])) {
		// TODO: LOAD STUFF
	} else {
		// TODO: START A NEW GAME
	}
	?>
	<div id="popup">
		<p>Game Saved!</p>
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
				><p>Location: <?php echo $stat['location'] ?></p
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
		<div class="main" id="mats">
			<?php
			// TEMP VAR - Number of unlocks
			$unlocks = 3;
			// TEMP VAR - Prices
			$prices_b = array(4,8,16,32,64,128);
			$prices_s = array(1,2,4,8,16,32);
			for($i=0;$i<$unlocks;$i++) {
				echo '<article>';
				echo '<nav class="text">';
				echo '<p>'.getUnlock($i).'</p>';
				echo '<p>Count: '.$counts[$i].'</p>';
				echo '</nav>';
				echo '<nav class="prices">';
				for($j=0;$j<3;$j++){echo '<button class="buy" num="'.pow(10,$j).'" price="'.($prices_b[$i]*pow(10,$j)).'" type="button"><p>Buy '.pow(10,$j).'</p><p>Price: '.numCon($prices_b[$i]*pow(10,$j)).'</p></button>';}
				for($j=0;$j<3;$j++){echo '<button class="sell" num="'.pow(10,$j).'" price="'.($prices_s[$i]*pow(10,$j)).'" type="button"><p>Sell '.pow(10,$j).'</p><p>Price: '.numCon($prices_s[$i]*pow(10,$j)).'</p></button>';}
				echo '</nav>';
				echo '</article>';
			}
			?>
		</div>
		<div class="main" id="locs">
			<article>
				<p>Parking Lot</p>
				<button type="button">Travel Here</button>
			</article>
			<article>
				<p>Abandoned Classroom</p>
				<button type="button">Travel Here</button>
			</article>
			<article>
				<p>Teacher Workroom</p>
				<button type="button">Travel Here</button>
			</article>
			<article>
				<p>School Bookstore</p>
				<button type="button">Travel Here</button>
			</article>
		</div>
		<div class="main" id="upgs">
			<article>

			</article>
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
				<p>Pay Debt</p>
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