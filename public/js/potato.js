$(document).ready(function() {

	var name;
	var hp = 6;
	var age = 0;

	var oneChoices;
	var twoChoices;
	var threeChoices;
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

		$.ajax({
			type: "POST",
			url: "potato/dbloadchoices",
			data: {_name: name}
		}).done(function(data) {
			console.log(data);
		}).fail(function(status) {
			console.log(JSON.stringify(status));
		});

		$oneChoices = $ones;
		$twoChoices = $twos;
		$threeChoices = $threes;

		document.getElementById("name").innerHTML = "name: " + name;
		document.getElementById("hp").innerHTML = "hp: " + hp;
		document.getElementById("age").innerHTML = "age: " + age;
		document.getElementById("startButton").style.display = "none";
		document.getElementById("eventText").style.display = "block";
		document.getElementById("hp").style.display = "block";
		document.getElementById("age").style.display = "block";
		getEvent();
	});

	$("#choiceOne, #choiceTwo, #choiceThree").click(function() {
		getEvent();
	});

	$("#chartToggle").click(function() {
		if ($("#ageChart").width() == 130) {
			$("#ageChart").width(230);
		} else {
			$("#ageChart").width(130);
		}
	});

	function getEvent() {

		age++;
		document.getElementById("age").innerHTML = "age: " + age;

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
				$.ajax({
					type: "GET",
					url: "potato/dbGetEvent",
					data: {_name: name}
				}).done(function(data) {
					console.log(data);
				}).fail(function(status) {
					console.log(JSON.stringify(status));
				});

				var eventText = event[1].replace("+name+",name);

				document.getElementById("eventText").innerHTML = eventText;
				setChoices(event[2]);
			}
		}
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
});
