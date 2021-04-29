#!C:\Users\Nabaa\AppData\Local\Programs\Python\Python38/python.exe
print("Content-Type: text/html")
print()

import cgi     #for dealing with forms
import mysql.connector  #to connect to database
form=cgi.FieldStorage()

app_name=str(form.getvalue("appname"))
roomid=str(form.getvalue("roomid"))

print(" <link rel='stylesheet' type='text/css' href='css/style.css'>")
print("<div class='loader fit'>")
print("<img src='img/load.gif' alt='Loading...' />")
print(
    "<h1 style='font-family: Times New Roman, Times, serif;font-size:50px;padding-top3:30px ;color:#b3b3b3'>Loading...</h1>")

if app_name=="None" or roomid=="None" :
    redirectURL = "AddAppliances.php?isempty=Please Fill the blank"
    print('<meta http-equiv="refresh" content="0;url=' + str(redirectURL) + '" />')
else:

    conn = mysql.connector.Connect(host="localhost", port="3306", user="root", password="", database="harms_db")
    cur = conn.cursor()

    cur.execute("SELECT room_id FROM rooms where room_id=" + roomid)

    a = 0
    for (room_id) in cur:
        a = 1

    cur.close()
    conn.close()

    if a == 1:
      conn = mysql.connector.Connect(host="localhost", port="3306", user="root", password="", database="harms_db")
      cur = conn.cursor()
      cur.execute("insert into appliances (Appliance_Name,room_id) values (%s,%s)", (app_name,roomid))

      conn.commit()
      cur.close()
      conn.close()

      redirectURL="AddAppliances.php?showPass=Data Added Successfully!!!"
      print('<meta http-equiv="refresh" content="0;url='+str(redirectURL)+'" />')

    if a == 0:
        redirectURL = "AddAppliances.php?err=There is no Room with "+roomid+" id!!!"
        print('<meta http-equiv="refresh" content="0;url=' + str(redirectURL) + '" />')