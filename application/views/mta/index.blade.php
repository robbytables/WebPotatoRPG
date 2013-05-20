@layout('mta.base')

@section('content')
<h1>MTA Trips</h1>
<div class='currentTime' data-time="{{ $data['currentTime']*1000 }}"></div>
<span data-livestamp="{{ $data['currentTime'] }}"></span>
<div id="test">
</div>
<a id="copyright" href="https://twitter.com/chris_germano">Chris Germano 2013</a>
@endsection