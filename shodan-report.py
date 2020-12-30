import requests
import sys
import time
import json
import sqlite3
import os

counter = 0
# grep all failed logins from auth.log: egrep 'Failed password for invalid' /var/log/auth.log | awk '{print $13}' | uniq > failedips.txt
f = open("./shortpees.txt", "r")

db = 'pees.db'
conn = sqlite3.connect(db)
c = conn.cursor()
c.execute("CREATE TABLE shodanreport (id text, shodanurl json, server json, domains json, lastupdate json, countryname json, longitude json, latitude json, vulns json)")

for l in f:
    l = l.rstrip()
    shodankey = '<API KEY>'
    url = 'https://api.shodan.io/shodan/host/' + '%s' % l + '?key=' + shodankey
    print(url)
    params = {'apikey':'<APIKEY>' }
    time.sleep(12)
    response = requests.get(url, params=params)
    print(response)
    #Virus total API rate limits 4 requests per minute
    try:
        shodata = response.json()
        print(shodata['last_update'])

        print(shodata['data'][0]['domains'])
        print(shodata['data'][0]['data'])
        print(shodata['data'][1]['product'])
        print(shodata['data'][1]['data'])

        print(shodata['data']['timestamp'])
        #print(shodata['data'][1]['http']['redirects'])
        print(shodata['data'][1]['http']['server'])
        print(shodata['country_name'])

        print(shodata['ports'])
        print(shodata['last_update'])
        print(shodata['hostnames'])
        print(shodata['org'])
        print(shodata['longitude'])
        print(shodata['vulns'])

    except:
        pass
    

    print(l)
    #print(data['scan_date'])
    #print(data['scans'])
    #print(data['scan_id'])
    #print(data['permalink'])
    #print(data['filescan_id'])
    #print(data['positives'])
    #print(data['total'])
    #print(data['scans']['BitDefender'])
    #print(data['scans']['Kaspersky'])
    #print(data['scans']['Spamhaus'])
    #print(data['verbose_msg'])

    #print(data['detected_urls'][0]['url'])
    #print(data['resolutions'][0]['hostname'])
    #print(data['resolutions'][0]['last_resolved'])

    #print(data['detected_urls'])
    for k,v in shodata.items():
        try:
        #print(k)
        #print(v)
            c.execute("insert into shodanreport values (?, ?, ?, ?, ?, ?, ?, ?, ? )",
            [l, 
            json.dumps(url), 
            json.dumps(shodata['data'][0]['http']['server']), 
            json.dumps(shodata['data'][0]['domains']),
            json.dumps(shodata['last_update']), 
            json.dumps(shodata['country_name']), 
            json.dumps(shodata['longitude']), 
            json.dumps(shodata['latitude']),
            json.dumps(shodata['vulns'])])
            #[l, json.dumps(data['as_owner']), json.dumps(data['asn']), json.dumps(data['detected_urls']), json.dumps(data['resolutions']), json.dumps(data['undetected_urls']), json.dumps(data['verbose_msg'])])

            conn.commit()
            
            #conn.close()
        except KeyError:
            pass
        
        #print(*data.items(), sep='\n')
    #Save each response as IP.json
            
        

        
        
        #a_file = open("failed-ssh/json/" + str(counter) + ".json", "w")
        #json.dump(data, a_file, indent=4)
        #a_file.close()
counter += 100
        
conn.close()

    
            

