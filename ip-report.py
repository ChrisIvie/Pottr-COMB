#!/usr/bin/python3
import requests
import sys
import time
import json
import sqlite3
import os

counter = 0
# grep all failed logins from auth.log: egrep 'Failed password for invalid' /var/log/auth.log | awk '{print $13}' | uniq > failedips.txt
f = open("shortpees.txt", "r")

db = 'pees.db' #Store results from Virus Total in sqlite database
conn = sqlite3.connect(db)
c = conn.cursor()
c.execute("CREATE TABLE peesreport (id text, scandate json, scanid json, permalink json, filescan_id json, positives json, totalscans json, BitDefenderresult json, Kasperskyresult json, Spamhausresult json, verbosemsg json )")

for l in f:
    l = l.rstrip()
    url = 'https://www.virustotal.com/vtapi/v2/url/report'
    params = {'apikey':'<APIKEY>','allinfo': 'true' ,'resource':'%s' % l }
    time.sleep(16) #Virus total API rate limits 4 requests per minute
    response = requests.get(url, params=params)
    print(response) #print response 
    try:
        data = response.json()
    except:
        pass
    print(l)
    

    for k,v in data.items(): # For loop for JSON result, 
        try:
            c.execute("insert into peesreport values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )",
            [l, json.dumps(data['scan_date']), json.dumps(data['scan_id']), json.dumps(data['permalink']), json.dumps(data['filescan_id']), json.dumps(data['positives']), json.dumps(data['total']), json.dumps(data['scans']['BitDefender']), json.dumps(data['scans']['Kaspersky']), json.dumps(data['scans']['Spamhaus']), json.dumps(data['verbose_msg'])])

            conn.commit() 
        except KeyError:
            pass
        
        counter += 100 #This doesn't stop at 100.. fixing soon
conn.close()

    
            

