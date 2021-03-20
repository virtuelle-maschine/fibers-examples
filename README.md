Examples for using ext-fibers ([https://github.com/amphp/ext-fiber](https://github.com/amphp/ext-fiber)).

Initially run:
```shell
docker-compose run php-srv composer install 
```

Run an example with
```shell
docker-compose run php-srv php /var/www/html/src/<DIR>/<script>
```
e.g.
```shell
docker-compose run php-srv php /var/www/html/src/01-simple/sleep.php
```