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
