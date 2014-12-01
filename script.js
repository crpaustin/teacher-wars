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
	// **POPUP FUNCTION
	function popup(text) {
		text = text || 'POPUP';
		$('#popup p').html(text);
		$('#popup').css('opacity','1.0');
		$('#popup').css('display','block');
		setTimeout(function(){
			var opa = 1.00;
			var opaTimer = setInterval(function(){
				if(opa > 0) {
					opa -= 0.01;
					$('#popup').css('opacity',String(opa));
				} else {
					$('#popup').css('opacity','0.0');
					$('#popup').css('display','none');
					clearInterval(opaTimer);
				}
			}, 20);
		}, 1000);
	}
	// **STAT SET LOOP
	var update = setInterval(function(){
		var dName = $('article#name p').html().split(': ');
		var dLocation = $('article#location p').html().split(': ');
		var dMoney = $('article#money p').html().split(': $');
		var dDay = $('article#day p').html().split(': ');
		$.ajax({
			url: 'update.php',
			type: 'post',
			data: {
				user: dName[1],
				location: dLocation[1],
				money: dMoney[1],
				day: dDay[1]
			},
			success: function(data,status) {
				//popup('Random Save!');
				//console.log(data);
			}
		});
	}, 5000);
	// **BUY STUFF
	$('.buy').click(function(){
		
	});
	// **RESET GAME
	$('#sets .reset').click(function(){
		// send a request to reset.php
		// this file resets cookies to default
		$.ajax({
			url: 'reset.php',
			success: function(data,status) {
				// refresh page
				location.reload();
			}
		});
	});
});