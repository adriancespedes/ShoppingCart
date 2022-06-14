## Title
PHP Shopping cart Implementation

## Requirements
PHP v8.1 and composer

## Example Usage From Bash Console
$ composer install  
$ cd bin  
$ chmod 777 console  
$ ./console  

## Docker (You need to docker login before)
docker-compose up -d
docker exec -ti php-app bash
vendor/bin/phpunit -c . # Run unit tests
