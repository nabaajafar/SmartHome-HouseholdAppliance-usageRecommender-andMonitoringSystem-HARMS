import pandas as pd
from datetime import datetime

###############################################################
# read the file as dataframe
A_B_Sensor_df = pd.read_csv("A_B_Sensor_csv.csv")
A_B_Sensor_df = A_B_Sensor_df.iloc[:, 0:5]
print(A_B_Sensor_df)

device_ids = pd.read_csv("device_ids.csv")
time_diff = []

for i, rule in A_B_Sensor_df.iterrows():
    if ("--" not in rule['Start'] and "Start" not in rule['Start']):
        for j, devids in device_ids.iterrows():
            rule['Location'] = rule['Location'].replace(devids["Location"], str(devids["ID"]))
        start = datetime.strptime(rule['Start'] + " " + rule[1], '%Y-%m-%d %H:%M:%S')
        end = datetime.strptime(rule['End'] + " " + rule[3], '%Y-%m-%d %H:%M:%S')
        difference = end - start
        differenceseconds = difference.total_seconds()
        time_diff.append(differenceseconds)
        A_B_Sensor_df.at[i, 'Location'] = rule['Location']
        A_B_Sensor_df.at[i, 'seconds'] = differenceseconds
A_B_Sensor_df = A_B_Sensor_df.iloc[:, 4:6]
A_B_Sensor_df = A_B_Sensor_df.fillna(0)
print(A_B_Sensor_df)

by_hour = A_B_Sensor_df.groupby('Location')
data = {}

data['AVG Time'] = by_hour["seconds"].mean()
avgtimes = pd.DataFrame(data)

avgtimes.to_csv("device_avgtime.csv", header=True, index=True)
print(avgtimes)