@extends("master")

@section("title", "Rank")

@section("nav-bar")
  @parent
@endsection

@section("content")
  <div class="row">
    <div class="col-sm-10 col-md-10 col-lg-10">
      <h3>Ranking</h3>
    </div>
      <div id="rankTable" class="col-sm-12 col-md-12 col-lg-12">
        <img style="height:50%; display:block; margin-left:auto; margin-right:auto" src="{{ URL::asset('assets/img/loading.gif') }}" />
    </div>
  </div>
@endsection
@section("jsScripts")
<script type="text/javascript">
  google.load("visualization", "1.1", {packages:["table"]});
  google.setOnLoadCallback(function(){
    drawRankTable();
  });

</script>
@endsection
