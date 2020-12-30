# COMB by Pottr
Real time IP analysis/threat detection using the Virus Total and Shodan API. Included with a full web GUI and perfect for running in the background. 

## Installation


To use this tool please run the following command in your working folder:
 ```bash 
egrep 'Failed password for invalid' /var/log/auth.log | awk '{print $13}' 
```
Generating the Virus Total API keys: 
Login or create an account on Virus total, once logged in click on your name in the top right > API key.

Note: This API is limited, 4 request per minute.


![Alt text](https://i.imgur.com/fa83tXm.png)

Once you have replaced the API key in ip-scan.py you will simply run ``` python3 ip-scan.py ```

## Web interface

![Alt text](https://i.imgur.com/AICiY9c.png)


The failed ssh folder contains the web interface, you will usually place this folder in /var/www/html/ or wherever you have your website files hosted. 

Note: The script generates json files in /var/www/html/failed-ssh/json/



## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change. (I know the Web interface is ugly, i'll be adjusting this) 

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)
