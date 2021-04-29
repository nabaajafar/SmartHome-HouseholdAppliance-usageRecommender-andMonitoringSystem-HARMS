
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" >
      <link rel="stylesheet" type="text/css" href="css/style.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Smart Home-login</title>
  </head>
  <body class="bg-nav fit">


  <div  class="navbar-brand text-light h-75 d-inline-block p-2" ></div>


    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1 class="text-light display-4 mt-100 pt-5 " style="font-size:80px"><strong style="font-family: Times New Roman, Times, serif">Smart Home(HARMS):</strong>A Way to Live Comfortably and Reducing the Energy Consumption </h1>
            </div>
            <div class="col-md-4 pt-5 ">
                <div class="card mt-100 ">
                    <div class="card-body border rounded shadow-sm  " style="background-color:#f0f0f5; height:400px ">
                        <form class="form mt-2" action="LoginPage.py" method="post" name="Login">
                           <h3 class="text-center text-warning font-weight-bolder" style="font-size:40px;font-family: Times New Roman, Times, serif">Login</h3>

                            <label  style="font-family: Times New Roman, Times, serif;font-size:20px"> User Name: </label><br>
                            <input type="text"  class="form-control" name="username" id="username" ><br>
                             <label style=";font-family: Times New Roman, Times, serif;font-size:20px"> Password: </label><br>

                            <input type="password"  class="form-control" name="pass" id="pass"  ><br>
                        <input class="btn btn-warning btn-block fit" id="Login" type="submit" value="Login"  style="font-size:20px;font-family: Times New Roman, Times, serif color:#fff;

                           height: 50px;
                           padding:10px 15px;
                           text-decoration: none;
                           border-radius: 5px;
                           cursor: pointer;
                           box-shadow: 6px 6px 10px -4px rgba(0,0,0,0.75);">

                        </form>

<?php if(@$_GET['Emptyfield']==TRUE) {?>
                <div class="alert-light text-danger py-3" style="color: red"><?php echo @$_GET['Emptyfield'];?></div>
                <?php }?>

                 <?php if(@$_GET['notsuccess']==TRUE) {?>
                <div class="alert-light text-danger py-3" style="color: red"><?php echo @$_GET['notsuccess'];?></div>
                <?php }?>



                    </div>

                </div>

            </div>

        </div>


    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>

  </body>
</html>