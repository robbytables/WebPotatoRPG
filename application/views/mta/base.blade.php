<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="utf-8">
	<title>Potato MTA</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	{{ HTML::style('css/mta.css') }}
	{{ HTML::script('http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js') }}
	{{ HTML::script('js/mta.js') }}
</head>
<body>
    <div class="container">
          @yield('content')
    </div>
</body>
</html>