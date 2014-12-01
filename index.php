<?php
if(isset($_COOKIE['user'])) {
	setcookie('user',$_COOKIE['user'],time()+(3600*24*30),'/');
	echo '<aside user="-'.$_COOKIE['user'].'"></aside>';
	setcookie('stat',$_COOKIE['stat'],time()+(3600*24*30),'/');
	$stat = stripslashes($_COOKIE['stat']);
	$stat = json_decode($stat, true);
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
			<article>
				<p>Paper</p>
				<p>Count: 2</p>
				<button class="buy" type="button"><p>Buy 1</p><p>Price: 1</p></button>
				<button class="sell" type="button"><p>Sell 1</p><p>Price: 1</p></button>
			</article>
			<article>
				<p>Pencils</p>
				<p>Count: 1</p>
				<button class="buy" type="button"><p>Buy 1</p><p>Price: 5</p></button>
				<button class="sell" type="button"><p>Sell 1</p><p>Price: 2</p></button>
			</article>
			<article>
				<p>Pens</p>
				<p>Count: 0</p>
				<button class="buy" type="button"><p>Buy 1</p><p>Price: 50</p></button>
				<button class="sell" type="button"><p>Sell 1</p><p>Price: 20</p></button>
			</article>
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
				<p>Debt: $203</p>
			</article>
			<article>
				<p>Borrow Money</p>
				<button class="button">$1</button>
				<button class="button">$10</button>
				<button class="button">$100</button>
				<button class="button">$1000</button>
			</article>
			<article>
				<p>Pay Debt</p>
				<button class="button">$1</button>
				<button class="button">$10</button>
				<button class="button">$100</button>
				<button class="button">$1000</button>
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