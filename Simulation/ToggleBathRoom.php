<?PHP
                
                $host="127.0.0.1:3306";  // Change the port based on your server
                $user="root";
                $pwd=""; // Change the password based on your server
                $db="harms_db";
                $con= mysqli_connect($host, $user, $pwd, $db);
             
                    $query = " select * from rooms where room_id = 3";
                    $result = mysqli_query($con, $query);
                    $row = mysqli_fetch_row($result);
                    
                    if($row[2] == 0){  // 0 means no motion from db 
                        toggleToOn($con);  // true then change it to motion 
                    }else{
                        toggleToOff($con); // false then change it to no motion 
                    }
                     
                 
                function toggleToOn($con){
                    $query = "Update rooms set room_state = 1 where room_id = 3";
                     mysqli_query($con, $query);
                    echo 'Motion';  // keep the echo dont delete it .. its for changing the label on the btn 
                }
                function toggleToOff($con){
                   
                    $query = "Update rooms set room_state = 0 where room_id = 3";
                     mysqli_query($con, $query);
                    echo 'No Motion';   // keep the echo dont delete it .. its for changing the label on the btn 
                }
?>