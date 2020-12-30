#!/bin/bash
now=$(date +"%m_%d_%Y_%T")
egrep 'Failed password for invalid' /var/log/auth.log | awk '{print $13}' > pees.txt
sort pees.txt | uniq -c | sort | tail -75 | awk '{print $(NF-0)}' > shortpees.txt
#mv shortpees.txt /root/failed-ssh-logins/
sleep 3
cp pees.txt /root/failed-ssh-logins/logs/pees_$now.txt
cp shortpees.txt /root/failed-ssh-logins/logs/shortpees_$now.txt
ls /root/failed-ssh-logins/ | grep shortpees
mv /var/www/pees.db /root/failed-ssh-logins/db-backup/pees_$now.db
/usr/bin/python3 /root/failed-ssh-logins/ip-report.py 
sleep 3
/usr/bin/python3 /root/failed-ssh-logins/ip-report-shodan.py 


