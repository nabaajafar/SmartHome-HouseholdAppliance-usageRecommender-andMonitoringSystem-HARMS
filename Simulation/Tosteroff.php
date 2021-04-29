<?php
$host="127.0.0.1:3306";  // Change the port based on your server
$user="root";
$pwd=""; // Change the password based on your server
$db="harms_db";
$con= mysqli_connect($host, $user, $pwd, $db);

$query = "Update appliances set state = 0 where Appliance_id = 1";
mysqli_query($con, $query);
date_default_timezone_set("Asia/Riyadh");
$d0 = date("m/d/Y");
$t0 = date("h:i:s A");

$query1 = "Update usagepattern set EndDate = '$d0', EndTime = '$t0'  where Appliance_id = 1 AND EndDate = 'a' AND EndTime = 'a'";
mysqli_query($con, $query1);

$q = "Select StartDate, StartTime, EndDate, EndTime from usagepattern where Appliance_id = 1 ";
$result = mysqli_query($con, $q);

$row= mysqli_fetch_assoc($result);

$date1 = date_create( $row['StartDate'] );
$date2 = date_create ( $row['EndDate'] );
$time1 = strtotime ( $row['StartTime'] );
$time2 = strtotime ( $row['EndTime'] );

$diffdate = date_diff($date1,$date2);
$difftime = $time2 - $time1; 

$secondsdate = (($diffdate->days * 24 * 60) + ($diffdate->h * 60) + $diffdate->i)*60;

$q1 = "Select energy_consumption from appliances where Appliance_id = 1 ";
$result1 = mysqli_query($con, $q1);

$row1= mysqli_fetch_assoc($result1);
$oldvalue = $row1['energy_consumption'];

$totalsecond = $secondsdate + $difftime + $oldvalue;

$query = "Update appliances set energy_consumption = $totalsecond where Appliance_id = 1";
mysqli_query($con, $query);
?>