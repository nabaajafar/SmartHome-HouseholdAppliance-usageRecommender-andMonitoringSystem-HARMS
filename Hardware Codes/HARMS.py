led1 =21
import mysql.connector
from gpiozero import MotionSensor
import RPi.GPIO as GPIO
import threading
import smbus
import time
from datetime import datetime
from datetime import date

today = date.today()
pir = MotionSensor(4)
GPIO.setmode(GPIO.BCM)
GPIO.setup(led1,GPIO.OUT)
#init Smbus
bus = smbus.SMBus(1)
address = 7

def check_state():
    while True:
        conn = mysql.connector.Connect(host="192.168.1.30", port="3306", user="root", password="", database="harms_db")
        cur = conn.cursor()
        
        state = cur.execute("select state from appliances where Appliance_id = 4")
        state = cur.fetchall()
        #print(state[0][0])
        if int(state[0][0]) == 0:
            GPIO.output(led1, True)
        elif int(state[0][0]) == 1:
            GPIO.output(led1, False)
        cur.close()
        conn.close()
threading.Thread(target=check_state).start()
        
def motions():
    while True:
        conn = mysql.connector.Connect(host="192.168.1.30", port="3306", user="root", password="", database="harms_db")
        cur = conn.cursor()
        
        
        pir.wait_for_motion()
       # print("Motion detected")
        cur.execute("update rooms set room_state = 1 where room_id = 2")
        conn.commit()

        pir.wait_for_no_motion()
      #  print("No Motion detected")
        cur.execute("update rooms set room_state = 0 where room_id = 2")
        conn.commit()
        
        cur.close()
        conn.close()
threading.Thread(target=motions).start()


def currents():
    flag = 0
    while True:
        conn = mysql.connector.Connect(host="192.168.1.30", port="3306", user="root", password="", database="harms_db")
        cur = conn.cursor()
        
        states = cur.execute("select state from appliances where Appliance_id = 4")
        states = cur.fetchall()     
        
        if int(states[0][0]) == 1:
            if flag == 0:
                dt = datetime.now()
                t = dt.strftime("%I:%M:%S %p")
                d = today.strftime("%m/%d/%Y")
                cur.execute("INSERT INTO usagepattern (StartDate, StartTime, EndDate, EndTime, Appliance_id, Appliance_Name, room_id, Room_Name) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)", (d, t, 'a', 'a', 4, 'Light',2, 'Kitchen'))
                conn.commit()
                flag = 1
                
            try:
                rep = bus.read_i2c_block_data(address, 0, 16)
                
                string = ""
                for i in range(0,4):
                    string += chr(rep[i])
                    cur.execute("update appliances set energy_consumption = energy_consumption +"+string+" where Appliance_id = 4")
                    conn.commit()
            except:
                continue
        else:
            if flag == 1:
                dt = datetime.now()
                t = dt.strftime("%I:%M:%S %p")
                d = today.strftime("%m/%d/%Y")
                cur.execute("Update usagepattern set EndDate= %s ,endTime= %s where Appliance_id = 4 and EndDate= 'a' and EndTime= 'a'",(d,t))
                conn.commit()
                flag = 0
        cur.close()
        conn.close()
threading.Thread(target=currents).start()

