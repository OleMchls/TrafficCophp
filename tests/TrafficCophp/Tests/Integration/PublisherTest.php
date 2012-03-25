<?php

namespace TrafficCophp\Tests\Integration;

use TrafficCophp\Network\SocketTransport;
use TrafficCophp\Publisher\Publisher;
use TrafficCophp\Message\PublishMessage;
use TrafficCophp\Channel\Channel;

/**
 * Description of PublisherTest
 *
 * @author ole
 */
class PublisherTest extends \PHPUnit_Framework_TestCase {

	public function testPublish() {
		$transport = new SocketTransport($_ENV['traffic_cop_host'], $_ENV['traffic_cop_port']);
		$publisher = new Publisher($transport);
		$channel = new Channel('channel_one');
		$message = new PublishMessage($channel, 'Hey there, im a message');
		$publisher->publish($message);
	}

}