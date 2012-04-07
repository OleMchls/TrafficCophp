<?php

require __DIR__ . '/../vendor/.composer/autoload.php';

use TrafficCophp\Client;

$client = new Client('127.0.0.1', 3542);
$client->publish('channel_two', 'A little test message from php client example');

$client->subscribe('channel_one', 'channel_two', 'channel_three');

while (true) {
	var_dump($client->receive());
	$client->receive(function($channel, $message) {
		var_dump(array(
			'channel' => $channel,
			'message' => $message
		));
	});
}
