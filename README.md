# Official PHP client for TrafficCop

build status to come

This is the official PHP client for [TrafficCop](https://github.com/santosh79/traffic_cop/).
It provides a very simple client for basic usage but offers also very OO-Style usage.
Just see examples for that.

## Install

Installation should be done via [composer](http://packagist.org/).

```
{
    "require": {
        "nesQuick/TrafficCophp": "dev-master"
    }
}
```

## Example

You should have a llok into the examples folder.
A simple usage example could look like this

```php
<?php

require __DIR__ . '/../vendor/.composer/autoload.php';

use TrafficCophp\Client;

$client = new Client('127.0.0.1', 3542);
$client->publish('channel_two', 'A little test message from php client example');

$client->subscribe('channel_one', 'channel_two', 'channel_three');

while (true) {
	$client->receive(function($channel, $message) {
		printf('Got message "%s" on %s', $message, $channel);
	});
}
```

## ToDo's

* remove old ide docs
* write php doc
* cleanup use statements
* refactor channel collection

## License

Licensed under the MIT license.