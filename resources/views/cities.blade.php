<!DOCTYPE html>
<html>
  <head>
    <title>Cities</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!-- {!! HTML::style('/assets/css/bootstrap.min.css') !!} -->
    <!-- <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}"> -->
    <link rel="stylesheet" href="http://getbootstrap.com/examples/dashboard/dashboard.css">
  </head>
  <body>
    <class="container-fluid">
      <div class="row">
          <div class="col-sm-4 col-md-3 sidebar">
            <ul class="nav nav-sidebar tree">
                <li class="Test">
                  <label class="tree-toggle" for="Domicilios Particulares Permanentes" data-selected="Domicilios_Particulares_Permanentes">
                    Domic&#237;lios Particulares Permanentes
                  </label>
                  <ul class="tree">
                  <li>
                    <label class="tree-toggle" for="Por Abastecimento de Agua" data-selected="Por_Abastecimento_de_Agua" >
                      Por Abastecimento de &#193;gua
                    </label>
                    <ul class="tree">
                      <li class="checkbox">
                        <label for="Rede Geral">
                          <input class="selector" type="checkbox" value='Rede_Geral' />
                          Rede Geral
                        </label>
                      </li>
                    </ul>
                    <ul class="tree">
                      <li class="checkbox">
                        <label for="Rede Geral">
                          <input class="selector" type="checkbox" value='Outra_Forma' />
                          Outra Forma
                        </label>
                      </li>
                    </ul>
                  </li>
                  <li>
                    <label class="tree-toggle" for="Por Destino do Lixo" data-selected="Por_Destino_do_Lixo" >
                      Por Destino do Lixo
                    </label>
                    <ul class="tree">
                      <li class="checkbox">
                        <label for="Rede Geral">
                          <input class="selector" type="checkbox" value='Queimado' />
                          Queimado
                        </label>
                      </li>
                    </ul>
                    <ul class="tree">
                      <li class="checkbox">
                        <label for="Rede Geral">
                          <input class="selector" type="checkbox" value='Outro_Destino' />
                          Outro Destino
                        </label>
                      </li>
                    </ul>
                  </li>
                </ul>
              </li>
            </ul>
          </div>

      <div class="col-sm-4 col-md-3">
        <div id="chart">
        </div>
      </div>
    </div>
  </div>
  </body>
  <footer>
    <script type="javascript" src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Load Google Charts API -->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart', 'line']});

      $(document).ready(function(){

        $('.tree-toggle').click(function(){
          $(this).parent().children('ul.tree').toggle(200);
        });

        //Verify which checkbox is selected and request data from server to create the chart
        $('.selector').click(function(){
          if($(this).is(':checked')){
              var selected = $(this).parents().prevAll('.tree-toggle');
              for(var i=0; i < selected.length; i++){
                selected[i] = $(selected[i]).attr('data-selected');
              }

              selected = $(selected).toArray().reverse();
              selected.push($(this).attr('value'));

              $.ajax({
                url:'citiesCategories',
                success: function(result){
                  selected.unshift('Alpestre')
                  //console.log(result);
                  drawChart(result, selected);
                },
                data: {selected},
                method: 'GET'
              });
          }
        });

        // Set a callback to run when the Google Visualization API is loaded.
        //google.setOnLoadCallback(drawChart);

        // Callback that creates and populates a data table,
        // instantiates the pie chart, passes in the data and
        // draws it.
        function drawChart(info, selectedInfo) {
          // Create the data table.
          selectedInfo.splice(1,1);


          for(inf in selectedInfo){
              info = $.map(info, function(elem){
                return elem[selectedInfo[inf]];
            });
          }
          for(inf in info){
              $.map(info[inf], function(elem){
                return elem[selectedInfo[inf]];
            });
          }

          //Parse the json data from server to JSON format required by Google Charts
          //var cols will keep columns information, first column will be Year
          var cols = '{ "c" :[{"label":"Anos", "type":"string"},';
          //var rows will keep rows
          var rows = '';
          //Iterate throughout onject "info[0]"
          //and concatenate the columns labels into cols variable
          $.each(info[0], function(key, elem){
            cols = cols + '{"label":"' +  key + '", "type": "number"},';
            rows = rows + '{"c":['
            //Iterate throughout object "elem"
            //Here I should write the "key", what has the years, as a first column and next columns
            //must contain the variable "elem", which has the values.
           $.each(elem, function(key, elem){
                rows = rows + '{"v": "' + elem + '"},';
            });
            //remove last comma
            rows = rows.substr(0, (rows.length - 1));
            //close the row
            rows = rows + ']},';
          });
          //remove las comma
          rows = rows.substr(0, (rows.length - 1));
          cols = cols.substr(0, (cols.length - 1));
          console.log('Original: ' + JSON.stringify(info[0]));
          console.log('Columns: ' + cols);
          console.log('Rows: ' + rows);

          var cols = '{"cols" : ['+ cols +'],'+
                       '"rows" : ['+ rows +']}';

          console.log('Columns: ' + cols);

          var data = new google.visualization.DataTable(cols);
          var visualization = new google.visualization.LineChart(document.getElementById('chart'));
          visualization.draw(dataTableData, {width: 400, height: 240});

        }
      });
    </script>
  </footer>
</html>
