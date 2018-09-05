<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){    
    loadstation();
});

function loadstation(){
    $("#data").load("http://localhost/UberChallenge/api/trips/read.php",function(responseTxt, statusTxt, xhr){
        if(statusTxt == "success"){
            $("div").html("<ol></ol>");
            console.log($.parseJSON(responseTxt));
            // parse the json response
            var js = $.parseJSON(responseTxt);
            $('<p></p>').html("List of drivers exceeding 25% of the trips this month ").appendTo('ol');
            // get total number of trips in current month
            var totalTripsMonth = js.totalTripsMonth[0].total;
            console.log(totalTripsMonth);
            // loop on total trpis per driver for current month
            //and represent only who exceed 25% of total trips in current month
            for (var i = 0; i < js.recordsPerMonth.length; i++) {
                console.log(js.recordsPerMonth[i]);
                if(totalTripsMonth*25/100 < js.recordsPerMonth[i].trip_num){
                    $('<li></li>').html("driver reference= "+js.recordsPerMonth[i].driver+" number of trips = "+js.recordsPerMonth[i].trip_num+" for month "+js.recordsPerMonth[i].trip_month).appendTo('ol');

                }
            }
            $('<p></p>').html("List of drivers exceeding 25% of the trips this year ").appendTo('ol');
            // get total number of trips in current year
            var totalTripsYear = js.totalTripsYear[0].total ;
            console.log(totalTripsYear);
            // loop on total trpis per driver for current year
            //and represent only who exceed 25% of total trips in current year
            for (var i = 0; i < js.recordsPerYear.length; i++) {
                console.log(js.recordsPerYear[i]);
                if(totalTripsYear*25/100 < js.recordsPerYear[i].trip_num){
                    $('<li></li>').html("driver reference= "+js.recordsPerYear[i].driver+" number of trips = "+js.recordsPerYear[i].trip_num+" for month "+js.recordsPerYear[i].trip_year).appendTo('ol');

                }
            }
            $('<p></p>').html("List of drivers exceeding 25% of the trips all time ").appendTo('ol');
            // get total number of trips in all time
            var totalTrips =js.totalTripsAllTime[0].total;
            console.log(totalTrips);
            // loop on total trpis per driver for all time
            //and represent only who exceed 25% of total trips in timeall 
            for (var i = 0; i < js.recordsAllTimes.length; i++) {
                console.log(js.recordsAllTimes[i]);
                if(totalTrips*25/100 < js.recordsAllTimes[i].trip_num){
                    $('<li></li>').html("driver reference= "+js.recordsAllTimes[i].driver+" number of trips = "+js.recordsAllTimes[i].trip_num).appendTo('ol');

                }
            }
         }
        if(statusTxt == "error")
            alert("Error: " + xhr.status + ": " + xhr.statusText);
    });
    //setTimeout(loadstation, 2000);
}
</script>
</head>
<body>
    <div id="data"></div>
</body>
</html>