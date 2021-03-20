<?php

// how to run:
// docker-compose run php-srv php /var/www/html/src/01-simple/sleep.php

require __DIR__ . "/../../vendor/autoload.php";

use function Amp\{async, await, delay};

for ($i = 1; $i < 4; ++$i) {
    print("\n$i. run:\n");
    $time = microtime(true);
    printf("Starting (%01.4f secs)\n", microtime(true) - $time);
    await([
        async(function () use ($time) {
            delay(1000);
            printf("Later (%01.4f secs)\n", microtime(true) - $time);
        }),
        async(function () use ($time) {
            delay(900);
            printf("First (%01.4f secs)\n", microtime(true) - $time);
        })
    ]);
    printf("Done (%01.4f secs)\n", microtime(true) - $time);
}