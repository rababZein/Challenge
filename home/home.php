<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){    
    loadstation();
});

function loadstation(){
    $("#station_data").load("http://localhost/UberChallenge/api/trips/read.php");
    setTimeout(loadstation, 2000);
}
</script>
</head>
<body>

<div id="station_data"></div>

</body>
</html>