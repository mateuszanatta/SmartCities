var BAR_CHART_WIDTH  = '550'; //Constant variables that define the width of the bars in bar chart
var BAR_CHART_HEIGHT = '300'; //Constant variables that define the height of the bars in bar chart
var allTags; //Global varable which holds all tags and theirs cities

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
/**
* This function will draw table for top ten tags
*/
function drawAllTagsTopTenRankingTable(){
  $.ajax({
    url: 'allTagsTopTen',
    dataType: 'json',
    success: function(tagsTopTen){//In case of success it will receive a array from the server

      //create a string with the coloumns name
      var cols = '{"cols": [{"label":"Hashtags", "type":"string"}, {"label":"Ocorrências", "type":"number"}],';

      //create a string to keep the rows
      var rows = '"rows":[';

      //Iterate tags array and concatenate the string with the name of each tag
      $.each(tagsTopTen, function(key, elem){
        rows +='{"c":[{"v":"'+key+'"}, {"v":"'+elem+'"}]},';
      });

      rows = rows.substr(0, (rows.length - 1));
      rows += ']}';

      var table = cols+rows;

      var options = {width: '100%'};

      var data = new google.visualization.DataTable(table);
      var visualization = new google.visualization.Table(document.getElementById('tagsRankTable'));
      visualization.draw(data, options);
    },
    method: 'GET'
  });
}
/**
* This function will draw the cities' ranking table
*/
function drawRankTable(){
  //Make ajax call to a showRank method
  $.ajax({
    url:'showRank',
    dataType: 'json',
    success: function(info){//In case of success it will receive a array from the server
      //create a string with the coloumns name
      var cols = '{"cols" :[{"label":"Cidade", "type":"string"},{"label":"Educação", "type":"number"},'+
                 '{"label":"Economia", "type":"number"},{"label":"Emprego", "type":"number"},'+
                 '{"label":"Meio Ambiente", "type":"number"},{"label":"Finanças Públicas", "type":"number"},'+
                 '{"label":"Saúde", "type":"number"},{"label":"Rank", "type":"number"}],';
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
        '{"v":'+info['health'][elem]+'},{"v":'+info['overall'][elem]+'}]},';
      });
      rows = rows.substr(0, (rows.length - 1));
      rows += ']}';

      var table = cols+rows;
      var data = new google.visualization.DataTable(table);

      var options = {width: '100%',
                     sortColumn: 7};

      var visualization = new google.visualization.Table(document.getElementById('rankTable'));

      google.visualization.events.addListener(visualization, 'ready', function(){
        $('#rankTable tr').css('cursor', 'pointer');
      });

      visualization.draw(data, options);

      //Add a listner to identify when a row is selected
      google.visualization.events.addListener(visualization, 'select', selectHandler);

      //Handle the select event and redirect the page to the profile page of the selected city
      function selectHandler(e){
        var city = data.getValue(visualization.getSelection()[0].row, 0);
        window.location = APP_URL + '/profiles/' + city
      }
    },
    method: 'GET'
  });
}

/**
* This function will draw a pie chart with the tags occurrences
*/
function drawOverviewPieChart(){
  $.ajax({
    url: 'sumAllTags',
    dataType: 'json',
    success: function(tags){//In case of success it will receive a array from the server
      //create a string with the coloumns name
      var cols = '{"cols": [{"label":"Hashtags", "type":"string"}, {"label":"Ocorr&ecirc;ncias", "type":"number"}],';

      //create a string to keep the rows
      var rows = '"rows":[';

      //Iterate tags array and concatenate the string with the name of each tag
      $.each(tags, function(key, elem){
        rows +='{"c":[{"v":"'+key+'"},{"v":'+elem+'}]},';
      });
      rows = rows.substr(0, (rows.length - 1));
      rows += ']}';

      var pieChart = cols+rows;
      var options = {
          legend: {position : 'none'},
          chartArea:{
            left:10,
            top:10,
            width:"100%",
            height:"100%"
          },
        };

      var data = new google.visualization.DataTable(pieChart);
      var chart = new google.visualization.PieChart(document.getElementById('tagsChart'));
      chart.draw(data, options);
    },
    method: 'GET'
  });
  console.log("Done overview chart");
}
/**
* This function will draw a pie chart with the registered user age range
*/
function drawAgeRangePieChart(){
  $.ajax({
    url: 'userAgeRange',
    dataType: 'json',
    success: function(ageRange){//In case of success it will receive a array from the server
      //create a string with the coloumns name
      var cols = '{"cols": [{"label":"Range", "type":"string"}, {"label":"Ocorr&ecirc;ncias", "type":"number"}],';

      //create a string to keep the rows
      var rows = '"rows":[';

      //Iterate ageRange array and concatenate the string with the age range
      $.each(ageRange, function(key, elem){
        rows +='{"c":[{"v":"'+key+'"},{"v":'+elem+'}]},';
      });
      rows = rows.substr(0, (rows.length - 1));
      rows += ']}';

      var pieChart = cols+rows;
      var options = {
          legend: {position : 'none'},
          chartArea:{
            left:10,
            top:10,
            width:"100%",
            height:"100%"
          },
        };

      var data = new google.visualization.DataTable(pieChart);
      var chart = new google.visualization.PieChart(document.getElementById('ageRangeChart'));
      chart.draw(data, options);
    },
    method: 'GET'
  });
}
/**
* This function will draw a pie chart showing from where people registered on the app are from
*/
function drawPeopleFromPieChart(){
  $.ajax({
    url: 'peopleFrom',
    dataType: 'json',
    success: function(peopleFrom){//In case of success it will receive a array from the server
      //create a string with the coloumns name
      var cols = '{"cols": [{"label":"City", "type":"string"}, {"label":"Ocorr&ecirc;ncias", "type":"number"}],';

      //create a string to keep the rows
      var rows = '"rows":[';

      //Iterate peopleFrom array and concatenate the string with the age range
      $.each(peopleFrom, function(key, elem){
        rows +='{"c":[{"v":"'+key+'"},{"v":'+elem+'}]},';
      });
      rows = rows.substr(0, (rows.length - 1));
      rows += ']}';

      var pieChart = cols+rows;
      var options = {
          legend: {position : 'none'},
          chartArea:{
            left:10,
            top:10,
            width:"100%",
            height:"100%"
          },
        };

      var data = new google.visualization.DataTable(pieChart);
      var chart = new google.visualization.PieChart(document.getElementById('peopleFromChart'));
      chart.draw(data, options);
    },
    method: 'GET'
  });
}
/**
* This function retrieve all cities and their tags
*/
function citiesTags(){
  $.ajax({
    url: 'allTags',
    dataType: 'json',
    success: function(citiesTags){//In case of success it will receive a array from the server
      setAllTags(citiesTags);
      drawTagPieChartByCity("Alpestre");
      drawTopTenTagTableByCity("Alpestre");
    },
    method: 'GET'
  });
}
function setAllTags(cityTags){
  allTags = cityTags;
}
/**
* It will draw a PieChart with the tags info of the selected city
*/
function drawTagPieChartByCity(cityName){
  //create a string with the coloumns name
  var cols = '{"cols": [{"label":"Hashtags", "type":"string"}, {"label":"Ocorr&ecirc;ncias", "type":"number"}],';

  //create a string to keep the rows
  var rows = '"rows":[';

  //Iterate tags array and concatenate the string with the name of each tag
  $.each(allTags[cityName], function(key, elem){
    rows +='{"c":[{"v":"'+key+'"},{"v":'+elem+'}]},';
  });
  rows = rows.substr(0, (rows.length - 1));
  rows += ']}';

  var pieChart = cols+rows;
  var options = {
      legend: {position : 'none'},
      chartArea:{
        left:10,
        top:10,
        width:"100%",
        height:"100%"
      },
    };

  var data = new google.visualization.DataTable(pieChart);
  var chart = new google.visualization.PieChart(document.getElementById('cityTagsChart'));
  chart.draw(data, options);
}
/**
* It will sort the vtag values of the selected city and display the top ten tags
*/
function drawTopTenTagTableByCity(cityName){
  var cityTag = allTags[cityName];
  //create a string with the coloumns name
  var cols = '{"cols": [{"label":"Hashtags", "type":"string"}],';
  //create a string to keep the rows
  var rows = '"rows":[';

  //Sort the tags by their value
  sortedTags = Object.keys(cityTag).sort(function(a, b){
    return cityTag[b] - cityTag[a];
  });
  //Iterate the top 10 tags and concatenate the string with the name of each tag
  $.each(sortedTags.slice(0, 9), function(key, elem){
    rows +='{"c":[{"v":"'+elem+'"}]},';
  });

  rows = rows.substr(0, (rows.length - 1));
  rows += ']}';

  var table = cols+rows;

  var options = {width: '100%'};

  var data = new google.visualization.DataTable(table);
  var visualization = new google.visualization.Table(document.getElementById('cityTagsTable'));
  visualization.draw(data, options);
}

function cityExist(cityName){
  return allTags[cityName];
}

/**
* Get the selected city and populate the chart and table with the city info
*/
$('#city').change(function(){
  var cityName = $("#city option:selected").val();

  if(cityExist(cityName) !== undefined){
    $('#noCity').attr('hidden', true);
    $('#rowChart').attr('hidden', false);
    $('#rowTable').attr('hidden', false);
    drawTopTenTagTableByCity(cityName);
    drawTagPieChartByCity(cityName);
  }else{
    $('#rowChart').attr('hidden', true);
    $('#rowTable').attr('hidden', true);
    $('#noCity').attr('hidden', false);
  }
});

function initFacebook(){
  $(document).ready(function(){
    $.ajax({url:'facebook/login', success: function(result){
      $('.fb-login-link').attr({href: result});
      //console.log('Link: ' + result);
    }
    });
  });
}
