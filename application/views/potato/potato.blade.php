@layout('potato.base')

@section('content')
    <h1>latvia dream of potato</h1>
    <button id="startButton" type="button" onclick="begin()" style="display:block;">start</button>
    <button type="button" onclick="getEvent()" style="display:none;">get event</button>
    <div id="game">
	  <div id="header">
        <div id="name"></div>
	    <div id="age"></div>
        <div id="hp"></div>
	  </div>
      <div id="eventText"></div>
      <button id="choiceOne" onclick="getEvent()" style="display:none;"></button>
      <button id="choiceTwo" onclick="getEvent()" style="display:none;"></button>
      <button id="choiceThree" onclick="getEvent()" style="display:none;"></button>
    </div>
    <h2>{{ $data['totalUsers'] }} Latvians have try dream</h2>
    <a id="copyright" href="https://twitter.com/chris_germano">Chris Germano 2013</a>
@endsection