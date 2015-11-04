@extends("master")

@section("title", "Profile")

@section("nav-bar")
  @parent
@endsection

@section("content")
<div class="row">
  <div class="col-sm-10 col-md-10 col-lg-10">
    <h3>{{$cityName}}</h3>
  </div>
    <div id="chart" class="col-sm-12 col-md-12 col-lg-12">
      <img style="height:50%; display:block; margin-left:auto; margin-right:auto" src="{{ URL::asset('assets/img/loading.gif') }}" />
  </div>
</div>
@endsection
@section("jsScripts")
@endsection
