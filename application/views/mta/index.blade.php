@layout('mta.base')

@section('content')
    <h1>MTA Trips</h1>
    <h3>{{ date('h:i:sa', $data['currentTime']) }}</h3>
    <h2> {{ $data['currentTime'] }} </h2>
    <span data-livestamp="{{ $data['currentTime'] }}"></span>
    <div id="test"></div>
    <a id="copyright" href="https://twitter.com/chris_germano">Chris Germano 2013</a>
@endsection