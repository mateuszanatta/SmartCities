<!DOCTYPE html>
<html>
  <head>
    <title>Facebook tags</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!-- {!! HTML::style('/assets/css/bootstrap.min.css') !!} -->
    <!-- <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}"> -->
    <link rel="stylesheet" href="http://getbootstrap.com/examples/dashboard/dashboard.css">
  </head>
  <body>
      <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Smart Cities</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
              <li><a href="#">Dashboard</a></li>
              <li><a href="#">Settings</a></li>
              <li><a href="#">Profile</a></li>
              <li><a href="#">Help</a></li>
            </ul>
            <form class="navbar-form navbar-right">
              <input type="text" class="form-control" placeholder="Search...">
            </form>
          </div>
        </div>
      </nav>
      <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 col-md-2 sidebar">
              <ul class="nav nav-sidebar">
                <li>{!! HTML::linkAction('SocialController@index', 'Visao Geral') !!}</li>
                <li>{!! HTML::linkAction('SocialController@cidades', 'Cidades') !!}</li>
              </ul>
            </div>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
              <!--Facebook tags -->
              <!-- <span id="fb-login" style="color:#337AB7">Entre com o Facebook para compartilhar seus comentarios
                <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
                </fb:login-button>
              </span> -->
              @if(Session::get("isFBLogged"))
        				<img src="{!!Session::get("picture")!!}" />
        				<span class = "label label-success">Welcome {{Session::get("username")}} your log in was successful</span>
      			  @else
      				  <a id="fb-login-link"><img src="http://statzam.com/buttonFbLogin.png" alt="Login with Facebook" /></a>
      			  @endif
              <!-- {!! HTML::linkRoute('facebook.login', 'Login with Facebook') !!} -->
              <!-- <div id="myDiv"></div> -->
              <!--<div id="status">
              </div>-->
              <!-- End Facebook Tags -->
              @if ($section == 'cidades')
                <h1 class="page-header">Informacao Social - Cidades</h1>
                <div class="row placeholder">
                  <div class="col-xs-6 col-sm-2 placeholders">
                    <img class="img-responsive" alt="Visao geral das tags mais mencionadas" src="http://jollymystic.com/wp-content/uploads/pie-chart.png" />
                    <h2 class="sub-header">City 1 Top 10</h2>
                    <div class="table-responsive table-bordered">
                      <table class="table table-striped">
                        <tbody>
                          <tr><td>Buracos</td></tr>
                          <tr><td>Lixo</td></tr>
                          <tr><td>Examplo</td></tr>
                          <tr><td>Buracos</td></tr>
                          <tr><td>Lixo</td></tr>
                          <tr><td>Examplo</td></tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                <div class="col-xs-6 col-sm-2 placeholders">
                  <img class="img-responsive" alt="Idade dos assinantes" src="http://jollymystic.com/wp-content/uploads/pie-chart.png"/>
                  <h2 class="sub-header">City 2 Top 10</h2>
                  <div class="table-responsive table-bordered">
                    <table class="table table-striped">
                      <tbody>
                        <tr><td>Buracos</td></tr>
                        <tr><td>Lixo</td></tr>
                        <tr><td>Examplo</td></tr>
                        <tr><td>Buracos</td></tr>
                        <tr><td>Lixo</td></tr>
                        <tr><td>Examplo</td></tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-xs-6 col-sm-2 placeholders">
                  <img class="img-responsive" alt="Cidades Participantes" src="http://jollymystic.com/wp-content/uploads/pie-chart.png"/>
                  <h2 class="sub-header">City 3 Top 10</h2>
                  <div class="table-responsive table-bordered">
                    <table class="table table-striped">
                      <tbody>
                        <tr><td>Buracos</td></tr>
                        <tr><td>Lixo</td></tr>
                        <tr><td>Examplo</td></tr>
                        <tr><td>Buracos</td></tr>
                        <tr><td>Lixo</td></tr>
                        <tr><td>Examplo</td></tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-xs-6 col-sm-2 placeholders">
                  <img class="img-responsive" alt="Cidades Participantes" src="http://jollymystic.com/wp-content/uploads/pie-chart.png"/>
                  <h2 class="sub-header">City 4 Top 10</h2>
                  <div class="table-responsive table-bordered">
                    <table class="table table-striped">
                      <tbody>
                        <tr><td>Buracos</td></tr>
                        <tr><td>Lixo</td></tr>
                        <tr><td>Examplo</td></tr>
                        <tr><td>Buracos</td></tr>
                        <tr><td>Lixo</td></tr>
                        <tr><td>Examplo</td></tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-xs-6 col-sm-2 placeholders">
                  <img class="img-responsive" alt="Cidades Participantes" src="http://jollymystic.com/wp-content/uploads/pie-chart.png"/>
                  <h2 class="sub-header">City 5 Top 10</h2>
                  <div class="table-responsive table-bordered">
                    <table class="table table-striped">
                      <tbody>
                        <tr><td>Buracos</td></tr>
                        <tr><td>Lixo</td></tr>
                        <tr><td>Examplo</td></tr>
                        <tr><td>Buracos</td></tr>
                        <tr><td>Lixo</td></tr>
                        <tr><td>Examplo</td></tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-xs-6 col-sm-2 placeholders">
                  <img class="img-responsive" alt="Cidades Participantes" src="http://jollymystic.com/wp-content/uploads/pie-chart.png"/>
                  <h2 class="sub-header">City 6 Top 10</h2>
                  <div class="table-responsive table-bordered">
                    <table class="table table-striped">
                      <tbody>
                        <tr><td>Buracos</td></tr>
                        <tr><td>Lixo</td></tr>
                        <tr><td>Examplo</td></tr>
                        <tr><td>Buracos</td></tr>
                        <tr><td>Lixo</td></tr>
                        <tr><td>Examplo</td></tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              @else
                <h1 class="page-header">Informacao Social</h1>
                <div class="row placeholder">
                  <div class="col-xs-6 col-sm-4 placeholders">
                    <img class="img-responsive" alt="Visao geral das tags mais mencionadas" src="http://jollymystic.com/wp-content/uploads/pie-chart.png" />
                    <h4>Visao Geral - Tags</h4>
                    <span class="text-muted">Visao geral</span>
                  </div>
                  <div class="col-xs-6 col-sm-4 placeholders">
                    <img class="img-responsive" alt="Idade dos assinantes" src="http://jollymystic.com/wp-content/uploads/pie-chart.png"/>
                    <h4>Idades</h4>
                    <span class="text-muted">Idades</span>
                  </div>
                  <div class="col-xs-6 col-sm-4 placeholders">
                    <img class="img-responsive" alt="Cidades Participantes" src="http://jollymystic.com/wp-content/uploads/pie-chart.png"/>
                    <h4>Idades</h4>
                    <span class="text-muted">Cidades</span>
                  </div>
                </div>
                <h2 class="sub-header">Top 100</h2>
                <div class="table-responsive">
                <table class="table table-striped">
                <thead><tr><th>Hashtag</th></tr></thead>
                <tbody>
                  <tr><td>Buracos</td></tr>
                  <tr><td>Lixo</td></tr>
                  <tr><td>Examplo</td></tr>
                  <tr><td>Buracos</td></tr>
                  <tr><td>Lixo</td></tr>
                  <tr><td>Examplo</td></tr>
                </tbody>
              </table>
            </div>
          @endif
        </div>
      </div>
  </div>
  </body>
  <footer>
    <script type="javascript" src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Facebook JavaScript Login -->
    <script type="text/javascript">
      $(document).ready(function(){
        $.ajax({url:'facebook/login', success: function(result){
          $('#fb-login-link').attr({href: result});
          console.log('Link: ' + result);
        }});
      });


      // This is called with the results from from FB.getLoginStatus().
      // function statusChangeCallback(response) {
      //   console.log('statusChangeCallback');
      //   console.log(response);
      //   // The response object is returned with a status field that lets the
      //   // app know the current login status of the person.
      //   // Full docs on the response object can be found in the documentation
      //   // for FB.getLoginStatus().
      //   if (response.status === 'connected') {
      //     // Logged into your app and Facebook.
      //     document.getElementById('fb-login').hidden = true;
      //     testAPI();
      //   } else if (response.status === 'not_authorized') {
      //     // The person is logged into Facebook, but not your app.
      //     document.getElementById('status').innerHTML = 'Please log ' +
      //       'into this app.';
      //   } else {
      //     // The person is not logged into Facebook, so we're not sure if
      //     // they are logged into this app or not.
      //     document.getElementById('status').innerHTML = 'Please log ' +
      //       'into Facebook.';
      //   }
      // }
      //
      // // This function is called when someone finishes with the Login
      // // Button.  See the onlogin handler attached to it in the sample
      // // code below.
      // function checkLoginState() {
      //   FB.getLoginStatus(function(response) {
      //     statusChangeCallback(response);
      //   });
      // }
      //
      // window.fbAsyncInit = function() {
      // FB.init({
      //   appId      : '684315061700036',
      //   cookie     : true,  // enable cookies to allow the server to access
      //                       // the session
      //   xfbml      : true,  // parse social plugins on this page
      //   version    : 'v2.2' // use version 2.2
      // });
      //
      // // Now that we've initialized the JavaScript SDK, we call
      // // FB.getLoginStatus().  This function gets the state of the
      // // person visiting this page and can return one of three states to
      // // the callback you provide.  They can be:
      // //
      // // 1. Logged into your app ('connected')
      // // 2. Logged into Facebook, but not your app ('not_authorized')
      // // 3. Not logged into Facebook and can't tell if they are logged into
      // //    your app or not.
      // //
      // // These three cases are handled in the callback function.
      //
      // FB.getLoginStatus(function(response) {
      //   statusChangeCallback(response);
      //   var tempAccessToken = response.authResponse.accessToken;
      //   longLifeToken(tempAccessToken);
      //
      // });
      //
      // function longLifeToken(tempToken){
      //   var xmlhttp;
      //   if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
      //     xmlhttp=new XMLHttpRequest();
      //   }
      //   else{// code for IE6, IE5
      //     xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      //   }
      //   xmlhttp.onreadystatechange=function(){
      //     if (xmlhttp.readyState==4 && xmlhttp.status==200){
      //       document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
      //       console.log('Response: ' + xmlhttp.responseText);
      //     }
      //   }
      //   xmlhttp.open("POST","facebook",true);
      //   xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
      //
      //   //Requisicoes POST em Laravel necessitam possuir um token de acesso.
      //   //token que pode ser adquirido usando o comando blade: {{ csrf_token() }}
      //   xmlhttp.send("accessToken="+ tempToken + "&_token=" + "{{ csrf_token() }}");
      // }
      //
      // };

      // Load the SDK asynchronously
      // (function(d, s, id) {
      //   var js, fjs = d.getElementsByTagName(s)[0];
      //   if (d.getElementById(id)) return;
      //   js = d.createElement(s); js.id = id;
      //   js.src = "//connect.facebook.net/en_US/sdk.js";
      //   fjs.parentNode.insertBefore(js, fjs);
      // }(document, 'script', 'facebook-jssdk'));

      // Here we run a very simple test of the Graph API after login is
      // successful.  See statusChangeCallback() for when this call is made.
      // function testAPI() {
      //   console.log('Welcome!  Fetching your information.... ');
      //   FB.api('/me', function(response) {
      //     console.log('Successful login for: ' + response.name);
      //     document.getElementById('status').innerHTML =
      //       'Thanks for logging in, ' + response.name +'!';
      //   });
      // }
    </script>
  </footer>
</html>
