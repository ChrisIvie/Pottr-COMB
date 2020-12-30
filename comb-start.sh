#!/bin/bash
now=$(date +"%m_%d_%Y_%T")
egrep 'Failed password for invalid' /var/log/auth.log | awk '{print $13}' > pees.txt
# Remove duplicate IPs, sort by most login attempts, get the highest 75 login attempts
sort pees.txt | uniq -c | sort | tail -75 | awk '{print $(NF-0)}' > shortpees.txt
#mv shortpees.txt /root/failed-ssh-logins/
#Move old database into backup folder
mv ./pees.db ./db-backup/pees_$now.db
echo 'Submitting IPs to Virus Total (This will take awhile)'
python3 ./ip-report.py 
sleep 3
echo 'Submitting IPs to Shodan'
python3 ./ip-report-shodan.py 
echo 'Starting COMB web interface'
php -S 127.0.0.1:80 -t ./report &



