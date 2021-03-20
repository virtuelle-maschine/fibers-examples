<?php

// taken from: https://clue.engineering/2021/fibers-in-php
// how to run:
// docker-compose run php-srv php /var/www/html/src/01-simple/clue-example.php

require __DIR__ . "/../../vendor/autoload.php";

use function Amp\{async, await, delay};

class ResponseDummy
{
    public function getStatusCode(): int
    {
        return 200;
    }
}

function fetch(string $url): ResponseDummy
{
    delay(strstr($url, 'api') ? 2000 : 1000);
    return new ResponseDummy();
}

class UserRepository
{
    private static string $base1 = 'http://example.com/user/';
    private static string $base2 = 'http://api.example.org/user/';

    public static function checkUser(int $id): bool
    {
        $promise1 = async(fn() => fetch(self::$base1 . $id));
        $promise2 = async(fn() => fetch(self::$base2 . $id));

        $responses = await([$promise1, $promise2]);

        return $responses[0]->getStatusCode() === 200 && $responses[1]->getStatusCode() === 200;
    }
}

$time = microtime(true);
printf("Starting (%01.4f secs)\n", microtime(true) - $time);

if (UserRepository::checkUser(42)) {
    echo "User exists!\n";
}

printf("Done (%01.4f secs)\n", microtime(true) - $time);