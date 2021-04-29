#!C:\Users\Nabaa\AppData\Local\Programs\Python\Python38/python.exe
print("Content-Type: text/html")
print()

import cgi     #for dealing with forms
import mysql.connector  #to connect to database
form=cgi.FieldStorage()

sensor_name=str(form.getvalue("select_type"))
appid=str(form.getvalue("appid"))

print(" <link rel='stylesheet' type='text/css' href='css/style.css'>")
print("<div class='loader fit'>")
print("<img src='img/load.gif' alt='Loading...' />")
print(
    "<h1 style='font-family: Times New Roman, Times, serif;font-size:50px;padding-top3:30px ;color:#b3b3b3'>Loading...</h1>")


if sensor_name=="None" or appid=="None" :
    redirectURL = "AddSensors.php?isempty=Please Fill the blank"
    print('<meta http-equiv="refresh" content="0;url=' + str(redirectURL) + '" />')

else:


    conn = mysql.connector.Connect(host="localhost", port="3306", user="root", password="", database="harms_db")
    cur = conn.cursor()

    cur.execute("SELECT Appliance_id FROM appliances where Appliance_id="+appid)

    a=0
    for (Appliance_id) in cur:

        a=1

    cur.close()
    conn.close()
    if a==1:
        conn = mysql.connector.Connect(host="localhost", port="3306", user="root", password="", database="harms_db")
        cur = conn.cursor()
        cur.execute("insert into sensors (sensor_type,Appliance_id) values (%s,%s)", (sensor_name, appid))

        conn.commit()
        cur.close()
        conn.close()
        redirectURL = "AddSensors.php?showPass=Data Added Successfully!!!"
        print('<meta http-equiv="refresh" content="0;url=' + str(redirectURL) + '" />')

    if a==0:
        redirectURL = "AddSensors.php?err=There is no Appliance with"+appid+" id!!!"
        print('<meta http-equiv="refresh" content="0;url=' + str(redirectURL) + '" />')

print(sensor_name,appid)