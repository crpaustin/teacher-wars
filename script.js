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
	var popupIsRunning = false;
	function popup(text) {
		if(!popupIsRunning) {
			popupIsRunning = true;
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
						popupIsRunning = false;
					}
				}, 10);
			}, 500);
		}
	}

	// **EVENT STUFF
	$('#event aside').click(function(){
		$('#event').css('display','none');
	});

	// **SOME DESCRIPTIVE VARIABLES
	var numOfMats = 6;

	// **STAT INITIALIZE
	var statName = $('#name p').html().split(': ')[1];
	var statLocationNum = $('#location p').attr('loc');
	var statLocationName = $('#location p').html().split(': ')[1];
	var statMoney = $('#money p').html().split(': $')[1];
	var statDay = $('#day p').html().split(': ')[1];
	var statDebt = $('#debt p').html().split(': $')[1];
	var statRespect = $('#respect p').html().split(': ')[1];
	// Array of all mat counts
	var statCounts = [];
	// For each mat available, set stats count
	$('article .text p:nth-child(2)').each(function(){
		statCounts[statCounts.length] = $(this).html().split(': ')[1];
	});
	// For each mat not available, set count to 0
	while(statCounts.length < numOfMats) {
		statCounts[statCounts.length] = 0;
	}
	// Get stocks of all mats
	var statStocks = [];
	var rawStocks = $('#mats').attr('stocks').split(',');
	for(i=0;i<6;i++) {
		statStocks[statStocks.length] = rawStocks[i];
	}
	// Get prices of all mats
	var statPrices = [];
	var rawPrices = $('#mats').attr('prices').split(',');
	for(i=0;i<6;i++) {
		statPrices[statPrices.length] = rawPrices[i];
	}
	// Get unlocks
	var statUnlocks = $('#upgs').attr('unlocks');

	// **STAT SET LOOPS
	function doUpdateCookies(callback) {
		$.ajax({
			url: 'update.php',
			type: 'post',
			data: {
				user: statName,
				location: statLocationNum,
				money: statMoney,
				day: statDay,
				debt: statDebt,
				respect: statRespect,
				counts: statCounts,
				stocks: statStocks,
				prices: statPrices,
				unlocks: statUnlocks
			},
			success: function(data,status) {
				//popup('Random Save!');
				//console.log(data);
				callback = callback || doUpdateGraphics;
				callback();
			}
		});
	}
	function doUpdateGraphics() {
		$('#name p').html('Name: '+statName);
		$('#location p').html('Location: '+statLocationName);
		$('#money p').html('Money: $'+statMoney);
		$('#day p').html('Day: '+statDay);
		$('#debt p').html('Debt: $'+statDebt);
		$('#respect p').html('Respect: '+statRespect);
		for(i=0;i<numOfMats;i++) {
			$('article .text p:nth-child(2)').eq(i).html('Count: '+statCounts[i]);
			$('article .text p:nth-child(3)').eq(i).html('Stock: '+statStocks[i]);
		}
	}
	var updateCookies = setInterval(doUpdateCookies,2000);
	var updateGraphics = setInterval(doUpdateGraphics,20);

	// **BUY STUFF
	// Initialize stats to prevent manual changing(cheating)
	$('.buy').each(function(){
		var num = $(this).attr('num');
		var price = $(this).attr('price');
		var apos = $(this).parent().parent().attr('apos');
		$(this).data('num',num);
		$(this).data('price',price);
		$(this).data('apos',apos);
	});
	$('.buy').click(function(){
		// Number to purchase
		var num = Number($(this).data('num'));
		// Price per item
		var price = Number($(this).data('price'));
		// Array position of current mat
		var apos = Number($(this).data('apos'));
		// If stock and money is high enough, edit values
		if(num<=statStocks[apos]) {
			if(price<=statMoney) {
				statStocks[apos] = Number(statStocks[apos]) - num;
				statCounts[apos] = Number(statCounts[apos]) + num;
				statMoney -= price;
			} else {
				popup('Not enough money');
			}
		} else {
			popup('Not enough stock');
		}
	});

	// **SELL STUFF
	// Initialize stats to prevent manual changing
	$('.sell').each(function(){
		var num = $(this).attr('num');
		var price = $(this).attr('price');
		var apos = $(this).parent().parent().attr('apos');
		$(this).data('num',num);
		$(this).data('price',price);
		$(this).data('apos',apos);
	});
	$('.sell').click(function(){
		// Number to sell
		var num = Number($(this).data('num'));
		// Price per item
		var price = Number($(this).data('price'));
		// Array position of current mat
		var apos = Number($(this).data('apos'));
		// If count is high enough, edit values
		if(num<=statCounts[apos]) {
			statStocks[apos] = Number(statStocks[apos]) + num;
			statCounts[apos] = Number(statCounts[apos]) - num;
			statMoney = Number(statMoney) + price;
		} else {
			popup('Not enough items')
		}
	});

	// **LOCATIONS
	$('#locs article').each(function(){
		var loc = $(this).attr('loc');
		$(this).data('loc',loc);
	});
	$('#locs article button').click(function(){
		var loc = $(this).parent().data('loc');
		$.ajax({
			url: 'newday.php',
			type: 'post',
			data: {
				user: statName,
				location: loc,
				money: statMoney,
				day: statDay,
				debt: statDebt,
				respect: statRespect,
				counts: statCounts,
				stocks: statStocks,
				prices: statPrices,
				unlocks: statUnlocks
			},
			success: function(data,status) {
				location.reload();
			}
		});
	});

	// **UPGRADES
	// Initialize stats to prevent manual changing
	$('.upgrade').each(function(){
		var price = $(this).attr('price');
		$(this).data('price',price);
	});
	$('.upgrade').click(function(){
		// Price of upgrade
		var price = Number($(this).data('price'));
		// If money is high enough, unlock
		if(price<=statMoney) {
			statMoney = Number(statMoney) - price;
			statUnlocks = Number(statUnlocks) + 1;
			console.log(statUnlocks);
			doUpdateCookies(function(){
				location.reload();
			});
		} else {
			popup('Not enough money');
		}
	});

	// **BANK
	$('#bank article button').each(function(){
		var num = $(this).attr('num');
		var type = $(this).parent().attr('type');
		$(this).data('num',num);
		$(this).data('type',type);
	});
	$('#bank article button').each(function(){
		
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

	// **ADMIN THINGY
	$('.scr').click(function(){
		statMoney = 50000;
		popup('Cheater!');
	});
});