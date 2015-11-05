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
</div>
  @endsection
  @section("jsScripts")
    <!-- Facebook JavaScript Login -->
    <script type="text/javascript">
      $(document).ready(function(){
        $.ajax({url:'facebook/login', success: function(result){
          $('#fb-login-link').attr({href: result});
          //console.log('Link: ' + result);
        }});
      });
    </script>
  @endsection
