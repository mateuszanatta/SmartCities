@section("overview")
  <h1 class="page-header">Informac&atilde;o Social</h1>
  <div class="row placeholder">
    <div class="col-xs-6 col-sm-4 placeholders">
      <div id="tagsChart">
        <img style="display:block; margin-left:auto; margin-right:auto" src="{{ URL::asset('assets/img/loading.gif') }}" />
      </div>
      <!-- <img class="img-responsive" alt="Visao geral das tags mais mencionadas" src="http://jollymystic.com/wp-content/uploads/pie-chart.png" /> -->
      <h4>Vis&atilde;o Geral - Hashtags</h4>
    </div>
    <div class="col-xs-6 col-sm-4 placeholders">
      <div id="ageRangeChart">
        <img style="display:block; margin-left:auto; margin-right:auto" src="{{ URL::asset('assets/img/loading.gif') }}" />
      </div>
      <h4>Idades</h4>
    </div>
    <div class="col-xs-6 col-sm-4 placeholders">
      <div id="peopleFromChart">
        <img style="display:block; margin-left:auto; margin-right:auto" src="{{ URL::asset('assets/img/loading.gif') }}" />
      </div>
      <h4>Cidades</h4>
    </div>
  </div>
  <div class="row placeholder">
    <h2 class="sub-header">Top 10 Hashtags</h2>
    <div id="tagsRankTable" class="table-responsive">
      <img style="height:64px; display:block; margin-left:auto; margin-right:auto" src="{{ URL::asset('assets/img/loading.gif') }}" />
    </div>
  </div>
  @section("jsScripts")
    <!-- Facebook JavaScript Login -->
    <script type="text/javascript">
      initFacebook();
      google.load("visualization", "1.1", {packages:["table", "corechart"]});
      google.setOnLoadCallback(function(){
        drawAllTagsTopTenRankingTable();
        drawOverviewPieChart();
        drawAgeRangePieChart();
        drawPeopleFromPieChart();
      });
    </script>
  @endsection
@endsection
