<!DOCTYPE html>
<html lang="en">
 <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" >
      <link rel="stylesheet" type="text/css" href="css/style.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Smart Home-chang password</title>
  </head>
<body class="back fit">

<div  >

  <center> <div class="col-md-6 p-2">
               <div class="card mt-50 ">
                   <div class="card-body border rounded shadow-sm " style="background-color:#f0f0f5; height:300px ">
                        <form class="form mt-2" action="ChangePassword.py" method="post" >
                           <h3 class="text-center text-warning font-weight-bolder" style="font-size:40px;font-family: Times New Roman, Times, serif">Change you Password</h3>

                            <label  style="font-family: Times New Roman, Times, serif;font-size:20px"> Enter new password: </label><br>
                            <input type="text"  class="form-control" name="newPass"><br>

                            <input  type="submit" value="Save" class="btn btn-warning btn-block fit" style="font-size:20px;font-family: Times New Roman, Times, serif color:#fff;
                           width:100px;
                           height: 40px;

                           text-decoration: none;
                           border-radius: 5px;
                           cursor: pointer;
                           box-shadow: 6px 6px 10px -4px rgba(0,0,0,0.75);">


                        </form><br>

<?php if(@$_GET['ischange']==TRUE) {?>

                <div class="alert-light py-3 rounded" style="background-color:#d6f5d6  ;
                 color: #196719"><?php echo @$_GET['ischange'];?></div>
 <script>
 setTimeout(function(){
      window.location.replace("Dashboard.php");

 },5000);
</script>
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

