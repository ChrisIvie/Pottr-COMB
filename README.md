# COMB by Pottr
Real time IP analysis/threat detection using the Virus Total and Shodan API. Included with a full web GUI and perfect for running in the background. 

## Installation
Right now this only runs on Ubuntu, any version. Git clone this repo, add Virus Total and Shodan API keys then run `./comb-start.sh`

## Virus Total API
Generating the Virus Total API keys: 
Login or create an account on Virus total, once logged in click on your name in the top right > API key.

You will place this key in virustotal-report.py. 

Note: This API is limited, 4 request per minute.


![Alt text](https://i.imgur.com/fa83tXm.png)

## Shodan API 

Head over to https://developer.shodan.io/, create an account and you will see 'Show API Key' at the top of the page, once you have the API key place it in shodan-report.py

## Web interface

![Alt text](https://i.imgur.com/7nelWAH.png)

PHP has a built in simple HTTP server, currently binded to 127.0.0.1:80 in  `./comb-start.sh` 

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change. (I know the Web interface is ugly, i'll be adjusting this) 

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)
