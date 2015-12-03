@extends("master")

@section("title", "Social")

@section("nav-bar")
  @parent
@endsection

@section("content")
<div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 col-md-2 sidebar">
              <ul class="nav nav-sidebar">
                <li>{!! HTML::linkAction('SocialController@index', 'Vis&atilde;o Geral') !!}</li>
                <li>{!! HTML::linkAction('SocialController@cidades', 'Cidades') !!}</li>
              </ul>
            </div>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
              {{Session::put("isFBLogged", false)}}
              @if(Session::get("isFBLogged"))
        				<img src="{!!Session::get("picture")!!}" />
        				<span class = "label label-success">Welcome {{Session::get("username")}} your log in was successful</span>
      			  @else
      				  <a class="fb-login-link"><img src="http://statzam.com/buttonFbLogin.png" alt="Login with Facebook" /></a>
      			  @endif
              @if ($section == 'cidades')
                @include("cityTags")
                @yield("cityTags")
              @else
                @include("socialOverview")
                @yield("overview")
          @endif
        </div>
      </div>
  </div>
</div>
  @endsection
