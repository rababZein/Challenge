<?php
class Trips{
 
    // database connection and table name
    private $conn;
    private $table_name = "trips";
 
    // object properties
    public $id;
    public $driver_reference;
    public $trip_date;

 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // get total number of trips  in all time
    function getTotalTripsAllTime(){    
        // select all query
        $query = "SELECT  count(id) as total 
                  FROM ". $this->table_name;
        // prepare query statement
        $stmt = $this->conn->prepare($query);    
        // execute query
        $stmt->execute();   
        return $stmt;
    }
 
    // get all trips per driver in all time
    function getTripsForDriversAllTime(){  
        // select all query
        $query = "SELECT driver_reference as driver, count( id ) as trip_num   
                  FROM " . $this->table_name.
                  " group by driver_reference ";
        // prepare query statement
        $stmt = $this->conn->prepare($query);    
        // execute query
        $stmt->execute();    
        return $stmt;
    }

    // get total number of trips in current month
    function getTotalTripsMonth(){  
        // select all query
        $query = "SELECT  count(id) as total                  
                  FROM ". $this->table_name ."  
                  where MONTH( trip_date ) = MONTH( current_date( ) )   
                  group by  MONTH(trip_date)";
        // prepare query statement
        $stmt = $this->conn->prepare($query);    
        // execute query
        $stmt->execute();   
        return $stmt;
    }

    // get total trips per driver for current month
    function getTripsForDriversPerMonth(){    
        // select all query
        $query = "SELECT driver_reference as driver, count( id ) as trip_num  , MONTH(trip_date) as trip_month 
                  FROM " . $this->table_name.
                  " where MONTH( trip_date ) = MONTH( current_date( ) )
                  group by driver_reference , MONTH(trip_date)";
        // prepare query statement
        $stmt = $this->conn->prepare($query);   
        // execute query
        $stmt->execute();    
        return $stmt;
    }

    // get total number of trips in current year
    function getTotalTripsYear(){   
        // select all query
        $query = "SELECT count(id) as total                
                  FROM ". $this->table_name ."   
                  where YEAR( trip_date ) = YEAR( current_date( ) )
                  group by  YEAR(trip_date)";
        // prepare query statement
        $stmt = $this->conn->prepare($query);   
        // execute query
        $stmt->execute();    
        return $stmt;
    }

    // get total number of trips per driver in this year
    function getTripsForDriversPerYear(){  
        // select all query
        $query = "SELECT driver_reference as driver, count( id ) as trip_num  , YEAR(trip_date) as trip_year 
                  FROM " . $this->table_name.
                  " where YEAR( trip_date ) = YEAR( current_date( ) )  
                  group by driver_reference , YEAR(trip_date)";
        // prepare query statement
        $stmt = $this->conn->prepare($query);    
        // execute query
        $stmt->execute();    
        return $stmt;
    }



    // create a new trip for specific driver in current date
    function create(){  
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                     driver_reference=:driver_reference, trip_date=:trip_date";    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        //$this->id=htmlspecialchars(strip_tags($this->id));
        $this->driver_reference=htmlspecialchars(strip_tags($this->driver_reference));
        $this->trip_date=htmlspecialchars(strip_tags($this->trip_date));
    
        // bind values
        //$stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":driver_reference", $this->driver_reference);
        $stmt->bindParam(":trip_date", $this->trip_date);

    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }
}
?>