<!DOCTYPE html>
<html lang="en">
 <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" >
      <link rel="stylesheet" type="text/css" href="css/style.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Smart Home-AddRoom</title>
  </head>
<body class="back fit">
     <header class=" bg-nav d-flex flex-column flex-md-row align-items-center p-4 px-md-4  bg-body border-bottom shadow-sm">
         <img src="img/LOGO.png" class="img-fluid " height="30px" width="30px" >
         <h1 class="h3 my-0 me-md-auto fw-normal" style=" font-family: Times New Roman, Times, serif"><strong>HARMS Dashboard Setting</strong></h1>

    <a class="btn btn-warning btn-block text-light "style="
                           height: 45px;
                           border-radius: 5px;
                           cursor: pointer;
                           " href="index.php"><strong>LOGOUT</strong></a>


    </header>
<div  >
<a href="Setting.php" class="p-2 " ><img src="img/setting2.png" class="img-fluid " alt="setting_pic" style="width:50px; height: 50px"></a>
    <span  style="font-family: Times New Roman, Times, serif;font-size:30px;padding-top3:30px" class="mt-50 " ><-- Setting</span>
  <center> <div class="col-md-3">
               <div class="card mt-30 ">
                   <div class="card-body border rounded shadow-sm " style="background-color:#f0f0f5; height:310px ">
                        <form class="form mt-1" action="AddRoom.py" method="post" >
                           <h3 class="text-center text-warning font-weight-bolder" style="font-size:40px;font-family: Times New Roman, Times, serif">Add Room</h3>

                            <label  style="font-family: Times New Roman, Times, serif;font-size:20px"> Room Name: </label><br>
                            <input type="text"  class="form-control" name="roomName"><br>

                            <input  type="submit" value="Save" class="btn btn-warning btn-block fit" style="font-size:20px;font-family: Times New Roman, Times, serif color:#fff;
                           width:100px;
                           height: 50px;
                           padding:5px 15px;
                           text-decoration: none;
                           border-radius: 5px;
                           cursor: pointer;
                           box-shadow: 6px 6px 10px -4px rgba(0,0,0,0.75);">


                        </form><br>
                <?php if(@$_GET['showPass']==TRUE) {?>
                <div class="alert-light py-3 rounded" style="background-color: #d6f5d6 ; color: #196719"><?php echo @$_GET['showPass'];?></div>
                <?php }?>

                <?php if(@$_GET['isempty']==TRUE) {?>
                <div class="alert-light py-3 rounded" style="background-color: #ffcccc ;
                 color: #990000"><?php echo @$_GET['isempty'];?></div>
                <?php }?>


                    </div>

                </div>

            </div></center>
</div>
</body>
