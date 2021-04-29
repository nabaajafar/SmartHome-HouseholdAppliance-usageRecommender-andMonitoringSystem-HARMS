import pandas as pd
import gspread
from oauth2client.service_account import ServiceAccountCredentials
from gspread_dataframe import set_with_dataframe
from gspread_dataframe import get_as_dataframe
from mlxtend.preprocessing import TransactionEncoder
from mlxtend.frequent_patterns import apriori
from mlxtend.frequent_patterns import association_rules




scope = ["https://spreadsheets.google.com/feeds", "https://www.googleapis.com/auth/spreadsheets",
         "https://www.googleapis.com/auth/drive.file", "https://www.googleapis.com/auth/drive"]
##set our credential
creds = ServiceAccountCredentials.from_json_keyfile_name("credd.json", scope)
client=gspread.authorize(creds)


# merge date of user1 and user2
data = data2 = ""

# Reading data from file1
with open(r'OrdonezA_Sensors.txt') as fp:
    data = fp.read()

# Reading data from file2
with open(r'OrdonezB_Sensors.txt') as fp:
    data2 = fp.read()

# Merging 2 files
# To add the data of file2
# from next line
data += "\n"
data += data2

print(data)

with open(r'A_B_Sensor_pch.txt', 'w') as fp:
    fp.write(data)
###############################################################

#Convert txt file into CSV

txt_file_read = open(r"A_B_Sensor_pch.txt", "r")
txt_file_write= open(r"A_B_Sensor_csv.csv", "w")

for line in txt_file_read:
    splitText = (line.split())
    split_by_comma = ','.join(splitText)
    print(split_by_comma)
    txt_file_write.write(split_by_comma +'\n')
txt_file_read.close()
txt_file_write.close()

###############################################################
#read the file as dataframe
A_B_Sensor_df = pd.read_csv("A_B_Sensor_csv.csv")
print(A_B_Sensor_df)

#set coulmns
A_B_Sensor_df.columns=['StartDate','StartTime','EndDate','EndTime','Location','Type','Place' ]
print(A_B_Sensor_df)

#Delete row 0
A_B_Sensor_df.drop([0],inplace = True)
#delete 'Type' column
A_B_Sensor_df.drop(["Type"], axis = 1, inplace = True)
print(A_B_Sensor_df)

###############################################################

#open Sensor sheet1 and set the previous dataframe to
print(client)
sheet_1 = client.open("Sensors").sheet1
set_with_dataframe(sheet_1, A_B_Sensor_df)
wks_df = get_as_dataframe(sheet_1)
df_date_loc = wks_df[['StartDate','Location']]
print(df_date_loc)

#group df_date_loc by startdate
patterns = pd.DataFrame(df_date_loc.groupby(['StartDate']).Location.unique().reset_index())
patterns.drop(38,inplace=True)
patterns.drop(0, inplace=True)
#Open Sensor sheet2 to append dataframeappend & get it
sheet_2 = client.open("Sensors").get_worksheet(1)
#set_with_dataframe(sheet_2,patterns,include_column_header=False)
df_pattern =get_as_dataframe(sheet_2,usecols=[1,2,3,4,5,6,7,8,9,10,11,12,13], has_header=False).dropna(axis=0,how='all').fillna('')
print(df_pattern)
###############################################################

# create boolean dataframe
#Transactionencoder is used to transform this dataset into a NumPy array.
pattern_lst= df_pattern.values.tolist() #convert the pattern to List
Encoder = TransactionEncoder() #Encoder object
Encoder_fit = Encoder.fit(pattern_lst).transform(pattern_lst) #fit() to learn the Encoder the unique labels on the dataset, transform() transforms the input dataset (a Python list of lists) into a one-hot encoded NumPy boolean array
pattern_logic = pd.DataFrame(Encoder_fit, columns=Encoder.columns_) # convert to df
pattern_logic.drop('',axis=1, inplace=True) #delete columns that refers to empty string ''
print(pattern_logic)

###############################################################
#Apply Apriori to generate frequent itemset
Freq_Itemset = apriori(pattern_logic, min_support=0.2, use_colnames=True)
print(Freq_Itemset)
###############################################################

#generate association rules
rules = association_rules(Freq_Itemset, metric="confidence", min_threshold=0.9)
rules.drop("leverage", axis=1, inplace=True)
rules.drop("conviction", axis=1, inplace=True)
rules.to_csv('assoc_rules.csv', header = True, index = False)
print(rules)

################################################################

