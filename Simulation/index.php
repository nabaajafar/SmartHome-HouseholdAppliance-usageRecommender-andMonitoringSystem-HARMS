<!DOCTYPE html>

<html>
    <head>
        
        <meta charset="UTF-8">
        <title>HARMS Simulation</title>
        
        <style>
            #content{max-width: 1400px; margin: 0 auto}
            #HE{border-style: double; border-radius: 5px; width: 1000px ; position: absolute; margin-right:100px;}
            #CP{border-style: double; border-radius: 5px; position: absolute; margin-left: 1000px; width: 300px; height: 718px;}
            img{border-radius: 50%;}
            .container .checkmark:after {top: 9px; left: 9px; width: 8px; height: 8px; border-radius: 50%; background: white;}
            .deac{border-radius: 12px; background-color:blue; color: whitesmoke; width: 90px;height: 40px;font-weight: bold; margin-top: 270px; cursor: pointer; margin-left:400px; opacity: 0.6;}
            button:hover {box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19); border: 1px solid wheat;opacity: 1}
            h1{ text-align: center; font-family: Andalus;}
            P{font-family: Andalus}
            label{font-family: Andalus}
            #R1{background-image: url("Pic/1.jpg"); background-repeat: no-repeat; background-size: cover;}
            #R2{background-image: url("Pic/2.jpg"); background-repeat: no-repeat; background-size: cover;}
            #R3{background-image: url("Pic/3.jpg"); background-size: cover;background-repeat: no-repeat}
            #R4{background-image: url("Pic/4.jpg"); background-size: cover;background-repeat: no-repeat}
            
            table, th, td {border: 1px solid black;}
            tr:hover {background-color: #f5f5f5;}
            
            #rad1{position: absolute; margin-top: 130px; margin-left: 140px}
            #rad2{position: absolute; margin-left: 20px; margin-top:80px }
            #rad3{position: absolute; margin-top: 210px; margin-left: 270px}
            
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body>
                
        <?php 
                
                $roomsState = array(); // array that hold rooms initial state values from db 
                   
                $host="127.0.0.1:3306";  // Change the port based on your server
                $user="root";
                $pwd=""; // Change the password based on your server
                $db="harms_db";
                $con= mysqli_connect($host, $user, $pwd, $db);
                
                $query = " select * from rooms ";
                $result = mysqli_query($con, $query);
                while ($row = $result->fetch_assoc()) {
                   
                    if ($row['room_state']."" == "1" ){ // check wither there is motion or not
                        $row['room_state'] = "Motion";
                    }else{
                        $row['room_state'] = "No Motion";
                    }
                    array_push($roomsState , $row['room_state']."");
                   
                }


                $query0 = "select state from appliances where Appliance_id =1 ";
                $result0 = mysqli_query($con, $query0);

                $s = $result0->fetch_assoc();
                $tosterstate = $s['state'];

                $query2 = "select state from appliances where Appliance_id =2 ";
                $result2 = mysqli_query($con, $query2);

                $s2 = $result2->fetch_assoc();
                $refrigeratorstate = $s2['state'];

                $query3 = "select state from appliances where Appliance_id =3 ";
                $result3 = mysqli_query($con, $query3);

                $s3 = $result3->fetch_assoc();
                $microwavestate = $s3['state'];

                
                ?>
        <div id="content">
            
            <div id="HE" style="background-color:#fef9e7 ">
           <h1>Home Environment</h1> 
           <table style="width:100%; height: 100%">
               <tr>
                   <th>
                       <!-- Bed room -->
                        <div id="R1" class="room">
                            <button name="Motion" class="deac" value="0" onclick="Toggle()" > <?php echo $roomsState[0] // select the index based on db sequence?>   </button>
                        </div>

                
               </th>
               
               <th>
                   <!-- living room -->
               <div id="R2" class="room">

                   <button name="Motion4" class="deac" onclick="ToggleLivingroom()"><?php echo $roomsState[3] // select the index based on db sequence?></button>

               </div>
                   </th>
               </tr>
               
               <tr>
                   <th>
                       <!-- Kitchen -->
               <div id="R3" class="room">
                   <!-- Toster-->
                   <div id="rad1" >
                       <label class="container ra1">ON
                        <input id="R_Onbtn"  type="radio" name="radio" value="on" <?php echo ($tosterstate=='1'?' checked=checked':'');?> >
                    
                    </label>
                    <label class="container">OFF
                        <input id="R_Offbtn" type="radio" name="radio" value="off" <?php echo ($tosterstate=='0'?' checked=checked':'');?>>
                        <span class="checkmark"></span>
                    </label>
                   </div>
             
                   <!-- Refra-->
                   <div id="rad2">
                   <label class="container">ON
                        <input id="R1_Onbtn"  type="radio" name="radio1" value="on" <?php echo ($refrigeratorstate=='1'?' checked=checked':'');?> >
                        <span class="checkmark"></span>
                    </label>
                    <label class="container">OFF
                        <input id="R1_Offbtn" type="radio" name="radio1" value="off" <?php echo ($refrigeratorstate=='0'?' checked=checked':'');?> >
                        <span class="checkmark"></span>
                    </label>
                   </div>
                   
                   
                   <!-- microiven-->
                   <div id="rad3">
                   <label class="container" >ON
                        <input id="R2_Onbtn"  type="radio" name="radio2" value="on" <?php echo ($microwavestate=='1'?' checked=checked':'');?> >
                        <span class="checkmark"></span>
                    </label>
                    <label class="container">OFF
                        <input id="R2_Offbtn" type="radio" name="radio2" value="off" <?php echo ($microwavestate=='0'?' checked=checked':'');?> >
                        <span class="checkmark"></span>
                    </label>
                       </div>
                    <button name="Motion3" class="deac" onclick= "ToggleKitchin()"><?php echo $roomsState[1] // select the index based on db sequence?> </button> 
               </div>
                       </th>
                       
                       <th>
               <!-- Bathroom -->
               <div id="R4" class="room">
              
                <button name="Motion2" class="deac" onclick="Togglebathroom()"><?php echo $roomsState[2] // select the index based on db sequence?> </button> 
              
               </div>
                           </th>
               </tr>
          </table>
        </div>
        
        <div id="CP" style="background-color:#fef9e7 ">
           <h1>Control Panel</h1>
           <table style="width:100%; ">
               <tr style=" background-color:blueviolet; color: whitesmoke">
                   <th>Appliances</th>
                   <th>Location</th>
                   <th>State</th>
               </tr>
               <tr>
                   <th> 
                      <p>Toaster</p>
                   </th>
                   <th><p>Kitchen</p></th>
                   <th id="BoxVal1"><?php echo ($tosterstate=='1'?' On':'Off');?></th> 
               </tr>
               
               
               <tr>
                    
                   <th> 
                       <p>Refrigerator</p>
                   </th> 
                     <th><p>Kitchen</p></th>
                   <th id="BoxVal2"><?php echo ($refrigeratorstate=='1'?' On':'Off');?></th>  
               </tr>
               
               <tr>
                  
                   <th> 
                       <p>MicrowaveOven</p>
                   </th> 
                     <th><p>Kitchen</p></th>
                   <th id="BoxVal3"> <?php echo ($microwavestate=='1'?' On':'Off');?></th>  
               </tr>
           </table>
        </div>
            
      </div>
        
        <script>
            
            document.getElementById("R_Onbtn").addEventListener("click" , getValue);
            document.getElementById("R_Offbtn").addEventListener("click" , getValue);
            
            function getValue(){
               var onSelected = document.getElementById("R_Onbtn");
               if(onSelected.checked){
                   console.log("True");
                   document.getElementById("BoxVal1").innerHTML = "On";
                   $.ajax({url: "Toster.php" , success: function (result) { // this is AJAX request to request php code to run using JQuery 
                        
                    }})

               }
               else{
                    console.log("fall");
                    document.getElementById("BoxVal1").innerHTML = "Off"; 
                    $.ajax({url: "Tosteroff.php" , success: function (result) { // this is AJAX request to request php code to run using JQuery 
                        
                    }})
               }  
            }
            
            
    //
            
            document.getElementById("R1_Onbtn").addEventListener("click" , getValue1);
            document.getElementById("R1_Offbtn").addEventListener("click" , getValue1);
            
            function getValue1(){
               var onSelected = document.getElementById("R1_Onbtn");
               if(onSelected.checked){
                   console.log("True");
                   document.getElementById("BoxVal2").innerHTML = "On"
                   $.ajax({url: "Refrigerator.php" , success: function (result) { // this is AJAX request to request php code to run using JQuery 
                   }})
               }
               else{
                   console.log("fall");
                   document.getElementById("BoxVal2").innerHTML = "Off"
                   $.ajax({url: "Refrigeratoroff.php" , success: function (result) { // this is AJAX request to request php code to run using JQuery 
                   }})
               }

            }
            
   //
            
            
            document.getElementById("R2_Onbtn").addEventListener("click" , getValue2);
            document.getElementById("R2_Offbtn").addEventListener("click" , getValue2);
            
            function getValue2(){
               var onSelected = document.getElementById("R2_Onbtn");
               if(onSelected.checked){
                   console.log("True");
                   document.getElementById("BoxVal3").innerHTML = "On";
                   $.ajax({url: "Microwave.php" , success: function (result) { // this is AJAX request to request php code to run using JQuery 
                   }})
               }
               else{
                   console.log("fall");
                   document.getElementById("BoxVal3").innerHTML = "Off";
                   $.ajax({url: "Microwaveoff.php" , success: function (result) { // this is AJAX request to request php code to run using JQuery 
                   }})
               }  
            }
            
            
                
                <!--Bedroom-->
                 function Toggle(){
                    var btn = document.getElementsByName("Motion")[0] ;
                    $.ajax({url: "TogleBtn.php" , success: function (result) { // this is AJAX request to request php code to run using JQuery 
                        btn.innerHTML = result;
                    }})
                  }
                  <!-- Kitchen -->
                function ToggleKitchin(){
                    var btn1 = document.getElementsByName("Motion3")[0] ;
                    $.ajax({url: "ToggleKitchen.php" , success: function (result) { // this is AJAX request to request php code to run using JQuery 
                        btn1.innerHTML = result;
                    }})
                }
                
                
                
                <!--Bathroom-->
                function Togglebathroom(){
                    var btn2 = document.getElementsByName("Motion2")[0] ;
                    $.ajax({url: "ToggleBathRoom.php" , success: function (result) { // this is AJAX request to request php code to run using JQuery 
                        btn2.innerHTML = result;
                    }})
                }
                
                <!--Livingroom-->
                function ToggleLivingroom(){
                    var btn3 = document.getElementsByName("Motion4")[0] ;
                    $.ajax({url: "ToggleLivingRoom.php" , success: function (result) { // this is AJAX request to request php code to run using JQuery 
                        btn3.innerHTML = result;
                    }})
                }
   
        </script>
    </body>
</html>
