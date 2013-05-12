@layout('potato.base')

@section('content')
    <h1>latvia dream of potato</h1>
    {{ $data['name'] }}
    <h2>There are currently:  users</h2>
    <button id="startButton" type="button" onclick="begin()" style="display:block;">start</button>
    <button type="button" onclick="getEvent()" style="display:none;">get event</button>
    <div id="game">
      <div id="name"></div>
      <div id="hp"></div>
      <div id="eventText"></div>
      <button id="choiceOne" onclick="getEvent()" style="display:none;"></button>
      <button id="choiceTwo" onclick="getEvent()" style="display:none;"></button>
      <button id="choiceThree" onclick="getEvent()" style="display:none;"></button>
    </div>
    <div id="copyright">Chris Germano 2013</div>
@endsection