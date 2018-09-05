<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate trips object
include_once '../objects/trips.php';
 
$database = new Database();
$db = $database->getConnection();
 
$trip = new Trips($db);
 
// get posted data
//$data = json_decode(file_get_contents("php://input"));
// echo $data; exit;
// set product property values
//$trip->id = $data->id;
$trip->driver_reference = 1;
$trip->trip_date = date('Y-m-d H:i:s');
 
// create the trip for the specific driver
if($trip->create()){
    echo '{';
        echo '"message": "Trip was added."';
    echo '}';
}
 
// if unable to create the trip, tell the user
else{
    echo '{';
        echo '"message": "Unable to add trip."';
    echo '}';
}
?>