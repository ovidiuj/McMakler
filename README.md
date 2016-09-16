# Basic PHP and Symfony 2.8 test

Resources:
- [Requirements](https://github.com/OskHa/basic-symfony28-interview-test/tree/2.0_nasa)

Install & test:
- run composer install
- run chmod -R 777 app/cache/
- run chmod -R 777 app/logs/
- access the project with your favourite browser
    * for route `/`
      * you should see `{"hello":"world"}`
- run php app/console app:nasa-data
- access /neo/hazardous route
- access /neo/fastest route
- run php app/console test:command <ID>

