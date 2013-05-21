$(document).ready(function() {

	var name;
	var hp = 6;
	var age = 0;

	var eventArray;
	var eventTypes;
	var oneChoices;
	var twoChoices;
	var threeChoices;
	var usedEvents;
	var potatoGet = "is not hallucen? is.. is mighty potato! glory day for Latvia!";


	$("#startButton").click(function() {
		name = prompt("what is name");
		if (name == null || name == undefined || name == "" || name == "null") {
		  name = "latvian";
		}
		hp = 6;
		age = 0;
		setEvents(name);
		$.ajax({
			type: "POST",
			url: "potato/dbwrite",
			data: {_name: name}
		}).done(function(data) {
			sessionStorage.userId = data.id;
			console.log(data);
		}).fail(function(status) {
			console.log(JSON.stringify(status));
		});
		usedEvents = [];
		document.getElementById("name").innerHTML = "name: " + name;
		document.getElementById("hp").innerHTML = "hp: " + hp;
		document.getElementById("age").innerHTML = "age: " + age;
		document.getElementById("startButton").style.display = "none";
		document.getElementById("eventText").style.display = "block";
		document.getElementById("hp").style.display = "block";
		document.getElementById("age").style.display = "block";
		console.log("getting choices");
		getChoices();
	});

	function setEvents(name) {
		eventArray = ["is cold. see potato. actually hallucinate.",
			"no bread. eat snow. so cold.",
			"politburo shoot dog. joke on him, was son. suffer is over.",
			"politburo take house. joke on him, house is snow.",
			"sister think " + name + " die in snow. go look. sister die in snow.",
			"baby is frostbite. must act with quick. baby was delicious.",
			"hunger is return. poor " + name + ".",
			"politburo by home. make laugh inside. politburo was inside. sad day.",
			"you find potato. was decoy by politburo. very sad.",
			"door knock. is politburo. sad ending for " + name + ".",
			"politburo take wife. is okay, more bread for " + name + ".",
			"dog walk to " + name + ". last dog mistake. dog actually wife. no sad.",
			"is more cold than hunger? premise ridiculous! all is cold hunger.",
			"chicken road cross. no humor because malnourish. chicken was dinner."];
		eventTypes = [1, 1, 2, 3, 2, 2, 1, 3, 3, 3, 3, 2, 1, 1];
		potatoChoices = ["is overwhelm by glorious potato!"];
		oneChoices = ["dream of potato. end suffer with sleep.",
			"dig for food. find rock. was delicious.",
			"hunger is suffer. no end, just cold.",
			"when " + name + " is sleep I eat. oh. I " + name + ".",
			"family excrement in bowl begin to look taste good."];
		twoChoices = ["no time to mourn, back to hallucinate.",
			"tell family of loss. they ask \"but what about potato?\"",
			"before bury save leg. eat like king for day.",
			"is okay. no expect not hunger."];
		threeChoices = ["politburo dog. most useful as stew.",
			"you find potato. was decoy by politburo. very sad.",
			"succumb to politburo. forget hunger for moment.",
			"ask forgive. politburo ask \"for what\". you ask for give food.",
			"politburo make day as sad as hunger"];
	}

	function getChoices() {
		console.log("got choices");
		age++;
		if (parseInt(Math.random() * 10) < 8) {
			hp--;
			document.getElementById("hp").innerHTML = "hp: " + hp;
		}
		if (hp <= 0) {
			document.getElementById("name").style.marginLeft = "auto";
			document.getElementById("name").style.marginRight = "auto";
			document.getElementById("name").innerHTML = name + "'s suffer is over";
			document.getElementById("choiceOne").style.display = "none";
			document.getElementById("choiceTwo").style.display = "none";
			document.getElementById("choiceThree").style.display = "none";
			document.getElementById("eventText").style.display = "none";
			document.getElementById("startButton").style.display = "block";
			document.getElementById("hp").style.display = "none";
			document.getElementById("age").style.display = "none";
			$.ajax({
				type: "POST",
				url: "potato/dbwriteAge",
				data: {_id: sessionStorage.userId, _age: age}
			}).done(function(data) {
				console.log(data);
			}).fail(function(status) {
				console.log(JSON.stringify(status));
			});
		} else {
			var potatoChance = parseInt(Math.random() * 100);
			if (potatoChance == 42) {
				hp += 10;
				document.getElementById("eventText").innerHTML = potatoGet;
				setChoices(0);
			} else {
				var index = uniqueIndex(parseInt(Math.random() * (eventArray.length - 1)));
				var newEvent = eventArray[index];
				var eventType = eventTypes[index];
				document.getElementById("eventText").innerHTML = newEvent;
				setChoices(eventType);
			}
		}
	}

	$("#choiceOne", "#choiceTwo", "#choiceThree").click(function() {
		getChoices();
	});

	function uniqueIndex(ind) {
		for (var i = 0; i < usedEvents.length; i++) {
			if (usedEvents[i] == ind)
				return uniqueIndex(parseInt(Math.random() * (eventArray.length - 1)));
		}
		usedEvents.push(ind);
		return ind;
	}

	function setChoices(ind) {
		if (ind == 1) {
			pickUnique(oneChoices, 3);
		} else if (ind == 2) {
			pickUnique(twoChoices, 3);
		} else if (ind == 3) {
			pickUnique(threeChoices, 3);
		} else if (ind == 0) {
			pickUnique(potatoChoices, 1);
		}
	}

	function pickUnique(choices, num) {
		var one = -1;
		var two = -1;
		var three = -1;

		if (num > 2) {
			while (one == two || two == three || one == three) {
				one = parseInt(Math.random() * choices.length, 10);
				two = parseInt(Math.random() * choices.length, 10);
				three = parseInt(Math.random() * choices.length, 10);
			}
			document.getElementById("choiceOne").style.display = "block";
			document.getElementById("choiceTwo").style.display = "block";
			document.getElementById("choiceThree").style.display = "block";
			document.getElementById("choiceOne").innerHTML = choices[one];
			document.getElementById("choiceTwo").innerHTML = choices[two];
			document.getElementById("choiceThree").innerHTML = choices[three];
		} else if (num > 1) {
			while (one == two) {
				one = parseInt(Math.random() * choices.length, 10);
				two = parseInt(Math.random() * choices.length, 10);
			}
			document.getElementById("choiceOne").style.display = "block";
			document.getElementById("choiceTwo").style.display = "block";
			document.getElementById("choiceThree").style.display = "none";
			document.getElementById("choiceOne").innerHTML = choices[one];
			document.getElementById("choiceTwo").innerHTML = choices[two];
		} else {
			one = parseInt(Math.random() * choices.length, 10);
			document.getElementById("choiceOne").style.display = "block";
			document.getElementById("choiceTwo").style.display = "none";
			document.getElementById("choiceThree").style.display = "none";
			document.getElementById("choiceOne").innerHTML = choices[one];
		}
	}

	$("#chartToggle").click(function() {
		if ($("#ageChart").width() == 130) {
			$("#ageChart").width(230);
		} else {
			$("#ageChart").width(130);
		}
	});
});
