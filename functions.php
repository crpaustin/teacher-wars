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

function getUnlock($unl) {
	switch($unl) {
		case 0: return 'Paper'; break;
		case 1: return 'Pencil'; break;
		case 2: return 'Pen'; break;
		case 3: return 'Marker'; break;
		case 4: return 'Highlighter'; break;
		case 5: return 'Laptop'; break;
	}
}

?>