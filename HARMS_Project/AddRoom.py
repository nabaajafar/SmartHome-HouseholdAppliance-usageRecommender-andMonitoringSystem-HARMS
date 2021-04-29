#!C:\Users\Nabaa\AppData\Local\Programs\Python\Python38/python.exe
print("Content-Type: text/html")
print()

import cgi     #for dealing with forms
import mysql.connector  #to connect to database
form=cgi.FieldStorage()
R=str(form.getvalue("roomName"))

print(" <link rel='stylesheet' type='text/css' href='css/style.css'>")
print("<div class='loader fit'>")
print("<img src='img/load.gif' alt='Loading...' />")
print(
    "<h1 style='font-family: Times New Roman, Times, serif;font-size:50px;padding-top3:30px ;color:#b3b3b3'>Loading...</h1>")

if R=="None":
    redirectURL = "AddRoom.php?isempty=Please Fill the blank"
    print('<meta http-equiv="refresh" content="0;url=' + str(redirectURL) + '" />')

else:
  conn = mysql.connector.Connect(host="localhost", port="3306",
                               user="root", password="", database="harms_db")
  cur = conn.cursor()
  cur.execute("insert into rooms (room_name)values('%s')" % (R))
  conn.commit()
  cur.close()
  conn.close()
  redirectURL="AddRoom.php?showPass=Data Added Successfully!!!"
  print('<meta http-equiv="refresh" content="0;url='+str(redirectURL)+'" />')