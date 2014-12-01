$(document).ready(function(){
	// **CHECK USER (NEW OR RETURNING)
	if($('aside').attr('user')=='new') {
		// new user
		$('#newuser').css('display','block');
	} else {
		// returning user
		$('#game').css('display','block');
	}
	// **FUNCTION WHEN TAB IS CLICKED
	$('#tabs article').click(function(){
		// set all tabs to not selected
		$('#tabs article').each(function(){
			$(this).attr('class','');
		});
		// set new tab to selected
		$(this).attr('class','sel');
		// set all content to no display
		$('.main').each(function(){
			$(this).css('display','none');
		});
		// set new content to display
		switch($('#tabs .sel').html()) {
			case 'Materials': $('#mats').css('display','block'); break;
			case 'Locations': $('#locs').css('display','block'); break;
			case 'Upgrades': $('#upgs').css('display','block'); break;
			case 'Bank': $('#bank').css('display','block'); break;
			case 'Settings': $('#sets').css('display','block'); break;
			default: $('#mats').css('display','block'); break;
		}
	});
	// **RESET GAME
	$('#sets .reset').click(function(){
		// send a request to reset.php
		// this file resets cookies to default
		$.ajax({
			url: 'reset.php',
			success: function(data,status) {
				location.reload();
			}
		});
	});
});