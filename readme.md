# tuppence-talk #

* Get the account balance from Starling
* Have I been paid yet?
* Tell me the dates of my monthly payments?

## Directions for running the project in docker ##

1. `cd laradock-tuppence-talk`
2. `sudo /etc/init.d/apache2 stop` 
3. `docker-compose up -d nginx postgres pgadmin` 
4. see http://localhost
5. run php in docker-compose exec workbench 

## Resources ##

* [starling PHP SDK](https://github.com/MoneyMeg/starling-php-sdk)

* https://course.buildachatbot.io

* Alexa/OAuth/Connect to Facebook: https://matchboxmobile.com/oauth-using-alexa

* https://web.telegram.org/#/im

## Todos ##

[ ] get end to end telegram/ngrok bot running where users can query balance
[ ] OAuth2 transaction using Laravel Passport to authenticate with Starling to get related client_id
[ ] Deploy code/container to VPS: http://bit.ly/2CZRYCh
[ ] Alexa set up with Account Linking and Voice Profile
