<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="utf-8">
	<title>Potato RPG</title>
	<link rel="icon" type="image/ico" href="../../../public/spud.ico"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	{{ HTML::style('css/potato.css') }}
	{{ HTML::script('http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js') }}
	{{ HTML::script('js/potato.js') }}
</head>
<body>
    <div class="container">
          @yield('content')
    </div>
</body>
</html>
