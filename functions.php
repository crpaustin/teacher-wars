<?php
/**
 * Turn a number into a string with commas if not greater than 9.9E+13
 * @param  Integer $num Number to be converted
 * @return String       Converted number
 */
function numCon($num) {
	// Is the number in scientific form? (due to PHP conversion)
	$sci = strpos($num,'E');

	// If it's not in scientific form, add commas
	if(!$sci) {
		// Number of digits minus one then divided by 3
		// Rounded down
		// Equals number of commas
		$commas = floor((strlen($num)-1)/3);

		// Set the converted number to the base
		$con = $num;

		// Add the necessary commas to their locations
		// (-($i*3)-($i-1))
		// First iteration example
		// 1 * 3 = 3 inverted = -3
		// -3 - (1-1) = -3 - 0 = -3
		// -3 spots for first comma
		for($i=1;$i<=$commas;$i++) {
			$con = substr_replace($con,',',(-($i*3)-($i-1)),0);
		}
	} else {
		// Otherwise, just return the number
		$con = $num;
	}
	return $con;
}

/**
 * Returns a material name from number
 * @param  Integer $unl Material number
 * @return String       Material name
 */
function getUnlock($unl) {
	switch($unl) {
		case 0: return 'Paper'; break;
		case 1: return 'Pencil'; break;
		case 2: return 'Pen'; break;
		case 3: return 'Stapler'; break;
		case 4: return 'Textbook'; break;
		case 5: return 'Laptop'; break;
	}
}

/**
 * Returns a location name from number
 * @param  Integer $loc Location number
 * @return String       Location name
 */
function getLocation($loc) {
	switch($loc) {
		case 0: return 'Parking Lot'; break;
		case 1: return 'Abandoned Classroom'; break;
		case 2: return 'Teacher Workroom'; break;
		case 3: return 'School Bookstore'; break;
		case 4: return 'School Library'; break;
		case 5: return 'Computer Lab'; break;
	}
}

// Event Types
// 0 - Surplus of Material
// 1 - Shortage of Material
// 2 - Caught Dirty Dealing

function doEventChance($unl) {
	$chance = ($unl * 10) - ($unl * 3);
	$num = rand(1,100);
	$event = array();
	if($num <= $chance) {
		$event[0] = true;
		$chance2 = 100 - ((100 - $chance) / 2);
		$num2 = rand(1,100);
		if($num2 <= $chance) {
			$event[1] = 2;
			$min = 1  + (5 *pow(($unl),3)) + ((600*($unl-1))*(($unl-1)/4));
			$max = 10 + (15*pow(($unl),3)) + ((350*($unl-1))*(($unl-1)/4));
			$price = rand($min,$max);
			$event[2] = $price;
		} elseif($num2 <= $chance2) {
			$event[1] = 1;
			$event[2] = getRandomMaterial($unl);
		} else {
			$event[1] = 0;
			$event[2] = getRandomMaterial($unl);
		}
	} else {
		$event[0] = false;
		$event[1] = 0;
		$event[2] = 0;
	}
	return $event;
}

function getRandomMaterial($unl) {
	$num = rand(1,($unl*10));
	$mat = (int)ceil($num / 10);
	$mat = $mat - 1;
	return $mat;
}

/**
 * Generate pseudo-random stocks
 * @param  Integer $loc   Location reference
 * @param  Boolean $event Is there an event?
 * @param  Integer $type  What kind of event?
 * @param  Integer $mat   What material is affected?
 * @return Array          Pseudo-random stocks
 */
function genStocks($loc,$event,$type,$mat) {
	$stocks = array();
	for($i=0;$i<6;$i++) {
		$min = 48/($i+1);
		$max = 288/pow($i+2,2);
		$rawStock = rand($min,$max);
		if($event&&$mat==$i) {
			switch($type) {
				case 0:  $rawStock = floor($rawStock * 0.5);
				case 1:  $rawStock = floor($rawStock * 2.0);
				default: $rawStock = floor($rawStock * 0.5);
			}
		}
		if($loc==$i){$rawStock = floor($rawStock * 1.4);}
		$stocks[] = $rawStock;
	}
	return $stocks;
}

/**
 * Generate pseudo-random prices
 * @param  Boolean $event Is there an event?
 * @param  Integer $type  What kind of event?
 * @param  Integer $mat   What material is affected?
 * @return Array          Pseudo-random prices
 */
function genPrices($event,$type,$mat) {
	$prices = array();
	for($i=0;$i<6;$i++) {
		$min = 1  + (5 *pow(($i+1),3)) + ((600*$i)*($i/4));
		$max = 10 + (15*pow(($i+1),3)) + ((350*$i)*($i/4));
		$rawPrice = rand($min,$max);
		if($event&&$mat==$i) {
			switch($type) {
				case 0:  $rawPrice = floor($rawPrice * 1.6);
				case 1:  $rawPrice = floor($rawPrice * 0.5);
				default: $rawPrice = floor($rawPrice * 1.6);
			}
		}
		$prices[] = $rawPrice;
	}
	return $prices;
}

// **MATH STUFF**
// Used for testing and balancing numbers
/*
echo '<table border="1" cellpadding="3">';
for($i=0;$i<6;$i++) {
	echo '<tr>';
	echo '<td>Trial '.($i+1).'</td>';
	$stocks = genStocks($i,false,0,0);
	for($j=0;$j<6;$j++) {echo '<td>'.$stocks[$j].'</td>';}
	echo '</tr>';
}
echo '<tr>';
echo '<td>Averages</td>';
for($i=0;$i<6;$i++) {
	echo '<td>';
	$total = 0;
	for($j=0;$j<100;$j++){$total+=genStocks(6,false,0,0)[$i];}
	$average = round($total / 100,0);
	echo $average;
	echo '</td>';
}
echo '</tr>';
echo '</table>';

echo '<br>';

echo '<table border="1" cellpadding="3">';
echo '<tr>';
echo '<td>Min</td>';
for($i=0;$i<6;$i++) {
	echo '<td>';
	$min = 1  + (5 *pow(($i+1),3)) + ((600*$i)*($i/4));
	echo $min;
	echo '</td>';
}
echo '<tr>';
echo '<td>Max</td>';
for($i=0;$i<6;$i++) {
	echo '<td>';
	$max = floor(10 + (15*pow(($i+1),3)) + ((350*$i)*($i/4)));
	echo $max;
	echo '</td>';
}
for($i=0;$i<6;$i++) {
	echo '<tr>';
	echo '<td>Trial '.($i+1).'</td>';
	$prices = genPrices(false,0,0);
	for($j=0;$j<6;$j++) {echo '<td>'.$prices[$j].'</td>';}
	echo '</tr>';
}
echo '<tr>';
echo '<td>Averages</td>';
for($i=0;$i<6;$i++) {
	echo '<td>';
	$total = 0;
	for($j=0;$j<100;$j++){$total+=genPrices(false,0,0)[$i];}
	$average = round($total / 100,0);
	echo $average;
	echo '</td>';
}
echo '</tr>';
echo '<tr>';
echo '<td>Shortage of Pens</td>';
for($i=0;$i<6;$i++) {
	echo '<td>';
	$total = 0;
	for($j=0;$j<100;$j++){$total+=genPrices(true,0,2)[$i];}
	$average = round($total / 100,0);
	echo $average;
	echo '</td>';
}
echo '</tr>';
echo '<tr>';
echo '<td>Surplus of Pens</td>';
for($i=0;$i<6;$i++) {
	echo '<td>';
	$total = 0;
	for($j=0;$j<100;$j++){$total+=genPrices(true,1,2)[$i];}
	$average = round($total / 100,0);
	echo $average;
	echo '</td>';
}
echo '</tr>';
echo '</table>';
*/
?>