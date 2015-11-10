<!DOCTYPE html>
<html>
  <head>
    <title>@yield("title")</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Latest compiled and minified CSS -->
    <!-- <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> -->
    <!-- {!! HTML::style('/assets/css/bootstrap.min.css') !!} -->
    <!-- <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}"> -->
    <!-- <link rel="stylesheet" href="http://getbootstrap.com/examples/dashboard/dashboard.css"> -->
    <link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/dashboard.css') }}">
    @yield("cssSection")
  </head>
  <body>
    @section("nav-bar")
      <div class="row">
        <nav class="navbar navbar-inverse navbar-fixed-top">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">SmartCities</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav navbar-right">
                <li>{!! HTML::linkAction('RankController@index', 'Ranking') !!}</li>
                <li><a href="#">Benchmarking</a></li>
                <li>{!! HTML::linkAction('SocialController@index', 'Social') !!}</li>
                <li><a href="#">About</a></li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    @show
    <div class="container">
      @yield("content")
    </div>
  </body>
  <footer>
    <!-- jQuery library -->
    <script src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
    <!-- Load Google Charts API -->
    <script type="text/javascript" src="{{ URL::asset('assets/js/googleJsapi') }}"></script>
    <!-- <script type="text/javascript" src="https://www.google.com/jsapi"></script> -->
    <!-- Latest compiled and minified JavaScript -->
    <script src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript">
        //Variable will hold the base app url.
        //This varible has to be declared here otherwise the blade syntax will not be recognized.
        var APP_URL = {!! json_encode(url('/')) !!};
    </script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script> -->
    <script src="{{ URL::asset('assets/js/function.js') }}"></script>
    @yield("jsScripts")
  </footer>
</html>
