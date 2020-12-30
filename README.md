# COMB by Pottr.io
Real time IP analysis/threat detection using the Virus Total and Shodan API. Included with a full web GUI and perfect for running in the background. 

Demo of Web interface: https://notgoogle.com/report/index.php

The results on the page above are real SSH login attempts to my public web server.

## Installation


Right now this only runs on Ubuntu, any version.
Note: This script requires PHP
 
1. Git clone this repo
2. Insert Virus Total API key into ` virustotal-report.py `.
3. Insert Shodan API key into `shodan-report.py` 
4. run `pip install -r requirements.txt`
5. run `./comb-start.sh`


## Virus Total API
Generating the Virus Total API keys: 
1. Login or create an account on Virus total
2. Once logged in click on your name in the top right > API key.

Note: This API is limited, 4 request per minute.


![Alt text](https://i.imgur.com/fa83tXm.png)

## Shodan API 
1. Head over to https://developer.shodan.io/ 
2. Create an account
3. you will see 'Show API Key' at the top of the page.

![Alt text](https://i.imgur.com/kDYS08W.png)

## Web interface

![Alt text](https://i.imgur.com/7nelWAH.png)

PHP has a built in simple HTTP server, currently binded to 127.0.0.1:80 in  `./comb-start.sh` 

Note: The web UI can be located in the ./report folder, currently 75 results are loaded in from the database, possiblily repeats. Each result "card" uses VT and Shodan analysis results. Green = Virus Total. Yellow = Shodan.

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change. (I know the Web interface is ugly, i'll be adjusting this) 

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)
