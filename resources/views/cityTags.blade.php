@section("cityTags")
<h1 class="page-header">Informac&atilde;o Social - Cidades</h1>
<div class="row placeholder">
  <select id="city">
    <option value="Alpestre">Alpestre</option>
    <option value="Ametista do Sul">Ametista do Sul</option>
    <option value="Caiçara">Cai&ccedil;ara</option>
    <option value="Constantina">Constantina</option>
    <option value="Cristal do Sul">Cristal do Sul</option>
    <option value="Dois Irmãos das Missões">Dois Irm&atilde;os das Miss&otilde;es</option>
    <option value="Engenho Velho">Engenho Velho</option>
    <option value="Erval Seco">Erval Seco</option>
    <option value="Frederico Westphalen">Frederico Westphalen</option>
    <option value="Gramado dos Loureiros">Gramado dos Loureiros</option>
    <option value="Iraí">Ira&iacute;</option>
    <option value="Liberato Salzano">Liberato Salzano</option>
    <option value="Nonoai">Nonoai</option>
    <option value="Novo Tiradentes">Novo Tiradentes</option>
    <option value="Novo Xingu">Novo Xingu</option>
    <option value="Palmitinho">Palmitinho</option>
    <option value="Pinheirinho do Vale">Pinheirinho do Vale</option>
    <option value="Planalto">Planalto</option>
    <option value="Rio dos Índios">Rio dos &Iacute;ndios</option>
    <option value="Rodeio Bonito">Rodeio Bonito</option>
    <option value="Rondinha">Rondinha</option>
    <option value="Seberi">Seberi</option>
    <option value="Taquaruçu do Sul">Taquaru&ccedil;u do Sul</option>
    <option value="Três Palmeiras">Tr&ecirc;s Palmeiras</option>
    <option value="Trindade do Sul">Trindade do Sul</option>
    <option value="Vicente Dutra">Vicente Dutra</option>
    <option value="Vista Alegre">Vista Alegre</option>
  </select>
</div>
<div id="rowChart" class="row placeholder">
  <div class="col-xs-10 col-sm-12 placeholders">
    <div id="cityTagsChart">
      <img style="display:block; margin-left:auto; margin-right:auto" src="{{ URL::asset('assets/img/loading.gif') }}" />
    </div>
    <h4>Hashtags</h4>
  </div>
</div>
<div id="rowTable" class="row placeholder">
  <h2 class="sub-header">Top 10 Hashtags</h2>
  <div id="cityTagsTable" class="table-responsive">
    <img style="height:64px; display:block; margin-left:auto; margin-right:auto" src="{{ URL::asset('assets/img/loading.gif') }}" />
  </div>
</div>
<div id="noCity" class="row" hidden="true">
  <div class="jumbotron">
  <h1>Oops.</h1>
  <p>Ainda n&atilde;o possu&iacute;mos informa&ccedil;&otilde;es para essa cidade</p>
  <p>Seja o primeiro a compartilhar suas Hashtags conosco </p>
  <a class="fb-login-link"><img src="http://statzam.com/buttonFbLogin.png" alt="Login with Facebook" /></a>
</div>
</div>
@section("jsScripts")
  <!-- Facebook JavaScript Login -->
  <script type="text/javascript">
    initFacebook();
    google.load("visualization", "1.1", {packages:["table", "corechart"]});
    google.setOnLoadCallback(function(){
      citiesTags();
    });
  </script>
@endsection
@endsection
