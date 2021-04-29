#!C:\Users\Nabaa\AppData\Local\Programs\Python\Python38/python.exe
print("Content-Type: text/html")
print()


print("<meta charset='utf-8'>")
print("<meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no' >")
print(" <link rel='stylesheet' type='text/css' href='css/style.css'>")
print(" <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1' crossorigin='anonymous'>")
print("<body class='back fit'>")
print("  <header class= ' bg-nav d-flex flex-column flex-md-row align-items-center p-4 px-md-4  bg-body border-bottom shadow-sm'>")
print(" <img src='img/LOGO.png' class='img-fluid'  height='30px' width='30px' >")
print("<h1 class='h3 my-0 me-md-auto fw-normal' style=' font-family: Times New Roman, Times, serif'><strong>HARMS Dashboard Setting</strong></h1>")
print("<a class='btn btn-warning btn-block text-light ' style='height: 45px;border-radius: 5px;cursor: pointer;' href='index.php'><strong>LOGOUT</strong></a>")
print("</header>")
print("<a href='Setting.php' class='p-2 ' ><img src='img/setting2.png' class='img-fluid ' alt='setting_pic' style='width:50px; height: 50px'></a>")
print("<span  style='font-family: Times New Roman, Times, serif;font-size:30px;padding-top3:30px' class='mt-50 ' ><-- Setting</span>")




import cgi     #for dealing with forms
import mysql.connector  #to connect to database
form=cgi.FieldStorage()



conn = mysql.connector.Connect(host="localhost", port="3306", user="root", password="", database="harms_db")
cur = conn.cursor()

cur.execute("SELECT Appliance_id,Appliance_Name,state,room_id FROM appliances ")


print("<br>")

print("<center><h1>Appliances Information</h1></center>")
print("<table style='border: 1px solid black' width=80% align=center bgcolor=#f0f0f5")
print("<tr><td style='font-family: Times New Roman, Times, serif;font-size:40px'><strong>ID</strong></td><td style='font-family: Times New Roman, Times, serif;font-size:40px'><strong> Appliance Name</strong></td><td style='font-family: Times New Roman, Times, serif;font-size:40px'><strong>state (on/off)</strong></td><td style='font-family: Times New Roman, Times, serif;font-size:40px'><strong>Room ID</strong></td><tr>")

for (Appliance_id,Appliance_Name,state,room_id ) in cur:
    print("<tr><td style='font-family: Times New Roman, Times, serif;font-size:30px'>",Appliance_id,"</td><td style='font-family: Times New Roman, Times, serif;font-size:30px'>",Appliance_Name,"</td><td style='font-family: Times New Roman, Times, serif;font-size:30px'>",state,"</td><td style='font-family: Times New Roman, Times, serif;font-size:30px'>",room_id,"</td></tr>")

print("</table>")
cur.close()
conn.close()
print("</body>")