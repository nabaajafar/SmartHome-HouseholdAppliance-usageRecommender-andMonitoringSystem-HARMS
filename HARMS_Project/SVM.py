from sklearn.model_selection import train_test_split
from sklearn.metrics import accuracy_score
from sklearn.svm import SVC
import numpy as np
import pandas as pd
import mysql.connector
import time
from datetime import datetime


device_ids = pd.read_csv("device_ids.csv")
device_times = pd.read_csv("device_avgtime.csv")


#####Get used devices from Database
mydb = mysql.connector.connect(
    host="127.0.0.1",
    user="root",
    password="",
    database="harms_db",
    port="3306"
)

mycursor = mydb.cursor()
query = "SELECT  str_to_date(StartDate,\"%m/%d/%Y\") day,Room_Name,GROUP_CONCAT(DISTINCT  Appliance_Name order by Appliance_Name asc SEPARATOR \",\") appliances_used FROM `usagepattern`   group by day, Room_Name order by day"
mycursor.execute(query)
myresult = mycursor.fetchall()

used_devices = myresult[0][2]
room_name = myresult[0][1]
try_in =[]

####Convert device names to ID
used_ids = used_devices
for j, devids in device_ids.iterrows():
    used_ids = used_ids.replace(devids["Location"], str(devids["ID"]))
try_in.append([])
for deviceid in used_ids.split(","):
    try_in[0].append(deviceid)
count = len(used_ids.split(","))
print(str(count)+" devices")

#### Make sure the array size of used devices same as the features size
while len(try_in[0])<8:
     try_in[0].append(0)



df_assc_Class = pd.read_csv("Basin.csv")
print("Features")
features =   np.array(df_assc_Class.iloc[:, 1:])
print(features)
####Data target
print("Target")
target = np.array(df_assc_Class.iloc[: , 0])
print(target)

####Train and test the SVM
x_train,x_test,y_train,y_test= train_test_split(features,target, test_size= 0.3)
svclassifier = SVC()
svclassifier = svclassifier.fit(x_train, y_train)
y_pred = svclassifier.predict(x_test)

acc_training = accuracy_score(y_train, svclassifier.predict(x_train))
print("Accuracy of training is %s" % (acc_training)+"\n")
acc = accuracy_score(y_test, y_pred)
print("Accuracy of test is %s" % (acc)+"\n")

####Predict recommended device from used devices
result_1= svclassifier.predict(try_in)
print("the class is ", result_1)

###Find the average time of the device.
for j, devtimes in device_times.iterrows():
    if(devtimes['Location'] == result_1):
        avgtime = devtimes["AVG Time"]
print(avgtime)

####Print the name of the devices
recommended = ""
for j, devids in device_ids.iterrows():
    if(devids['ID'] == result_1):
        recommended = devids["Location"]
print("Used:"+used_devices+", Recommended: "+ recommended+" Time: " + str(avgtime))

####add to results and update the state in database
mycursor = mydb.cursor()
mycursor.execute("INSERT INTO result SET Start = NOW(),End = DATE_ADD(NOW(), INTERVAL "+str(avgtime)+" second), state = 1, Room_Name = '"+room_name+"', Appliance_Name = '"+str(recommended)+"', Run_Time = "+str(avgtime))
mycursor.execute("UPDATE appliances SET state = 1 WHERE Appliance_Name = '"+str(recommended)+"'")
mydb.commit()


###checking the motion of an inhabitant in a house

while True:
    mycursor = mydb.cursor()
    query = "SELECT  * FROM `result` where Run_Time is not null and state = 1"
    mycursor.execute(query)
    results = mycursor.fetchall()

    for result in results:
        endtime = None
        room_name = result[2]
        device_name = result[3]
        if (result[6] is not None):
            endtime = result[6]  # datetime.strptime(result[6], '%Y-%m-%d %H:%M:%S')
        if (endtime is None or endtime <= datetime.now()):
            query = "select room_state from rooms where Room_Name = '" + room_name + "' limit 1"
            print(device_name + " in " + room_name + " needs to be turned off")
            mycursor.execute(query)
            rooms = mycursor.fetchall()
            state = rooms[0][0]
            print("Room State: " + str(state))
            if (endtime is None or state == 1):
                query = "update result set End = DATE_ADD(NOW(), INTERVAL " + str(
                    result[4]) + " second) where result_id = " + str(result[0])
                print("Someone in the room, checking after " + str(result[4]) + " secnonds")
            else:
                query = "update result set state = 0 where result_id = " + str(result[0])
                print("No one in th room, " + device_name + " is turned off")
            mycursor.execute(query)
            mydb.commit()
    time.sleep(1)

