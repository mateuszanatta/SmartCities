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
      <div id="chart" class="col-sm-12 col-md-12 col-lg-12">
        <img style="height:50%; display:block; margin-left:auto; margin-right:auto" src="{{ URL::asset('assets/img/loading.gif') }}" />
    </div>
  </div>
@endsection
@section("jsScripts")
<script type="text/javascript">
  google.load("visualization", "1.1", {packages:["table"]});
  google.setOnLoadCallback(drawTable);

  function drawTable(){
    //Make ajax call to a showRank method
    $.ajax({
      url:'showRank',
      dataType: 'json',
      success: function(info){//In case of success it will receive a array from the server
        //create a string with the coloumns name
        var cols = '{"cols" :[{"label":"Cidade", "type":"string"},{"label":"Educação", "type":"number"},'+
                   '{"label":"Economia", "type":"number"},{"label":"Emprego", "type":"number"},'+
                   '{"label":"Meio Ambiente", "type":"number"},{"label":"Finanças Públicas", "type":"number"},'+
                   '{"label":"Saúde", "type":"number"}],';
        //create a string to keep the rows
        var rows = '"rows":[';
        //Get the cities names
        var cities = Object.keys(info.education);
        //Iterate the cities array and concatenate the string with the values of each city
        //in the array cities
        $.each(cities, function(key, elem){
           rows +='{"c":[{"v":"'+elem+'"},{"v":'+info['education'][elem]+'},'+
          '{"v":'+info['economy'][elem]+'},{"v":'+info['employment'][elem]+'},'+
          '{"v":'+info['environment'][elem]+'},{"v":'+info['governmentExpen'][elem]+'},'+
          '{"v":'+info['health'][elem]+'}]},';
        });
        rows = rows.substr(0, (rows.length - 1));
        rows += ']}';

        var table = cols+rows;
        var data = new google.visualization.DataTable(table);

        var visualization = new google.visualization.Table(document.getElementById('chart'));
        visualization.draw(data, {width: '100%', height: '100%'});
      },
      method: 'GET'
    });
  }
</script>
@endsection
