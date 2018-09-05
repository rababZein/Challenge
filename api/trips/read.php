<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/trips.php';
 
// instantiate database and trips object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$trips = new Trips($db);

// trips array
$trips_arr=array();

// get total number of trips  in all time
//////////////////////////////////////////
// query trips
$stmtTotalAllTime = $trips->getTotalTripsAllTime();
$numTotalAllTime = $stmtTotalAllTime->rowCount();
// check if more than 0 record found
if( $numTotalAllTime > 0){
    $trips_arr["totalTripsAllTime"]=array();
 
    // retrieve table contents
    while ($row = $stmtTotalAllTime->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $trip_item_totalAllTime=array(
            "total" => $total
        );
 
        array_push($trips_arr["totalTripsAllTime"], $trip_item_totalAllTime);
    }
}

// get total number of trips in current month
/////////////////////////////////////////////
// query trips
$stmtTotalMonth = $trips->getTotalTripsMonth();
$numTotalMonth = $stmtTotalMonth->rowCount();
// check if more than 0 record found
if( $numTotalMonth > 0){
    $trips_arr["totalTripsMonth"]=array();
 
    // retrieve table contents
    while ($row = $stmtTotalMonth->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $trip_item_totalMonth=array(
            "total" => $total
        );
 
        array_push($trips_arr["totalTripsMonth"], $trip_item_totalMonth);
    }
}

// get total number of trips in current year
////////////////////////////////////////////
// query trips
$stmtTotalYear = $trips->getTotalTripsYear();
$numTotalYear = $stmtTotalYear->rowCount();
// check if more than 0 record found
if( $numTotalYear > 0){
    $trips_arr["totalTripsYear"]=array();
 
    // retrieve table contents
    while ($row = $stmtTotalYear->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $trip_item_totalYear=array(
            "total" => $total
        );
 
        array_push($trips_arr["totalTripsYear"], $trip_item_totalYear);
    }
}

// get total trips per driver for current month
////////////////////////////////////////////////
// query trips
$stmtPerMonth = $trips->getTripsForDriversPerMonth();
$numPerMonth = $stmtPerMonth->rowCount();
// check if more than 0 record found
if( $numPerMonth > 0){
    
    $trips_arr["recordsPerMonth"]=array();
 
    // retrieve table contents
    while ($row = $stmtPerMonth->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $trip_item_month=array(
            "driver" => $driver,
            "trip_num" => $trip_num,
            "trip_month" => $trip_month
        );
 
        array_push($trips_arr["recordsPerMonth"], $trip_item_month);
    }
}


// get total trips per driver for current year
///////////////////////////////////////////////
// query trips
$stmtPerYear = $trips->getTripsForDriversPerYear();
$numPerYear = $stmtPerYear->rowCount();
// check if more than 0 record found
if( $numPerYear > 0){
    
    $trips_arr["recordsPerYear"]=array();
 
    // retrieve table contents
    while ($row = $stmtPerYear->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $trip_item_year=array(
            "driver" => $driver,
            "trip_num" => $trip_num,
            "trip_year" => $trip_year
        );
 
        array_push($trips_arr["recordsPerYear"], $trip_item_year);
    }
}



// get total trips per driver in all time
/////////////////////////////////////////////////// 
// query trips
$stmtAllTime = $trips->getTripsForDriversAllTime();
$numAllTime = $stmtAllTime->rowCount();
// check if more than 0 record found
if($numAllTime>0){
    $trips_arr["recordsAllTimes"]=array();
 
    // retrieve table contents
    while ($row = $stmtAllTime->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $trip_item=array(
            "driver" => $driver,
            "trip_num" => $trip_num
        );
 
        array_push($trips_arr["recordsAllTimes"], $trip_item);
    }
 
    echo json_encode($trips_arr); 
}else{
    echo json_encode(
        array("message" => "No trips found.")
    );
}
?>