<?php

require __DIR__ . '/../vendor/.composer/autoload.php';

use TrafficCophp\Network\SocketTransport;
use TrafficCophp\Publisher\Publisher;
use TrafficCophp\Subscriber\Subscriber;
use TrafficCophp\Message\SubscribeMessage;
use TrafficCophp\Message\PublishMessage;
use TrafficCophp\Channel\ChannelCollection;
use TrafficCophp\Channel\Channel;
use TrafficCophp\Message\ServerMessage;

$_ENV['traffic_cop_host'] = '127.0.0.1';
$_ENV['traffic_cop_port'] = 3542;

$transport = new SocketTransport($_ENV['traffic_cop_host'], $_ENV['traffic_cop_port']);
$publisher = new Publisher($transport);
$channel = new Channel('channel_one');
$message = new PublishMessage($channel, 'Hey there, im a message');
$publisher->publish($message);