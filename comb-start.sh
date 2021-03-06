#!/bin/bash
read -p "Please enter Virus Total API Key: " vtapikey
sed -i "s/<APIKEY>/$vtapikey/" virustotal-report.py
echo "Key insearted into virustotal-report.py: " $vtapikey
read -p "Please enter Shodan API key: " shodanapikey
sed -i "s/<API KEY>/$shodanapikey/" shodan-report.py
echo "Key insearted into shodan-report.py"
pkill php
now=$(date +"%m_%d_%Y_%T")
egrep 'Failed password for invalid' /var/log/auth.log | awk '{print $13}' > pees.txt
# Remove duplicate IPs, sort by most login attempts, get the highest 75 login attempts
sort pees.txt | uniq -c | sort | tail -75 | awk '{print $(NF-0)}' > shortpees.txt
#mv shortpees.txt /root/failed-ssh-logins/
#Move old database into backup folder
mv ./pees.db ./db-backup/pees_$now.db
echo "Submitting IPs to Virus Total (This will take awhile)"
python3 ./virustotal-report.py 
sleep 3
echo 'Submitting IPs to Shodan'
python3 ./shodan-report.py 
#echo 'Starting COMB web interface'
php -S 127.0.0.1:8080 -t ./report &



