import gspread
import mysql.connector  #to connect to database
from oauth2client.service_account import ServiceAccountCredentials

from pprint import pprint
scope = ["https://spreadsheets.google.com/feeds","https://www.googleapis.com/auth/spreadsheets","https://www.googleapis.com/auth/drive.file","https://www.googleapis.com/auth/drive"]
#set our credential
creds=ServiceAccountCredentials.from_json_keyfile_name("harmSheet-3714bed046d2.json",scope)
client=gspread.authorize(creds)
sheet=client.open("Appliances").sheet1  #name of sheet & sheet number
#to fech the data
data=sheet.get_all_records()
conn = mysql.connector.Connect(host="localhost", port="3306", user="root", password="", database="harms_db")
cur = conn.cursor()


sheet.clear()
cur.execute('SELECT Appliance_Name, state, energy_consumption, energy_consumption_weekly, room_id FROM appliances')
rows = cur.fetchall()

for x in rows:
        insertrow=x
        print(insertrow)
        sheet.insert_row(insertrow)

sheet.insert_row(values=["Appliances","state","energy_consumption","energy_consumption_weekly","room_id"])
cur.close()
conn.close()