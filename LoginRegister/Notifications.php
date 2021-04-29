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
 $stmt = $conn->prepare("SELECT result_id,state,
 Room_Name, Appliance_Name,date_format(Start,"%H:%M:%S") as time FROM result  ;");
 
//executing the query 
 $stmt->execute();
 

 //binding results to the query 
 $stmt->bind_result($result_id,$state, $Room_Name, $Appliance_Name ,$time);

$results = array(); 
 
 //traversing through all the result 
 while($stmt->fetch()){
 $temp = array();
 $temp['state'] = $state; 
 $temp['Room_Name'] = $Room_Name; 
 $temp['Appliance_Name'] = $Appliance_Name;
  $temp['time'] = $time;
    $temp['result_id'] = $result_id;
 array_push($results, $temp);
 }
 
 //displaying the result in json format 
 echo json_encode($results);

?>