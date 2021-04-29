#!C:\Users\Nabaa\AppData\Local\Programs\Python\Python38/python.exe
print("Content-Type: text/html")
print()

import cgi     #for dealing with forms
import mysql.connector  #to connect to database
form=cgi.FieldStorage()
password=str(form.getvalue("newPass"))

if password=="None":
    redirectURL = "ChangePassword.php?isempty=Please Fill the blank"
    print('<meta http-equiv="refresh" content="0;url=' + str(redirectURL) + '" />')


else:
   state=1
   conn = mysql.connector.Connect(host="localhost", port="3306", user="root", password="", database="harms_db")
   cur = conn.cursor()
   cur.execute("UPDATE users SET password=%s,state=%s WHERE userName='Admin'",(password,state))

   conn.commit()
   cur.close()
   conn.close()
   redirectURL="ChangePassword.php?ischange=Password changed Successfully!!!"
   print('<meta http-equiv="refresh" content="0;url='+str(redirectURL)+'" />')

