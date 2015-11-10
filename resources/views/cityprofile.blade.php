@extends("master")

@section("title", "Profile")

@section("cssSection")
  <style>
    .chartShadow{
      box-shadow: 3px 3px 6px #666;
      height: 305px;
      margin: 20px 0 25px;
      width: 567px;
    }
  </style>
@endsection

@section("nav-bar")
  @parent
@endsection

@section("content")
<div class="row">
  <div class="col-sm-10 col-md-10 col-lg-10">
    <h3>{{$cityName}} - Profile</h3>
  </div>
</div>
<div class="row">
  <div id="chartProfile" class="col-sm-9 col-md-8 col-lg-7">
    <img style="height:64px; display:block; margin-left:auto; margin-right:auto" src="{{ URL::asset('assets/img/loading.gif') }}" />
  </div>
</div>
<div class="row">
  <div id="chartEducation" class="col-sm-9 col-md-8 col-lg-7">
    <img style="height:64px; display:block; margin-left:auto; margin-right:auto" src="{{ URL::asset('assets/img/loading.gif') }}" />
  </div>
</div>
<div class="row">
  <div id="chartGovernment" class="col-sm-9 col-md-8 col-lg-7">
    <img style="height:64px; display:block; margin-left:auto; margin-right:auto" src="{{ URL::asset('assets/img/loading.gif') }}" />
  </div>
</div>
<div class="row">
  <div id="chartHealth" class="col-sm-9 col-md-8 col-lg-7">
    <img style="height:64px; display:block; margin-left:auto; margin-right:auto" src="{{ URL::asset('assets/img/loading.gif') }}" />
  </div>
</div>
<div class="row">
  <div id="chartEconomy" class="col-sm-9 col-md-8 col-lg-7">
    <img style="height:64px; display:block; margin-left:auto; margin-right:auto" src="{{ URL::asset('assets/img/loading.gif') }}" />
  </div>
</div>
<div class="row">
  <div id="chartEmployment" class="col-sm-9 col-md-8 col-lg-7">
    <img style="height:64px; display:block; margin-left:auto; margin-right:auto" src="{{ URL::asset('assets/img/loading.gif') }}" />
  </div>
</div>
<div class="row">
  <div id="chartEnvironment" class="col-sm-9 col-md-8 col-lg-7">
    <img style="height:64px; display:block; margin-left:auto; margin-right:auto" src="{{ URL::asset('assets/img/loading.gif') }}" />
  </div>
</div>
</div>
@endsection
@section("jsScripts")
<script type="text/javascript">

  google.load("visualization", "1.1", {packages:['corechart']});

  google.setOnLoadCallback(function(){
    drawProfileChart('profile', '{{$cityName}}', ['#3f51b5'], 'chartProfile', 'Campos chave');
    drawProfileChart('education', '{{$cityName}}', ['#f44336'], 'chartEducation', 'Educação');
    drawProfileChart('governmentExpenditures', '{{$cityName}}', ['#4caf50'], 'chartGovernment', 'Finanças Públicas');
    drawProfileChart('health', '{{$cityName}}', ['#ffeb3b'], 'chartHealth', 'Saúde');
    drawProfileChart('economy', '{{$cityName}}', ['#ff5722'], 'chartEconomy', 'Economia');
    drawProfileChart('employment', '{{$cityName}}', ['#673ab7'], 'chartEmployment', 'Emprego');
    drawProfileChart('environment', '{{$cityName}}', ['#8bc34a'], 'chartEnvironment', 'Meio Ambiente');
  });

</script>
@endsection
