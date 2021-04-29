<?php 

 //database constants
 define('DB_HOST', 'localhost');
 define('DB_USER', 'root');
 define('DB_PASS', '');
 define('DB_NAME', 'harms_db');
 
 //connecting to database and getting the connection object
 $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
 
 //Checking if any error occured while connecting
 if (mysqli_connect_errno()) {
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
 die();
 }
 
 //creating a query
 $stmt = $conn->prepare("SELECT Appliance_Name, Room_Name, state FROM result;");
 
 //executing the query 
 $stmt->execute();
 
 //binding results to the query 
 $stmt->bind_result($Appliance_Name, $Room_Name, $state );
 
 $cards = array(); 
 
 //traversing through all the result 
 while($stmt->fetch()){
 $temp = array();
if($state == 1){
 $temp['Action'] = 'ON'; 
 $temp['Room'] = $Room_Name; 
 $temp['Appliance'] = $Appliance_Name;
 
 array_push($cards, $temp);
}
else
{
 $temp['Action'] = 'OFF'; 
 $temp['Room'] = $Room_Name; 
 $temp['Appliance'] = $Appliance_Name;
 
 array_push($cards, $temp);
}
 }
 
 //displaying the result in json format 
 echo json_encode($cards);