<?php

namespace TrafficCophp\Tests\Integration;

use TrafficCophp\Network\SocketTransport;
use TrafficCophp\Subscriber\Subscriber;
use TrafficCophp\Message\SubscribeMessage;
use TrafficCophp\Channel\ChannelCollection;
use TrafficCophp\Channel\Channel;
use TrafficCophp\Message\ServerMessage;

class SubscriberTest extends \PHPUnit_Framework_TestCase {

	public function testSubscribeAndReceive() {
		$transport = new SocketTransport($_ENV['traffic_cop_host'], $_ENV['traffic_cop_port']);
		$subscriber = new Subscriber($transport);
		$channels = new ChannelCollection();
		$channels->addChannel(new Channel('channel_one'));
		$subscribeMessage = new SubscribeMessage($channels);
		$subscriber->subscribe($subscribeMessage);

		$test = new \TrafficCophp\Tests\Integration\PublisherTest();
		$test->testPublish();

		$subscriber->receive($message = new ServerMessage(new ChannelCollection()));

		$this->assertEquals('Hey there, im a message', $message->getMessage());
	}

}