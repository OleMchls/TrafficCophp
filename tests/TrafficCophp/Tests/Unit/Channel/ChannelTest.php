<?php

namespace TrafficCophp\Tests\Unit\Channel;

use TrafficCophp\Channel\Channel;

class ChannelTest extends \PHPUnit_Framework_TestCase {

	public function testGetName() {
		$channel = new Channel('channel_one');
		$this->assertEquals('channel_one', $channel->getName());
	}

	public function testInvalidName() {
		$this->setExpectedException('TrafficCophp\\Channel\\InvalidChannelNameException');
		$channel = new Channel('channel,one');
	}

}