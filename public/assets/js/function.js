var BAR_CHART_WIDTH  = '550'; //Constant variables that define the width of the bars in bar chart
var BAR_CHART_HEIGHT = '300'; //Constant variables that define the height of the bars in bar chart

/**
* This function will draw charts for profile packages
* @param string subject it will receive the doamin name e.g education, health
* @param string city it will receive the city's name to create its profile
* @param array color it is a array with chart color
* @param string target it will receive the html element id where the chart will be drawn
* @param string title it will receive the chart title
*/
function drawProfileChart(subject, city, color, target, title){

  //Make ajax call to the index method in the CityProfileController
  $.ajax({
    url: ''+subject + '/' + city,
    dataType: 'json',
    success: function(info){//In case of success it will receive a array from the server
      //console.log(info);
      var cols = '{"cols" :[{"label":"", "type":"string"},{"label":"Value", "type":"number"}],';
      //create a string to keep the rows
      var rows = '"rows":[';
      //Iterate the cities array and concatenate the string with the values of each city
      //in the array cities
      $.each(info, function(key, elem){
         rows +='{"c":[{"v":"'+key+'"},{"v":'+info[key]+'}]},';
      });
      rows = rows.substr(0, (rows.length - 1));
      rows += ']}';

      var table = cols+rows;

      var data = new google.visualization.DataTable(table);
      //chart options
      var options = {
                      width : BAR_CHART_WIDTH,
                      height: BAR_CHART_HEIGHT,
                      title: title,
                      titleTextStyle:{ fontSize: 20, titlePosition: 'none' },
                      legend: { position:'none' },
                      bars: 'horizontal',
                      tooltip : { isHtml : true },
                      hAxis:{
                        viewWindow:{
                          max: 7.5,
                          min: -7.5
                        }
                      },
                      colors: color,
                      bar: { groupWidth: "90%" }
                    };

      var visualization = new google.visualization.BarChart(document.getElementById(target));
      visualization.draw(data, options);
    },
    method: 'GET'
  });
  $('#'+target).addClass('placeholder chartShadow');
}
