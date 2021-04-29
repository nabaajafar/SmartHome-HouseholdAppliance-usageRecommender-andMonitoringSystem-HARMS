<?php
$host="127.0.0.1:3306";  // Change the port based on your server
$user="root";
$pwd=""; // Change the password based on your server
$db="harms_db";
$con= mysqli_connect($host, $user, $pwd, $db);

$query = "Update appliances set state = 1 where Appliance_id = 2";
mysqli_query($con, $query);
date_default_timezone_set("Asia/Riyadh");
$d0 = date("m/d/Y");
$t0 = date("h:i:s A");

$query1 = "Insert into usagepattern (StartDate, StartTime, EndDate, EndTime, Appliance_id, Appliance_Name, room_id, Room_Name) VALUES ('$d0', '$t0', 'a', 'a', 2, 'Fridge', 2, 'Kitchen')";
mysqli_query($con, $query1);
?>