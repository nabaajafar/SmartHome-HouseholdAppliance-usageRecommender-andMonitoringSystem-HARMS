#!C:\Users\Nabaa\AppData\Local\Programs\Python\Python38/python.exe
print("Content-Type: text/html")
print()

import cgi     #for dealing with forms
import mysql.connector  #to connect to database
form=cgi.FieldStorage()

username=str(form.getvalue("username"))
#email=str(form.getvalue("email"))
password=str(form.getvalue("pass"))

conn = mysql.connector.Connect(host="localhost", port="3306", user="root", password="", database="harms_db")
cur = conn.cursor()

#cur.execute("insert into users (userName,email,password) values (%s,%s,%s)", (username, email, password))
cur.execute("SELECT userName,state FROM users WHERE userName=%s and password=%s ",(username,password))




ch=0
state_user=1
admin=0
for(userName,state) in cur:
    if state == 0:
        state_user = 0
    if userName=="Admin":
        admin=1
    print(" <link rel='stylesheet' type='text/css' href='css/style.css'>")
    print("<div class='loader fit'>")
    print("<img src='img/load.gif' alt='Loading...' />")
    print("<h1 style='font-family: Times New Roman, Times, serif;font-size:50px;padding-top3:30px ;color:#b3b3b3'>Loading...</h1>")
    ch = 1



cur.close()
conn.close()


if state_user == 0:#ask him to change password
    redirectURL="ChangePassword.php"
    print('<meta http-equiv="refresh" content="0;url=' + str(redirectURL) + '" />')
elif state_user==1 and admin==1:
    redirectURL = "Dashboard.php"
    print('<meta http-equiv="refresh" content="0;url='+str(redirectURL)+'" />')

else :
       redirectURL = "index.php?notsuccess=** Your Password or Username is not correct,please try again**"
       print('<meta http-equiv="refresh" content="0;url=' + str(redirectURL) + '" />')

