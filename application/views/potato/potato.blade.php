@layout('potato.base')

@section('content')
    <h1>latvia dream of potato</h1>
    <button id="startButton" type="button" style="display:block;">start</button>
    <div id="game">
	  <div id="header">
        <div id="name"></div>
	    <div id="age"></div>
        <div id="hp"></div>
	  </div>
      <div id="eventText"></div>
      <button id="choiceOne" style="display:none;"></button>
      <button id="choiceTwo"style="display:none;"></button>
      <button id="choiceThree" style="display:none;"></button>
    </div>
	<div id="ageChart">
		<div id="chartToggle">O</div>
		<p id="topTen">
			#1 {{ $data['topAges'][0] }} </br>
			#2 {{ $data['topAges'][1] }} </br>
			#3 {{ $data['topAges'][2] }} </br>
			#4 {{ $data['topAges'][3] }} </br>
			#5 {{ $data['topAges'][4] }} </br>
			#6 {{ $data['topAges'][5] }} </br>
			#7 {{ $data['topAges'][6] }} </br>
			#8 {{ $data['topAges'][7] }} </br>
			#9 {{ $data['topAges'][8] }} </br>
			#10 {{ $data['topAges'][9] }}
		</p>
	</div>
    <h2>{{ $data['totalUsers'] }} Latvians have try dream</h2>
    <a id="copyright" href="https://twitter.com/chris_germano">Chris Germano 2013</a>
@endsection
